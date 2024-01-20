<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class="py-6 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 ">
        <? foreach($categories as $category) : ?>
        <a href="<?= \Core\Session::getLang(); ?>/products/<?=$category['slug'];?>" class="group">
            <h3 class="py-4 text-lg text-gray-700"><?=$category['name']; ?></h3>
            <div class="w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                <img src="/public/images/categories/<?=$category['category_id'];?>.png" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="object-cover object-center w-full h-full group-hover:opacity-75">
            </div>
          </a>
        <? endforeach ?>
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>