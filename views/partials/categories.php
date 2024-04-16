<div class="flex flex-wrap justify-start md:justify-center w-full gap-2 md:gap-4 px-2 mx-auto mb-10 max-w-7xl lg:px-0 text-slate-600 [&>a:hover]:bg-[#ed0078] [&>a:hover]:border-[#ed0078] [&>a:hover]:text-white [&>a]:transition-all [&>a]:duration-150 [&>a]:ease-in">
    <? foreach($categories as $category) : ?>
        <a href="/shop/<?=$category['slug']?>" class="px-2 md:px-4 py-1 md:py-2 border <?= ($category['category_id'] === $product['category'] or $category['slug'] === $current_category) ? 'bg-[#ed0078] border-[#ed0078] text-white' : 'text-slate-500' ?> hover:bg-[#ed0078]" title="<?= $category['name'] ?>"><?=$category['name']?></a>
    <? endforeach ?>
</div>