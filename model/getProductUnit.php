<?php

require "database.php";


if($_POST["action"] == "getUnit"){
    $prod = $_POST["prod"];

    $Query = mysqli_fetch_assoc(mysqli_query($con , "SELECT * FROM `product_list` WHERE `prod_int` = '{$prod}'"));

    $getUnit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_unit_map` WHERE `prod_id` = '{$Query['id']}'"));

    // echo getUnit($getUnit['id'])[0];
    echo (getUnit($getUnit['id'])[0]["unit_name"]);
}