<?php use App\Controllers\Auth;
use App\Controllers\LogsController;

require_once __DIR__ . '/../../config/app.php';

if (!isset($_SESSION['login']) && $_SESSION['login'] === null) {
    LogsController::create("trying to access dashboard page through url while not logged in.");
    redirect("auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= SITE_URL ?>css/app.css">
    <title>Boat Booking</title>
</head>
<body class="bg-gray-100">

<div x-data="{ menuOpen: false }" class="flex min-h-screen custom-scrollbar">
    <!-- start::Black overlay -->
    <div :class="menuOpen ? 'block' : 'hidden'" @click="menuOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    <!-- end::Black overlay -->

    <!-- start::side bar-->
    <?php require_once __DIR__ . "/sidebar.php"; ?>
    <!-- end::side bar -->

    <div class="lg:pl-64 w-full flex flex-col">
        <!-- start::Topbar -->
        <?php require_once __DIR__ . "/navigation.php"; ?>
        <!-- end::Topbar -->

        <!-- start:Page content -->
        <div class="h-full bg-gray-200 p-8">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="flex w-full mx-auto py-6 px-1 sm:px-6 lg:px-8">
                    Welcome: <?= Auth::user()->firstname ?>
                </div>
            </header>
