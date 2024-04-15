<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta name="view-transition" content="same-origin" />
    <meta name="viewport" content="user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=yes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta property="og:url"           content="https://www.tudorhalatiu.com/">
    <meta property="og:type"          content="website">
    <meta property="og:title"         content="<?= $title ?? Core\Lang::text('header.title') ?>">
    <meta property="og:description"   content="<?= $description ?? Core\Lang::text('header.description') ?>">
    <meta property="og:image" content="">
    <meta name="REVISIT-AFTER" content="1 DAYS">
    <meta name="COPYRIGHT" content="S.C. Bluesky Studios S.R.L.">
    <meta name="robots" content="index,follow,noodp">
    <meta name="googlebot" content="index,follow">
    <meta content="<?= $description ?? Core\Lang::text('header.description') ?>" name="description">
    <meta content="<?= $keywords ?? Core\Lang::text('header.keywords') ?>" name="keywords">
    <title><?= $title ?? Core\Lang::text('header.title') ?></title>
    <link rel="stylesheet" href="/public/css/styles.css" class="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap');
    </style>
</head>
<body class="flex flex-col items-center justify-start min-h-screen font-merriweather">