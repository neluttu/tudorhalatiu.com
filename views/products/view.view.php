<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<div class="flex flex-wrap justify-start md:justify-center w-full gap-2 md:gap-4 px-2 mx-auto mb-10 max-w-7xl lg:px-0 text-slate-600 [&>a:hover]:bg-[#ed0078] [&>a:hover]:border-[#ed0078] [&>a:hover]:text-white [&>a]:transition-all [&>a]:duration-150 [&>a]:ease-in">
    <? foreach($categories as $category) : ?>
        <a href="/shop/<?=$category['slug']?>" class="px-2 md:px-4 py-1 md:py-2 border <?= $category['category_id'] === $product['category'] ? 'bg-[#ed0078] border-[#ed0078] text-white' : 'text-slate-500' ?> hover:bg-[#ed0078]  "><?=$category['name']?></a>
    <? endforeach ?>
</div>

<?php
require base_path('views/partials/banner.php');
use Core\Lang;
?>

<main class="w-full px-2 mx-auto max-w-7xl lg:px-0">
    <? Core\Session::getMessage(); ?>
    <?
    if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') echo '<a href="/admin/produs/'.$product['id'].'" class="text-[#ed0078] hover:underline">Editeaza produsul</a> | '.$views.' vizualizări';
    ?>
    <div class="flex items-start justify-start gap-10 py-6">
        <div class="flex-1">
            <img src="/public/images/products/<?=$product['id']?>.jpg" class="w-full rounded-md" alt="<?=$product['name']?> - Tudor Halațiu">
        </div>
        <div class="flex-1 text-sm font-light leading-loose text-slate-700">
            <h1 class="text-4xl font-semibold text-right text-[#ed0078]">
                <?= number_format($product['price'], 2) . ' lei' ?>
            </h1>
            <hr class="w-[100px] border-b-2 border-slate-700 mt-4 float-end">
            <form method="post" class="flex items-center justify-end gap-3 mt-10">
                <? if($product['sizes']) { 
                    $i = 0;
                    foreach(explode(',', $product['sizes']) as $Size) {
                ?>
                <div class="font-sans font-semibold text-center w-[48px] aspect-square cursor-pointer">
                    <input type="radio" name="size" id="size_<?= $Size ?>" value="<?= $Size ?>" class="hidden peer" <?= $i === 0 ? 'checked' : '' ?> />
                    <label for="size_<?= $Size ?>" class="peer-checked:bg-[#ed0078] block p-2  hover:bg-[#ed0078] transition-all duration-150 ease-in cursor-pointer text-white bg-black rounded-md"><?= $Size ?></label>
                </div>
                <? $i = 1; } } ?>

                <input type="hidden" name="id" value="<?=$product['id'] ?>">
                <input type="hidden" name="name" value="<?=$product['name'] ?>">
                <input type="hidden" name="price" value="<?=$product['price'] ?>">
                
                <button type="submit" class="px-6 py-2 ml-10 bg-[#ed0078] text-white rounded-md grow">
                    <?= Lang::text('product.add_to_cart'); ?>
                </button>
            </form>
            <hr class="w-[100px] border-b-2 border-slate-700 mt-8 mb-4">
            <p class="font-medium"><?=$product['excerpt'];?></p>
            <br><br>
            <?=nl2br($product['description']);?>
            
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>