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
    'name' => '',
    'capacity' => '',
    'description' => '',
    'image' => '',
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === 'createBoat') {
    $boatStatus = BoatsController::store($_POST, $_FILES);

    if ($boatStatus['status']) {
        $success = $boatStatus['message'];
    } else {
        $error = $boatStatus['message'];
        $oldValues = [
            'name' => $_POST['capacity'],
            'description' => $_POST['description'],
            'capacity' => $_POST['capacity'],
            'image' => $_FILES['image']['name'],
        ];
    }
}
?>
    <!-- Page Content -->
    <main class="py-12">
        <div class="relative bg-white mb-4 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex px-2 items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                <div>
                    Add Boats
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

            <form action="" method="post" class="mb-6 w-1/2 mx-auto" enctype="multipart/form-data">
                <input type="hidden" name="action" value="createBoat">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <div class="mb-6">
                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Boat Name</label>
                    <input type="text" value="<?= $oldValues['name'] ?>" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-4" required />
                </div>

                <div class="mb-6 w-full">
                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Capacity</label>
                    <input type="number" value="<?= $oldValues['capacity'] ?>" name="capacity" id="capacity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-4" required />
                </div>

                <div class="mb-6 w-full">
                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Description(optional)</label>
                    <textarea class="w-full" name="description" id="" cols="50" rows="5">
                            <?= $oldValues['description'] ?>
                        </textarea>
                </div>

                <div class="mb-6">
                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900 ">Boat Image</label>
                    <input type="file" value="<?= $oldValues['image'] ?>" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2" required />
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

