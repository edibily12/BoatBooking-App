<?php

use App\Controllers\Auth;
use App\Controllers\BookingController;
use App\Controllers\LockedController;
use App\Controllers\LogsController;
use App\Controllers\SchedulesController;
use App\Models\Booking;
use App\Models\User;
use App\Services\Encryption;
use App\Services\Pagination;
use Carbon\Carbon;

require_once dirname(__DIR__). "/../inc/auth-header.php";
if ($_SESSION['role_id'] !== User::ADMIN) {
    LogsController::create("trying to access create schedules page through url while not authorized.");
    redirect("dashboard/index.php");
    exit();
}
$logs = LogsController::index();


?>
    <!-- Page Content -->
    <main class="py-12">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="table-fixed text-sm text-left rtl:text-right text-gray-500 w-full">
                <thead class="text-xs text-gray-700 uppercase">
                <tr class="border border-b-2 border-b-gray-500">
                    <th scope="col" class="w-8">
                        #
                    </th>
                    <th scope="col" class="px-6 w-1/2 max-w-[200px] py-3 bg-gray-300">
                        Action
                    </th>
                    <th scope="col" class="px-6 w-1/4 py-3">
                        Ip Address
                    </th>
                    <th scope="col" class="px-6 w-1/4 py-3">
                        User Agent
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($logs) > 0): ?>
                    <?php $sno = 1; ?>
                    <?php foreach ($logs as $log): ?>
                    <tr class="">
                    <td><?= $sno++ ?></td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 text-ellipsis bg-gray-300">
                        <?= $log->action ?>
                    </th>
                    <td class="px-6 py-4">
                        <?= $log->ip_address ?>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 text-ellipsis bg-gray-300">
                        <?= $log->user_agent ?>
                    </th>
                </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr class="bg-white border-b hover:bg-gray-100">
                        <td class="w-full p-4" colspan="6">
                            <p>No data found</p>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
<!--            --><?php //Pagination::links($logs) ?>
        </div>

    </main>
    <!-- end:Page content -->

<?php require_once dirname(__DIR__). "/../inc/auth-footer.php"?>


