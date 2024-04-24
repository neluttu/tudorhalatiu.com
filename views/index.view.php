<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<main class="relative">
    <h1 class="absolute inline-block px-4 font-sans font-bold text-white slide-in-left text-clamp top-6 md:top-10 left-4 bg-black/40 backdrop-blur-md">FII CURAJOASĂ</h1>
    <h2 class="absolute inline-block px-4 font-sans font-bold slide-in-left text-main-color text-clamp top-16 md:top-36 left-4 bg-black/40 backdrop-blur-md">ȘI STRĂLUCEȘTE!</h2>
    <img src="/public/images/tudor-halatiu-web.jpg" class="-mt-10 md:-mt-24">
    <div class="grid grid-cols-1 px-2 mt-16 gap-x-6 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mx-auto w-[100dvw] ml-[calc(50%-50dvw)]">
    
        <? foreach($products as $product) :?>
        <a href="<?= \Core\Session::getLang(); ?>/product/<?=slug($product['name']) . '/' . $product['id']; ?>" class="group" title="<?= $product['excerpt'] ?>">
            <div class="w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                <img src="/public/images/products/<?=$product['id']?>/poster.avif" alt="<?= $product['excerpt'] ?>" class="object-cover object-center w-full h-full transition-all duration-300 ease-in group-hover:scale-110">
            </div>
            <h3 class="mt-4 text-sm text-main-color"><?=$product['name'] ?></h3>
            <p class="mt-1 text-lg font-medium text-gray-900"><?= number_format($product['price'], 2, ',','.') ?> lei</p>
        </a>
        <? endforeach; ?>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
<style>
    .char {
  filter: blur(calc(1rem * var(--blur, 1)));
  transition: filter var(--speed, 5s);
}

.char:hover {
  --blur: 0;
  --speed: 1s;
}
</style>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. <span class="char">Reiciendis, beatae.</span></p>