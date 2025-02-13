<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SITANGAN - DLH Kota Cimahi</title>
    <link rel="icon" href="<?php echo base_url('/assets/images/logo/favicon.png'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('/assets/images/logo/favicon.png'); ?>" type="image/x-icon">
    <meta name="description" content="sitangan dinas lingkungan hidup kota cimahi">
    <meta name="keywords" content="sitangan, kota cimahi, dlh cimahi">
    <meta name="author" content="dlh cimahi">
    <?= $this->include('/layout/source/css') ?>
</head>

<body>
    <div id="base_url" data-url="<?php echo base_url(); ?>"></div>
    <?= $this->include('/layout/header') ?>
    <?= $this->include('/layout/sidebar') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include('/layout/source/js');  ?>
</body>

</html>