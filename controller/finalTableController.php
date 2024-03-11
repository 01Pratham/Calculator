<?php
$Array = array();
$_Prices = [];
$Sku_Data = [];
// PPrint($_POST);
foreach ($_POST as $key => $arr) {
    if (is_array($arr)) {
        $vmId = 1;

        $Sku_Data[$key] = [
            "phase_name" => $arr["estmtname"],
            "phase_tenure" => $arr["period"],
            "phase_total_recurring" => 0,
            "groups" => []
        ];

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
                    $STATE[$key][$_V["database"]][] = ($_V["state"]);
                    $CPU[$key][$_V["os"]][] = intval($_V["vcpu"]);
                    $AntiVirus[$key][$_V["virus_type"]][] = ($_V["virus_type"] == "") ? 0 : intval($_V["vmqty"]);
                    $IpAddress[$key][$_V["ip_public_type"]][] = $_V["ip_public"] * $_V["vmqty"];

                    $Array[$key][preg_replace("/_.*/", "", $_K)][$vmId] = [
                        "service" => $_V["vmname"],
                        "product" => getVm($vmarr),
                        "qty" => $_V["vmqty"] . " NO",
                        "unit_price" => getVmPrice($vmarr),
                        "mrc" => getVmPrice($vmarr) * $_V["vmqty"],
                        "otc" => $_V[""],
                        "discount" => (!empty($_DiscountedData[$key]["Data"][$_K])) ? array_sum($_DiscountedData[$key]["Data"][$_K]) / 3 : 0,
                    ];

                    $Sku_Data[$key]["groups"][$_K] = [
                        "group_name" => $_V["vmname"],
                        "group_id" => getCrmGroupId(preg_replace("/_.*/", "", $_K)),
                        "group_quantity" => $_V["vmqty"],
                        "products" => [
                            "cpu" => [
                                "qty" => $_V["vcpu"],
                                "sku_code" => getProductSku("vcpu_static"),
                                "unit_price" => getProductPrice("vcpu_static"),
                                "discount" => $_DiscountedData[$key]["Data"][$_K]["CPU"]
                            ],
                            "ram" => [
                                "qty" => $_V["ram"],
                                "sku_code" => getProductSku("vram_static"),
                                "unit_price" => getProductPrice("vram_static"),
                                "discount" => $_DiscountedData[$key]["Data"][$_K]["RAM"]
                            ],
                            "disk" => [
                                "qty" => $_V["inst_disk"],
                                "sku_code" => getProductSku($_V["vmDiskIOPS"]),
                                "unit_price" => getProductPrice($_V["vmDiskIOPS"]),
                                "discount" => $_DiscountedData[$key]["Data"][$_K]["Disk"]
                            ],
                        ]
                    ];

                    $vmId += 1;
                    $_Prices[$key]["VM" . preg_replace("/vm_/", "", $_K)][$_V["vmname"]] = getVmPrice($vmarr) * $_V["vmqty"];
                    // $Sku_Data

                    $Array[$key]["software"] = [];
                    if (!empty($_V["database"])) {
                        $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("db"));
                        $_Prices[$key]["VM" . preg_replace("/vm_/", "", $_K)]["db"] = getSoftPricesByVM(["int" => $_V["database"], "vcore" => $_V["vcpu"], "vmqty" => $_V["vmqty"]]);
                        $Sku_Data[$key]["groups"][$_K]["products"]["db"] = [
                            "qty" => getSoftPricesByVM(["int" => $_V["database"], "vcore" => $_V["vcpu"], "vmqty" => 1], "lics"),
                            "sku_code" => getProductSku($_V["database"]),
                            "unit_price" => getProductPrice($_V["database"]),
                            "discount" => $_DiscountedData[$key]["Data"]["software"][$_V["database"]]
                        ];
                    }
                    if (!empty($_V["os"])) {
                        $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("os"));
                        $_Prices[$key]["VM" . preg_replace("/vm_/", "", $_K)]["os"] = getSoftPricesByVM(["int" => $_V["os"], "vcore" => $_V["vcpu"], "vmqty" => $_V["vmqty"]]);
                        $Sku_Data[$key]["groups"][$_K]["products"]["os"] = [
                            "qty" => getSoftPricesByVM(["int" => $_V["os"], "vcore" => $_V["vcpu"], "vmqty" => 1], "lics"),
                            "sku_code" => getProductSku($_V["os"]),
                            "unit_price" => getProductPrice($_V["os"]),
                            "discount" => $_DiscountedData[$key]["Data"]["software"][$_V["os"]]
                        ];
                    }
                    if ($_V["virus_type"] != "") {
                        $Array[$key]["security"]["av"] = [
                            "service" => "Anti Virus",
                            "product" => getProdName($_V["virus_type"]),
                            "qty" => array_sum($AntiVirus[$key][$_V["virus_type"]]) . " NO",
                            "unit_price" => getProductPrice($_V["virus_type"]),
                            "mrc" => getProductPrice($_V["virus_type"]) * array_sum($AntiVirus[$key][$_V["virus_type"]]),
                            "otc" => $_V[""],
                            "discount" =>  empty($_DiscountedData[$key]["Data"]["security"]["av"]) ? 0 : $_DiscountedData[$key]["Data"]["security"]["av"],
                        ];
                        $_Prices[$key]["security"][$_V["virus_type"]] = getProductPrice($_V["virus_type"]) * array_sum($AntiVirus[$key][$_V["virus_type"]]);
                        $Sku_Data[$key]["groups"][$_K]["products"]["av"] = [
                            "qty" => 1,
                            "sku_code" => getProductSku($_V["virus_type"]),
                            "unit_price" => getProductPrice($_V["virus_type"]),
                            "discount" => $_DiscountedData[$key]["Data"]["security"]["av"]
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
                            "discount" => $_V[""],
                        ];
                        $_Prices[$key]["network"][$_V["ip_public_type"]] = getProductPrice($_V["ip_public_type"]) * array_sum($IpAddress[$key][$_V["ip_public_type"]]);
                        $Sku_Data[$key]["groups"]["network"]["products"]["ip"] = [
                            "qty" => array_sum($IpAddress[$key][$_V["ip_public_type"]]),
                            "sku_code" => getProductSku($_V["ip_public_type"]),
                            "unit_price" => getProductPrice($_V["ip_public_type"]),
                            "discount" => $_DiscountedData[$key]["Data"]["network"]["ip"]
                        ];
                    }
                } else {
                    $Sku_Data[$key]["groups"][$_K]["group_name"] = $_K;
                    $Sku_Data[$key]["groups"][$_K]["group_id"] = getCrmGroupId($_K);
                    $Sku_Data[$key]["groups"][$_K]["group_quantity"] = 1;
                    foreach ($_V as $_k => $_v) {
                        $name = preg_replace("/_select|_qty|_unit/", "", $_k);
                        if (preg_match("/_mgmt/", $_k) && preg_match("/os|db/", $_k)) {
                            if (preg_match("/os/", $_k)) {
                                $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("os"));

                                $Sku_Data[$key]["groups"][$_K]["products"] = array_merge($Sku_Data[$key]["groups"][$_K]["products"], getMngServicesQty("os", "SKU"));
                            }
                            // $Sku_Data[$key]["groups"][$_K]["products"][$name]
                            if (preg_match("/db/", $_k)) {
                                $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("db"));
                                $Sku_Data[$key]["groups"][$_K]["products"] = array_merge($Sku_Data[$key]["groups"][$_K]["products"], getMngServicesQty("db", "SKU"));
                            }
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
                        ];
                        $_Prices[$key][$_K][$_V["{$name}_select"]] = $UnitPrice * floatval($_V["{$name}_qty"]);
                        $Sku_Data[$key]["groups"][$_K]["products"][$name] = [
                            "qty" => floatval($_V["{$name}_qty"]),
                            "sku_code" => getProductSku($_V["{$name}_select"]),
                            "unit_price" => $UnitPrice,
                            "discount" => $_DiscountedData[$key]["Data"][$_K][$name]
                        ];
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
    $Period[$KEY] = $VAL["period"];
    $Region[$KEY] = $VAL["region"];
    foreach ($VAL as $Key => $Val) {
        if (is_array($Val)) {
            foreach ($Val as $key => $val) {
                if (preg_match("/_mgmt/", $key)) {
                    $ManagedServices[$KEY][] = $val["mrc"];
                    $DiscountedManagedServices[$KEY][] =  $val["mrc"] - ($val["mrc"] *  ($val["discount"] / 100));
                    $_Prices[$KEY]["MonthlyTotal"] += $val["mrc"];
                    $Sku_Data[$KEY]["phase_total_recurring"] += $val["mrc"];
                } else {
                    $Infrastructure[$KEY][] = $val["mrc"];
                    $DiscountedInfrastructure[$KEY][] =  $val["mrc"] - ($val["mrc"] *  ($val["discount"] / 100));
                    $_Prices[$KEY]["MonthlyTotal"] += $val["mrc"];
                    $Sku_Data[$KEY]["phase_total_recurring"] += $val["mrc"];
                }
            }
        }
    }
}

// PPrint($Sku_Data);


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
        "vcore" => $arr['cpu'] * getProductPrice("vcpu_static"),
        "ram" => $arr['ram'] * getProductPrice("vram_static"),
        "storage" => $arr['disk'] * getProductPrice($arr['diskIops']),
    ]);
}


function getMngServicesQty($prodType, $type = "price")
{
    global $key, $DISK, $VMQTY, $con, $_DiscountedData;
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
                $mgmt_qty = ($DISK_SUM * $VMQTY_SUM) <= (100 * $VMQTY_SUM) ? ($DISK_SUM * $VMQTY_SUM) : 1;
                $REM = $DISK_SUM - 100;
                $upto100 = $upto50 = 0;

                if (($DISK_SUM * $VMQTY_SUM) > (100 * $VMQTY_SUM)) {
                    $upto100 = floor($REM / 100);
                    $upto50 = floor(($REM - ($upto100 * 100)) / 50);
                }

                $mgmt_unit_cost =    [
                    "base" => getProductPrice($str[0] . "_{$prodType}_mgmt"),
                    "upto100" => $upto100 > 0 ? 1100 : 0,
                    "upto50" => $upto50 > 0 ? 550 : 0,
                ];

                $mgmt_mrc = [
                    "base" => getProductPrice($str[0] . "_{$prodType}_mgmt") * 1,
                    "upto100" => $upto100 > 0 ? 1100 * $upto100 : 0,
                    "upto50" => $upto50 > 0 ? 550 * $upto50 : 0,
                ];

                $MGMT[$str[0] . "_{$prodType}_mgmt"] = [
                    "service" => "Service",
                    "product" => $product_name,
                    "qty" => ($mgmt_qty) . " " . getUnitName($str[0] . "_{$prodType}_mgmt", "prod_int")["unit_name"],
                    "unit_price" => array_sum($mgmt_unit_cost),
                    "mrc" => array_sum($mgmt_mrc),
                    "otc" => $_V[""],
                    "discount" => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                ];


                $Sku_Data[$str[0] . "_{$prodType}_mgmt_base"] = [
                    "qty" => $mgmt_qty,
                    "sku_code" => getProductSku($str[0] . "_{$prodType}_mgmt"),
                    "unit_price" => $mgmt_unit_cost["base"],
                    "discount" => 50,
                ];
                if ($mgmt_unit_cost["upto100"] > 0) {
                    $Sku_Data[$str[0] . "_{$prodType}_mgmt_upto100"] = [
                        "qty" => $mgmt_qty,
                        "sku_code" => getProductSku($str[0] . "_{$prodType}_mgmt"),
                        "unit_price" => $mgmt_unit_cost["upto100"],
                        "discount" => 50,
                    ];
                }
                if ($mgmt_unit_cost["upto50"] > 0) {
                    $Sku_Data[$str[0] . "_{$prodType}_mgmt_base_upto50"] = [
                        "qty" => $mgmt_qty,
                        "sku_code" => getProductSku($str[0] . "_{$prodType}_mgmt"),
                        "unit_price" => $mgmt_unit_cost["upto50"],
                        "discount" => 50,
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

// 
function getSoftwareLic($type)
{
    global $key, $_DiscountedData, $CPU, $VMQTY, $con, $STATE;
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
                    if (preg_match("/ms/", $val) && preg_match("/Passive/", $STATE[$key][$val][$i])) {
                        $totalCores[] = $CPU[$key][$val][$i] * intval($VMQTY[$key][$val][$i] / 2);
                    } else {
                        $totalCores[] = $CPU[$key][$val][$i] * $VMQTY[$key][$val][$i];
                    }
                }
                $lic += intval(array_sum($totalCores) / $core_devide);
            } else {
                $lic = array_sum($VMQTY[$key][$val]);
            }
            $Array[$val] = [
                "service" => "Service",
                "product" => getProdName($val),
                "qty" => ($lic) . " " . getUnitName($val, "prod_int")["unit_name"],
                "unit_price" =>  getProductPrice($val),
                "mrc" => $lic * getProductPrice($val),
                "otc" => $_V[""],
                "discount" => empty($_DiscountedData[$key]["Data"]["software"][$val]) ? 0 : $_DiscountedData[$key]["Data"]["software"][$val],
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
    ];
    return $Array;
}



function getSoftPricesByVM($Array, $type = "price")
{
    global $con;
    try {
        $Q = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_os_calculation` WHERE `product_int` = '{$Array["int"]}'"));
    } catch (Error $e) {
        $Q = [];
    }

    if (!empty($Q)) {
        list($variableName, $value) = explode(' = ', $Q['calculation']);
        $$variableName = $value;

        $lic = ($Array["vcore"] * $Array["vmqty"]) / $core_devide;
    } else {
        $lic = $Array["vmqty"];
    }
    if ($type == "price") {
        return $lic * getProductPrice($Array['int']);
    } else {
        return $lic;
    }
}
