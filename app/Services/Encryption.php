<?php

namespace App\Services;

class Encryption
{
    public static function encrypt($plaintext)
    {
        $key = base64_decode("Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=");
        $method = 'aes-256-cbc';
        $ivLength = openssl_cipher_iv_length($method);
        $strong = false;
        $iv = openssl_random_pseudo_bytes($ivLength, $strong);

        if ($iv === false || !$strong) {
            throw new \RuntimeException('Failed to generate a secure IV.');
        }

        $encrypted = openssl_encrypt($plaintext, $method, $key, 0, $iv);
        return base64_encode($encrypted . '::' . base64_encode($iv));
    }

    public static function decrypt($encrypted)
    {
        $key = base64_decode("Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=");
        $method = 'aes-256-cbc';
        list($encrypted_data, $iv) = explode('::', base64_decode($encrypted), 2);
        $iv = base64_decode($iv);
        return openssl_decrypt($encrypted_data, $method, $key, 0, $iv);
    }
}
