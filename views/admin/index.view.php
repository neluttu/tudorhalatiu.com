<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="py-4 text-2xl font-semibold">Hello, <?= $_SESSION['user']['name'] ?>.</h1>
        
        This is the admin page for your webshop.
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
