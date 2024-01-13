<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="py-4 text-2xl font-semibold">Hello, <?= $_SESSION['user']['name'] ?? 'Guest'; ?></h1>
        
        This is the index page. Be sure to check out the <a href="/notes" class="text-blue-500">notes page</a>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
