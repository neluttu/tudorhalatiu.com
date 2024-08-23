<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<section class="px-6 flex w-full h-[calc(100dvh_-_200px)] mt-10 gap-6 flex-col md:flex-row 
                    [&>div]:bg-cover
                    md:[&>div]:bg-top
                    [&>div]:bg-center
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
        <!-- <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/1.jpg)] brightness-[35%]"></div> -->
        <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/2.jpg)] brightness-[35%]"></div>
        <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/4.jpg)] brightness-[35%]"></div>
        <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/5.jpg)] brightness-[35%]"></div>
        <div class="slide flex-[4] md:flex-[5] bg-[url(/public/images/2024/10.jpg)] group">
            <div class="flex items-center justify-start h-full px-10 text-xl font-normal text-left transition-all duration-300 ease-in rounded-lg group-hover:bg-black/40 group-hover:backdrop-blur-sm text-main-color group">
                <span class="text-xl text-white transition-all duration-300 ease-in opacity-0 group-hover:opacity-100">
                    <p class="pb-5 text-5xl font-semibold uppercase">Rich Witch<br><span class="text-2xl text-main-color">Fall - Winter, 2024</span></p>
                    <!-- <p class="text-lg leading-relaxed">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim nam, velit voluptates expedita magnam ipsam molestias placeat excepturi dolore inventore eos? A voluptatibus magni suscipit maxime earum doloremque necessitatibus perferendis reprehenderit totam tempore facilis</p> -->
                </span>
            </div>
        </div>
        <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/6.jpg)] brightness-[35%]"></div>
        <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/7.jpg)] brightness-[35%]"></div>
        <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/8.jpg)] brightness-[35%]"></div>
        <!-- <div class="slide flex-[0.8] md:flex-[0.8] bg-[url(/public/images/2024/9.jpg)] brightness-[35%]"></div> -->
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

    <div class="grid grid-cols-1 px-2 mt-16 gap-x-6 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mx-auto w-[100dvw] ml-[calc(50%-50dvw)]">
    
        <? foreach($products as $product) :?>
        <a href="<?= \Core\Session::getLang(); ?>/shop/<?= $product['category_slug'] ?>/<?= $product['slug'] ?>" class="group" title="<?= $product['excerpt'] ?>">
            <div class="w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                <img src="/public/images/products/<?=$product['id']?>/poster.avif" alt="<?= $product['excerpt'] ?>" class="object-cover object-center w-full h-full transition-all duration-300 ease-in group-hover:scale-110" loading="lazy" alt="<?= $product['name'] . ' ' . $product['excerpt'] ?>">
            </div>
            <h3 class="mt-4 text-sm text-main-color"><?=$product['name'] ?></h3>
            <p class="mt-1 text-lg font-medium text-gray-900">
            <?= showPrice($product['price'], $product['discount']) ?>
            </p>
        </a>
        <? endforeach; ?>
    </div>
</main>
<form method="post" action="/payment-notify">
    <input type="hidden" value='hIFSVVzYTeTXBnW6wTgY/w==,7OJqd4GrY6o22NNPtnigxsj2A/EwQzwNDqZtDx7m6JQ2OKXQccwjYrm0E2/7LjMQ/YaMGq9QRJskyNerV1HO52J3PZvviWdFXZh9MReVxm0Nhaq/C+ZLyuJbAtovDBmbicBzA85cNs4Fxj9lsGC2h2lhlWrU1UT96aBv2HTkw8flp5HbZ/Q8ZxxMXY3+mMn7uPsCOEgLJMNPib8tD+WRKB7i+2EpMa2H+SxuMzlzf2iEYFY29ycV1pT/FRKl+F0W2D85mb1RoPbJZWKBIyk9h3xQMzoyhtRIvAtcR0ogW370U0HOuhnWAGgsm07yKTtFqkPqqKUmuH8DyMZkMpj8ue56Q0dix17arGydpEDYIzdTMTVbPKK6Zc7A5JEQbZzxsP9VKRjDwVX9UpQUiVC5yP3Kwwv2T4XSwVNm2BrqogI=' name="opensslResult">
    <input type="submit">
</form>
<? require base_path('views/partials/footer.php'); ?>