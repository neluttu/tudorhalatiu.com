<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-4 text-2xl font-semibold">Online shopping, choose your category:</h1>
        <ul class="flex flex-wrap items-center justify-start gap-10">
        <? foreach($categories as $category) : ?>
            <li class="flex-1 min-w-[360px]">
                <a href="<?= \Core\Session::getLang(); ?>/products/<?=slug($category['name']);?>/<?=$category['category_id']?>" class="text-lg font-semibold">
                    <img src="/public/images/img0<?=$category['category_id'];?>.webp" class="w-full mb-3">
                    <?=$category['name']; ?> (<?=$category['count']?> items)
                </a>
            </li>
        <? endforeach ?>
        </ul>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>