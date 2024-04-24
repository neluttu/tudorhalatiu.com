<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-16 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="order-last md:order-first flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div class="order-2 w-full md:order-1 md:-mt-10 md:grow">
        <form method="post" action="/admin/product/<?= $product['id'] ?>">
            <input type="hidden" name="_method" value="patch">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <div class="flex flex-wrap items-start justify-center w-full mt-4 md:gap-3 md:gap-y-1 text-slate-700">
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Nume produs:</span>
                <label class="w-full mb-2 border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <input name="name" required type="text" value="<?=$product['name']?>" class="w-full px-2 py-2 text-sm text-right bg-transparent outline-none">
                </label>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Preț produs:</span>
                <label class="flex items-center justify-center w-full mb-2 border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <input type="text" required name="price" value="<?=$product['price']?>" class="flex-1 px-2 py-2 text-sm text-right bg-transparent outline-none"> 
                    <span class="px-2">lei</span>
                </label>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Mărimi produs:</span>
                <span class="flex items-center justify-end w-full gap-4 p-2 mb-2 text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <? $productSizes = explode(',', $product['sizes']); foreach($sizes as $size) : ?>
                    <label for="size_<?=$size?>" class="flex items-center justify-end gap-1 cursor-pointer">
                        <input type="checkbox" name="sizes[]" value="<?= $size ?>" id="size_<?=$size?>" <?= in_array($size, $productSizes) ? 'checked="checked"' : '' ?>> <span> <?=$size?></span>
                    </label>
                    <? endforeach ?>
                </span>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Categorie produs:</span>
                <select name="category" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <? foreach ($categories as $category) : ?>
                        <option value="<?=$category['category_id']?>"  <?= $category['category_id'] === $product['category'] ? 'selected' : '' ?>><?=$category['name']?></option>
                    <? endforeach ?>
                </select>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Este pe stoc?</span>
                <select name="stock" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <option value="Yes" <?= $product['stock'] == 'Yes' ? 'selected' : '' ?>>Da</option>
                    <option value="No" <?= $product['stock'] == 'No' ? 'selected' : '' ?>>Nu</option>
                </select>
                <span class="w-full"></span>
                <span class="w-full py-2 font-semibold md:w-auto md:flex-1">Este vizibil pe site?</span>
                <select name="status" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1">
                    <option value="Online" <?= $product['status'] == 'Online' ? 'selected' : '' ?>>Da</option>
                    <option value="Offline" <?= $product['status'] == 'Offline' ? 'selected' : '' ?>>Nu</option>
                </select>
                <span class="w-full"></span>
                <span class="self-start w-full py-2 font-semibold md:w-auto md:flex-1">Rezumat</span>
                <textarea name="excerpt" class="flex items-center justify-center w-full p-2 mb-2 text-sm border rounded-md h-28 md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1"><?=$product['excerpt']; ?></textarea>
                <span class="w-full"></span>
                <span class="self-start w-full py-2 font-semibold md:w-auto md:flex-1">Descriere</span>
                <textarea name="description" class="flex items-center justify-center w-full p-2 mb-2 text-sm border rounded-md h-44 md:bg-white md:rounded-none md:border-0 md:border-b bg-slate-50 md:w-auto md:flex-1"><?=$product['description']; ?></textarea>
                <span class="w-full"></span>
                
                <button class="px-10 py-3 text-white rounded-md bg-rose-700">
                    Șterge produsul
                </button>
                <button type="submit" class="px-10 py-3 text-white bg-green-700 rounded-md">
                    Actualizează
                </button>
            </div>
        </form>
        <form method="post" enctype="multipart/form-data" class="mt-10"  id="images">
            <input type="hidden" name="id" value="<?= $product['id'] ?>" />
            <div class="w-full my-3 mb-8">
                Adaugă o imagine la acest produs:<br><br>
                <input type="file" name="image" accept=".avif"><br><br>
                <button type="submit" class="px-10 py-3 text-white bg-green-700 rounded-md">
                    Adaugă imaginea
                </button>
            </div>
        </form>
        <div class="grid grid-cols-3 gap-4">
            <? 
            $i = 0;
            foreach($images as $image) : 
            ?>
                <div class="relative overflow-hidden rounded-lg group">
                    <div class="absolute flex items-center justify-between w-full h-auto gap-4 p-4 transition-all duration-150 ease-in opacity-0 group-hover:opacity-100">
                        <? if($i > 0) : ?>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="image" value="<?= $image ?>">
                            <button class="grid items-center p-2 transition-all duration-150 ease-in bg-white rounded-lg hover:bg-[#befff8]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009988" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M15 8h.01" />
                                    <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" />
                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" />
                                    <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l.5 .5" />
                                    <path d="M15 19l2 2l4 -4" />
                                </svg>
                            </button>
                        </form>
                        <? endif ?>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="image" value="<?= $image ?>">
                            <button class="grid items-center p-2 transition-all duration-150 ease-in bg-white rounded-lg hover:bg-rose-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 7h16" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    <path d="M10 12l4 4m0 -4l-4 4" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <img src="/<?=$image . '?t=' . time() ?>" >
                </div>
            <? $i++; endforeach; ?>
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>