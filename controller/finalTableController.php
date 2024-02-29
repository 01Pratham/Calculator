<?php

// PPrint($_POST);


$Array = array();

foreach ($_POST as $key => $arr) {
    if (is_array($arr)) {
        foreach ($arr as $_K => $_V) {
            if ($_K == "estmtname") $Array[$key]["HEAD"] = $_V;
            if ($_K == "period") $Array[$key]["period"] = $_V;

            if (is_array($_V)) {
                if (preg_match("/compute_/", $_K)) {
                    $vmarr = [
                        "cpu" => $_V["vcpu"],
                        "ram" => $_V["ram"],
                        "diskIops" => $_V["vmDiskIOPS"],
                        "disk" => $_V["inst_disk"],
                        "os" => $_V["os"],
                        "db" => $_V["database"],
                    ];

                    $DISK[$key][$_V["database"]][] = intval($_V["inst_disk"]) * intval($_V["vmqty"]);
                    $DISK[$key][$_V["os"]][] = intval($_V["inst_disk"]) * intval($_V["vmqty"]);
                    $VMQTY[$key][$_V["database"]][] = intval($_V["vmqty"]);
                    $VMQTY[$key][$_V["os"]][] = intval($_V["vmqty"]);


                    $Array[$key][preg_replace("/_.*/", "", $_K)][] = [
                        "service" => $_V["vmname"],
                        "product" => getVm($vmarr),
                        "qty" => $_V["vmqty"],
                        "unit_price" => getVmPrice($vmarr),
                        "mrc" => getVmPrice($vmarr) * $_V["vmqty"],
                        "otc" => $_V[""],
                        "discount" => $_V[""],
                    ];
                } else {
                    foreach ($_V as $_k => $_v) {
                        $name = preg_replace("/_select|_qty|_unit/", "", $_k);
                        if (preg_match("/_mgmt/", $_k) && preg_match("/os|db/", $_k)) {
                            $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("os"));
                            $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("db"));
                            continue;
                        }
                        $Array[$key][$_K][$name] = [
                            "service" => "Service",
                            "product" => getProdName($_V["{$name}_select"]),
                            "qty" => floatval($_V["{$name}_qty"]),
                            "unit_price" =>  getProductPrice($_V["{$name}_select"]),
                            // "unit_price" =>  ($_V["{$name}_select"]),
                            "mrc" => getProductPrice($_V["{$name}_select"]) * floatval($_V["{$name}_qty"]),
                            // "mrc" => ($_V["{$name}_select"]),
                            "otc" => $_V[""],
                            "discount" => $_V[""],
                        ];
                    }
                }
            }
        }
    }
}

$Infrastructure = [];
$ManagedServices = [];
$Period = [];

foreach($Array as $KEY => $VAL){
    $Period[$KEY] = $VAL["period"];
    foreach($VAL as $Key => $Val) {
        if(is_array($Val)){
            foreach($Val as $key => $val){
                if(preg_match("/_mgmt/",$key)){
                    $ManagedServices[$KEY][] = $val["mrc"];
                }else{
                    $Infrastructure[$KEY][] = $val["mrc"];
                }
            }
        }
    }
}


// PPrint($Array);

// PPrint($ManagedServices);
// PPrint($Infrastructure);

function getVm($arr)
{
    return  "vCores : " . $arr['cpu'] .
        " | RAM "   . $arr['ram'] .
        " GB | Disk - " . preg_replace("/Block Storage|IOPS per GB| /", '', getProdName($arr['diskIops'])) .
        " IOPS - " . $arr['disk'] .
        " GB | OS : " . getProdName($arr['os']).
        " | DB : " . getProdName($arr['db']);
}

function getVmPrice($arr)
{
    return array_sum([
        "vcore" => $arr['cpu'] * getProductPrice("vram_static"),
        "ram" => $arr['cpu'] * getProductPrice("vcpu_static"),
        "storage" => $arr['cpu'] * getProductPrice($arr['diskIops']),
    ]);
}


function getMngServicesQty($type)
{
    global $key, $DISK, $VMQTY, $con;
    $FinalArr = [];
    $Query = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `sec_category` = '{$type}'");
    while ($arr = mysqli_fetch_assoc($Query)) {
        $prod[] = $arr['prod_int'];
    }
    $MGMT = [];
    $$type = array_keys($DISK[$key]);
    foreach ($$type as $i => $val) {
        foreach ($prod as $k => $int) {
            if ($val == $int) {
                $str = explode("_", $int);
                $product_name = getProdName($str[0] . "_{$type}_mgmt");
                $DISK_SUM = array_sum($DISK[$key][$int]);
                $VMQTY_SUM = array_sum($VMQTY[$key][$int]);
                $mgmt_qty = ($DISK_SUM * $VMQTY_SUM) <= (100 * $VMQTY_SUM) ? ($DISK_SUM * $VMQTY_SUM) : 1;
                $REM = $DISK_SUM - 100;
                $upto100 = $upto50 = 0;

                if (($DISK_SUM * $VMQTY_SUM) > (100 * $VMQTY_SUM)) {
                    $upto100 = floor($REM / 100);
                    $upto50 = floor(($REM - ($upto100 * 100)) / 50);
                }

                $mgmt_unit_cost =    [
                    "base" => getProductPrice($str[0] . "_{$type}_mgmt"),
                    "upto100" => $upto100 > 0 ? 1100 : 0,
                    "upto50" => $upto50 > 0 ? 550 : 0,
                ];

                $mgmt_mrc = [
                    "base" => getProductPrice($str[0] . "_{$type}_mgmt") * 1,
                    "upto100" => $upto100 > 0 ? 1100 * $upto100 : 0,
                    "upto50" => $upto50 > 0 ? 550 * $upto50 : 0,
                ];

                $MGMT[$str[0] . "_{$type}_mgmt"] = [
                    "service" => "Service",
                    "product" => $product_name,
                    "qty" => ($mgmt_qty),
                    "unit_price" => array_sum($mgmt_unit_cost),
                    "mrc" => array_sum($mgmt_mrc),
                    "otc" => $_V[""],
                    "discount" => $_V[""],
                ];
            }
        }
    }
    return $MGMT;
}
