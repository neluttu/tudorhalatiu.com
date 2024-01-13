<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta name="viewport" content="user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=yes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta property="og:url"           content="https://www.dietethic.ro/">
    <meta property="og:type"          content="website">
    <meta property="og:title"         content="<?= $title ?? Core\Lang::text('header.title') ?>">
    <meta property="og:description"   content="<?= $description ?? Core\Lang::text('header.description') ?>">
    <meta property="og:image" content="https://www.dietethic.ro/template/images/fb_og.jpg">
    <meta name="REVISIT-AFTER" content="1 DAYS">
    <meta name="COPYRIGHT" content="S.C. Bluesky Studios S.R.L.">
    <meta name="robots" content="index,follow,noodp">
    <meta name="googlebot" content="index,follow">
    <meta content="<?= $description ?? Core\Lang::text('header.description') ?>" name="description">
    <meta content="<?= $keywords ?? Core\Lang::text('header.keywords') ?>" name="keywords">
    <title><?=$title ?? Core\Lang::text('header.title') ?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/styles.css">
    <link rel="alternate" href="https://www.dietethic.ro/" hreflang="ro-ro">
</head>
<body class="w-full">
    <div class="min-h-full">