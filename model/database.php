<?php
error_reporting(E_ERROR | E_PARSE);

if (file_exists("../model/connection.php")) {
    require "../model/connection.php";
} else {
    require "model/connection.php";
}


mysqli_set_charset($con, 'utf8');

$reg = mysqli_query($con, 'Select Distinct region from tbl_pack');
$ser = mysqli_query($con, 'Select Distinct pack_series from tbl_pack');

$pack_query = 'Select Distinct pack from tbl_pack';
$pack = mysqli_query($con, $pack_query);
$product_prices = array();
$tbl = array();
$secArr = array();

if (isset($_POST['buffer'])) {
    echo $_POST['buffer'];
}

if (!function_exists("priceTbl")) {
    function priceTbl($region)
    {
        global $EstmDATA, $con;
        // $exe_query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `region`  = 0 ");
        $exe_query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `region` = '{$region}'");
        while ($price_tbl = mysqli_fetch_assoc($exe_query)) {
            $price_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `rate_card_id` = '{$EstmDATA['product_list']}' AND `prod_id` = '{$price_tbl['id']}'"));
            $product_prices[$price_tbl['prod_int']] = floatval($price_query['price']);
            $prod_cat[$price_tbl['prod_int']] = $price_tbl['sec_category'];
            $product_sku[$price_tbl['prod_int']] = $price_tbl['sku_code'];
            $products[$price_tbl['prod_int']] = $price_tbl['product'];

            // print_r($price_tbl);
        }
        $exe_query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `region`  = '0'");
        while ($price_tbl = mysqli_fetch_assoc($exe_query)) {
            $price_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `rate_card_id` = '{$EstmDATA['product_list']}' AND `prod_id` = '{$price_tbl['id']}'"));
            $product_prices[$price_tbl['prod_int']] = intval($price_query['price']);
            $prod_cat[$price_tbl['prod_int']] = $price_tbl['sec_category'];
            $product_sku[$price_tbl['prod_int']] = $price_tbl['sku_code'];
            $products[$price_tbl['prod_int']] = $price_tbl['product'];

            // print_r($price_tbl);
        }
        return compact("product_prices", "prod_cat", "product_sku", "products", "price_tbl");
    }
}
// print_r( $prod_cat );

if (!function_exists('employee')) {
    function employee($code)
    {
        global $con;
        $get_emp = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `login_master` WHERE `employee_code` = '{$code}'"));
        return $get_emp;
    }
}

if (!function_exists('create_opt')) {
    function create_opt($category, $savedVal = "")
    {
        global $con;
        $query = mysqli_query($con, "SELECT DISTINCT `product` , `prod_int` FROM `product_list` WHERE `sec_category` = '{$category}'");
        while ($product = mysqli_fetch_assoc($query)) {
            if ($savedVal == $product['prod_int']) {
                echo "<option selected value  = '{$product['prod_int']}'>{$product['product']}</option>";
            } else {
                echo "<option value  = '{$product['prod_int']}'>{$product['product']}</option>";
            }
        }
    }
}
if (!function_exists('GetVal')) {
    function GetVal($id)
    {
        global $con;
        $quer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `product_list` WHERE `id` = '{$id}'"));
        return $quer;
    }
}

if (!function_exists("UserRole")) {
    function UserRole($Permission)
    {
        global $con;
        $get_user_role = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `login_master` WHERE `employee_code` = '{$_SESSION['emp_code']}'"));
        $get_user_permissions = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `role_permissions` WHERE `role_id` = '{$get_user_role['user_role']}'"));
        $arr = explode(",", $get_user_permissions["permission_id"]);
        foreach ($arr as $k => $v) {
            if ($v == $Permission) {
                return true;
                break;
            }
        }
    }
}

$dbQuery = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `primary_category` = 'software' AND `sec_category` = 'db'");
while ($arr = mysqli_fetch_assoc($dbQuery)) {
    $dbArr[] = $arr['prod_int'];
}


$osQuery = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `primary_category` = 'software' AND `sec_category` = 'os'");
while ($arr = mysqli_fetch_assoc($osQuery)) {
    $osArr[] = $arr['prod_int'];
}

$strgQuery = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `primary_category` = 'storage'");
while ($arr = mysqli_fetch_assoc($strgQuery)) {
    if (preg_match("/Backup|Archiv|Tape|Fire/", $arr['product'])) {
    } else {
        $strgArr[$arr["prod_int"]] = $arr['product'];
    }
}

$secQuery = mysqli_query($con, "SELECT DISTINCT `sec_category` FROM `product_list` WHERE `primary_category` = 'security'");
while ($arr = mysqli_fetch_assoc($secQuery)) {
    // echo "SELECT DISTINCT `prod_int`, `product` FROM `product_list` WHERE `sec_category` = '{$arr['sec_category']}'";

    $prodQuer = mysqli_query($con, "SELECT DISTINCT `prod_int`, `product` FROM `product_list` WHERE `sec_category` = '{$arr['sec_category']}'");
    while ($prod = mysqli_fetch_assoc($prodQuer)) {
        if ($arr['sec_category'] == "av") {
        } else {
            $secArr[$arr['sec_category']][$prod["prod_int"]] = $prod['product'];
        }
    }
}

// print_r($secArr);


if (!function_exists("getProdName")) {
    function getProdName($int)
    {
        global $con;
        $query = mysqli_fetch_assoc(mysqli_query($con, "SELECT DISTINCT `product` FROM `product_list` WHERE `prod_int` = '{$int}'"));
        return $query['product'];
    }
}

if (!function_exists("getEstimateDetails")) {
    function getEstimateDetails($id)
    {
        global $con;
        $query = mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `id` = '{$id}' ");
        if ($query) {
            $data = mysqli_fetch_assoc($query);
            return $data;
        }
    }
}


if (!function_exists("Query")) {
    function Query($query)
    {
        global $con;
        return mysqli_query($con, $query);
    }
}

if (!function_exists("PPrint")) {
    function PPrint($Array)
    {
        echo "<pre>";
        print_r($Array);
        echo "</pre>";
    }
}


if (!function_exists("getUnit")) {
    function getUnit($id)
    {
        global $con;
        $unitId = array();

        $quer = mysqli_query($con, "SELECT * FROM `tbl_unit_map` WHERE `prod_id` = '{$id}'");

        while ($row = mysqli_fetch_assoc($quer)) {
            $quer2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_unit` WHERE `id` = {$row['unit_id']}"));
            $unitId[] = $quer2;
        }
        return $unitId;
    }
}
