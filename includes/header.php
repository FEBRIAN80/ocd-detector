<?php
// Header untuk user pages
if (!defined('HEADER_INCLUDED')) {
    define('HEADER_INCLUDED', true);
    include 'config/database.php';
    checkLogin();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - OCD Detector' : 'OCD Detector'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
