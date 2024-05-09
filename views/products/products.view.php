<?php 
// Page head
require base_path('views/partials/head.php'); 

// Page navigation
require base_path('views/partials/nav.php'); 

// Top product categories select boxes
require base_path('views/partials/categories.php'); 

// Page title and subtitle
require base_path('views/partials/banner.php'); 
?>
<main class="w-full px-2 py-10 mx-auto xl:px-0 max-w-7xl">
    <div class="grid grid-cols-1 gap-x-6 gap-y-10 md:gap-y-16 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl">
        <? foreach($products as $product) :?>
        <a href="<?= \Core\Session::getLang(); ?>/shop/<?= $product['category_slug'] ?>/<?= $product['slug']; ?>" class="group" title="<?= $product['excerpt'] ?>">
            <div class="relative w-full mb-3 overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                <? if($product['discount'] and isset($product['discount'])) : ?><span class="absolute z-10 p-2 text-white rounded-lg md:p-4 top-3 left-3 bg-main-color">-<?= $product['discount'] ?> % discount</span> <? endif ?>
                <img loading="lazy" src="/public/images/products/<?=$product['id']?>/poster.avif" alt="<?= $product['excerpt'] ?>" class="object-cover object-center w-full h-full transition-all duration-300 ease-in group-hover:scale-110" loading="lazy">
            </div>
            <h2 class="text-base font-semibold text-gray-700"><?=$product['name'] ?></h2>
            <hr class="w-[100px] border-b-2 border-slate-700 my-3">
            <p class="text-lg font-medium text-main-color">
                <?= showPrice($product['price'], $product['discount']) ?>
            </p>

        </a>
        <? endforeach; ?>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>