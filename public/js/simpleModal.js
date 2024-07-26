document.addEventListener('DOMContentLoaded', () => {
    const openModalButtons = document.querySelector('.open-modal');
    const body = document.querySelector('body');
    const modal = document.getElementById('modal');
    const form = document.querySelector('#cancel-order');

    openModalButtons.addEventListener('click', () => {
        modal.classList.add('flex');
        modal.classList.remove('hidden');
        //body.classList.add('fixed', 'mx-auto');

        const confirmButton = modal.querySelector('.confirm-btn');
        confirmButton.addEventListener('click', () => {
            form.submit();
            hideModal();
        });

        const closeButtons = modal.querySelectorAll('.close-modal, #modal');
        closeButtons.forEach(closeButton => {
            closeButton.addEventListener('click', () => {
                hideModal();
            });
        });
    });

    function hideModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            body.classList.remove('fixed');
    }
});