<?php use Core\Session; ?>
<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex items-start justify-start w-full gap-6 px-2 mt-10 max-w-7xl">
    <div
        class="flex flex-col items-start justify-center w-1/5 gap-3 shrink-0 text-slate-600 border-b [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <?php require base_path('views/admin/menu.view.php') ?>
    </div>
    <div class="flex-1">
        <?php if (!empty($message)): ?>
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="w-full p-3 my-3 mb-8 bg-gray-100 border rounded-lg"
            id="hero_image">

            <input type="hidden" name="id" value="<?php echo $hero['id'] ?? '' ?>">
            <?php if (isset($hero['id'])): ?><input type="hidden" name="_method" value="patch"><?php endif; ?>
            Setează o imagine hero cu sau fără link pentru prima pagină a magazinului:
            <input type="file" name="image" class="hidden" accept=".avif" id="fileInput">
            <div class="flex flex-wrap items-center justify-start w-full gap-3">
                <div class="w-full mt-2">
                    <input type="text" name="title" value="<?= $hero['title'] ?? ''; ?>" placeholder="Titlu banner"
                        class="w-full p-2 py-3 mt-4 text-sm bg-white border border-gray-300 rounded-md">
                </div>
                <div class="w-full ">
                    <input type="text" name="url" value="<?= $hero['url'] ?? ''; ?>"
                        placeholder="Link banner opțional: /shop/fuste-si-pantaloni"
                        class="w-full p-2 py-3 mt-2 text-sm bg-white border border-gray-300 rounded-md">
                </div>
                <?php if ($hero): ?>
                    <div class="w-full">
                        <img src="/public/images/hero-images/<?= $hero['image_url'] ?>" alt="<?= $hero['title']; ?>"
                            class="w-full h-auto mt-4 rounded-md">
                    </div>
                <?php endif; ?>
                <div
                    class="relative flex items-center justify-start gap-4 p-3 mt-3 bg-white border border-gray-300 rounded-md cursor-pointer grow file-input-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer shrink-0" width="28" height="28"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#009988" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 8h.01" />
                        <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" />
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" />
                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l.5 .5" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                    <span id="fileName" class="text-xs text-gray-500 md:text-inherit">Selectează un fișier cu extensia /
                        formatul avif...</span>
                </div>

                <button type="submit" class="px-10 py-4 mt-3 text-sm text-white bg-green-700 rounded-md">
                    Setează hero
                </button>
            </div>
            <div id="imagePreview" class="mt-4"></div>

            <small class="block pt-2 text-xs text-rose-700">Important: imaginea să fie de <u>fix 1280 x 726
                    pixeli</u></small>
        </form>
        <script src="/public/js/input_image.js"></script>

        <?php if ($hero): ?>
            <form method="post" action="/admin/front-page-hero/delete">
                <input type="hidden" name="id" value="<?= $hero['id'] ?>">
                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="w-full px-10 py-4 mt-3 text-sm text-white bg-red-700 rounded-md">
                    Șterge imaginea hero
                </button>

            </form>
        <?php endif; ?>
    </div>

</main>
<?php require base_path('views/partials/footer.php'); ?>