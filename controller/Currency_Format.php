<?php
if (!function_exists("INR")) {
    function INR($number, $act = "echo")
    {
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);

        for ($i = 0; $i < $length; $i++) {
            if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
                $delimiter .= ',';
            }
            $delimiter .= $money[$i];
        }
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);

        if ($decimal != '0') {
            $result = $result . $decimal;
        }
        if ($act == "echo") {
            echo  "₹ " . $result;
        } elseif ($act == "return") {
            return  "₹ " . $result;
        }
    }
}



if (isset($_POST["action"])) {

    if ($_POST["action"] == "CurrencyFormat") {
        $array1 = json_decode($_POST["arr1"], true);
        $array2 = json_decode($_POST["arr2"], true);
        $months = $_POST['months'];
        $result = array(
            "infra" => INR(array_sum($array1), "return"),
            "mng" => INR(array_sum($array2), "return"),
            "Total" => INR(array_sum($array1) + array_sum($array2), "return"),
            "MonthlyTotal" => INR((array_sum($array1) + array_sum($array2)) * $months, "return"),
            "Otc" => INR(((array_sum($array1) + array_sum($array2)) * 12) * 0.05, "return")
        );

        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}
