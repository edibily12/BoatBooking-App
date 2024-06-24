<?php

use App\Controllers\Auth;

require_once dirname(__DIR__). "/../inc/header.php";

if (isset($_SESSION['verified']) && $_SESSION['verified'] === false) {
    redirect("auth/verify.php");
    exit;
}

//if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['role_id'] === 2) {
//    redirect("user-dashboard.php");
//    exit;
//}

$oldValues = [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'phone' => '',
    'password' => '',
    'password_confirmation' => '',
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === 'register') {
    $status = Auth::register($_POST);

    if ($status['status']) {
        $success = $status['message'];
    } else {
        $error = $status['message'];
        $oldValues = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'password' => $_POST['password'],
            'password_confirmation' => $_POST['password_confirmation'],
        ];
    }
}



?>

    <section class="min-h-screen flex items-stretch text-white ">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center" style="background-image: url('<?= SITE_URL ?>files/images/boats/1.webp');">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="w-full px-24 z-10">
                <h1 class="text-5xl font-bold text-center tracking-wide">Keep it special</h1>
                <p class="text-3xl my-4">Capture your personal memory in unique way, anywhere.</p>
            </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url('<?= SITE_URL ?>files/images/boats/1.webp');">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
                <h1 class="my-6 text-3xl font-black">
                    REGISTER
                </h1>

                <?php if (isset($error)): ?>
                    <div id="error" class="block sm:w-2/3 w-full px-4 lg:px-0 mx-auto p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center" role="alert">
                        <span class=""><?= $error ?></span>
                        <div class="flex justify-center items-center text-sm font-medium mt-2">
                            <svg aria-hidden="true" class="inline w-8 h-8 text-red-200 animate-spin dark:text-red-600 fill-red-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if (isset($success)): ?>
                    <div id="success" class="block sm:w-2/3 w-full px-4 lg:px-0 mx-auto p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 text-center" role="alert">
                        <span class=""><?= $success ?></span>
                        <div class="flex justify-center items-center text-sm font-medium mt-2">
                            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>


                <form action="" method="post" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    <input type="hidden" value="register" name="action">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <div class="flex gap-4">
                        <div class="pb-2 pt-4">
                            <input type="text" name="fname" value="<?= $oldValues['fname'] ?>" id="fname" placeholder="First Name" class="block w-full p-4 text-lg rounded-sm bg-black">
                        </div>
                        <div class="pb-2 pt-4">
                            <input class="block w-full p-4 text-lg  rounded-sm bg-black" type="text" name="lname" value="<?= $oldValues['lname'] ?>" id="password" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="pb-2 pt-4">
                        <input type="email" name="email" value="<?= $oldValues['email'] ?>" id="email" placeholder="Email" class="block w-full p-4 text-lg rounded-sm bg-black">
                    </div>

                    <div class="pb-2 pt-4">
                        <input type="number" name="phone" value="<?= $oldValues['phone'] ?>" id="phone" placeholder="Phone Number eg 07..." class="block w-full p-4 text-lg rounded-sm bg-black">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-sm bg-black" type="password" name="password" value="<?= $oldValues['password'] ?>"id="password" placeholder="Password">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-sm bg-black" type="password" name="password_confirmation" value="<?= $oldValues['password_confirmation'] ?>" id="password_confirm" placeholder="Confirm Password">
                    </div>
                    <div class="flex justify-between items-center text-blue-400">
                        <a href="#">Forgot your password?</a>
                        <a href="<?= SITE_URL ?>pages/auth/login.php">Login Now</a>
                    </div>
                    <div class="px-4 pb-2 pt-4">
                        <button type="submit" class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">REGISTER</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php require_once dirname(__DIR__). "/../inc/footer.php"?>
<script>
    $("#error").delay(3000).slideUp(200, function() {
        // $(this).alert('close');
    });

    $("#success").delay(5000).slideUp(200, function() {
        const siteUrl = "<?php echo SITE_URL; ?>";
        window.location.href=siteUrl + "pages/auth/verify.php"
    });
</script>
