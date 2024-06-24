<?php
require_once dirname(__DIR__). "/../inc/header.php";

if (isset($_SESSION['verified']) && $_SESSION['verified'] === false) {
    redirect("auth/verify.php");
    exit();
}
?>

    <section class="min-h-screen flex items-stretch text-white ">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center" style="background-image: url('<?= SITE_URL ?>files/images/boats/5.webp');">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="w-full px-24 z-10">
                <h1 class="text-5xl font-bold text-center tracking-wide">Keep it special</h1>
                <p class="text-3xl my-4">Capture your personal memory in unique way, anywhere.</p>
            </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url('<?= SITE_URL ?>files/images/boats/5.webp');">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
                <h1 class="my-6 text-3xl font-black">
                    LOGIN
                </h1>
                <form action="" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    <div class="pb-2 pt-4">
                        <input type="email" name="email" id="email" placeholder="Email" class="block w-full p-4 text-lg rounded-sm bg-black">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-sm bg-black" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="flex justify-between items-center text-blue-400">
                        <a href="#">Forgot your password?</a>
                        <a href="<?= SITE_URL ?>pages/auth/register.php">Register Now</a>
                    </div>
                    <div class="px-4 pb-2 pt-4">
                        <button class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php require_once dirname(__DIR__). "/../inc/footer.php"?>