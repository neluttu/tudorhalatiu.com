<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/categories.php'); ?>

<?php
require base_path('views/partials/banner.php');
use Core\Lang;
?>

<main class="w-full px-2 mx-auto max-w-7xl">
    <? Core\Session::getMessage(); ?>
    <? if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') : ?>
        <span class="font-sans text-sm font-bold uppercase"><a href="/admin/product/<?= $product['id'] ?>" class="text-main-color hover:underline">Editeaza produsul</a> | <?= $views ?> vizualizări</span>
    <? endif ?>
    <div class="relative flex flex-col items-start justify-start gap-4 py-6 sm:gap-10 md:flex-row">
        <div class="w-full overflow-hidden rounded-lg md:sticky md:top-0 md:w-2/5" id="stickyContainer">
            <div class="relative bg-gray-200">
                <? if($product['discount'] and isset($product['discount'])) : ?><span class="absolute z-0 p-2 text-white rounded-lg md:p-4 top-3 left-3 bg-main-color flicker-1">-<?= $product['discount'] ?> % discount</span> <? endif ?>
                <img src="/public/images/products/<?=$product['id']?>/poster.avif" class="w-full transition-all duration-300 ease-in rounded-lg" alt="<?=$product['name']?> - Tudor Halațiu" id="poster" loading="lazy">
            </div>
            <script src="/public/js/fixedPosterImage.js"></script>
        </div>
        <div class="relative w-full text-sm font-light leading-loose md:-mt-20 md:flex-1 text-slate-700">
            <div class="fixed bottom-0 left-0 z-50 w-full px-3 pt-3 pb-3 sm:p-0 sm:static bg-white/80 md:bg-transparent backdrop-blur-sm md:backdrop-blur-none">
                <div class="flex items-center justify-between text-xl font-semibold sm:text-2xl md:text-4xl text-main-color">
                    <h2 class="flex-1 text-base sm:text-xl md:hidden"><?= $product['name'] ?></h2>
                    <p class="flex-1 text-right">
                    <?= showPrice($product['price'], $product['discount']) ?>
                    </p>
                </div>
                <hr class="w-[100px] border-b-2 border-slate-700 md:mt-4 float-end hidden md:block">
                <form method="post" class="flex items-center justify-end gap-1 mt-4 md:mt-10 sm:gap-3">
                    <? if($product['sizes'] and $product['stock'] === 'Yes') { 
                        $i = 0;
                        foreach(explode(',', $product['sizes']) as $Size) {
                    ?>
                    <div class="font-sans font-semibold text-center min-w-[34px] md:min-w-[46px] cursor-pointer">
                        <input type="radio" name="size" id="size_<?= $Size ?>" value="<?= $Size ?>" class="hidden peer" <?= $i === 0 ? 'checked' : '' ?> />
                        <label for="size_<?= $Size ?>" class="peer-checked:bg-main-color block p-[3px] md:p-[9px]  hover:bg-main-color transition-all duration-150 ease-in cursor-pointer text-white bg-black rounded-lg"><?= $Size ?></label>
                    </div>
                    <? $i = 1; } } ?>
                    <input type="hidden" name="id" value="<?=$product['id'] ?>">
                    <input type="hidden" name="name" value="<?=$product['name'] ?>">
                    <input type="hidden" name="price" value="<?=$product['price'] ?>">
                    <input type="hidden" name="discount" value="<?=$product['discount'] ?>">
                    
                    <button <?= $product['stock'] === 'No' ? 'disabled' : '' ?> type="submit" class="px-2 py-1 ml-10 font-semibold text-white rounded-lg md:py-2 <?= $product['stock'] === 'No' ? 'bg-gray-300' : 'bg-main-color grow' ?>">
                        <?= $product['stock'] === 'Yes' ? Lang::text('product.add_to_cart') : 'Stoc indisponibil' ?>
                    </button>
                </form>
            </div>
            <? if(count($photos) > 0) : ?>
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-4">
                <span class="[&>img]:transition-all [&>img]:duration-300 [&>img]:ease-in sm:[&>img:hover]:scale-105 [&>img]:rounded-lg [&>img]:cursor-pointer [&>img]:w-full hidden group overflow-hidden rounded-lg sm:block ">
                    <img src="/public/images/products/<?=$product['id']?>/poster.avif" class="transition-all duration-300 ease-in rounded-lg cursor-pointer productImage group-hover:scale-105" alt="<?=$product['name']?> by Tudor Halațiu" loading="lazy">
                </span>
                <? foreach($photos as $photo) : ?>
                <span class="overflow-hidden rounded-lg group">
                    <img src="/<?= $photo ?>" alt="<?= $product['name'] ?>" class="transition-all duration-300 ease-in rounded-lg cursor-pointer productImage group-hover:scale-105" alt="<?=$product['name']?> by Tudor Halațiu" loading="lazy">
                </span>
                <? endforeach ?>
                <script src="/public/js/changePoster.js"></script>
            </div>
            <? endif ?>
            <? if($product['sizes'] != 'ONE SIZE') : ?>
            <ul class="flex flex-col items-center justify-start w-full mt-4 text-xs md:text-sm">
                <li class="flex items-center justify-center w-full border-b [&>span]:p-2 [&>span]:font-semibold">
                    <span class="flex-1 text-left"></span>
                    <span class="flex-1 text-right text-main-color">XS</span>
                    <span class="flex-1 text-right text-main-color">S</span>
                    <span class="flex-1 text-right text-main-color">M</span>
                    <span class="flex-1 text-right text-main-color">L</span>
                    <span class="flex-1 text-right text-main-color">XL</span>
                </li>
                <li class="flex items-center justify-center w-full border-b [&>span]:p-2 [&>span:first-child]:font-semibold">
                    <span class="flex-1 text-left text-main-color">BUST</span>
                    <span class="flex-1 text-right">84 cm</span>
                    <span class="flex-1 text-right">88 cm</span>
                    <span class="flex-1 text-right">92 cm</span>
                    <span class="flex-1 text-right">96 cm</span>
                    <span class="flex-1 text-right">100 cm</span>
                </li>
                <li class="flex items-center justify-center w-full border-b [&>span]:p-2 [&>span:first-child]:font-semibold">
                    <span class="flex-1 text-left text-main-color">TALIE</span>
                    <span class="flex-1 text-right">64 cm</span>
                    <span class="flex-1 text-right">68 cm</span>
                    <span class="flex-1 text-right">72 cm</span>
                    <span class="flex-1 text-right">76 cm</span>
                    <span class="flex-1 text-right">80 cm</span>
                </li>
                <li class="flex items-center justify-center w-full border-b [&>span]:p-2 [&>span:first-child]:font-semibold">
                    <span class="flex-1 text-left text-main-color">ȘOLD</span>
                    <span class="flex-1 text-right">90 cm</span>
                    <span class="flex-1 text-right">94 cm</span>
                    <span class="flex-1 text-right">98 cm</span>
                    <span class="flex-1 text-right">102 cm</span>
                    <span class="flex-1 text-right">106 cm</span>
                </li>
            </ul>
            <? endif ?>
            <hr class="w-[100px] border-b-2 border-slate-700 mt-8 mb-4">
            <p class="mb-2 text-base font-semibold"><?=$product['excerpt'];?></p>
            <p class="[&>a]:text-main-color [&>a]:underline">
            <? 
            $product['description'] = str_replace(['[b]','[/b]'], ['<b class="font-semibold">','</b>'], $product['description']);
            echo str_replace('[-]', '<span class="w-[8px] h-[8px] inline-block aspect-square rounded-sm bg-main-color mr-2"></span>', nl2br($product['description']));
            ?>
            </p>
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); 
// use Detection\MobileDetect;
// $detect = new MobileDetect();
// var_dump($detect->getUserAgent()); // "Mozilla/5.0 (Windows NT 10.0; Win64; x64) ..."

// try {
//     $isMobile = $detect->isMobile(); // bool(false)
//     var_dump($isMobile);
// } catch (\Detection\Exception\MobileDetectException $e) {
// }
// try {
//     $isTablet = $detect->isTablet(); // bool(false)
//     var_dump($isTablet);
// } catch (\Detection\Exception\MobileDetectException $e) {
// }
?>