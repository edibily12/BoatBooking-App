<?php

use App\Controllers\Auth;
use App\Controllers\BookingController;
use App\Controllers\SchedulesController;
use App\Models\User;
use Carbon\Carbon;

require_once dirname(__DIR__). "/../inc/auth-header.php";
$bookings = BookingController::index();
$allBookings = BookingController::allBookings();
//dd($bookings);

?>
    <!-- Page Content -->
    <main class="py-12">
        <div class="relative mb-4 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex px-2 items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                <div>
                    Latest Booking
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-200 uppercase bg-gray-500">
                <tr>
                    <th scope="col" class="p-4">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 font-black">
                        Day
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Boat
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php if (Auth::user()->role_id === User::MGR) : ?>
                    <?php if(count($allBookings) > 0): ?>
                        <?php $sno = 1; ?>
                        <?php foreach ($allBookings as $booking): ?>
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <td class="w-4 p-4">
                                    <?= $sno++ ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= Carbon::parse($booking->schedule->day)->format('D, F j, Y') ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= Carbon::parse($booking->schedule->scheddules_time)->format('H:i:s A') ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $booking->schedule->boat->name?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="w-4 p-4" colspan="6">
                                <p>No data found</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
                </tbody>
            </table>


        </div>
    </main>
    <!-- end:Page content -->

<?php require_once dirname(__DIR__). "/../inc/auth-footer.php"?>


