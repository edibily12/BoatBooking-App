<?php
use App\Controllers\Auth;use App\Models\User;
?>
<div>

    <aside
        :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
        class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 bg-gray-700 overflow-y-auto lg:translate-x-0 lg:inset-0 custom-scrollbar"
    >
        <!-- start::Logo -->
        <div class="flex gap-2 items-center justify-center bg-black bg-opacity-30 h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="#">
                    logo
                </a>
            </div>

            <h1 class="text-gray-100 text-lg font-bold uppercase tracking-widest">
                Click2Boat
            </h1>
        </div>
        <!-- end::Logo -->

        <!-- start::Navigation -->
        <nav class="py-10 custom-scrollbar">
            <?php if (Auth::user()->role_id !== User::ADMIN) : ?>
            <!-- start::Menu link -->
            <a
                href="<?= SITE_URL ?>pages/dashboard/index.php"
                class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
            >
                <span class="ml-3 transition duration-200">
                    Dashboard
                </span>
            </a>
            <!-- end::Menu link -->
            <p class="text-xs text-gray-500 mt-10 mb-2 px-6 uppercase">User</p>
            <!-- start::Menu link -->
            <a href="<?= SITE_URL ?>pages/schedules/index.php"
                class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
            >
                <span class="ml-3 transition duration-200">
                    Schedules
                </span>
            </a>
            <!-- end::Menu link -->

            <!-- start::Menu link -->
            <a href="<?= SITE_URL ?>pages/bookings/index.php"
                class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
            >
                <span class="ml-3 transition duration-200">
                    Booking
                </span>
            </a>
            <!-- end::Menu link -->

            <!-- start::Menu link -->
            <a href="<?= SITE_URL ?>pages/boats/index.php"
                class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
            >
                <span class="ml-3 transition duration-200">
                    Boats
                </span>
            </a>
            <!-- end::Menu link -->
            <?php endif; ?>


            <?php if (Auth::user()->role_id === User::ADMIN): ?>
            <!-- start::Menu link -->
            <a href="<?= SITE_URL ?>pages/logs/index.php"
                class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
            >
                <span class="ml-3 transition duration-200">
                    Logs
                </span>
            </a>
            <!-- end::Menu link -->
            <!-- start::Menu link -->
            <a href="<?= SITE_URL ?>pages/locked/index.php"
                class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
            >
                <span class="ml-3 transition duration-200">
                    Locked Accounts
                </span>
            </a>
            <!-- end::Menu link -->
            <?php endif; ?>

        </nav>
        <!-- end::Navigation -->
    </aside>

</div>