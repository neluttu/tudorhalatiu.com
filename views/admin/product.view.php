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
                <span class="w-full py-2 text-sm font-normal md:flex-1">Nume produs:</span>
                <label class="w-full mb-2 border rounded-md bg-slate-50 md:flex-1">
                    <input id="name" name="name" required type="text" value="<?=$product['name']?>" class="w-full px-2 py-2 text-sm bg-transparent outline-none">
                </label>
                <span class="w-full"></span>
                <span class="w-full py-2 text-sm font-normal md:flex-1">Slug/URL produs:</span>
                <label class="w-full mb-2 border rounded-md bg-slate-50 md:flex-1">
                    <input id="slug" readonly name="slug" required type="text" value="<?=$product['slug']?>" class="w-full px-2 py-2 text-sm bg-transparent outline-none">
                </label>

                <!-- Load all product slugs and current product slug into hidden fields -->
                <input type="hidden" name="slugs_hidden" value='<?= json_encode($slugs); ?>' id="slugs_hidden">
                <input type="hidden" name="current_slug" value='<?= $product['slug'] ?>' id="current_slug">
                <!-- JS below grabs the input fields with the correct data and loads the script externally -->
                <script src="/public/js/checkProductSlugs.js">
                    
                </script>
                <span class="w-full"></span>
                <span class="w-full py-2 text-sm font-normal md:flex-1">Preț produs:</span>
                <label class="flex items-center justify-center w-full mb-2 border rounded-md bg-slate-50 md:flex-1">
                    <input type="text" required name="price" value="<?=$product['price']?>" class="flex-1 px-2 py-2 text-sm text-right bg-transparent outline-none"> 
                    <span class="px-2">lei</span>
                </label>
                <span class="w-full"></span>
                <span class="w-full py-2 text-sm font-normal md:flex-1">Mărimi produs:</span>
                <span class="flex items-center justify-end w-full gap-4 p-2 mb-2 text-right border rounded-md bg-slate-50 md:flex-1">
                    <? $productSizes = explode(',', $product['sizes']); foreach($sizes as $size) : ?>
                    <label for="size_<?=$size?>" class="flex items-center justify-end gap-1 text-sm font-light cursor-pointer">
                        <input type="checkbox" name="sizes[]" value="<?= $size ?>" id="size_<?=$size?>" <?= in_array($size, $productSizes) ? 'checked="checked"' : '' ?>> <span> <?=$size?></span>
                    </label>
                    <? endforeach ?>
                </span>
                <span class="w-full"></span>
                <span class="w-full py-2 text-sm font-normal md:flex-1">Categorie produs:</span>
                <select name="category" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md bg-slate-50 md:flex-1">
                    <? foreach ($categories as $category) : ?>
                        <option value="<?=$category['category_id']?>"  <?= $category['category_id'] === $product['category'] ? 'selected' : '' ?>><?=$category['name']?></option>
                    <? endforeach ?>
                </select>
                <span class="w-full"></span>
                <span class="w-full py-2 text-sm font-normal md:flex-1">Este pe stoc?</span>
                <select name="stock" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md bg-slate-50 md:flex-1">
                    <option value="Yes" <?= $product['stock'] == 'Yes' ? 'selected' : '' ?>>Da</option>
                    <option value="No" <?= $product['stock'] == 'No' ? 'selected' : '' ?>>Nu</option>
                </select>
                <span class="w-full"></span>
                <span class="w-full py-2 text-sm font-normal md:flex-1">Este vizibil pe site?</span>
                <select name="status" class="flex items-center justify-center w-full p-2 mb-2 text-sm text-right border rounded-md bg-slate-50 md:flex-1">
                    <option value="Online" <?= $product['status'] == 'Online' ? 'selected' : '' ?>>Da</option>
                    <option value="Offline" <?= $product['status'] == 'Offline' ? 'selected' : '' ?>>Nu</option>
                </select>
                <span class="w-full"></span>
                <span class="self-start w-full py-2 text-sm font-normal md:flex-1">Rezumat</span>
                <textarea name="excerpt" class="flex items-center justify-center w-full p-2 mb-2 text-sm border rounded-md auto-resize-textarea h-28 bg-slate-50 md:flex-1 dbText"><?=$product['excerpt']; ?></textarea>
                <span class="w-full"></span>
                <span class="self-start w-full py-2 text-sm font-normal md:flex-1">Descriere</span>
                <textarea name="description" class="flex items-center justify-center w-full p-2 mb-2 text-sm border rounded-md auto-resize-textarea h-44 bg-slate-50 md:flex-1 dbText"><?=$product['description']; ?></textarea>
                <script src="/public/js/dynamic-textarea.js"></script>
                <span class="w-full"></span>
                <div class="self-start w-full">
                    <button type="submit" class="px-6 py-4 text-sm text-white bg-green-700 rounded-md" id="submitBtn">
                        Actualizează datele produsului
                    </button>
                </div>
            </div>
        </form>
        <form method="post" enctype="multipart/form-data" class="w-full p-3 my-3 mt-10 mb-8 bg-gray-100 border rounded-lg"  id="images">
            <input type="hidden" name="id" value="<?= $product['id'] ?>" />
            Adaugă o imagine la acest produs:
            <input type="file" name="image" class="hidden" accept=".avif" id="fileInput" required>
            <div class="flex items-center justify-start w-full gap-4">
                <div class="relative flex items-center justify-start gap-4 p-3 mt-3 bg-white border border-gray-300 rounded-md cursor-pointer grow file-input-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer shrink-0" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009988" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M15 8h.01" />
                        <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" />
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" />
                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l.5 .5" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                    <span id="fileName" class="text-xs text-gray-500 md:text-inherit">Selectează un fișier cu extensia / formatul avif...</span>
                </div>
                <button type="submit" class="px-10 py-4 mt-3 text-sm text-white bg-green-700 rounded-md">
                    Încarcă imaginea
                </button>
            </div>
            <small class="block pt-2 text-xs text-rose-700">Important: imaginea să fie de <u>fix 600 x 900 pixeli</u></small>
        </form>
        <script src="/public/js/input_image.js"></script>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-6">
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
                            <button title="Setează ca și imagine principală" class="grid items-center p-2 transition-all duration-150 ease-in bg-white rounded-lg hover:bg-[#befff8]">
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
                            <button title="Șterge imaginea" class="grid items-center p-2 transition-all duration-150 ease-in bg-white rounded-lg hover:bg-rose-200">
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
                    <img src="/<?=$image . '?t=' . time() ?>" alt="<?= $product['name'] ?>">
                </div>
            <? $i++; endforeach; ?>
        </div>
        <form method="post" action="/admin/product/<?=$product['id']?>/destroy" class="flex flex-col p-3 mt-16 bg-gray-100 border rounded-lg">
            <input type="hidden" name="product_id" value="<?=$product['id'] ?>">
            <h2 class="mb-2 text-rose-700"><input type="checkbox" class="mr-2" id="destory"> <label for="destory" class="cursor-pointer">Șterge produs din baza de date</label></h2>
            <small class="text-gray-500">Atenție! Toate informațiile legate de acest produs (texte, imagini) vor fi șterse din baza de date <u class="text-rose-700">permanent</u>.</small>
            <button type="submit" class="px-6 py-3 mt-4 text-sm text-white rounded-md bg-rose-700" disabled="true" id="deleteButton">
                        Șterge produsul din baza de date
            </button>
            <script src="/public/js/deleteImageButton.js"></script>
        </form>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>