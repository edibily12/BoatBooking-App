<?php

use App\Controllers\Auth;
use App\Controllers\BoatsController;
use App\Controllers\BookingController;
use App\Controllers\LogsController;
use App\Controllers\SchedulesController;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

require_once dirname(__DIR__). "/../inc/auth-header.php";
if ($_SESSION['role_id'] !== User::MGR) {
    LogsController::create("trying to access create schedules page through url while not authorized.");
    redirect("dashboard/index.php");
    exit();
}

$boats = BoatsController::index();

$oldValues = [
    'day' => '',
    'schedules_date' => '',
    'schedules_time' => '',
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === 'create') {
    $scheduleStatus = SchedulesController::stord($_POST);

    if ($scheduleStatus['status']) {
        $success = $scheduleStatus['message'];
    } else {
        $error = $scheduleStatus['message'];
        $oldValues = [
            'day' => $_POST['day'],
            'schedules_date' => $_POST['schedules_date'],
            'schedules_time' => $_POST['schedules_time'],
        ];
    }
}
?>
    <!-- Page Content -->
    <main class="py-12">
        <div class="relative bg-white mb-4 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex px-2 items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                <div>
                    Add Schedule
                </div>
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

            <form action="" method="post" class="mb-6 w-1/2 mx-auto">
                <input type="hidden" name="action" value="create">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <div class="mb-6">
                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Day</label>
                    <input type="date" value="<?= $oldValues['day'] ?>" name="day" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-4" required />
                </div>

                <div class="flex gap-4">
                    <div class="mb-6 w-full">
                        <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Schedule Date</label>
                        <input type="date" value="<?= $oldValues['schedules_date'] ?>" name="schedules_date" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-4" required />
                    </div>
                    <div class="mb-6 w-full">
                        <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Schedule Time</label>
                        <input type="time" value="<?= $oldValues['schedules_time'] ?>" name="schedules_time" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-4" required />
                    </div>
                </div>

                <div class="mb-6">
                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Boat</label>
                    <select name="boat_id" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-4">
                        <option value="">--Choose Boat--</option>
                        <?php foreach ($boats as $boat): ?>
                            <option value="<?= $boat->id ?>"><?= $boat->name     ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 mb-2 block">SUBMIT</button>
            </form>
        </div>
    </main>
    <!-- end:Page content -->

<?php require_once dirname(__DIR__). "/../inc/auth-footer.php"?>

<script>
    $("#error").delay(3000).slideUp(200, function() {
        // $(this).alert('close');
    });

    $("#success").delay(5000).slideUp(200, function() {
    });
</script>

