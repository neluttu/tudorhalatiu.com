<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <a href="/notes" class="inline-block mt-3 px-3 py-2 rounded-md bg-gray-200 text-slate-600 mb-4">< Back to notes</a>
        <p class="text-2xl mb-10">    
            <?= htmlspecialchars($note['note']) ?>
        </p>
        <form method="post" action="/notes">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button class="px-3 py-2 text-white bg-red-400 rounded-md mt-3">Delete this note</button>
        </form>
        <a href="/note/edit/<?=$note['id'];?>" class="inline-block mt-3 px-3 py-2 rounded-md bg-gray-200 text-slate-600 mb-4">Edit note</a>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>