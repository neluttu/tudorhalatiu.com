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
    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl">
        <? foreach($products as $product) :?>
        <a href="<?= \Core\Session::getLang(); ?>/product/<?=slug($product['name']) . '/' . $product['id']; ?>" class="group" title="<?= $product['excerpt'] ?>">
            <div class="w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                <img src="/public/images/products/<?=$product['id']?>/poster.jpg" alt="<?= $product['excerpt'] ?>" class="object-cover object-center w-full h-full group-hover:opacity-75">
            </div>
            <h3 class="mt-4 text-sm text-gray-700"><?=$product['name'] ?></h3>
            <p class="mt-1 text-lg font-medium text-gray-900"><?= number_format($product['price'], 2, ',','.') ?> lei</p>
        </a>
        <? endforeach; ?>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>