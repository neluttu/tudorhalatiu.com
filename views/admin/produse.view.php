<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div class="w-full md:-mt-10 md:grow">
        <?
        
        foreach($products as $product) {
            if ($product['category_name'] != $currentCategory) {
                if ($currentCategory !== null) echo "</div>";
                echo '<div class="w-full p-2 my-4 border rounded-md text-slate-600 bg-slate-50">' . $product['category_name'] . '</div>';
                echo '<div class="grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">';
                $currentCategory = $product['category_name'];
            }
        ?>
            <a href="<?= \Core\Session::getLang(); ?>/admin/produs/<?= $product['id']; ?>" class="group">
                <div class="w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                <img src="/public/images/products/<?=$product['id']?>.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="object-cover object-center w-full h-full group-hover:opacity-75">
                </div>
                <h3 class="mt-4 text-sm text-gray-700"><?=$product['name'] ?></h3>
                <p class="mt-1 text-lg font-medium text-gray-900"><?= number_format($product['price'], 2, ',','.') ?> lei</p>
            </a>            
        <?
            }
            echo "</div>";
        ?>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
