<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div class="w-full md:-mt-10 md:grow">
        <form nane="filter" class="flex items-center justify-start" method="get">
            <label for="filters">
                Afișează:
                <select class="p-2 mb-2 text-sm border rounded-md bg-slate-50" id="filters" name="filter" onchange="this.form.submit()">
                    <option value="" <?= (isset($_GET['filter']) and $_GET['filter'] === '') ? 'selected' : '' ?>>toate produsele</option>
                    <option value="discount" <?= (isset($_GET['filter']) and $_GET['filter'] === 'discount') ? 'selected' : '' ?>>cele cu discount</option>
                    <option value="stock" <?= (isset($_GET['filter']) and $_GET['filter'] === 'stock') ? 'selected' : '' ?>>cele fara stoc</option>
                    <option value="status" <?= (isset($_GET['filter']) and $_GET['filter'] === 'status') ? 'selected' : '' ?>>cele care nu se afiseaza pe site</option>
                </select>
            </label>
        </form>
        <?
        foreach($products as $product) {
            if ($product['category_name'] != $currentCategory) {
                if ($currentCategory !== null) echo "</div>";
                echo '<div class="w-full p-2 my-4 text-white rounded-md bg-main-color">' . $product['category_name'] . '</div>';
                echo '<div class="grid grid-cols-3 gap-x-6 gap-y-10 sm:grid-cols-4 lg:grid-cols-7">';
                $currentCategory = $product['category_name'];
            }
        ?>
            <a href="<?= \Core\Session::getLang(); ?>/admin/product/<?= $product['id']; ?>" class="group" title="<?= $product['name'] ?>">
                <div class="relative w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                    
                    <img src="/public/images/products/<?=$product['id']?>/<?= is_file(base_path() . '/public/images/products/' . $product['id'] . '/poster.avif') ? 'poster.avif' : '../../no-poster.avif' ?>" alt="<?= $product['excerpt'] ?>" class="object-cover object-center w-full h-full transition-all duration-150 ease-in group-hover:opacity-75 <?= $product['status'] === 'Offline' ? 'grayscale' : ''?>" loading="lazy">
                </div>
                <h3 class="mt-4 text-xs text-gray-700 line-clamp-1"><?=$product['name'] ?></h3>
                <p class="mt-1 text-sm font-medium text-main-color"><?= number_format($product['price'], 2, ',','.') ?> lei</p>
                <small class="text-xs text-gray-600"><?= $product['views'] ?> vizualizări</small>
                <small class="block text-xs text-gray-600 uppercase bg-white/80 backdrop-blur-sm"><?= $product['stock'] === 'No' ? '<span class="text-red-700">Stoc: Nu</span>' : '<span class="text-green-700">Stoc: Da</span>'?></small>
            </a>            
        <?
            }
            echo "</div>";
        ?>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
