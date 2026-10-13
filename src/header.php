<?php
declare(strict_types=1);
require_once __DIR__ . '/helpers.php';
$title  = $title ?? 'Blue Peak Coffee Tours';
$active = $active ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?></title>
  <meta name="description" content="Small-group coffee and hiking tours from Kingston to the Blue Mountains.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,800&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<header class="nav">
  <div class="wrap nav__inner">
    <a class="brand" href="/">
      <svg width="30" height="22" viewBox="0 0 30 22" aria-hidden="true"><path d="M0 22 L11 4 L17 13 L22 7 L30 22Z" fill="#F6C21B"/></svg>
      Blue Peak
    </a>
    <button class="nav__toggle" aria-expanded="false" aria-controls="menu">Menu</button>
    <nav id="menu" class="nav__links">
      <a href="/#tours"<?= $active === 'tours' ? ' aria-current="page"' : '' ?>>Tours</a>
      <a href="/#how">How it works</a>
      <a href="/#faq">Questions</a>
      <a class="btn btn--sun btn--small" href="/book.php">Book a tour</a>
    </nav>
  </div>
</header>
<main>
