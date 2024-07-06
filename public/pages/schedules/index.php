<?php

use App\Controllers\Auth;
use App\Controllers\BookingController;
use App\Controllers\SchedulesController;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

require_once dirname(__DIR__). "/../inc/auth-header.php";
$schedules = SchedulesController::index();

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === 'book') {
    $booking = BookingController::store($_POST);

    if ($booking['status']) {
        $success = $booking['message'];
    } else {
        $error = $booking['message'];
    }
}else{
    $schedules = SchedulesController::index();
}

?>
    <!-- Page Content -->
    <main class="py-12">
        <div class="relative mb-4 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex px-2 items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                <div>
                    Schedules
                </div>
                <?php if (Auth::user()->role_id === User::MGR): ?>
                <div class="relative">
                    <a href="<?= SITE_URL ?>pages/schedules/create.php">
                        <button data-modal-show="addSchedule" class="bg-blue-700 py-2 px-6 text-gray-100">ADD SCHEDULE</button>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <?php if (isset($error)): ?>
                <div id="error" class="block w-full px-4 lg:px-0 mx-auto p-4 mb-4 text-red-800 rounded-lg bg-red-50 text-center" role="alert">
                    <span class=""><?= $error ?? null ?></span>
                </div>
            <?php endif; ?>


            <?php if (isset($success)): ?>
                <div id="success" class="block w-full px-4 lg:px-0 mx-auto p-4 mb-4 text-green-800 rounded-lg bg-green-50 text-center" role="alert">
                    <span class=""><?= $success ?? null ?></span>
                </div>
            <?php endif; ?>

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
                    <?php if(Auth::user()->role_id === User::USER): ?>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>
                <?php if(count($schedules) > 0): ?>
                    <?php $sno = 1; ?>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="w-4 p-4">
                                <?= $sno++ ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= Carbon::parse($schedule->day)->format('D, F j, Y') ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= Carbon::parse($schedule->scheddules_time)->format('H:i:s A') ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $schedule->boat->name?>
                            </td>

                                <?php
                                    $bookingExist = Booking::where('schedule_id', $schedule->id)
                                        ->where('user_id', Auth::user()->id)
                                        ->exists();
                                ?>
                                <!-- Modal toggle -->
                                <?php if(Auth::user()->role_id === User::USER): ?>
                                    <td class="px-6 py-4">
                                            <?php if ($bookingExist): ?>
                                                <p class="text-green-600 font-black">Booked</p>
                                            <?php else: ?>
                                            <button type="button" data-modal-target="bookBoat" data-modal-show="bookBoat"
                                                    class="font-medium text-blue-600 ml-2 hover:underline"
                                                    data-day="<?= Carbon::parse($schedule->day)->format('Y-m-d') ?>"
                                                    data-time="<?= Carbon::parse($schedule->schedules_time)->format('H:i:s A') ?>"
                                                    data-boat-id="<?= $schedule->boat->id ?>"
                                                    data-schedule-id="<?= $schedule->id ?>"
                                                    data-boat-name="<?= $schedule->boat->name ?>"
                                                    onclick="showScheduleDetails(this)">Book Now<button>
                                            <?php endif; ?>
                                    </td>
                                <?php endif; ?>

                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr class="bg-white border-b hover:bg-gray-100">
                        <td class="w-4 p-4" colspan="6">
                            <p>No data found</p>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <!-- Booking modal -->
            <div id="bookBoat" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <form action="" method="POST" class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Booking Details
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal()">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 text-center">
                            <p><strong>Day:</strong> <span id="modal-day"></span></p>
                            <p><strong>Time:</strong> <span id="modal-time"></span></p>
                            <p><strong>Boat:</strong> <span id="modal-boat"></span></p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                            <input type="hidden" name="action" value="book">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="day" id="input-day">
                            <input type="hidden" name="time" id="input-time">
                            <input type="hidden" name="boat" id="input-boat">
                            <input type="hidden" name="schedule_id" id="input-schedule-id">

                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- end:Page content -->

<?php require_once dirname(__DIR__). "/../inc/auth-footer.php"?>
<script>
    function showScheduleDetails(element) {
        const day = element.getAttribute('data-day');
        const time = element.getAttribute('data-time');
        const scheduleId = element.getAttribute('data-schedule-id');
        const boatName = element.getAttribute('data-boat-name');

        document.getElementById('modal-day').textContent = new Date(day).toDateString();
        document.getElementById('modal-time').textContent = time;
        document.getElementById('modal-boat').textContent = boatName;

        document.getElementById('input-day').value = day;
        document.getElementById('input-time').value = time;
        document.getElementById('input-boat').value = boatName;
        document.getElementById('input-schedule-id').value = scheduleId;

        const modal = document.getElementById('bookBoat');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('bookBoat');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    $("#error").delay(3000).slideUp(200, function() {
        // $(this).alert('close');
    });

    $("#success").delay(5000).slideUp(200, function() {
    });
</script>


