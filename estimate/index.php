<?php
$timeout = 2;
ini_set("session.gc_maxlifetime", $timeout);

session_start();

if (isset($_SESSION['uname'])) {
    // print_r($_SESSION);
    include '../model/database.php';
    include '../model/activity_logs.php';
    include '../model/editable.php';
    require '../controller/Currency_Format.php';

    // print_r($Editable); 
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        require '../view/includes/header.php';
        require "../view/includes/footer.php";
        ?>
    </head>

    <body class="sidebar-mini layout-fixed sidebar-collapse" style="background: #f4f6f9; overflow-x: hidden;" data-new-gr-c-s-check-loaded="14.1111.0" data-gr-ext-installed style="height: auto;">

    <?php
    require '../view/includes/nav.php';
    require 'estmt.php';
} else {
    header('Location: ../login.php');
}
    ?>
    </body>

    </html>