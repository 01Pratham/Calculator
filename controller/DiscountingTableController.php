<?php

// PPrint($_DiscountedData);

foreach ($_Data as $key => $arr) {
    if (is_array($arr)) {
        // $vmId = 1;
        foreach ($arr as $_K => $_V) {
            if ($_K == "estmtname") $Array[$key]["HEAD"] = $_V;
            if ($_K == "period") $Array[$key]["period"] = $_V;
            if ($_K == "region") $Array[$key]["region"] = $_V;

            if (is_array($_V)) {
                if (preg_match("/vm_/", $_K)) {
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
                    $CPU[$key][$_V["database"]][] = intval($_V["vcpu"]);
                    $CPU[$key][$_V["os"]][] = intval($_V["vcpu"]);
                    $AntiVirus[$key][$_V["virus_type"]][] = ($_V["virus_type"] == "") ? 0 : intval($_V["vmqty"]);
                    $IpAddress[$key][$_V["ip_public_type"]][] = $_V["ip_public"] * $_V["vmqty"];

                    $Array[$key][preg_replace("/_.*/", "", $_K)][$_K] = [
                        "service" => $_V["vmname"],
                        "product" => getVm($vmarr),
                        "qty" => $_V["vmqty"] . " NO",
                        "unit_price" => getVmPrice($vmarr),
                        "mrc" => getVmPrice($vmarr) * $_V["vmqty"],
                        "otc" => $_V[""],
                        "discount" => (!empty($_DiscountedData[$key]["Data"][$_K])) ? array_sum($_DiscountedData[$key]["Data"][$_K])/3 : 0,
                        // "discount" => array_sum($_DiscountedData[$KEY]["Data"][$_K])/3,
                    ];


                    $Products[$key][$_K][] = array(
                        "product" => 'CPU',
                        "SKU" => getProductSku('vcpu_static'),
                        "Quantity" => $_V["vcpu"],
                        "MRC" => (getProductPrice('vcpu_static') * $_V["vcpu"])
                    );
                    $Products[$key][$_K][] = array(
                        "product" => 'RAM',
                        "SKU" => getProductSku('vram_static'),
                        "Quantity" =>  $_V["ram"],
                        "MRC" => (getProductPrice('vram_static') * intval($_V["ram"]))
                    );
                    $Products[$key][$_K][] = array(
                        "product" => 'Disk',
                        "SKU" => getProductSku($_V["vmDiskIOPS"]),
                        "Quantity" =>  $_V["inst_disk"],
                        "MRC" => (getProductPrice($_V["vmDiskIOPS"]) * intval($_V["inst_disk"]))
                    );

                    $Products[$key][$_K]["QTY"] = $_V["vmqty"];

                    $Array[$key]["software"] = [];
                    if (!empty($_V["database"])) {
                        $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("db"));
                    }
                    if (!empty($_V["os"])) {
                        $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("os"));
                    }
                    // print_r($_DiscountedData[$KEY]["Data"]);


                    if ($_V["virus_type"] != "") {
                        $Array[$key]["security"]["av"] = [
                            "service" => "Anti Virus",
                            "product" => getProdName($_V["virus_type"]),
                            "qty" => array_sum($AntiVirus[$key][$_V["virus_type"]]) . " NO",
                            "unit_price" => getProductPrice($_V["virus_type"]),
                            "mrc" => getProductPrice($_V["virus_type"]) * array_sum($AntiVirus[$key][$_V["virus_type"]]),
                            "otc" => $_V[""],
                            "discount" => empty($_DiscountedData[$key]["Data"]["security"]["av"]) ? 0 : $_DiscountedData[$key]["Data"]["security"]["av"],
                            "sku" => getProductSku($_V["virus_type"])
                        ];
                    }

                    if ($_V["ip_public"] != "" || $_V["ip_public"] != "0") {
                        $Array[$key]["network"]["ip"] = [
                            "service" => "IP Address",
                            "product" => getProdName($_V["ip_public_type"]),
                            "qty" => array_sum($IpAddress[$key][$_V["ip_public_type"]]) . " NO",
                            "unit_price" => getProductPrice($_V["ip_public_type"]),
                            "mrc" => getProductPrice($_V["ip_public_type"]) * array_sum($IpAddress[$key][$_V["ip_public_type"]]),
                            "otc" => $_V[""],
                            "discount" => empty($_DiscountedData[$key]["Data"]["network"]["ip"]) ? 0 : $_DiscountedData[$key]["Data"]["network"]["ip"],
                            "sku" => getProductSku($_V["ip_public_type"])
                        ];
                    }
                } else {
                    foreach ($_V as $_k => $_v) {
                        $name = preg_replace("/_select|_qty|_unit/", "", $_k);
                        if (preg_match("/_mgmt/", $_k) && preg_match("/os|db/", $_k)) {
                            $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("os"));
                            $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("db"));
                            continue;
                        }
                        $Unit = (isset($_V["{$name}_unit"]) ? getUnitName($_V["{$name}_unit"])['unit_name'] : getUnitName($_V["{$name}_select"], "prod_int")["unit_name"]);
                        $Qty = floatval($_V["{$name}_qty"]) . " " . $Unit;
                        $UnitPrice = (isset($_V["{$name}_unit"]) && getUnitName($_V["{$name}_unit"])['unit_name'] == "TB") ? getProductPrice($_V["{$name}_select"]) * 1000 : getProductPrice($_V["{$name}_select"]);
                        $Array[$key][$_K][$name] = [
                            "service" => "Service",
                            "product" => getProdName($_V["{$name}_select"]),
                            "qty" => $Qty,
                            "unit_price" =>  $UnitPrice,
                            "mrc" => $UnitPrice * floatval($_V["{$name}_qty"]),
                            "otc" => $_V[""],
                            "discount" => $_DiscountedData[$key]["Data"][$_K][$name],
                            "sku" => getProductSku($_V["{$name}_select"])
                        ];
                    }
                }
            }
        }
    }
}

// PPrint($Array);
$Infrastructure = [];
$ManagedServices = [];
$Period = [];
$Region = [];


foreach ($Array as $KEY => $VAL) {
    $Period[$KEY] = $VAL["period"];
    $Region[$KEY] = $VAL["region"];
    foreach ($VAL as $Key => $Val) {
        if (is_array($Val)) {
            foreach ($Val as $key => $val) {
                if (preg_match("/_mgmt/", $key)) {
                    $ManagedServices[$KEY][] = $val["mrc"];
                } else {
                    $Infrastructure[$KEY][] = $val["mrc"];
                }

                if (!preg_match("/vm/", $Key)) {
                    $Products[$KEY][$Key][$key] = [
                        "product" => $val["product"],
                        "SKU" => $val["sku"],
                        "Quantity" => preg_replace("/[a-zA-Z]| /", '', $val["qty"]),
                        "MRC" => $val["mrc"]
                    ];
                }
            }
        }
    }
}
// PPrint($Products);

function getVm($arr)
{
    return  "vCores : " . $arr['cpu'] .
        " | RAM "   . $arr['ram'] .
        " GB | Disk - " . preg_replace("/[a-zA-Z]| /", '', getProdName($arr['diskIops'])) .
        " IOPS - " . $arr['disk'] .
        " GB | OS : " . getProdName($arr['os']) .
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
    global $key, $DISK, $VMQTY, $con , $_DiscountedData;
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
                    "qty" => ($mgmt_qty) . " " . getUnitName($str[0] . "_{$type}_mgmt", "prod_int")["unit_name"],
                    "unit_price" => array_sum($mgmt_unit_cost),
                    "mrc" => array_sum($mgmt_mrc),
                    "otc" => $_V[""],
                    "discount" => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$type}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$type}_mgmt"],
                    "sku" => getProductSku($str[0] . "_{$type}_mgmt")
                ];
            }
        }
    }
    return $MGMT;
}

function getSoftwareLic($type)
{
    global $key, $CPU, $VMQTY, $con , $_DiscountedData;
    $FinalArr = [];
    $Query = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `sec_category` = '{$type}'");
    while ($arr = mysqli_fetch_assoc($Query)) {
        $prod[] = $arr['prod_int'];
    }
    $MGMT = [];
    $$type = array_keys($CPU[$key]);

    $lic = 0;

    foreach ($$type as $i => $val) {
        if (in_array($val, $prod)) {
            try {
                $Q = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_os_calculation` WHERE `product_int` = '{$val}'"));
            } catch (Error $e) {
                $Q = [];
            }

            if (!empty($Q)) {
                list($variableName, $value) = explode(' = ', $Q['calculation']);
                $$variableName = $value;
                for ($i = 0; $i < count($CPU[$key][$val]); $i++) {
                    $totalCores[] = $CPU[$key][$val][$i] * $VMQTY[$key][$val][$i];
                }
                $lic += intval(array_sum($totalCores) / $core_devide);
            } else {
                $lic = array_sum($VMQTY[$key][$val]);
            }
            $Array[$val] = [
                "service" => "Service",
                "product" => getProdName($val),
                "qty" => ($lic) . " " . getUnitName($val, "prod_int")["unit_name"],
                "unit_price" => getProductPrice($val),
                "mrc" => $lic * getProductPrice($val),
                "otc" => $_V[""],
                "discount" => empty($_DiscountedData[$key]["Data"]["software"][$val]) ? 0 : $_DiscountedData[$key]["Data"]["software"][$val],
                "sku" => getProductSku($val)
            ];
        }
    }
    return $Array;
}
// print_r($Q);


function getQtyOthers($var, $group, $sec_cat)
{
    global $$var, $key;
    $arr = $$var[$key];
    $key = array_keys($arr[$key]);

    $Array[$sec_cat] = [
        "service" => "Service",
        "product" => getProdName($key[0]),
        "qty" => array_sum($arr) . " " . getUnitName($key[0], "prod_int")["unit_name"],
        "unit_price" =>  getProductPrice($key[0]),
        "mrc" => array_sum($arr) * getProductPrice($key[0]),
        "otc" => $_V[""],
        "discount" => empty($_DiscountedData[$key]["Data"][$sec_cat]) ? 0 : $_DiscountedData[$key]["Data"][$sec_cat],
        "sku" => getProductSku($key[0]),
    ];
    return $Array;
}
