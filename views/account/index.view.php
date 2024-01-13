<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-slate-700">Hi <?=$_SESSION['user']['name'] ?>!</h1> This is your account.
        
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
