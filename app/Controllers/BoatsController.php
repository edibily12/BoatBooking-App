<?php

namespace App\Controllers;

use App\Models\Boat;
use App\Services\Encryption;
use App\Services\SecurityManager;
use http\Env\Request;

class BoatsController
{

    public static function index($trashed = false)
    {
        if ($trashed) {
            return Boat::onlyTrashed()->orderBy('capacity', 'desc')->get();
        }

        return Boat::orderBy('capacity', 'desc')->get();
    }

    public static function restore($id): array
    {
        if (empty($id)) {
            return ['status' => false, 'message' => 'Invalid request'];
        }

        $boat = Boat::onlyTrashed()->find($id);
        if ($boat) {
            $boat->restore();
        }
        LogsController::create("Boat ". $boat->name ." restored by ". Auth::user()->email);
        return ['status' => true, 'message' => 'Boat restored successfull'];

    }

    public static function deletePermanently($id): array
    {
        if (empty($id)) {
            return ['status' => false, 'message' => 'Invalid request'];
        }
        $boat = Boat::onlyTrashed()->find($id);
        if ($boat) {
            $boat->forceDelete();
        }
        LogsController::create("Boat ". $boat->name ." permanently deleted by ". Auth::user()->email);
        return ['status' => true, 'message' => 'Boat deleted permanently'];
    }

    public static function store($request, $file): array
    {

        //validate token
        $validToken = SecurityManager::validateCSRFToken($request['csrf_token']);

        if (!$validToken) {
            return ['status' => false, 'message' => 'Invalid CSRF token'];
        }

        if (empty($request['name']) || empty($request['capacity']) || empty($request['description']) || empty($file['image']['name'])){
            return ['status' => false, 'message' => 'Invalid request, all fields are required'];
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $fileType = $_FILES['image']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $newFileName = Encryption::encrypt(time().$fileName) . '.' . $fileExtension;

            // Check file size (e.g., max 2MB)
            if ($fileSize > 2 * 1024 * 1024){
                return ['status' => false, 'message' => 'File too large'];
            }

            // Allowed file types
            $allowed_ext = array('jpg', 'webp', 'gif', 'png', 'jpeg');
            if (!in_array($fileExtension, $allowed_ext)){
                return ['status' => false, 'message' => 'Invalid file extension'];
            }

            // Directory in which the uploaded file will be moved
            $uploadFileDir = dirname(__DIR__,2). "/public/files/images/boats/";
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = $newFileName;
                Boat::create([
                    'name' => $request['name'],
                    'capacity' => $request['capacity'],
                    'description' => $request['description'],
                    'image' => $imagePath,
                ]);
                LogsController::create("New boat created: name ". $request['name']);
            } else {
                return ['status' => false, 'message' => 'Failed to upload image'];
            }
        }

        return ['status' => true, 'message' => 'Boat created successfully'];
    }

    public static function destroy($request): array
    {
        $validToken = SecurityManager::validateCSRFToken($request['csrf_token']);
        if (!$validToken) {
            return ['status' => false, 'message' => 'Invalid CSRF token'];
        }

        if (empty($request['id'])) {
            return ['status' => false, 'message' => 'Invalid request'];
        }

        $boat = Boat::findOrFail($request['id']);
        if (!Boat::destroy($request['id']))
        {
            return ['status' => false, 'message' => 'Invalid request'];
        }

        LogsController::create("Boat ". $boat->name ." partially deleted by ". Auth::user()->email);
        return ['status' => true, 'message' => 'Boat deleted successfully'];
    }

    public static function show($request)
    {
        $id = Encryption::decrypt($request['id']);

        return Boat::findOrFail($id);
    }

}