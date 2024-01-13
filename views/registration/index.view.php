<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative w-full px-6 pt-10 pb-8 mx-auto bg-white shadow-xl ring-1 ring-gray-900/5 sm:rounded-xl sm:px-10">
            <div class="w-full">
                <div class="text-center">
                    <h1 class="text-3xl font-semibold text-gray-900">Register</h1>
                    <p class="mt-2 text-gray-500">Create a new account</p>
                </div>
                <div class="mt-5">
                    <form action="/register" method="post">
                        <div class="relative mt-6">
                            <input type="text" name="email" id="email" value="<?= old('email'); ?>" placeholder="Email Address" class="w-full px-0 py-1 mt-1 border-b-2 border-gray-300 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                            <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Email Address</label>

                        </div>
                        <span class="text-sm text-red-500"><?= $errors['email'] ?? $errors['username_taken'] ?? '' ?> </span>
                        <div class="relative mt-6">
                            <input type="password" name="password" id="password" placeholder="Password" class="w-full px-0 py-1 mt-1 border-b-2 border-gray-300 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                            <label for="password" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Password</label>
                        </div>
                        <span class="text-sm text-red-500"><?= $errors['password'] ?? '' ?></span>
                        <div class="relative mt-6">
                            <input type="text" name="firstname" value="<?= old('firstname'); ?>" id="firstname" placeholder="First name" class="w-full px-0 py-1 mt-1 border-b-2 border-gray-300 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                            <label for="firstname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">First Name</label>
                        </div>
                        <span class="text-sm text-red-500"><?= $errors['firstname'] ?? '' ?></span>
                        <div class="relative mt-6">
                            <input type="text" name="lastname" value="<?= old('lastname'); ?>" id="lastname" placeholder="First name" class="w-full px-0 py-1 mt-1 border-b-2 border-gray-300 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                            <label for="lastname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Last Name</label>
                        </div>
                        <span class="text-sm text-red-500"><?= $errors['lastname'] ?? '' ?></span>
                        <div class="relative mt-6">
                            <input type="text" name="phone" value="<?= old('phone'); ?>" id="phone" placeholder="First name" class="w-full px-0 py-1 mt-1 border-b-2 border-gray-300 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                            <label for="phone" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Phone Number</label>
                        </div>
                        <span class="text-sm text-red-500"><?= $errors['phone'] ?? '' ?></span>
                        <div class="my-6">
                            <button type="submit" class="w-full px-3 py-4 text-white bg-black rounded-md focus:bg-gray-600 focus:outline-none">Register</button>
                        </div>
                        <p class="text-sm text-center text-gray-500">
                            Already have an account?
                            <a href="/login"
                                class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">Login now</a> or <a href="/reset-password" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">reset your password</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>       
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>