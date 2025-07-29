<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-center justify-center w-full gap-8 mx-auto text-center max-w-7xl">
    <p class="pt-10 text-slate-700">Mulțumim pentru comandă, <br><span class="text-main-color">inițiem transferul securizat</span> către procesatorul de plăți <span class="text-[#3b61fc]">TwisPay</span>.</p>
    <form id="twispay" action="https://<?= $twispayLive ? "secure.xmoney.com" : "secure-stage.xmoney.com" ?>" method="post" accept-charset="UTF-8" class="">
        <input type="hidden" name="jsonRequest" value="<?= $base64JsonRequest ?>">
        <input type="hidden" name="checksum" value="<?= $base64Checksum ?>">
        <input type="submit" class="hidden">
        <div class="loader"></div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(() => {
                    document.querySelector("#twispay").submit();
                }, 3000);
            });
        </script>
    </form>
</main>

<? require base_path('views/partials/footer.php'); ?>