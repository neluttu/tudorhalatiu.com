<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<? use Core\Lang; ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <? if(isset($_SESSION['_flashed']['cart_message']['result'])) : ?>
            <div class="p-3 mb-4 text-white bg-blue-400 border border-blue-500 rounded-md">
                <?= $_SESSION['_flashed']['cart_message']['result'] ?? 'No error message available at this time...'; ?>
            </div>
        <? endif ?>

        <h1 class="mb-4 text-2xl font-semibold">
            <?= Lang::text('product.price') . ' ' . number_format($product['price'], 2) . ' lei' ?>
        </h1>
        <img src="/public/images/products/<?=$product['id']?>.jpg" class="max-w-[460px]">
        <form method="post">
        <? if($product['sizes']) { ?>
            <select name="size" class="p-2 mr-2 bg-white border">
                <? foreach(explode(',', $product['sizes']) as $Size) echo '<option value="'.$Size.'">'.$Size.'</option>'; ?>
            </select>              
        <? } ?>          
            <input type="hidden" name="id" value="<?=$product['id'] ?>">
            <input type="hidden" name="name" value="<?=$product['name'] ?>">
            <input type="hidden" name="price" value="<?=$product['price'] ?>">

            <button type="submit" class="px-3 py-2 mt-4 bg-white border">
                <?= Lang::text('product.add_to_cart'); ?>
            </button>
        </form>
        <br><br>
        <?=$product['excerpt'];?>
        <br><br>
        <?=nl2br($product['description']);?>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>