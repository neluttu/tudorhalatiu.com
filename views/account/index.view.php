<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-main-color [&>a:hover]:border-b [&>a:hover]:border-main-color">
        <? require base_path('views/account/menu.view.php') ?>
    </div>
    
    <div class="w-full md:grow">
        <p class="mb-2 text-xl font-semibold text-main-color">Ești clientul magazinului din data de <?= roDate($user['created_at']) ?> </p>
        <p class="text-lg">Acestea sunt datele contului de client:</p>
        <div class="p-2 py-3 mt-5 border rounded-md empty:hidden font-lighter border-rose-400 bg-rose-50"><? if(isset($errors)) : foreach ($errors as $error) : ?>
            <p class="text-sm text-main-color"><?= $error; ?></p>
        <? endforeach; endif ?></div>
        <form method="post" class="w-full">
            <input type="hidden" name="_method" value="PATCH" />
            <div class="grid w-full grid-cols-1 mt-10 sm:grid-cols-2 gap-x-4 gap-y-3">
                <span class="self-center">
                    Adresa ta de email
                    <small class="block text-gray-500">Ea nu se poate edita, reprezintă numele tău de utilizator și de acces în magazin.</small>
                </span>
                <div class="relative self-center">
                    <input type="text" name="email" id="email" value="<?= $user['email'] ?>" readonly class="w-full px-0 py-2 mt-1 text-right border-b-2 border-gray-200 focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                </div>
                <div class="w-full col-span-1 sm:col-span-2"></div>
                <span class="self-center">
                    Numele tău
                    <small class="block text-gray-500">Poți schimba numele de client din această secțiune</small>
                </span>
                <div class="relative flex items-center self-center justify-center gap-4">
                    <input type="text" name="lastname" required id="lastname" value="<?= $user['lastname']?>" placeholder="Numele tău" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <input type="text" name="firstname" required id="firstname" value="<?= $user['firstname']?>" placeholder="Prenumele tău" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                </div>
                <div class="w-full col-span-1 sm:col-span-2"></div>
                <span class="self-center">
                    Număr de telefon
                    <small class="block text-gray-500">La care te putem contacta pentru comenzile tale.</small>
                </span>
                <div class="relative self-center">
                    <input type="text" name="phone" required id="phone" value="<?= $user['phone']?>" class="w-full px-0 py-2 mt-1 text-right border-b-2 border-gray-200 focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                </div>
                <div class="w-full col-span-1 mt-6 sm:col-span-2 text-main-color">Schimbă parola contului tău (opțional)</div>
                <span class="self-center">
                    Parola nouă
                    <small class="block text-gray-500">Setează o parolă nouă pentru acces în cont</small>
                </span>
                <div class="relative self-center">
                    <input type="password" name="password" id="password" value="" class="w-full px-0 py-2 mt-1 mb-1 text-right border-b-2 border-gray-200 focus:border-gray-500 focus:outline-none" autocomplete="new-password" />
                    <small class="text-xs text-gray-600">Minim <span class="text-main-color" id="check_min_length">8 caractere</span>, unul <span class="text-main-color" id="check_special_char">speci@l</span>, o <span class="text-main-color" id="check_uppercase">Litera mare</span> și <span class="text-main-color" id="check_number">1 număr</span>.</small>
                </div>
                <div class="w-full col-span-1 sm:col-span-2"></div>
                <span class="self-center">
                    Repetă parola nouă
                    <small class="block text-gray-500">Reintrodu parola introdusă în câmpul anterior pentru verificare</small>
                </span>
                <div class="relative self-center">
                    <input type="password" name="password_verify" id="password_verify" value="" class="w-full px-0 py-2 mt-1 text-right border-b-2 border-gray-200 focus:outline-none" autocomplete="NA" />
                </div>
                <script>
        const passwordInput = document.getElementById('password');
        const passwordVerifyInput = document.getElementById('password_verify');
        const checkMinLength = document.getElementById('check_min_length');
        const checkSpecialChar = document.getElementById('check_special_char');
        const checkUppercase = document.getElementById('check_uppercase');
        const checkNumber = document.getElementById('check_number');

        passwordInput.addEventListener('input', () => {
            const password = passwordInput.value;

            const isMinLengthValid = password.length >= 8;
            checkMinLength.classList.toggle('text-green-600', isMinLengthValid);
            checkMinLength.classList.toggle('text-main-color', !isMinLengthValid);

            const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
            const hasSpecialChar = specialCharRegex.test(password);
            checkSpecialChar.classList.toggle('text-green-600', hasSpecialChar);
            checkSpecialChar.classList.toggle('text-main-color', !hasSpecialChar);

            const hasUppercase = /[A-Z]/.test(password);
            checkUppercase.classList.toggle('text-green-600', hasUppercase);
            checkUppercase.classList.toggle('text-main-color', !hasUppercase);

            const hasNumber = /[0-9]/.test(password);
            checkNumber.classList.toggle('text-green-600', hasNumber);
            checkNumber.classList.toggle('text-main-color', !hasNumber);
        });

        passwordVerifyInput.addEventListener('input', () => {
            const password = passwordInput.value;
            const verifyPassword = passwordVerifyInput.value;

            const passwordsMatch = password === verifyPassword;
            passwordVerifyInput.classList.toggle('border-main-color', !passwordsMatch);
            passwordVerifyInput.classList.toggle('border-gray-200', passwordsMatch);
        });
    </script>
                <div class="w-full col-span-1 mt-6 text-right sm:col-span-2">
                    <button class="px-4 py-1 text-white rounded-md md:py-2 bg-main-color grow">Actualizează datele contului</button>
                </div>
            </div>
        </form>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>