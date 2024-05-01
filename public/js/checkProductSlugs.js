document.addEventListener('DOMContentLoaded', function() {
    // get all slugs
    const slugsInput = document.getElementById('slugs_hidden');
    const slugsValue = slugsInput.value;
    const slugs = JSON.parse(slugsValue);

    // get current slug
    const current_slug_input = document.getElementById('current_slug');
    let currentSlug = '';
    if (current_slug_input) currentSlug = current_slug_input.value;

    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const submitBtn = document.getElementById('submitBtn');


    nameInput.addEventListener('input', function() {
        const nameValue = nameInput.value.trim();
        const cleanedSlug = nameValue.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        const finalSlug = cleanedSlug.replace(/-$/, '');
        slugInput.value = finalSlug;

        // Verificăm dacă slug-ul există în array-ul de slugs și nu este egal cu currentSlug
        if (slugs.includes(finalSlug) && (finalSlug !== currentSlug)) {
            slugInput.classList.add('border', 'border-red-600', 'rounded-md', 'bg-red-100');
            submitBtn.classList.add('hidden');
        } else {
            slugInput.classList.remove('border', 'border-red-600', 'rounded-md', 'bg-red-100');
            submitBtn.classList.remove('hidden');
        }
    });

    slugInput.addEventListener('input', function() {
        const slugValue = slugInput.value.trim();
        const cleanedSlug = slugValue.replace(/[^a-z0-9-]+/g, '');
        const finalSlug = cleanedSlug.replace(/-$/, '');
        slugInput.value = finalSlug;

        // Verificăm dacă slug-ul există în array-ul de slugs și nu este egal cu currentSlug
        if (slugs.includes(finalSlug) && (finalSlug !== currentSlug)) {
            slugInput.classList.add('border', 'border-red-600', 'rounded-md', 'bg-red-100');
            submitBtn.classList.add('hidden');
        } else {
            slugInput.classList.remove('border', 'border-red-600', 'rounded-md', 'bg-red-100');
            submitBtn.classList.remove('hidden');
        }
    });
});
