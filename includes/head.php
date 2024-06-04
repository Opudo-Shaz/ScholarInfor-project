<?php 
    $base_url="http://".$_SERVER['SERVER_NAME'].'/fall/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="description" content="ScholarInfo - Kenya" />
  <meta name="author" content="OSLABS" />
  <meta name="keywords" content="ScholarInfo, Kenya " />



  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />
  <!-- End fonts -->

  <!-- core:css -->
  <link href="<?= $base_url.'assets/vendors/core/core.css'?>" rel="stylesheet">
  <!-- endinject -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= $base_url.'assets/vendors/flatpickr/flatpickr.min.css'?>"/>

  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="<?= $base_url."assets/fonts/feather-font/css/iconfont.css"?>"/>

  <!-- endinject -->

  <!-- Layout styles -->
  <link id="stylesheet" rel="stylesheet" href="<?= $base_url."assets/css/style-light.css"?>" />
  <link rel="stylesheet" href="<?= $base_url."assets/css/custom.css"?>"/>
  <link rel="stylesheet" href="<?= $base_url."assets/css/theme-toggler.css" ?>"/>
  <!-- End layout styles -->

  <link rel="shortcut icon"href="<?= $base_url."assets/images/favicon.jpg"?>" />
  <script src="<?= $base_url."assets/js/custom.js"?>" ></script>
</head>