<?php require_once __DIR__ . "/inc/header.php" ?>

<section id="home" class="bg-center bg-no-repeat bg-cover bg-[url('/files/images/boats/2.webp')] bg-gray-700 bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-48 lg:py-56">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Your Ultimate Boat Booking Experience</h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Discover and book the perfect boat for any occasion with our intuitive platform.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="#services" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Explore Services
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            <a href="<?= SITE_URL ?>pages/auth/register.php" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                Get Started
            </a>
        </div>
    </div>
</section>

<section id="about" class="bg-white py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">About Our Boat Booking App</h2>
        <p class="text-lg text-gray-700 leading-relaxed">
            Our boat booking app is designed to revolutionize the way people rent boats and organize events on water. We aim to provide a seamless booking experience with a wide range of boats to choose from, coupled with excellent customer service and support. Whether you're looking for a relaxing day on the water or planning a special event, our platform makes it easy and convenient.
        </p>
    </div>
</section>

<section id="services" class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Our Services</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Service 1: Boat Rental -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Boat Rental</h3>
                <p class="text-gray-600">Rent a variety of boats for different occasions and durations.</p>
            </div>

            <!-- Service 2: Online Booking -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Online Booking</h3>
                <p class="text-gray-600">Book your boat online with ease using our intuitive booking platform.</p>
            </div>

            <!-- Service 3: Crew Services -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Crew Services</h3>
                <p class="text-gray-600">Hire experienced crew members to accompany your boat rental.</p>
            </div>

            <!-- Service 4: Event Planning -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Event Planning</h3>
                <p class="text-gray-600">Plan and organize events on our boats, tailored to your needs.</p>
            </div>
        </div>
    </div>
</section>

<section id="boats" class="bg-white py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Boats Available</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Boat Card 1 -->
            <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                <img src="<?= SITE_URL ?>files/images/boats/1.webp" alt="Boat 1" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Boat Name 1</h3>
                    <p class="text-gray-600">$100,000</p>
                </div>
            </div>

            <!-- Boat Card 2 -->
            <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                <img src="<?= SITE_URL ?>files/images/boats/3.webp" alt="Boat 2" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Boat Name 2</h3>
                    <p class="text-gray-600">$150,000</p>
                </div>
            </div>

            <!-- Boat Card 3 -->
            <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                <img src="<?= SITE_URL ?>files/images/boats/4.webp" alt="Boat 3" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Boat Name 3</h3>
                    <p class="text-gray-600">$120,000</p>
                </div>
            </div>
            <!-- Boat Card 4 -->
            <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                <img src="<?= SITE_URL ?>files/images/boats/5.webp" alt="Boat 4" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Boat Name 3</h3>
                    <p class="text-gray-600">$120,000</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Contact Us</h2>
        <div class="max-w-md mx-auto">
            <form class="mb-6 text-left">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Your email</label>
                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="name@company.com" required />
                </div>
                <div class="mb-6">
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 ">Subject</label>
                    <input type="text" id="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Let us know how we can help you" required />
                </div>
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your message</label>
                    <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Your message..."></textarea>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block">Send message</button>
            </form>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

<?php require_once __DIR__ . "/inc/footer.php" ?>
