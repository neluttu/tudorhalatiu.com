document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        const nameValue = nameInput.value.trim();
        const cleanedSlug = nameValue.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        const finalSlug = cleanedSlug.replace(/-$/, '');
        slugInput.value = finalSlug;
    });

    slugInput.addEventListener('input', function() {
        const slugValue = slugInput.value.trim();
        const cleanedSlug = slugValue.replace(/[^a-z0-9-]+/g, '');
        const finalSlug = cleanedSlug.replace(/-$/, '');
        slugInput.value = finalSlug;
    });
});