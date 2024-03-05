<?php

function json_template($arr, $total)
{
    require '../controller/constants.php';
    $template = array(
        "opportunity_id" => (strlen($_POST['pot_id']) < 5) ? "0" . $_POST['pot_id'] : $_POST['pot_id'],
        "quotation_id" => '',
        "product_list" => $_POST['product_list'],
        "user_id" => $_SESSION['crmId'],
        "phase_name" => array()
    );
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Kolkata"));
    $date = $date->format('Y-m-d');

    $newInfra = array();
    $j = 1;
    foreach ($total as $key => $val) {
        if (is_array($val)) {
            foreach ($val as $k => $v) {

                if (is_array($v)) {
                    foreach ($v as $p) {
                        $newInfra[$j][] = $p;
                    }
                } else {
                    $newInfra[$j][] = $val;
                }
            }
        }
        $j++;
    }
    $p = 1;
    $pCount = 0;

    foreach ($arr as $KEY => $VAL) {
        if (is_array($VAL)) {
            $template['phase_name'][$pCount]["phase"] = $VAL["phase_name"];
            $template['phase_name'][$pCount]["phase_start_date"] = $date;
            $template['phase_name'][$pCount]["phase_tenure_month"] = $VAL["phase_tenure"];
            $template['phase_name'][$pCount]["phase_total_recurring"] = $VAL["phase_total_recurring"];
            $template['phase_name'][$pCount]["phase_total_otp"] = "";
            if (is_array($VAL["groups"])) {
                foreach ($VAL as $Key => $Val) {
                    if (is_array($Val)) {
                        $gCount = 0;
                        foreach ($Val as $key => $val) {
                            $template['phase_name'][$pCount]["group_name"][$gCount]['quotation_group_name'] = $val["group_name"];
                            $template['phase_name'][$pCount]["group_name"][$gCount]['group_otp_price'] = 1;
                            $template['phase_name'][$pCount]["group_name"][$gCount]['group_recurring_price'] =  1;
                            $template['phase_name'][$pCount]["group_name"][$gCount]['group_quantity'] = $val["group_quantity"];
                            $template['phase_name'][$pCount]["group_name"][$gCount]['group_id'] = $val["group_id"];
                            if (is_array($val["products"])) {
                                $iCount = 0;
                                foreach ($val as $_K => $_V) {
                                    if (is_array($_V)) {
                                        foreach ($_V as $_k => $_v){
                                            $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_sku'] = $_v["sku_code"];
                                            $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_quantity'] = $_v["qty"];
                                            $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_price'] = $_v["unit_price"];
                                            $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_discount'] = $_v["discount"];
                                            $iCount += 1;
                                        }
                                    }
                                }
                            }
                            $gCount += 1;
                        }
                    }
                }
            }
            $pCount += 1;
        }
    }

    return $template;
}
