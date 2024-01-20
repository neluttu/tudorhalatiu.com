<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<div class="flex flex-wrap justify-start md:justify-center w-full gap-2 md:gap-4 px-2 mx-auto mb-10 max-w-7xl lg:px-0 text-slate-600 [&>a:hover]:bg-[#ed0078] [&>a:hover]:border-[#ed0078] [&>a:hover]:text-white [&>a]:transition-all [&>a]:duration-150 [&>a]:ease-in">
    <? foreach($categories as $category) : ?>
        <a href="/products/<?=$category['slug']?>" class="px-2 md:px-4 py-1 md:py-2 border <?= $category['category_id'] === $product['category'] ? 'bg-[#ed0078] border-[#ed0078] text-white' : 'text-slate-500' ?> hover:bg-[#ed0078]  "><?=$category['name']?></a>
    <? endforeach ?>
</div>

<?php
require base_path('views/partials/banner.php');
use Core\Lang;
?>

<main class="w-full px-2 mx-auto max-w-7xl lg:px-0">
    <? if(isset($_SESSION['_flashed']['cart_message']['result'])) : ?>
        <div class="p-3 mb-4 text-white bg-blue-400 border border-blue-500 rounded-md">
            <?= $_SESSION['_flashed']['cart_message']['result'] ?? 'No error message available at this time...'; ?>
        </div>
    <? endif ?>
    
    <div class="flex items-start justify-start gap-10 py-6">
        <div class="flex-1">
            <img src="/public/images/products/<?=$product['id']?>.jpg" class="max-w-[460px]">
        </div>
        <div>
            <h1 class="mb-4 text-2xl font-semibold">
                <?= 
                //Lang::text('product.price') . ' ' . 
                number_format($product['price'], 2) . ' lei' 
                ?>
            </h1>

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
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>