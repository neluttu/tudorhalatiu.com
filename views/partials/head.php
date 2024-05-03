<!DOCTYPE html>
<html lang="ro" class="h-full">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T4KFM440Y9"></script>
    <script src="/public/js/googleAnalytics.js"></script>
    <?= $schema ?? '' ?>
    <meta charset="UTF-8">
    <meta http-equiv="expires" content="Thu, 31 Dec 2024 23:59:59 GMT">
    <meta name="view-transition"            content="same-origin" />
    <meta name="viewport"                   content="user-scalable=yes, initial-scale=1, maximum-scale=5, minimum-scale=1, width=device-width">
    <meta name="format-detection"           content="telephone=yes">
    <meta http-equiv="x-ua-compatible"      content="ie=edge">
    <meta name="REVISIT-AFTER"              content="1 DAYS">
    <meta name="COPYRIGHT"                  content="S.C. Bluesky Studios S.R.L.">
    <meta name="robots"                     content="index,follow,noodp">
    <meta name="googlebot"                  content="index,follow">
    <meta name="description"                content="<?= $description ?? Core\Lang::text('header.description') ?>">
    <meta name="keywords"                   content="<?= $keywords ?? Core\Lang::text('header.keywords') ?>">
    <meta property="og:locale"              content="ro-RO">
    <meta property="og:url"                 content="https://www.tudorhalatiu.com/">
    <meta property="og:type"                content="website">
    <meta property="og:title"               content="<?= $title ?? Core\Lang::text('header.title') ?>">
    <meta property="og:description"         content="<?= $description ?? Core\Lang::text('header.description') ?>">
    <meta property="og:image"               content="https://www.tudorhalatiu.com/public/images/tudor-halatiu-og.jpg">
    <meta name="twitter:card"               content="summary_large_image">
    <meta property="twitter:domain"         content="tudorhalatiu.com">
    <meta property="twitter:url"            content="https://tudorhalatiu.com">
    <meta property="twitter:title"          content="<?= $title ?? Core\Lang::text('header.title') ?>">
    <meta property="twitter:description"    content="<?= $description ?? Core\Lang::text('header.description') ?>">
    <meta name="twitter:image" content="https://www.tudorhalatiu.com/public/images/tudor-halatiu-og.jpg">
    <link rel="icon" type="image/svg+xml" href="/public/images/favicon.svg">
    <link rel="icon" type="image/png" href="/public/images/favicon.png">
    <title><?= $title ?? Core\Lang::text('header.title') ?></title>
    <link rel="canonical" href="https://tudorhalatiu.com<?= $_SERVER['REQUEST_URI'] ?>">
    <link rel="stylesheet" href="/public/css/styles.css" class="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body class="flex flex-col items-center justify-start min-h-screen font-merriweather">