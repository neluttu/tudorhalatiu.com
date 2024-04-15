<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-16 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="order-last md:order-first flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div class="order-2 w-full md:order-1 md:-mt-10 md:grow">
        <form method="post">
            <div class="flex flex-wrap items-start justify-center w-full mt-4 md:gap-3 md:gap-y-1 text-slate-700">
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Nume produs:</span>
                <label class="w-full mb-2 border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <input name="name" required type="text" value="<?= old('name') ?>" class="w-full px-2 py-2 text-sm text-right bg-transparent outline-none">
                </label>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Preț produs:</span>
                <label class="flex items-center justify-center w-full mb-2 border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <input type="text" required name="price" value="<?= old('price') ?>" class="flex-1 px-2 py-2 text-sm text-right bg-transparent outline-none"> 
                    <span class="px-2">lei</span>
                </label>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Mărimi produs:</span>
                <span class="flex items-center justify-end w-full gap-4 p-2 mb-2 text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <? foreach($sizes as $size) : ?>
                    <label for="size_<?=$size?>" class="flex items-center justify-end gap-1 cursor-pointer">
                        <input type="checkbox" name="sizes[]" value="<?= $size ?>" id="size_<?=$size?>"> <span> <?=$size?></span>
                    </label>
                    <? endforeach ?>
                </span>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Categorie produs:</span>
                <select name="category" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <? foreach ($categories as $category) : ?>
                        <option value="<?=$category['category_id']?>"  <?= $category['category_id'] == old('category2') ? 'selected' : '' ?>><?=$category['name']?></option>
                    <? endforeach ?>
                </select>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Este pe stoc?</span>
                <select name="stock" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <option value="Yes" <?= old('stock') == 'Yes' ? 'selected' : '' ?>>Da</option>
                    <option value="No" <?= old('stock') == 'No' ? 'selected' : '' ?>>Nu</option>
                </select>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Este vizibil pe site?</span>
                <select name="status" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <option value="Online" <?= old('status') == 'Online' ? 'selected' : '' ?>>Da</option>
                    <option value="Offline" <?= old('status') == 'Offline' ? 'selected' : '' ?>>Nu</option>
                </select>
                <span class="w-full"></span>
                <span class="self-start w-full py-2 font-semibold md:w-auto md:flex-1">Rezumat</span>
                <textarea name="excerpt" class="flex items-center justify-center w-full p-2 mb-2 text-sm border rounded-md h-28 md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1"><?= old('excerpt') ?></textarea>
                <span class="w-full"></span>
                <span class="self-start w-full py-2 font-semibold md:w-auto md:flex-1">Descriere</span>
                <textarea name="description" class="flex items-center justify-center w-full p-2 mb-2 text-sm border rounded-md h-44 md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1"><?= old('description') ?></textarea>
                <span class="w-full"></span>
                
                <button type="submit" class="px-10 py-3 text-white bg-green-700 rounded-md">
                    Adaugă produsul
                </button>
            </div>
        </form>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>