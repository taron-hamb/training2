<html>
<head>
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_URL; ?>resource/css/style.css">
    <script src="<?php echo SITE_URL; ?>resource/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>resource/js/js.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>resource/js/validation.js"></script>

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>resource/css/screen.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>resource/css/lightbox.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo SITE_URL; ?>resource/js/jquery.plugin.js"></script>
    <script src="<?php echo SITE_URL; ?>resource/js/jquery.datepick.js"></script>
</head>
<body>
<?php
if ($_SESSION != array()) {
    if ($_SESSION['is_login'] == "ok") {
        echo '<div class="log_out"><a href="/user/log_out" name="log_out">Log out</a></div>';
    }
} else {

}
?>