let showButton;
let hideButton;

document.addEventListener('DOMContentLoaded', function() {
    showButton = document.getElementById('showPassword');
    hideButton = document.getElementById('hidePassword');
    const passwordInput = document.getElementById('password');

    showButton.addEventListener('click', function() {
        togglePasswordVisibility(passwordInput);
    });

    hideButton.addEventListener('click', function() {
        togglePasswordVisibility(passwordInput);
    });
});

function togglePasswordVisibility(inputElement) {
    if (inputElement.type === 'password') {
        inputElement.type = 'text';
        showButton.classList.add('hidden');
        hideButton.classList.remove('hidden');
        hideButton.classList.remove('opacity-0');
        hideButton.classList.add('opacity-100');
    } else {
        inputElement.type = 'password';
        showButton.classList.remove('hidden');
        hideButton.classList.add('hidden');
        showButton.classList.remove('opacity-0');
        showButton.classList.add('opacity-100');
    }
}