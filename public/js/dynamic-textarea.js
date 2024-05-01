function adjustTextareaHeight(event) {
    const textarea = event.target;
    textarea.style.height = 'auto';

    const computedHeight = textarea.scrollHeight;
    textarea.style.height = computedHeight + 'px';
}

document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('.dbText');
    textareas.forEach(textarea => {
        adjustTextareaHeight({ target: textarea });

        textarea.addEventListener('input', adjustTextareaHeight);
    });
});