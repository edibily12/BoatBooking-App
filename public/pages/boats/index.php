<?php

use App\Controllers\Auth;
use App\Controllers\BoatsController;
use App\Models\User;
use App\Services\Encryption;

require_once dirname(__DIR__). "/../inc/auth-header.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    switch ($_POST["action"]) {
        case 'trashedBoat':
            $boats = BoatsController::index(true);
            break;
        case 'restoreBoat':
            BoatsController::restore($_POST['id']);
            $boats = BoatsController::index(true);
            break;
        case 'deleteBoatPermanently':
            BoatsController::deletePermanently($_POST['id']);
            $boats = BoatsController::index(true);
            break;
        default:
            $boats = BoatsController::index();
            break;
    }
}else{
    $boats = BoatsController::index();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === 'deleteBoat') {
    $boatStatus = BoatsController::destroy($_POST);

    if ($boatStatus['status']) {
        $success = $boatStatus['message'];
    } else {
        $error = $boatStatus['message'];
    }
}

?>
    <!-- Page Content -->
    <main class="py-12">
        <div class="relative mb-4 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex px-2 items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                <div>
                    Boats Available
                </div>
                <?php if (Auth::user()->role_id === User::MGR): ?>
                <div class="relative flex gap-4">
                    <form action="" method="post">
                        <input type="hidden" name="action" value="trashedBoat">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <button class="bg-yellow-700 py-2 px-6 text-gray-100">Trashed Boat</button>
                    </form>
                    <a href="<?= SITE_URL ?>pages/boats/create.php">
                        <button class="bg-blue-700 py-2 px-6 text-gray-100">ADD BOAT</button>
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (count($boats) > 0): ?>
                    <?php foreach ($boats as $boat): ?>

                        <!-- Boat Card 1 -->
                        <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                            <img src="<?= SITE_URL ?>files/images/boats/<?= $boat->image ?>" alt="Boat 1" class="w-full h-48 object-cover object-center">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                    <?= $boat->name ?>
                                </h3>
                                <p class="text-gray-600"><?= $boat->description ?></p>
                                <p class="text-gray-600">Capacity: <?= $boat->capacity ?></p>

                                <?php if (Auth::user()->role_id === User::MGR): ?>
                                    <?php if ($boat->trashed()): ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="action" value="restoreBoat">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($boat->id, ENT_QUOTES, 'UTF-8') ?>">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                                        <button type="submit" class="py-2.5 text-white my-2 px-6 bg-green-700 w-full">Restore</button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="action" value="deleteBoatPermanently">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($boat->id, ENT_QUOTES, 'UTF-8') ?>">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                                        <button type="submit" class="py-2.5 text-white my-2 px-6 bg-red-700 w-full">Delete Permanently</button>
                                    </form>
                                <?php else: ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="action" value="deleteBoat">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($boat->id, ENT_QUOTES, 'UTF-8') ?>">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                                        <button type="submit" class="py-2.5 text-white my-2 px-6 bg-red-700 w-full">Delete</button>
                                    </form>
                                <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?= SITE_URL ?>pages/boats/view.php?id=<?= Encryption::encrypt($boat->id) ?>">
                                        <button type="button" class="py-2.5 text-white my-2 px-6 bg-blue-700 w-full">View Boat</button>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="py-4 px-2">No data found</p>
                <?php endif; ?>
            </div>
        </div>

    </main>
    <!-- end:Page content -->

<?php require_once dirname(__DIR__). "/../inc/auth-footer.php"?>

<script>
    $("#error").delay(3000).slideUp(200, function() {
        // $(this).alert('close');
    });

    $("#success").delay(1000).slideUp(200, function() {
        window.location.href = window.location.href
    });
</script>
