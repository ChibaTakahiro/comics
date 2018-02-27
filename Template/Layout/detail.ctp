<?php

$title = "sample";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?=$title?></title>
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/css/basic.css" type="text/css">
<link rel="stylesheet" href="/dist/css/swiper.min.css">
<body>
    <?= $this->fetch('content') ?>
</body>
</html>
