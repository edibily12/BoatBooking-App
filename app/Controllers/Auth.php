<?php

namespace App\Controllers;
use App\Models\LockedAccount;
use App\Models\User;
use App\Services\SecurityManager;
use Random\RandomException;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class Auth
{
    /**
     * @throws RandomException
     * @throws ConfigurationException
     * @throws TwilioException
     */
    public static function register($request)
    {
        $validToken = SecurityManager::validateCSRFToken($request['csrf_token']);
        if (!$validToken) {
            return ['status' => false, 'message' => 'Invalid CSRF token'];
        }

        if (empty($request['fname']) || empty($request['lname']) || empty($request['email']) || empty($request['phone']) || empty($request['password'])) {
            return ['status' => false, 'message' => 'All fields must be filled'];
        }

        if (strlen($request['phone']) < 10 || strlen($request['phone']) > 10) {
            return ['status' => false, 'message' => 'Invalid phone number'];
        }

        if (!SecurityManager::valid_email($request['email'])) {
            return ['status' => false, 'message' => 'Invalid email address'];
        }

        if ($request['password'] !== $request['password_confirmation']) {
            return ['status' => false, 'message' => 'Passwords do not match'];
        }

        if (strlen($request['password']) < 6) {
            return ['status' => false, 'message' => 'password must be at least 6 characters'];
        }

        // Check if the user already exists
        $user = User::where('email', $request['email'])->first();
        if ($user) {
            return ['status' => false, 'message' => 'User already exists'];
        }

        // Hash the password
        $hashedPassword = password_hash($request['password'], PASSWORD_BCRYPT);
        $code = random_int(10000, 99999);
//      SecurityManager::send($code);

        $sid    = "AC5fd7c4d975dcf5843e41b14a3dc6d7fc";
        $token  = "a33832466b561d19b8a944094ceac854";
        $twilio = new Client($sid, $token);

        $twilio->messages
            ->create("+255712321823",
                array(
                    "from" => "+16509104093",
                    "body" => "B-".$code." is your verification code."
                )
            );


        $user = User::create([
            'role_id' => 3,
            'firstname' => $request['fname'],
            'lastname' => $request['lname'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'code' => $code,
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

    public static function login($request) {
        $validToken = SecurityManager::validateCSRFToken($request['csrf_token']);

        if (!$validToken) {
            return ['status' => false, 'message' => 'Invalid CSRF token'];
        }

        if (empty($request['email']) || empty($request['password'])) {
            return ['status' => false, 'message' => 'All fields must be filled'];
        }

        // Check if account is locked
        if (SecurityManager::isAccountLocked($request['email'])) {
            $locked = LockedAccount::create([
                'email' => $request['email'],
            ]);

            if ($locked){
                return ['status' => false, 'message' => 'Account locked. Please try again later.'];
            }

            return ['status' => false, 'message' => 'Something went wrong. please try again.'];
        }

        // Find the user by email
        $user = User::where('email', $request['email'])->first();

        if ($user && password_verify($request['password'], $user->password)) {
            // Reset failed login attempts
            $_SESSION['failed_login_attempts'][$request['email']] = 0;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['role_id'] = $user->role_id;
            $_SESSION['email'] = $user->email;
            $_SESSION['login'] = true;

            redirect('dashboard/index.php');
            exit();
        }

        // Increment failed login attempts and lock account if necessary
        SecurityManager::incrementFailedLoginAttempts($request['email']);
        return ['status' => false, 'message' => 'Invalid email or password'];
    }

    //get logged in user
    public static function user()
    {
        return User::where('email', $_SESSION['email'])->first();
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
        redirect('auth/login.php');
        exit();
    }
}