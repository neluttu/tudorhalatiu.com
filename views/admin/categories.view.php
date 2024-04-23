<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex items-start justify-start w-full gap-6 px-2 mt-10 max-w-7xl">
    <div class="flex flex-col items-start justify-center w-1/5 gap-3 shrink-0 text-slate-600 border-b [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div class="flex flex-col items-start justify-start w-full gap-y-6">
        <? foreach($categories as $category) : ?>
        <form method="post" class="flex justify-start w-full gap-2 pt-2 pb-2 text-sm border-b border-gray-300 items-bottom">
            <input type="hidden" name="_method" value="PATCH" />
            <input type="hidden" name="id" value="<?= $category['category_id'] ?>" />
            <label for="name_<?= $category['category_id']?>" class="flex flex-col items-start justify-start flex-1 gap-y-1">
                <span>Nume</span>
                <input id="name_<?= $category['category_id']?>" name="name" type="text" value="<?= $category['name']?>" class="w-full p-2 border rounded-lg">
            </label>
            <label for="text_<?= $category['category_id']?>" class="flex flex-col items-start justify-start flex-1 gap-y-1">
                <span>Descriere</span>
                <input id="text_<?= $category['category_id']?>" name="text" type="text" value="<?= $category['text']?>" class="w-full p-2 border rounded-lg">
            </label>
            <!-- <label for="slug_<?= $category['category_id']?>" class="flex flex-col items-start justify-start flex-1 text-gray-400 gap-y-1">
                <span class="">Slug</span>
                <input id="slug_<?= $category['category_id']?>" name="slug" type="text" value="<?= $category['slug']?>" class="w-full p-2 border rounded-lg ">
            </label> -->
            
            <button class="flex items-center justify-center px-3 py-1 text-white rounded-lg bg-main-color">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                </svg>
            </button>
        </form>
        <? endforeach ?>
        <!-- <small class="text-main-color">Editarea campului 2 (slug) va modifica URL-ul categoriei - periculos pentru Google daca a indexat deja URL-ul.</small> -->
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
