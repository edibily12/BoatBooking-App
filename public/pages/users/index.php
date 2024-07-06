<?php

use App\Controllers\UsersController;

$users = UsersController::index();
?>
<div class="relative mb-4 overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex px-2 items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
        <div>
            Users
        </div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for users">
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-200 uppercase bg-gray-500">
        <tr>
            <th scope="col" class="p-4">
                #
            </th>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Email
            </th>
            <th scope="col" class="px-6 py-3">
                Phone
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>

        <tbody>
        <?php if(count($users) > 0): ?>
        <?php $sno = 1; ?>
            <?php foreach ($users as $user): ?>
                <tr class="bg-white border-b hover:bg-gray-100">
            <td class="w-4 p-4">
                <?= $sno++ ?>
            </td>
            <td class="px-6 py-4">
                <?= $user->firstname . " " . $user->lastname   ?>
            </td>
            <td class="px-6 py-4">
                <?= $user->email?>
            </td>
            <td class="px-6 py-4">
                <?= $user->phone?>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <?php if($user->verified): ?>
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Verified
                    <?php else: ?>
                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Pending
                    <?php endif; ?>
                </div>
            </td>
            <td class="px-6 py-4">
                <!-- Modal toggle -->
                <a href="#" type="button" data-modal-target="deleteUserModal" data-modal-show="deleteUserModal" class="font-medium text-red-600 ml-2 hover:underline">Delete</a>
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
        </tbody>
    </table>

    <!-- Edit user modal -->
    <div id="deleteUserModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Delete user
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editUserModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 text-center">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>