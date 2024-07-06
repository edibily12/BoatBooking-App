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
if ($_SESSION['role_id'] !== User::USER) {
    LogsController::create("trying to access create schedules page through url while not authorized.");
    redirect("dashboard/index.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $boat = BoatsController::show($_GET);
}
?>
    <!-- Page Content -->
    <main class="py-4 bg-white">
        <div class="font-sans">
            <div class="p-4 w-full mx-auto">
                <div class="grid items-start grid-cols-1 lg:grid-cols-2 gap-6 max-lg:gap-12">
                    <div class="w-full lg:sticky top-0 sm:flex gap-2">
                        <img src="<?= SITE_URL ?>files/images/boats/<?= $boat->image ?>" alt="Product" class="w-full rounded-md object-cover" />
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Boat name: <?= $boat->name ?></h2>
                        <div class="flex flex-wrap gap-4 mt-4">
                            <p class="text-gray-800 text-xl font-bold">Capacity: <?= $boat->capacity ?> People</p>
                        </div>

                        <div class="flex space-x-2 mt-4">
                            <?php for($i = 0; $i < random_int(1,5); $i++): ?>
                                <svg class="w-5 fill-blue-600" viewBox="0 0 14 13" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                </svg>
                            <?php endfor; ?>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-gray-800">Schedules</h3>
                            <ul class="space-y-3 list-disc mt-4 pl-4 text-sm text-gray-800">
                                <?php if (count($boat->schedules) > 0): ?>
                                    <?php foreach ($boat->schedules as $schedule): ?>
                                        <li>
                                            Date: <strong><?= Carbon::parse($schedule->schedules_date)->format('D, F j, Y') ?></strong>
                                            Time: <strong><?= Carbon::parse($schedule->schedules_time)->format('H:i A') ?></strong>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>
                                        No schedules found.
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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

