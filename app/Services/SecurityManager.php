<?php

namespace App\Services;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SecurityManager
{
    public static function isAccountLocked($email) {
        $failedAttempts = isset($_SESSION['failed_login_attempts'][$email]) ? $_SESSION['failed_login_attempts'][$email] : 0;
        return $failedAttempts >= 3;
    }

    public static function incrementFailedLoginAttempts($email) {
        // Increment failed login attempts
        $_SESSION['failed_login_attempts'][$email] = isset($_SESSION['failed_login_attempts'][$email]) ? $_SESSION['failed_login_attempts'][$email] + 1 : 1;
    }

    public static function generateCSRFToken() {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
    }

    public static function valid_email($email) {
        // Check for presence of '@'
        if (strpos($email, '@') === false) {
            return false;
        }

        // Split into local and domain parts
        list($localPart, $domainPart) = explode('@', $email, 2);

        // Check for presence of '.' in domain part
        if (strpos($domainPart, '.') === false) {
            return false;
        }

        // Validate local part with more comprehensive regex
        if (!preg_match('/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+$/', $localPart)) {
            return false;
        }

        // Validate domain part with more comprehensive regex
        if (!preg_match('/^[a-zA-Z0-9.-]+$/', $domainPart)) {
            return false;
        }

        // Ensure the domain part does not start or end with a dot and does not have consecutive dots
        if (preg_match('/(^\.|\.\.|\. $)/', $domainPart) || $domainPart[0] === '.' || $domainPart[strlen($domainPart) - 1] === '.') {
            return false;
        }

        return true;
    }


    /**
     * @throws TwilioException
     * @throws ConfigurationException
     */
    public static function send($code)
    {
        $sid    = "AC006f6d47282f2aa8b767167a072eae6c";
        $token  = "d16ccff9f67e01f63600fed84e97e953";
        $twilio = new Client($sid, $token);

        $verification_check = $twilio->verify->v2->services("VA5bb68b6e1608697a872013b99066cdc9")
            ->verificationChecks
            ->create([
                    "to" => "+255620826701",
                    "code" => $code
                ]
            );

//        print($verification_check->sid);
    }



}