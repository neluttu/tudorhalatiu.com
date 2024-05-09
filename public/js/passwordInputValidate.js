const passwordInput = document.getElementById('password');
        const passwordVerifyInput = document.getElementById('password_verify');
        const checkMinLength = document.getElementById('check_min_length');
        const checkSpecialChar = document.getElementById('check_special_char');
        const checkUppercase = document.getElementById('check_uppercase');
        const checkNumber = document.getElementById('check_number');
        const submitButton = document.getElementById('submitButton');

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
                if (passwordsMatch) {
                    passwordVerifyInput.classList.remove('border-main-color');
                    passwordVerifyInput.classList.add('border-gray-200');
                    if(submitButton) { 
                        submitButton.innerText = 'Setază parola nouă';
                        submitButton.disabled = false;
                    }
                } else {
                    passwordVerifyInput.classList.remove('border-gray-200');
                    passwordVerifyInput.classList.add('border-main-color');
                    if(submitButton)  {
                        submitButton.innerText = 'Parolele nu coincid, rectificați';
                        submitButton.disabled = true;
                    }
                }
            });