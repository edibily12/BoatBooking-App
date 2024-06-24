<?php


namespace App\Controllers;
use App\Models\User;
use App\Services\SecurityManager;

class Auth
{
    public static function register($request)
    {
        $validToken = SecurityManager::validateCSRFToken($request['csrf_token']);
        if (!$validToken) {
            return ['status' => false, 'message' => 'Invalid CSRF token'];
        }

        if (empty($request['fname']) || empty($request['lname']) || empty($request['email']) || empty($request['phone']) || empty($request['password'])) {
            return ['status' => false, 'message' => 'All fields must be filled'];
        }

//        if (strlen($request['phone']) < 10 || strlen($request['phone']) > 10) {
//            return ['status' => false, 'message' => 'Invalid phone number'];
//        }

        if (!SecurityManager::valid_email($request['email'])) {
            return ['status' => false, 'message' => 'Invalid email address'];
        }

        if ($request['password'] !== $request['password_confirmation']) {
            return ['status' => false, 'message' => 'Passwords do not match'];
        }

        // Check if the user already exists
        $user = User::where('email', $request['email'])->first();
        if ($user) {
            return ['status' => false, 'message' => 'User already exists'];
        }

        // Hash the password
        $hashedPassword = password_hash($request['password'], PASSWORD_BCRYPT);

        $user = User::create([
            'role_id' => 3,
            'firstname' => $request['fname'],
            'lastname' => $request['lname'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'code' => 12345,
            'password' => $hashedPassword,
        ]);

        if (!$user){
            return ['status' => false, 'message' => 'Registration failed, please try again.'];
        }

        $_SESSION['id'] = $user->id;
        $_SESSION['verified'] = false;

        return ['status' => true, 'message' => 'Registration successfully. please check your phone number for a verification code.'];
    }

    public static function verify($request)
    {
        // Fetch the user from the database
        $user = User::findOrFail($request['id']);

        if (!$user) {
            return ['status' => false, 'message' => 'User not found'];
        }

        // Check if the user is already verified
        if ($user->verified) {
            return ['status' => false, 'message' => 'Account is already verified'];
        }

        // Check if the verification code matches
        if ($user->code === (int)$request['code']) {
            // Update the user's verification status
            $user->update(['verified' => true]);
            $user->verified = true;
            $user->save();

            $_SESSION['role_id'] = $user->role_id;
            $_SESSION['verified'] = true;

            return ['status' => true, 'message' => 'Account verified successfully'];
        }

        return ['status' => false, 'message' => 'Invalid verification code'];
    }
}