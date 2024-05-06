<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="px-2 py-6 mx-auto lg:px-0 max-w-7xl">
    <div class="grid grid-cols-2 gap-x-6 gap-y-10 md:grid-cols-3">
        <? foreach($categories as $category) : ?>
        <a href="<?= \Core\Session::getLang(); ?>/shop/<?=$category['slug'];?>" class="group">
            <h3 class="py-4 text-base text-gray-700 transition-all duration-300 ease-in group-hover:text-main-color md:text-lg"><?=$category['name']; ?></h3>
            <div class="w-full overflow-hidden transition-all duration-300 ease-in bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                <img src="/public/images/categories/<?=$category['slug'];?>.jpg" alt="Tudor Halațiu - <?=$category['text']?>" class="object-cover object-center w-full h-full transition-all duration-300 ease-in group-hover:scale-110" loading="lazy">
            </div>
            </a>
        <? endforeach ?>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>