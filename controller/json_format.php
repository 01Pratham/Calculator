<?php

function json_template($arr,    $total)
{
    require '../controller/constants.php';
    $template = array(
        "opportunity_id" => (strlen($_POST['pot_id'])<5) ? "0".$_POST['pot_id'] : $_POST['pot_id'],
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
        if(is_array($val)){
            foreach ($val as $k => $v){
              
                if (is_array($v)) {
                    foreach ($v as $p) {
                        $newInfra[$j][] = $p;
                    }
                } else {
                    $newInfra[$j][]= $val;
                }
            }
        }
        $j++;
    }
    $p = 1;
    $pCount = 0;
    foreach ($arr as $key => $val) {
        $Pname[] = $key;
        if (is_array($val)) {
            $template['phase_name'][$pCount]["phase"] = $Pname[$pCount];
            $template['phase_name'][$pCount]["phase_start_date"] = $date;
            $template['phase_name'][$pCount]["phase_tenure_month"] = $period[$p];
            $template['phase_name'][$pCount]["phase_total_recurring"] = (array_sum($newInfra[$p]));
            $template['phase_name'][$pCount]["phase_total_otp"] = number_format(((array_sum($newInfra[$p]) *12)* 0.05),2);

            $g = 1;
            $gCount = 0;
            foreach ($val as $k => $v) {
                $gName[$Pname[$pCount]][] = $k;
                // print_r($gName);
                if (is_array($v)) {
                     
                    // $template['phase_name'][$pCount]["group_name"][$gCount]['quotation_group_name'] = (preg_match("/VM/",$gName[$Pname[$pCount]][$gCount])) ? $arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Group_Name'] : $gName[$Pname[$pCount]][$gCount];
                    // $template['phase_name'][$pCount]["group_name"][$gCount]['group_otp_price'] = 1;
                    // $template['phase_name'][$pCount]["group_name"][$gCount]['group_recurring_price'] = (array_sum($total[$p][$gName[$Pname[$pCount]][$gCount]]));
                    // $template['phase_name'][$pCount]["group_name"][$gCount]['group_quantity'] = ($arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Quantity'])?$arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Quantity'] :1 ;
                    // $template['phase_name'][$pCount]["group_name"][$gCount]['group_id'] = '';
                    
                    $i = 1;
                    $iCount = 0;
                    foreach ($v as $_k => $_v){
                        $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][]=$_k;
                        if(!empty($iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount])){
                            if($iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount] == "NULL" || $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount] == "Quantity" || $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount] == "Group_Name"){
                                // continue;
                            }else{
                                $template['phase_name'][$pCount]["group_name"][$gCount]['quotation_group_name'] = (preg_match("/VM/",$gName[$Pname[$pCount]][$gCount])) ? $arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Group_Name'] : $gName[$Pname[$pCount]][$gCount];
                                $template['phase_name'][$pCount]["group_name"][$gCount]['group_otp_price'] = 1;
                                $template['phase_name'][$pCount]["group_name"][$gCount]['group_recurring_price'] = (array_sum($total[$p][$gName[$Pname[$pCount]][$gCount]]));
                                $template['phase_name'][$pCount]["group_name"][$gCount]['group_quantity'] = ($arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Quantity'])?$arr[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]]['Quantity'] :1 ;
                                $template['phase_name'][$pCount]["group_name"][$gCount]['group_id'] = getGroupId($iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount]);


                                $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_sku'] = $iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount];
                                if(empty($_v)){
                                    // continue;
                                }else{
                                    $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_quantity'] = floatval($_v["qty"]);  
                                    $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_price'] = getPerUnitPriceFromRateCard($iName[$Pname[$pCount]][$gName[$Pname[$pCount]][$gCount]][$iCount]);
                                    $template['phase_name'][$pCount]["group_name"][$gCount]['products'][$iCount]['product_discount'] = number_format(floatval($_v["discount"]) , 2);
                                }
                            }
                        }else{
                            continue;
                        }

                        $iCount+=1;
                        $i+=1;
                    }
                    
                    
                }

                $gCount = $gCount+1;
                $g = $g + 1;
            }

            $pCount += 1;
            $p = $p + 1;
        }
    }

    return $template;
}


function getPerUnitPriceFromRateCard($SKU){
    global $con;
    $getProdId = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `product_list` WHERE `sku_code` = '{$SKU}' "));
    $PriceQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rate_card_prices` WHERE `prod_id` = '{$getProdId['id']}'"));

    return ($PriceQuery["price"] != null) ? $PriceQuery["price"] : "0";
}


function getGroupId($SKU){
    global $con;
    $getProdId = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `product_list` WHERE `sku_code` = '{$SKU}' "));

    return $getProdId["crm_group_id"]??$SKU;
}