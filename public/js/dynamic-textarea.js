function adjustTextareaHeight(event) {
    const textarea = event.target;
    textarea.style.height = 'auto';

    const computedHeight = textarea.scrollHeight;
    textarea.style.height = computedHeight + 'px';
}

const textareas = document.querySelectorAll('.auto-resize-textarea');
textareas.forEach(textarea => {
    adjustTextareaHeight({ target: textarea });
});