<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php
$showcaseName = explode('-', $showcase);
?>

<?php if (isset($hero['image_url'])): ?>
    <a href="<?= $hero['url'] ?? '#' ?>" class="" title="<?= $hero['title'] ?? '' ?>">
        <img src="/public/images/hero-images/<?= $hero['image_url'] ?>" alt="<?= $hero['title'] ?>"
            class="mx-auto mt-10 rounded-lg">
    </a>
<?php endif; ?>

<section class="px-6 flex w-full h-[calc(100dvh_-_200px)] mt-10 gap-6 flex-col md:flex-row 
                    [&>div]:bg-cover
                    md:[&>div]:bg-[center_top]
                    [&>div]:rounded-lg
                    [&>div]:bg-no-repeat
                    [&>div]:bg-white
                    [&>div]:relative
                    [&>div]:cursor-pointer
                    [&>div]:transition-all
                    [&>div]:duration-300
                    [&>div]:ease-in
                    [&>div]:h-full
                    [&>div]:overflow-hidden
                    [&>div:hover]:brightness-100
                    ">
    <div class="slide flex-[0.8] md:flex-[0.8] brightness-[35%] ">
        <img src="/public/images/showcase/<?= $showcase ?>/1.jpg" class="object-cover object-top w-full h-full" alt="">
    </div>
    <div class="slide flex-[0.8] md:flex-[0.8] brightness-[35%] ">
        <img src="/public/images/showcase/<?= $showcase ?>/2.jpg" class="object-cover object-top w-full h-full" alt="">
    </div>
    <div class="slide flex-[0.8] md:flex-[0.8] brightness-[35%] ">
        <img src="/public/images/showcase/<?= $showcase ?>/3.jpg" class="object-cover object-top w-full h-full" alt="">
    </div>
    <div class="slide flex-[4] md:flex-[5] group relative">
        <div
            class="absolute flex items-center justify-start w-full h-full px-10 text-xl font-normal text-left transition-all duration-300 ease-in rounded-lg group-hover:bg-black/40 group-hover:backdrop-blur-sm text-main-color group">
            <span class="text-xl text-white transition-all duration-300 ease-in opacity-0 group-hover:opacity-100">
                <p class="pb-5 text-5xl font-semibold uppercase">
                    <?= $showcaseName[0] . ' ' . $showcaseName[1] ?><br><span class="text-2xl text-main-color">Fall -
                        Winter, <?= $showcaseName[2] ?></span>
                </p>
            </span>
        </div>
        <img src="/public/images/showcase/<?= $showcase ?>/4.jpg" class="object-cover object-top w-full h-full" alt="">
    </div>
    <div class="slide flex-[0.8] md:flex-[0.8] brightness-[35%] ">
        <img src="/public/images/showcase/<?= $showcase ?>/5.jpg" class="object-cover object-top w-full h-full" alt="">
    </div>
    <div class="slide flex-[0.8] md:flex-[0.8] brightness-[35%] ">
        <img src="/public/images/showcase/<?= $showcase ?>/6.jpg" class="object-cover object-top w-full h-full" alt="">
    </div>
    <div class="slide flex-[0.8] md:flex-[0.8] brightness-[35%] ">
        <img src="/public/images/showcase/<?= $showcase ?>/7.jpg" class="object-cover object-top w-full h-full" alt="">
    </div>
</section>
<main class="relative">

    <script>
        const slides = document.querySelectorAll('.slide');
        slides.forEach(slide => {
            slide.addEventListener('click', () => {
                slides.forEach(otherSlide => {
                    if (otherSlide !== slide) {
                        otherSlide.classList.remove('flex-[4]', 'md:flex-[5]', 'brightness-100');
                        otherSlide.classList.add('flex-[0.8]', 'md:flex-[0.8]', 'brightness-[35%]', '[&>div>span]:hidden');
                    }
                });

                slide.classList.remove('flex-[0.8]', 'md:flex-[0.8]', 'brightness-[35%]', '[&>div>span]:hidden');
                slide.classList.add('flex-[4]', 'md:flex-[5]', 'brightness-100');
            });
        });       
    </script>

    <div
        class="grid grid-cols-1 px-2 mt-16 gap-x-6 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mx-auto w-[100dvw] ml-[calc(50%-50dvw)]">

        <? foreach ($products as $product): ?>
            <a href="<?= \Core\Session::getLang(); ?>/shop/<?= $product['category_slug'] ?>/<?= $product['slug'] ?>"
                class="group" title="<?= $product['excerpt'] ?>">
                <div
                    class="w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                    <img src="/public/images/products/<?= $product['id'] ?>/poster.avif" alt="<?= $product['excerpt'] ?>"
                        class="object-cover object-center w-full h-full transition-all duration-300 ease-in group-hover:scale-110"
                        loading="lazy" alt="<?= $product['name'] . ' ' . $product['excerpt'] ?>">
                </div>
                <h3 class="mt-4 text-sm text-main-color"><?= $product['name'] ?></h3>
                <p class="mt-1 text-lg font-medium text-gray-900">
                    <?= showPrice($product['price'], $product['discount']) ?>
                </p>
            </a>
        <? endforeach; ?>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>