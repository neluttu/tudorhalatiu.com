<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>


<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <ul class="flex gap-3 flex-col">
        <? foreach($notes as $note) : ?>
            <li class="text-base text-slate-700 list-none border border-slate-300 bg-slate-200 rounded-md p-3"> 
                <a href="/note/<?=$note['id'];?>" class="hover:underline">
                    <?
                    $note['id'] = sprintf('%02s', $note['id']);
                    echo $note['id'] .'). ' . htmlspecialchars($note['note']) 
                    ?>
                </a>
            </li>
        <? endforeach ?>
        </ul>
        <a href="/notes/create" class="inline-block px-3 py-2 rounded-md bg-blue-600 text-white mt-10">Create new note</a>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
