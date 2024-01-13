<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <form method="post" action="/note">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?=$note['id'];?>">
            <div class="mt-2">
                <textarea id="note"  name="note" rows="3" class="block w-full rounded-md border-0 p-4 text-gray-900 shadow-sm text-lg"><?= $_POST['note'] ?? $note['note'] ?></textarea>
                <?
                    if(isset($errors['note'])) 
                        echo '<p class="text-red-600 text-sm mt-3">'. $errors['note'].'</p>';
                ?>
            </div>
            
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
            </div>
        </form>

        <a href="/notes" class="inline-block px-3 py-2 rounded-md bg-gray-200 text-slate-600">Back to notes</a>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>