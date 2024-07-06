<?php
session_start();

use App\Controllers\Auth;
use App\Services\SecurityManager;

const SITE_URL = 'http://localhost:3000/';

function redirect($page) {
    $path = SITE_URL."pages/";
    header("Location: ".$path.$page);
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';
function dd($obj)
{
    print_r($obj);
    exit();
}

if (!isset($_SESSION['csrf_token'])) {
    $token = SecurityManager::generateCSRFToken();
    $_SESSION['csrf_token'] = $token;
}

//logout
function logout()
{
    session_unset();
    session_destroy();
    redirect('auth/login.php');
    exit();
}


