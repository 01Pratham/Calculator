<?php

require "../model/database.php";

if (isset($_POST['action']) && $_POST['action'] == "Discount") {
    $discountPercentage = $_POST['discountVal'];
    $months = $_POST[''];
    $Total = $_POST['Total'];
    $Data = json_decode(($_POST['data']), true);
    $maxDiscountTotal = array();
    $newTotal = array();
    foreach ($Data as $Index => $Arr) {
        if (is_array($Arr)) {
            foreach ($Arr as $Key => $Val) {
                if (is_array($Val)) {
                    $Discountable_percentage = Product($Val['SKU'])["discountable_percentage"];
                    $groupQty = (preg_match("/vm/", $Index)) ? floatval($Arr["QTY"]) : 1;
                    $maxDiscountTotal[] = ($Discountable_percentage / 100) * floatval($Val['MRC']);
                    $newTotal[] = floatval($Val['MRC']);
                    $inputPrices[] = Product($Val['SKU'])["input_price"];
                    $Prices[] = Product($Val['SKU'])["price"];
                    $Quantity[] = intval($Val["Quantity"]) * $groupQty;
                }
            }
        }
    }
    $discountToBeGiven = ($Total * floatval($discountPercentage));
    $avgDiscPerc = (floatval($discountToBeGiven) / array_sum($maxDiscountTotal));
    $DiscountedMrcArr = array();
    foreach ($Data as $Index => $Arr) {
        if (is_array($Arr)) {
            foreach ($Arr as $Key => $Val) {
                if(is_array($Val)){
                    $Discountable_percentage = Product($Val['SKU'])["discountable_percentage"];
                    $discountable_price = ($Discountable_percentage / 100) * floatval($Val['MRC']);
                    $MRC = floatval($Val["MRC"]);
                    $DMRC = $MRC - ($discountable_price * floatval($avgDiscPerc));
                    $DiscountedMrcArr[$Index][preg_replace("/ /", "", $Key)] = ($MRC <= 0) ? 0 : 100 - (100 * ($DMRC / $MRC));
                }
            }
        }
    }
    foreach ($DiscountedMrcArr as $KEY => $VAL) {
        if (is_array($VAL)) {
            foreach ($VAL as $Key => $Val) {
                if ($Val < 0) {
                    $DiscountedMrcArr[$KEY][$Key] = 0;
                }
                // if ($Val > Product($Data[$KEY][$Key]['SKU'])["discountable_percentage"]) {
                //     $DiscountedMrcArr[$KEY][$Key] = floatval(Product($Data[$KEY][$Key]['SKU'])["discountable_percentage"]);
                // }
            }
        }
    }
}


function Product($SKU)
{
    global $con;
    $getProdId = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `product_list` WHERE `sku_code` = '{$SKU}'"));
    $getPrices = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `prod_id` = '{$getProdId['id']}'"));
    return $getPrices;
}


echo json_encode($DiscountedMrcArr, JSON_PRETTY_PRINT);
