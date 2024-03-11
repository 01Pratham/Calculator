<?php

require "../model/database.php";
// require "Currency_Format.php";

if (isset($_POST['action']) && $_POST['action'] == "Discount") {
    // print_r($_POST);
    $discountPercentage = $_POST['discountVal'];
    $months = $_POST[''];
    $Total = $_POST['Total'];
    $Data = json_decode(($_POST['data']), true);
    $maxDiscountTotal = array();
    $newTotal = array();
    // PPrint($Data);
    foreach ($Data as $Index => $Arr) {
        if (is_array($Arr)) {
            foreach ($Arr as $Key => $Val) {
                if (is_array($Val)) {
                    if (preg_match("/vm/", $Index)) {
                        $maxDiscountTotal[] = (Product($Val['SKU'])["discountable_price"] * intval($Val["Quantity"])) * floatval($Arr["QTY"]);
                    } else {
                        $maxDiscountTotal[] = (Product($Val['SKU'])["discountable_price"] * intval($Val["Quantity"]));
                    }
                    // $maxDiscountTotal[] = (Product($Val['SKU'])["discountable_price"] * intval($Val["Quantity"])) * floatval($Arr["QTY"]);
                    $inputPrices[] = Product($Val['SKU'])["input_price"];
                    $Prices[] = Product($Val['SKU'])["price"];
                    $newTotal[] = $Val['MRC'];
                    $Quantity[] = intval($Val["Quantity"]);
                    // echo $key;
                }
            }
        }
    }
    // PPrint($maxDiscountTotal);

    $discountToBeGiven = (array_sum($newTotal) * floatval($discountPercentage));
    $avgDiscPerc = floatval($discountToBeGiven) / array_sum($maxDiscountTotal);
    $DiscountedMrcArr = array();
    foreach ($Data as $Index => $Arr) {
        if (is_array($Arr)) {
            foreach ($Arr as $Key => $Val) {
                if (preg_match("/vm/", $Index)) {
                    if ($Key == "QTY") continue;
                    $MR = floatval($Val["MRC"]) * floatval($Arr["QTY"]);
                    $DM = ($MR -
                        (((floatval(Product($Val['SKU'])["discountable_price"]) * floatval($Val["Quantity"])) * floatval($Arr["QTY"])) *
                            floatval($avgDiscPerc)));
                    $DiscountedMrcArr[$Index][$Val["product"]] = ($MR <= 0) ? 0 : 100 - (100 * ($DM / $MR));
                } else {
                    $MR = floatval($Val["MRC"]);
                    $DM = floatval($Val['MRC']) -
                        ((floatval(Product($Val['SKU'])["discountable_price"]) * floatval($Val['Quantity'])) *
                            floatval($avgDiscPerc));

                    $DiscountedMrcArr[$Index][$Key] = ($MR <= 0) ? 0 : 100 - (100 * ($DM / $MR));
                }
            }
        }
    }

    foreach ($DiscountedMrcArr as $KEY => $VAL) {
        if ($VAL < 0) {
            $DiscountedMrcArr[$KEY] = 0;
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
