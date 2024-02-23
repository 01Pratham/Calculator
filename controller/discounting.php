<?php

require "../model/database.php";
// require "Currency_Format.php";

if (isset($_POST['action']) && $_POST['action'] == "Discount") {
    // print_r($_POST);
    $discountPercentage = $_POST['discountVal'];
    $months = $_POST[''];
    $Total = $_POST['Total'];
    $Data = json_decode(base64_decode($_POST['data']), true);
    $maxDiscountTotal = array();
    $newTotal = array();
    foreach ($Data as $Index => $Arr) {
        if (is_array($Arr)) {
            foreach ($Arr as $Key => $Val) {
                if (is_array($Val)) {
                    $maxDiscountTotal[] = (Product($Val['SKU'])["discountable_price"] * intval($Val["Quantity"])) * floatval($Arr["QTY"]);
                    $inputPrices[] = Product($Val['SKU'])["input_price"];
                    $Prices[] = Product($Val['SKU'])["price"];
                    $newTotal[] = $Val['MRC'];
                    $Quantity[] = intval($Val["Quantity"]);
                } else {
                    if ($Key == "SKU") {
                        $maxDiscountTotal[] = Product($Arr['SKU'])["discountable_price"] * $Arr["Quantity"];
                        $inputPrices[] = Product($Arr['SKU'])["input_price"];
                        $Prices[] = Product($Arr['SKU'])["price"];
                        $newTotal[] = $Arr['MRC'];
                        $Quantity[] = $Arr["Quantity"];
                    }
                }
            }
        }
    }
    $discountToBeGiven = (array_sum($newTotal) * floatval($discountPercentage));
    $avgDiscPerc = floatval($discountToBeGiven) / array_sum($maxDiscountTotal);
    $DiscountedMrcArr = array();
    foreach ($Data as $Index => $Arr) {
        if (is_array($Arr)) {
            foreach ($Arr as $Key => $Val) {
                if (is_array($Val)) {
                    $MR = floatval($Val["MRC"]) * floatval($Arr["QTY"]);
                    $DM = ($MR -
                        (((floatval(Product($Val['SKU'])["discountable_price"]) * floatval($Val["Quantity"])) * floatval($Arr["QTY"])) *
                            floatval($avgDiscPerc)));
                    $DiscountedMrcArr[$Index][$Val["product"]] = ($MR <= 0)? 0: 100 - (100 * ($DM / $MR));
                } else {
                    if ($Key == "SKU") {
                        $MR = floatval($Arr["MRC"]);
                        $DM = floatval($Arr['MRC']) -
                            ((floatval(Product($Arr['SKU'])["discountable_price"]) * floatval($Arr['Quantity'])) *
                                floatval($avgDiscPerc));

                        $DiscountedMrcArr[$Index] =($MR <= 0)? 0: 100 - (100 * ($DM / $MR));
                    }
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



// // print_r($DiscountedMrcArr);
// $newarr = array();
// foreach ($Data as $key => $val){
//     if(is_array($val)){
//         if($val["SKU"] == ""){
//             $newarr[$key] = $val["SKU"];
//         }
//     }
// }
// echo json_encode($Data,JSON_PRETTY_PRINT);  

// // echo "<pre>";
// // print_r($Data);
// // echo "</pre>";
// echo $avgDiscPerc;
echo json_encode($DiscountedMrcArr, JSON_PRETTY_PRINT);
