<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <ul class="flex flex-wrap items-center justify-start gap-4">
            <? foreach($products as $product) :?>
                <li class="min-w-[240px] text-lg shadow-md bg-white pb-2">
                    <a href="<?= \Core\Session::getLang(); ?>/product/<?=slug($product['name']) . '/' . $product['id']; ?>">
                        <img src="/public/images/products/<?=$product['id']?>.jpg" class="max-w-[320px]">
                        <p class="px-2 text-xl font-semibold"><?=$product['name'] . '</p><p class="px-2 text-base font-semibold"> '. Core\Lang::text('product.price') . ': ' . $product['price'] . '$' ?></p>
                    </a>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>