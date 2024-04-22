<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<?php require base_path('views/partials/categories.php'); ?>

<?php
require base_path('views/partials/banner.php');
use Core\Lang;
?>

<main class="w-full px-2 mx-auto max-w-7xl">
    <? Core\Session::getMessage(); ?>
    <? if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') echo '<a href="/admin/produs/'.$product['id'].'" class="text-main-color hover:underline">Editeaza produsul</a> | '.$views.' vizualizări';  ?>
    <div class="flex flex-col items-start justify-start gap-4 py-6 sm:gap-10 md:flex-row">
        <div class="w-full overflow-hidden bg-gray-200 rounded-md md:flex-1">
            <img src="/public/images/products/<?=$product['id']?>/poster.avif" class="w-full transition-all duration-300 ease-in rounded-md" alt="<?=$product['name']?> - Tudor Halațiu" id="poster">
        </div>
        <div class="relative w-full text-sm font-light leading-loose md:flex-1 text-slate-700">
            <span class="fixed bottom-0 left-0 w-full px-3 pt-1 pb-2 sm:p-0 sm:static bg-white/50 md:bg-transparent backdrop-blur-sm md:backdrop-blur-none">
                <h1 class="flex items-center justify-between text-xl font-semibold sm:text-2xl md:text-4xl text-main-color">
                    <p class="flex-1 text-base sm:text-xl md:hidden"><?= $product['name'] ?></p>
                    <p class="flex-1 text-right"><?= number_format($product['price'], 2) . ' lei' ?></p>
                </h1>
                <hr class="w-[100px] border-b-2 border-slate-700 md:mt-4 float-end hidden md:block">
                <form method="post" class="flex items-center justify-end gap-1 mt-4 md:mt-10 sm:gap-3">
                    <? if($product['sizes']) { 
                        $i = 0;
                        foreach(explode(',', $product['sizes']) as $Size) {
                    ?>
                    <div class="font-sans font-semibold text-center min-w-[34px] md:min-w-[46px] cursor-pointer">
                        <input type="radio" name="size" id="size_<?= $Size ?>" value="<?= $Size ?>" class="hidden peer" <?= $i === 0 ? 'checked' : '' ?> />
                        <label for="size_<?= $Size ?>" class="peer-checked:bg-main-color block p-[3px] md:p-[9px]  hover:bg-main-color transition-all duration-150 ease-in cursor-pointer text-white bg-black rounded-md"><?= $Size ?></label>
                    </div>
                    <? $i = 1; } } ?>
                    <input type="hidden" name="id" value="<?=$product['id'] ?>">
                    <input type="hidden" name="name" value="<?=$product['name'] ?>">
                    <input type="hidden" name="price" value="<?=$product['price'] ?>">
                    
                    <button type="submit" class="px-2 py-1 ml-10 text-white rounded-md md:py-2 bg-main-color grow">
                        <?= Lang::text('product.add_to_cart'); ?>
                    </button>
                </form>
            </span>
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-4">
                <span class="[&>img]:transition-all [&>img]:duration-300 [&>img]:ease-in sm:[&>img:hover]:scale-105 [&>img]:rounded-lg [&>img]:cursor-pointer [&>img]:w-full group overflow-hidden rounded-lg">
                    <img src="/public/images/products/<?=$product['id']?>/poster.avif" class="hidden transition-all duration-300 ease-in rounded-lg cursor-pointer md:block group-hover:scale-105" alt="<?=$product['name']?> - Tudor Halațiu"  onclick="changePoster(this.src)">
                </span>
                <? foreach($photos as $photo) : ?>
                <span class="overflow-hidden rounded-lg group">
                    <img src="/<?= $photo ?>" alt="<?= $product['name'] ?>" onclick="changePoster(this.src)" class="transition-all duration-300 ease-in rounded-lg cursor-pointer group-hover:scale-105">
                </span>
                <? endforeach ?>
                <script>
                    function changePoster(src) {
                        if (window.innerWidth >= 640) {
                            const posterImg = document.getElementById('poster');
                            posterImg.classList.remove('opacity-100'); 
                            posterImg.classList.add('opacity-0');

                            setTimeout(function() {
                                posterImg.src = src;
                                posterImg.classList.remove('opacity-0');
                                posterImg.classList.add('opacity-100');
                                if (window.innerWidth <= 768) posterImg.scrollIntoView({ behavior: 'smooth' });
                            }, 300);
                        }
                    }
                </script>
            </div>
            <hr class="w-[100px] border-b-2 border-slate-700 mt-8 mb-4">
            <p class="mb-10 font-semibold"><?=$product['excerpt'];?></p>
            <p class="[&>a]:text-main-color [&>a]:underline">
            <?= printDescription($product['description']) ?>
            </p>
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); 
use Detection\MobileDetect;
$detect = new MobileDetect();
var_dump($detect->getUserAgent()); // "Mozilla/5.0 (Windows NT 10.0; Win64; x64) ..."

try {
    $isMobile = $detect->isMobile(); // bool(false)
    var_dump($isMobile);
} catch (\Detection\Exception\MobileDetectException $e) {
}
try {
    $isTablet = $detect->isTablet(); // bool(false)
    var_dump($isTablet);
} catch (\Detection\Exception\MobileDetectException $e) {
}
?>