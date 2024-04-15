<?php

foreach ($_Data as $key => $arr) {
    if (is_array($arr)) {
        foreach ($arr as $_K => $_V) {
            if ($_K == "estmtname") $Array[$key]["HEAD"] = $_V;
            if ($_K == "period") $Array[$key]["period"] = $_V;
            if ($_K == "region") $Array[$key]["region"] = $_V;

            if (is_array($_V)) {
                if (!isset($Array[$key][$_K])) {
                    $Array[$key][$_K] = [];
                }
                if (preg_match("/vm_/", $_K)) {
                    $vmarr = [
                        "cpu"      => $_V["vcpu"],
                        "ram"      => $_V["ram"],
                        "diskIops" => $_V["vmDiskIOPS"],
                        "disk"     => $_V["inst_disk"],
                        "os"       => $_V["os"],
                        "db"       => $_V["database"],
                        "key"      => $key,
                        "_K"       => $_K
                    ];

                    $DISK[$key][$_V["database"]][] = intval($_V["inst_disk"]) * intval($_V["vmqty"]);
                    $DISK[$key][$_V["os"]][] = intval($_V["inst_disk"]) * intval($_V["vmqty"]);
                    $VMQTY[$key][$_V["database"]][] = intval($_V["vmqty"]);
                    $VMQTY[$key][$_V["os"]][] = intval($_V["vmqty"]);
                    $VMQTY[$key]["sum"][]                 = intval($_V["vmqty"]);
                    $CPU[$key][$_V["database"]][] = intval($_V["vcpu"]);
                    $CPU[$key][$_V["os"]][] = intval($_V["vcpu"]);
                    $AntiVirus[$key][$_V["virus_type"]][] = ($_V["virus_type"] == "") ? 0 : intval($_V["vmqty"]);
                    $IpAddress[$key][$_V["ip_public_type"]][] = intval($_V["ip_public"]) * intval($_V["vmqty"]);

                    $Array[$key][preg_replace("/_.*/", "", $_K)][$_K]["vcore"] = [
                        "service"      => $_V["vmname"],
                        "product"      => "vCores : {$_V["vcpu"]}",
                        "qty"          => floatval($_V["vmqty"]) . " NO",
                        "unit_price"   => $_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["vcore"],
                        "actual_price" => getProductPrice("vcpu_static"),
                        "mrc"          => ($_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["vcore"] * $_V["vcpu"]) * floatval($_V["vmqty"]),
                        "otc"          => $_V[""],
                        "discount"     => (!empty($_DiscountedData[$key]["Data"][$_K])) ? ($_DiscountedData[$key]["Data"][$_K]["vcore"]) : 0,
                    ];
                    $Array[$key][preg_replace("/_.*/", "", $_K)][$_K]["ram"] = [
                        "service"      => $_V["vmname"],
                        "product"      => "RAM : {$_V["ram"]} GB",
                        "qty"          => floatval($_V["vmqty"]) . " NO",
                        "unit_price"   => $_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["ram"],
                        "actual_price" => getProductPrice("vram_static"),
                        "mrc"          => ($_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["ram"] * $_V["ram"]) * floatval($_V["vmqty"]),
                        "otc"          => $_V[""],
                        "discount"     => (!empty($_DiscountedData[$key]["Data"][$_K])) ? ($_DiscountedData[$key]["Data"][$_K]["ram"]) : 0,
                    ];
                    $Array[$key][preg_replace("/_.*/", "", $_K)][$_K]["storage"] = [
                        "service"      => $_V["vmname"],
                        "product"      => "Disk - " . (preg_replace("/[a-zA-Z]| /", '', getProdName($_V['vmDiskIOPS']))) . " IOPS : {$_V["inst_disk"]} GB",
                        "qty"          => floatval($_V["vmqty"]) . " NO",
                        "unit_price"   => $_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["storage"],
                        "actual_price" => getProductPrice($_V['vmDiskIOPS']),
                        "mrc"          => ($_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["storage"] * $_V["inst_disk"]) * floatval($_V["vmqty"]),
                        "otc"          => $_V[""],
                        "discount"     => (!empty($_DiscountedData[$key]["Data"][$_K])) ? ($_DiscountedData[$key]["Data"][$_K]["storage"]) : 0,
                    ];
                    $Products[$key][$_K] = [
                        "vcore"            => [
                            "product"      => 'CPU',
                            "SKU"          => getProductSku('vcpu_static'),
                            "Quantity"     => $_V["vcpu"],
                            "MRC"          => ($_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["vcore"] * $_V["vcpu"]) * floatval($_V["vmqty"]),
                        ],
                        "ram"              => [
                            "product"      => 'RAM',
                            "SKU"          => getProductSku('vram_static'),
                            "Quantity"     =>  $_V["ram"],
                            "MRC"          => ($_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["ram"] * $_V["ram"]) * floatval($_V["vmqty"]),
                        ],
                        "storage"          => [
                            "product"      => 'Disk',
                            "SKU"          => getProductSku($_V["vmDiskIOPS"]),
                            "Quantity"     =>  $_V["inst_disk"],
                            "MRC"          => ($_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K]["storage"] * $_V["inst_disk"]) * floatval($_V["vmqty"]),
                        ],
                        // "QTY"              => floatval($_V["vmqty"]),
                    ];

                    if (!isset($Array[$key]["software"])) {
                        $Array[$key]["software"] = [];
                    }

                    if (!empty($_V["os"])) {
                        $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("os"));
                    }

                    if (!empty($_V["database"]) && $_V["database"] != "NA") {
                        $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("db"));
                    }

                    if ($_V["virus_type"] != "") {
                        $UnitPrice = floatval(!empty($_Prices[$key]["security"][$_V["virus_type"]]) ? $_Prices[$key]["security"][$_V["virus_type"]] : getProductPrice($_V["virus_type"]));
                        $Array[$key]["security"][$_V["virus_type"]] = [
                            "service"      => "Anti Virus",
                            "product"      => getProdName($_V["virus_type"]),
                            "qty"          => array_sum($AntiVirus[$key][$_V["virus_type"]]) . " NO",
                            "unit_price"   => $UnitPrice,
                            "actual_price" => getProductPrice($_V["virus_type"]),
                            "mrc"          => $UnitPrice * array_sum($AntiVirus[$key][$_V["virus_type"]]),
                            "otc"          => $_V[""],
                            "discount"     => empty($_DiscountedData[$key]["Data"]["security"][$_V["virus_type"]]) ? 0 : $_DiscountedData[$key]["Data"]["security"][$_V["virus_type"]],
                            "sku"          => getProductSku($_V["virus_type"])
                        ];
                    }

                    if ($_V["ip_public"] != "" || $_V["ip_public"] != "0") {
                        $UnitPrice = floatval(!empty($_Prices[$key]["network"][$_V["ip_public_type"]]) ? $_Prices[$key]["network"][$_V["ip_public_type"]] : getProductPrice($_V["ip_public_type"]));
                        $Array[$key]["network"][$_V["ip_public_type"]] = [
                            "service"      => "IP Address",
                            "product"      => getProdName($_V["ip_public_type"]),
                            "qty"          => array_sum($IpAddress[$key][$_V["ip_public_type"]]) . " NO",
                            "unit_price"   => $UnitPrice,
                            "actual_price" => getProductPrice($_V["ip_public_type"]),
                            "mrc"          => $UnitPrice * array_sum($IpAddress[$key][$_V["ip_public_type"]]),
                            "otc"          => $_V[""],
                            "discount"     => empty($_DiscountedData[$key]["Data"]["network"][$_V["ip_public_type"]]) ? 0 : $_DiscountedData[$key]["Data"]["network"][$_V["ip_public_type"]],
                            "sku"          => getProductSku($_V["ip_public_type"])
                        ];
                    }
                } else {
                    foreach ($_V as $_k => $_v) {
                        $name = preg_replace("/_select|_qty|_unit/", "", $_k);
                        if (preg_match("/_mgmt/", $_k) && preg_match("/os|db/", $_k)) {
                            if (preg_match("/os/", $_k)) {
                                $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("os"));
                            }
                            if (preg_match("/db/", $_k)) {
                                $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("db"));
                            }
                            continue;
                        }
                        $Unit = getUnitName($_V["{$name}_select"], "prod_int")["unit_name"];
                        $calQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_calculation` WHERE `sec_cat_name` = '{$name}'"));
                        // echo "SELECT * FROM `tbl_calculation` WHERE `sec_cat_name` = '{$name}' <br>";
                        if (!empty($calQuery)) {
                            $itemsArr = explode(",", $calQuery["calculation"]);
                            foreach ($itemsArr as $item) {
                                if (preg_match("/vm/", $item)) {
                                    $calculation[$key][$_K][$_V["{$name}_select"]][$item] = (!empty($VMQTY[$key]["sum"])) ? array_sum($VMQTY[$key]["sum"]) : 0;
                                } else {
                                    $calculation[$key][$_K][$_V["{$name}_select"]][$item] = (!empty($_V[$item])) ? floatval($_V[$item]) : 0;
                                }
                            }
                        }
                        $UnitPrice = floatval(!empty($_Prices[$key][$_K][$_V["{$name}_select"]]) ? $_Prices[$key][$_K][$_V["{$name}_select"]] : getProductPrice($_V["{$name}_select"]));
                        $Qty = (isset($_V["{$name}_unit"]) && getUnitName($_V["{$name}_unit"])["unit_name"] == "TB") ? floatval($_V["{$name}_qty"]) * 1024 : floatval($_V["{$name}_qty"]);
                        $Array[$key][$_K][$_V["{$name}_select"]] = [
                            "service"      => "Service",
                            "product"      => getProdName($_V["{$name}_select"]),
                            "qty"          => $Qty . " $Unit",
                            "unit_price"   => (getProductPrice($_V["{$name}_select"], "otc") > 0) ? getProductPrice($_V["{$name}_select"], "otc") : $UnitPrice,
                            "actual_price" => (getProductPrice($_V["{$name}_select"], "otc") > 0) ? getProductPrice($_V["{$name}_select"], "otc") : getProductPrice($_V["{$name}_select"]),
                            "mrc"          => $UnitPrice * $Qty,
                            "otc"          => $Qty * getProductPrice($_V["{$name}_select"], "otc"),
                            "discount"     => $_DiscountedData[$key]["Data"][$_K][$_V["{$name}_select"]],
                            "sku"          => getProductSku($_V["{$name}_select"]),
                        ];
                        if (preg_match("/otc/", $_k)) {
                            $Array[$key][$_K]["otc"] = [
                                "service"      => "Service",
                                "product"      => getProdName($_V["{$name}_select"]),
                                "qty"          => 1 . " NO",
                                "unit_price"   => 0,
                                "actual_price" => 0,
                                "mrc"          => 0,
                                "otc"          => 0,
                                "discount"     => 0,
                            ];
                        }
                    }
                }
            }
        }
    }
}

$Infrastructure = [];
$DiscountedInfrastructure = [];
$ManagedServices = [];
$DiscountedManagedServices = [];
$Period = [];
$Region = [];

foreach ($Array as $KEY => $VAL) {
    foreach ($VAL as $Key => $Val) {
        foreach ($Val as $key => $val) {
            if (isset($calculation[$KEY][$Key][$key])) {
                $Array[$KEY][$Key][$key]["qty"] = array_sum($calculation[$KEY][$Key][$key]) . " NO";
                $Array[$KEY][$Key][$key]["mrc"] = floatval($Array[$KEY][$Key][$key]["unit_price"]) * array_sum($calculation[$KEY][$Key][$key]);
            }
        }
    }
}

foreach ($Array as $KEY => $VAL) {
    $Period[$KEY] = $VAL["period"];
    $Region[$KEY] = $VAL["region"];
    foreach ($VAL as $Key => $Val) {
        if (preg_match("/vm_/", $Key)) {
            unset($Array[$KEY][$Key]);
        }
        if (is_array($Val)) {
            foreach ($Val as $key => $val) {
                if (preg_match("/managed/", $Key)) {
                    $ManagedServices[$KEY][] = $val["mrc"];
                    $DiscountedManagedServices[$KEY][] =  $val["mrc"] - ($val["mrc"] *  ($val["discount"] / 100));
                    $Sku_Data[$KEY]["phase_total_recurring"] += $val["mrc"];
                } else {
                    if (preg_match('/vm/', $key)) {
                        foreach ($val as $k => $v) {
                            $Infrastructure[$KEY][] = $v["mrc"];
                            $DiscountedInfrastructure[$KEY][] =  $v["mrc"] - ($v["mrc"] *  ($v["discount"] / 100));
                        }
                        continue;
                    }
                    $Infrastructure[$KEY][] = $val["mrc"];
                    $DiscountedInfrastructure[$KEY][] =  $val["mrc"] - ($val["mrc"] *  ($val["discount"] / 100));
                    $Sku_Data[$KEY]["phase_total_recurring"] += $val["mrc"];
                }
                if (!preg_match("/vm/", $Key)) {
                    $Products[$KEY][$Key][$key] = array(
                        "product"      => $val['product'],
                        "SKU"          => $val['sku'],
                        "Quantity"     => preg_replace("/[a-zA-Z]/", "", $val['qty']),
                        "MRC"          => $val['mrc']
                    );
                }
            }
        }
    }
    if (isset($VAL["otc"])) {
        $OTC = ((((!is_null($Infrastructure[$KEY])) ? array_sum($Infrastructure[$KEY]) : 0) + (!is_null($ManagedServices[$KEY]) ? array_sum($ManagedServices[$KEY]) : 0)) * 12) * 0.05;
        $Array[$KEY]["otc"]["otc"]["otc"] = $OTC;
        $Array[$KEY]["otc"]["otc"]["unit_price"] = $OTC;
        $Array[$KEY]["otc"]["otc"]["actual_price"] = $OTC;
    }
}

// PPrint(array_sum($DiscountedInfrastructure[1]));

function getVm($arr)
{
    return  "vCores : "     . $arr['cpu'] .
        " | RAM "       . $arr['ram'] .
        " GB | Disk - " . preg_replace("/[a-zA-Z]| /", '', getProdName($arr['diskIops'])) .
        " IOPS - "      . $arr['disk'] .
        " GB | OS : "   . getProdName($arr['os']) .
        " | DB : "      . getProdName($arr['db']);
}


function getVmPrice($arr)
{
    return array_sum([
        "vcore"   => $arr['cpu']  * getProductPrice("vcpu_static"),
        "ram"     => $arr['ram']  * getProductPrice("vram_static"),
        "storage" => $arr['disk'] * getProductPrice($arr['diskIops']),
    ]);
}



function getMngServicesQty($prodType, $type = "price")
{
    global $key, $DISK, $VMQTY, $con, $_DiscountedData, $updatedPrices;
    $FinalArr = [];
    $Query = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `sec_category` = '{$prodType}'");
    while ($arr = mysqli_fetch_assoc($Query)) {
        $prod[] = $arr['prod_int'];
    }
    $MGMT = [];
    $Sku_Data = [];
    $$prodType = array_keys($DISK[$key]);
    foreach ($$prodType as $i => $val) {
        foreach ($prod as $k => $int) {
            if ($val == $int) {
                $str = explode("_", $int);
                $product_name = getProdName($str[0] . "_{$prodType}_mgmt");
                $DISK_SUM = array_sum($DISK[$key][$int]);
                $VMQTY_SUM = array_sum($VMQTY[$key][$int]);
                $UnitPrice = floatval(!empty($updatedPrices[$key][$_K][$str[0] . "_{$prodType}_mgmt"]) ? $updatedPrices[$key][$_K][$str[0] . "_{$prodType}_mgmt"] : getProductPrice($str[0] . "_{$prodType}_mgmt"));

                if ($prodType == "db"  && !empty($product_name)) {
                    $mgmt_qty = ($DISK_SUM * $VMQTY_SUM) <= (100 * $VMQTY_SUM) ? ($DISK_SUM * $VMQTY_SUM) : 1;
                    $REM = $DISK_SUM - 100;
                    $upto100 = $upto50 = 0;

                    if (($DISK_SUM * $VMQTY_SUM) > (100 * $VMQTY_SUM)) {
                        $upto100 = floor($REM / 100);
                        $upto50 = floor(($REM - ($upto100 * 100)) / 50);
                    }

                    $mgmt_unit_cost =    [
                        "base"    => $UnitPrice,
                        "upto100" => $upto100 > 0 ? $UnitPrice * 0.2 : 0,
                        "upto50"  => $upto50 > 0 ? ($UnitPrice * 0.2) * 0.5 : 0,
                    ];

                    $mgmt_sum = [
                        "base"    => 1,
                        "upto100" => $upto100,
                        "upto50"  => $upto50,
                    ];

                    $mgmt_mrc = [
                        "base"    => $UnitPrice * 1,
                        "upto100" => $upto100 > 0 ? $UnitPrice * 0.2  * $upto100 : 0,
                        "upto50"  => $upto50 > 0 ? ($UnitPrice * 0.2) * 0.5 * $upto50 : 0,
                    ];

                    $MGMT[$str[0] . "_{$prodType}_mgmt"] = [
                        "service"      => "Service",
                        "product"      => $product_name,
                        "qty"          => array_sum($mgmt_sum) . " " . getUnitName($str[0] . "_{$prodType}_mgmt", "prod_int")["unit_name"],
                        "unit_price"   => array_sum($mgmt_unit_cost),
                        "actual_price" => array_sum($mgmt_unit_cost),
                        "mrc"          => array_sum($mgmt_mrc),
                        "otc"          => $_V[""],
                        "discount"     => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                        "sku"          => getProductSku($str[0] . "_{$prodType}_mgmt"),
                    ];

                    $Sku_Data[$str[0] . "_{$prodType}_mgmt_base"] = [
                        "qty"          => $mgmt_qty,
                        "sku_code"     => getProductSku($str[0] . "_{$prodType}_mgmt"),
                        "unit_price"   => $mgmt_unit_cost["base"],
                        "discount"     => 50,
                    ];
                    if ($mgmt_unit_cost["upto100"] > 0) {
                        $Sku_Data[$str[0] . "_{$prodType}_mgmt_upto100"] = [
                            "qty"          => $mgmt_qty,
                            "sku_code"     => getProductSku($str[0] . "_{$prodType}_mgmt"),
                            "unit_price"   => $mgmt_unit_cost["upto100"],
                            "discount"     => 50,
                        ];
                    }
                    if ($mgmt_unit_cost["upto50"] > 0) {
                        $Sku_Data[$str[0] . "_{$prodType}_mgmt_base_upto50"] = [
                            "qty"          => $mgmt_qty,
                            "sku_code"     => getProductSku($str[0] . "_{$prodType}_mgmt"),
                            "unit_price"   => $mgmt_unit_cost["upto50"],
                            "discount"     => 50,
                        ];
                    }
                }
                if ($prodType == "os" && !empty($product_name)) {
                    $MGMT[$str[0] . "_{$prodType}_mgmt"] = [
                        "service"      => "Service",
                        "product"      => $product_name,
                        "qty"          => $VMQTY_SUM . " NO",
                        "unit_price"   => $UnitPrice,
                        "actual_price" => $UnitPrice,
                        "mrc"          => $UnitPrice * $VMQTY_SUM,
                        "otc"          => $_V[""],
                        "discount"     => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                        "sku"          => getProductSku($str[0] . "_{$prodType}_mgmt"),
                    ];

                    $Sku_Data[$str[0] . "_{$prodType}_mgmt"] = [
                        "qty"          => $mgmt_qty,
                        "sku_code"     => getProductSku($str[0] . "_{$prodType}_mgmt"),
                        "unit_price"   => $mgmt_unit_cost["base"],
                        "discount"     => 50,
                    ];
                }
            }
        }
    }
    if ($type == "price") {
        return $MGMT;
    } else {
        return $Sku_Data;
    }
}



function getSoftwareLic($type)
{
    global $key, $_DiscountedData, $CPU, $VMQTY, $con, $_Prices, $STATE;
    $FinalArr = [];
    $Query = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `sec_category` = '{$type}'");
    while ($arr = mysqli_fetch_assoc($Query)) {
        $prod[] = $arr['prod_int'];
    }
    $MGMT = [];
    $$type = array_keys($CPU[$key]);


    foreach ($$type as $i => $val) {
        if (in_array($val, $prod)) {
            $lic = 0;
            try {
                $Q = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_os_calculation` WHERE `product_int` = '{$val}'"));
            } catch (Error $e) {
                $Q = [];
            }

            if (!empty($Q)) {
                $totalCores = [];
                list($variableName, $value) = explode(' = ', $Q['calculation']);
                $$variableName = $value;
                foreach ($CPU[$key][$val] as $i => $c) {
                    if (preg_match("/ms/", $val) && preg_match("/Passive/", $STATE[$key][$val][$i])) {
                        $totalCores[$i] = intval($CPU[$key][$val][$i]) * intval($VMQTY[$key][$val][$i] / 2);
                    } else {
                        $totalCores[$val . $i] = intval($CPU[$key][$val][$i]) * intval($VMQTY[$key][$val][$i]);
                    }
                }
                $lic += intval(array_sum($totalCores) / $core_devide);
            } else {
                $lic = array_sum($VMQTY[$key][$val]);
            }
            $Array[$val] = [
                "service"      => "Service",
                "product"      => getProdName($val),
                "qty"          => ($lic) . " " . getUnitName($val, "prod_int")["unit_name"],
                "unit_price"   => !empty($_Prices[$key]["software"][$val]) ? $_Prices[$key]["software"][$val] : getProductPrice($val),
                "actual_price" => getProductPrice($val),
                "mrc"          => $lic * (!empty($_Prices[$key]["software"][$val]) ? $_Prices[$key]["software"][$val] : getProductPrice($val)),
                "otc"          => $_V[""],
                "discount"     => empty($_DiscountedData[$key]["Data"]["software"][$val]) ? 0 : $_DiscountedData[$key]["Data"]["software"][$val],
                "sku"          => getProductSku($val)
            ];
        }
    }
    return $Array;
}
function getQtyOthers($var, $group, $sec_cat)
{
    global $$var, $key;
    $arr = $$var[$key];
    $key = array_keys($arr[$key]);

    $Array[$sec_cat] = [
        "service"      => "Service",
        "product"      => getProdName($key[0]),
        "qty"          => array_sum($arr) . " " . getUnitName($key[0], "prod_int")["unit_name"],
        "unit_price"   =>  getProductPrice($key[0]),
        "actual_price" => "",
        "mrc"          => array_sum($arr) * getProductPrice($key[0]),
        "otc"          => $_V[""],
        "discount"     => empty($_DiscountedData[$key]["Data"][$sec_cat]) ? 0 : $_DiscountedData[$key]["Data"][$sec_cat],
        "sku"          => getProductSku($key[0]),
    ];
    return $Array;
}


// PPrint($Array);