const destroyCheckbox = document.getElementById('destory');
const deleteButton = document.getElementById('deleteButton');
destroyCheckbox.addEventListener('change', function() {
    if (this.checked) deleteButton.removeAttribute('disabled');
    else deleteButton.setAttribute('disabled', true);
});