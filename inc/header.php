<?php
ob_start();
session_start();
include 'lib/session.php';
Session::init();

include_once 'classes/khoa.php';
include_once 'classes/benh.php';
include_once 'classes/bai_viet.php';
include_once 'classes/tin_tuc.php';

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$khoas = new Khoa();
$post = new post();
$benh = new Benh();
$tin_tuc = new news();

$getAllChiTietKhoaAndBenh = $khoas->getAllChiTietKhoaAndBenh();
$getMenuMobile = $benh->getMenuMobile();
// var_dump($getMenuMobile);
?>


<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");

$local = 'http://localhost/_nhatvietnew/phongkhamdakhoanhatviet.vn';
// $local = 'https://phongkhamdakhoanhatviet.vn'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Phòng khám Nhật Việt chuyên điều trị bệnh nam khoa, bệnh xã hội, da liễu, hậu môn - trực tràng uy tính tại thành phố Hồ Chí Minh">
    <title>Phòng khám Nhật Việt</title>
    <link rel="icon" href="<?php echo $local ?>/images/icons/icon_logo.png" type="image/x-icon">
    <link rel="preload" as="image" href="<?php echo $local ?>/images/banner/mobile_banner.webp" fetchpriority="high"
        media="(max-width: 768px)">
    <link rel="preload" href="<?php echo $local ?>/css/index.min.css" as="style"
        onload='this.onload=null,this.rel="stylesheet"'>


    <!-- CSS mobile -->
    <link rel="preload" href="<?php echo $local ?>/css/header-mobile.min.css" as="style" media="(max-width: 999px)"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $local ?>/css/appointment-mobile.min.css" as="style" media="(max-width: 999px)"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $local ?>/css/footer-mobile.min.css" as="style" media="(max-width: 999px)"
        onload="this.onload=null;this.rel='stylesheet'">
    <!-- CSS PC -->
    <link rel="preload" href="<?php echo $local ?>/css/header.min.css" as="style" media="(min-width: 1000px)"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $local ?>/css/footer.min.css" as="style" media="(min-width: 1000px)"
        onload="this.onload=null;this.rel='stylesheet'">


    <noscript>
        <link rel="stylesheet" href="<?php echo $local ?>/css/index.min.css">

        <link rel="stylesheet" href="<?php echo $local ?>/css/header-mobile.min.css">
        <link rel="stylesheet" href="<?php echo $local ?>/css/appointment-mobile.min.css">
        <link rel="stylesheet" href="<?php echo $local ?>/css/footer-mobile.min.css">
        <link rel="stylesheet" href="<?php echo $local ?>/css/header.min.css">
        <link rel="stylesheet" href="<?php echo $local ?>/css/footer.min.css">
    </noscript>