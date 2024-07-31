<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<main class="relative">
    <h1 class="absolute inline-block px-4 font-sans font-bold text-white slide-in-left text-clamp top-6 md:top-10 left-4 bg-black/40 backdrop-blur-md">FII CURAJOASĂ</h1>
    <h2 class="absolute inline-block px-4 font-sans font-bold slide-in-left text-main-color text-clamp top-16 md:top-36 left-4 bg-black/40 backdrop-blur-md">ȘI STRĂLUCEȘTE!</h2>
    <img src="/public/images/tudor-halatiu-web.avif" class="-mt-10 md:-mt-24" title="Tudor Halațiu" loading="lazy" alt="Tudor Halațiu">
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