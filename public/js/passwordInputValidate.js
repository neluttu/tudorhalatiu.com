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

        if(passwordVerifyInput) 
            passwordVerifyInput.addEventListener('input', () => {
                const password = passwordInput.value;
                const verifyPassword = passwordVerifyInput.value;

                const passwordsMatch = password === verifyPassword;
                passwordVerifyInput.classList.toggle('border-main-color', !passwordsMatch);
                passwordVerifyInput.classList.toggle('border-gray-200', passwordsMatch);
            });