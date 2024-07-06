<?php

namespace App\Controllers;

use App\Models\LockedAccount;

class LockedController
{

    public static function index()
    {
        return LockedAccount::orderBy('id', 'desc')->get();
    }

    public static function unlock(): array
    {

        $locked = LockedAccount::all();
        if (count($locked) > 0) {
            foreach ($locked as $lock) {
                $lock->delete();
            }

            $deletedLocked = LockedAccount::onlyTrashed()->get();
            foreach ($deletedLocked as $locked) {
                $locked->forceDelete();
            }
            LogsController::create("All locked accounts were unlocked by: ". Auth::user()->email);
            return ['status' => true, 'message' => 'All accounts unLocked successfully!'];
        }

        LogsController::create("Unlocking locked accounts. by: ". Auth::user()->email. " but 0 result found");
        return ['status' => false, 'message' => 'No locked accounts found!'];
    }

}