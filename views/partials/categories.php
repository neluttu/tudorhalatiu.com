<div class="flex 
            flex-wrap 
            justify-center 
            w-full 
            gap-2 
            md:gap-4 
            mt-4
            md:mt-0
            px-2 
            mx-auto 
            mb-4 
            sm:mb-10
            max-w-7xl 
            lg:px-0 
            text-slate-600 
            [&>a:hover]:bg-main-color 
            [&>a:hover]:border-main-color 
            [&>a:hover]:text-white 
            [&>a]:transition-all 
            [&>a]:duration-150 
            [&>a]:ease-in
            [&>a]:text-xs
            sm:[&>a]:text-sm">
    <? foreach($categories as $category) : ?>
        <a href="/shop/<?= $category['slug'] ?>" class="px-2 md:px-4 py-1 md:py-2 border <?= (isset($product['category']) && $category['category_id'] === $product['category']) || (isset($current_category) && $category['slug'] === $current_category) ? 'bg-main-color border-main-color text-white' : 'text-slate-500' ?> hover:bg-main-color" title="<?= $category['name'] ?>"><?= $category['name'] ?></a>

    <? endforeach ?>
</div>