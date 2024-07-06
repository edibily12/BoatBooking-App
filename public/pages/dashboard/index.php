<?php

use App\Controllers\Auth;

require_once dirname(__DIR__). "/../inc/auth-header.php";

?>
    <!-- Page Content -->
    <main class="py-12">
        <?php if(Auth::user()->role_id === \App\Models\User::ADMIN): ?>
            <?php require_once __DIR__ . "/../users/index.php"?>
        <?php else: ?>
            <?php require_once __DIR__ . "/../boats/index.php"?>
        <?php endif; ?>

    </main>
    <!-- end:Page content -->

<?php require_once dirname(__DIR__). "/../inc/auth-footer.php"?>