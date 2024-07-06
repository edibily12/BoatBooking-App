<?php

use App\Controllers\Auth;

if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['action']) && $_POST['action'] === 'logout') {
//        $auth->logs("user logged out");
    logout();
}

?>

<div class="flex flex-col">
    <header class="flex justify-between  items-center h-16 py-4 px-6 bg-white">
        <!-- start::Mobile menu button -->
        <div class="flex items-center">
            <button
                @click="menuOpen = true"
                class="text-gray-500 hover:text-primary focus:outline-none lg:hidden transition duration-200"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            </button>
        </div>
        <!-- end::Mobile menu button -->

        <!-- start::Right side top menu -->
        <div class="flex items-center">

            <!-- start::Notifications -->
            <div>
                <!-- start::Main link -->
                <div>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="logout" >
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
                <!-- end::Main link -->
            </div>
            <!-- end::Notifications -->

        </div>
        <!-- end::Right side top menu -->
    </header>
</div>