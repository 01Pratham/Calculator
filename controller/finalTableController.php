<?php
$Array = array();
$_Prices = [];
$calculation = array();
$Sku_Data = [];
$updatedPrices = json_decode(getEstimateDetails($EDITID)['prices'], true);
foreach ($_POST as $key => $arr) {
    if (is_array($arr)) {
        $Sku_Data[$key] = [
            "quotation_name"        => $arr["project_name"],
            "phase_name"            => $arr["estmtname"],
            "phase_tenure"          => $arr["period"],
            "phase_total_recurring" => 0,
            "groups"                => []
        ];

        foreach ($arr as $_K => $_V) {
            if ($_K == "estmtname") $Array[$key]["HEAD"] = $_V;
            if ($_K == "period") $Array[$key]["period"] = $_V;
            if ($_K == "region") $Array[$key]["region"] = $_V;

            if (is_array($_V)) {
                if (!isset($Array[$key][$_K])) {
                    $Array[$key][$_K] = array();
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

                    $DISK[$key][$_V["database"]][]            = intval($_V["inst_disk"]) * intval($_V["vmqty"]);
                    $DISK[$key][$_V["os"]][]                  = intval($_V["inst_disk"]) * intval($_V["vmqty"]);
                    $VMQTY[$key][$_V["database"]][]           = intval($_V["vmqty"]);
                    $VMQTY[$key][$_V["os"]][]                 = intval($_V["vmqty"]);
                    $VMQTY[$key]["sum"][]                 = intval($_V["vmqty"]);
                    $CPU[$key][$_V["database"]][]             = intval($_V["vcpu"]);
                    $STATE[$key][$_V["database"]][]           = ($_V["state"]);
                    $CPU[$key][$_V["os"]][]                   = intval($_V["vcpu"]);
                    $AntiVirus[$key][$_V["virus_type"]][]     = ($_V["virus_type"] == "") ? 0 : intval($_V["vmqty"]);
                    $IpAddress[$key][$_V["ip_public_type"]][] = floatval($_V["ip_public"]) * floatval(intval($_V["vmqty"]));

                    $Array[$key][preg_replace("/_.*/", "", $_K)][$_K] = [
                        "service"    => $_V["vmname"],
                        "product"    => getVm($vmarr),
                        "qty"        => intval($_V["vmqty"]) . " NO",
                        "unit_price" => getVmPrice($vmarr),
                        "mrc"        => getVmPrice($vmarr) * intval($_V["vmqty"]),
                        "otc"        => $_V[""],
                        "discount"   => (!empty($_DiscountedData[$key]["Data"][$_K])) ? 100 - (100 * ((getVmPrice($vmarr, "Discount") * intval($_V["vmqty"])) / (getVmPrice($vmarr) * intval($_V["vmqty"])))) : 0,
                    ];

                    $Sku_Data[$key]["groups"][$_K] = [
                        "group_name" => $_V["vmname"],
                        "group_id" => getCrmGroupId("virtual_machine"),
                        "group_quantity" => intval($_V["vmqty"]),
                        "products" => [
                            "cpu" => [
                                "qty"        => $_V["vcpu"],
                                "sku_code"   => getProductSku("vcpu_static"),
                                "unit_price" => getProductPrice("vcpu_static"),
                                "discount"   => $_DiscountedData[$key]["Data"][$_K]["vcore"]
                            ],
                            "ram" => [
                                "qty"        => $_V["ram"],
                                "sku_code"   => getProductSku("vram_static"),
                                "unit_price" => getProductPrice("vram_static"),
                                "discount"   => $_DiscountedData[$key]["Data"][$_K]["ram"]
                            ],
                            "disk" => [
                                "qty"        => $_V["inst_disk"],
                                "sku_code"   => getProductSku($_V["vmDiskIOPS"]),
                                "unit_price" => getProductPrice($_V["vmDiskIOPS"]),
                                "discount"   => $_DiscountedData[$key]["Data"][$_K]["storage"]
                            ],
                        ]
                    ];
                    $_Prices[$key][preg_replace("/_.*/", "", $_K)][$_K] = getVmPrice($vmarr, false);
                    if (!isset($Array[$key]["software"])) {
                        $Array[$key]["software"] = array();
                    }
                    if (!empty($_V["os"])) {
                        $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("os"));
                        $_Prices[$key]["software"][$_V["os"]] = getSoftPricesByVM(["int" => $_V["os"], "vcore" => 1, "vmqty" => 1]);
                        $Sku_Data[$key]["groups"][$_K]["products"]["os"] = [
                            "qty"        => getSoftPricesByVM(["int" => $_V["os"], "vcore" => $_V["vcpu"], "vmqty" => 1], "lics"),
                            "sku_code"   => getProductSku($_V["os"]),
                            "unit_price" => !empty($updatedPrices[$key]["software"][$_V["os"]]) ? $updatedPrices[$key]["software"][$_V["os"]] : getProductPrice($_V["os"]),
                            "discount"   => $_DiscountedData[$key]["Data"]["software"][$_V["os"]]
                        ];
                    }
                    if (!empty($_V["database"])) {
                        if ($_V["database"] != "NA") {
                            $Array[$key]["software"] = array_merge($Array[$key]["software"], getSoftwareLic("db"));
                            $_Prices[$key]["software"][$_V["database"]] = getSoftPricesByVM(["int" => $_V["database"], "vcore" => 1, "vmqty" => 1]);
                            $Sku_Data[$key]["groups"][$_K]["products"]["db"] = [
                                "qty"        => getSoftPricesByVM(["int" => $_V["database"], "vcore" => $_V["vcpu"], "vmqty" => 1], "lics"),
                                "sku_code"   => getProductSku($_V["database"]),
                                "unit_price" => !empty($updatedPrices[$key]["software"][$_V["database"]]) ? $updatedPrices[$key]["software"][$_V["database"]] :  getProductPrice($_V["database"]),
                                "discount"   => $_DiscountedData[$key]["Data"]["software"][$_V["database"]]
                            ];
                        }
                    }

                    if ($_V["virus_type"] != "") {
                        $UnitPrice = floatval(!empty($updatedPrices[$key]["security"][$_V["virus_type"]]) ? $updatedPrices[$key]["security"][$_V["virus_type"]] : getProductPrice($_V["virus_type"]));
                        $Array[$key]["security"][$_V["virus_type"]] = [
                            "service"    => "Anti Virus",
                            "product"    => getProdName($_V["virus_type"]),
                            "qty"        => array_sum($AntiVirus[$key][$_V["virus_type"]]) . " NO",
                            "unit_price" => $UnitPrice,
                            "mrc"        => $UnitPrice * array_sum($AntiVirus[$key][$_V["virus_type"]]),
                            "otc"        => $_V[""],
                            "discount"   =>  empty($_DiscountedData[$key]["Data"]["security"][$_V["virus_type"]]) ? 0 : $_DiscountedData[$key]["Data"]["security"][$_V["virus_type"]],
                        ];

                        $Sku_Data[$key]["groups"][$_K]["products"]["av"] = [
                            "qty"        => 1,
                            "sku_code"   => getProductSku($_V["virus_type"]),
                            "unit_price" => $UnitPrice,
                            "discount"   => $_DiscountedData[$key]["Data"]["security"][$_V["virus_type"]]
                        ];
                    }

                    if ($_V["ip_public"] != "" || $_V["ip_public"] != "0") {
                        $UnitPrice = floatval(!empty($updatedPrices[$key]["network"][$_V["ip_public_type"]]) ? $updatedPrices[$key]["network"][$_V["ip_public_type"]] : getProductPrice($_V["ip_public_type"]));
                        $Array[$key]["network"][$_V["ip_public_type"]] = [
                            "service"    => "IP Address",
                            "product"    => getProdName($_V["ip_public_type"]),
                            "qty"        => array_sum($IpAddress[$key][$_V["ip_public_type"]]) . " NO",
                            "unit_price" => $UnitPrice,
                            "mrc"        => $UnitPrice * array_sum($IpAddress[$key][$_V["ip_public_type"]]),
                            "otc"        => $_V[""],
                            "discount"   => $_DiscountedData[$key]["Data"]["network"][$_V["ip_public_type"]],
                        ];
                        $Sku_Data[$key]["groups"]["network"]["group_name"] = "network";
                        $Sku_Data[$key]["groups"]["network"]["group_quantity"] = 1;
                        $Sku_Data[$key]["groups"]["network"]["group_id"] = getCrmGroupId("network");
                        $Sku_Data[$key]["groups"]["network"]["products"]["ip"] = [
                            "qty"        => array_sum($IpAddress[$key][$_V["ip_public_type"]]),
                            "sku_code"   => getProductSku($_V["ip_public_type"]),
                            "unit_price" => $UnitPrice,
                            "discount"   => $_DiscountedData[$key]["Data"]["network"][$_V["ip_public_type"]]
                        ];
                    }
                } else {
                    $Sku_Data[$key]["groups"][$_K]["group_name"] = $_K;
                    $Sku_Data[$key]["groups"][$_K]["group_id"] = getCrmGroupId($_K);
                    $Sku_Data[$key]["groups"][$_K]["group_quantity"] = 1;
                    // PPrint( getMngServicesQty("os"));

                    foreach ($_V as $_k => $_v) {
                        $name = preg_replace("/_select|_qty|_unit/", "", $_k);
                        if (preg_match("/_mgmt/", $_k) && preg_match("/os|db/", $_k)) {
                            if (preg_match("/os/", $_k)) {
                                $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("os"));
                                if (!isset($Sku_Data[$key]["groups"][$_K]["products"])) {
                                    $Sku_Data[$key]["groups"][$_K]["products"] = [];
                                }
                                $Sku_Data[$key]["groups"][$_K]["products"] = array_merge($Sku_Data[$key]["groups"][$_K]["products"], getMngServicesQty("os", "SKU"));
                            }
                            if (preg_match("/db/", $_k)) {
                                $Array[$key][$_K] = array_merge($Array[$key][$_K], getMngServicesQty("db"));
                                if (!isset($Sku_Data[$key]["groups"][$_K]["products"])) {
                                    $Sku_Data[$key]["groups"][$_K]["products"] = [];
                                }
                                $Sku_Data[$key]["groups"][$_K]["products"] = array_merge($Sku_Data[$key]["groups"][$_K]["products"], getMngServicesQty("db", "SKU"));
                            }
                            continue;
                        }
                        $Unit = (isset($_V["{$name}_unit"]) ? getUnitName($_V["{$name}_unit"])['unit_name'] : getUnitName($_V["{$name}_select"], "prod_int")["unit_name"]);
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
                        $Qty = floatval($_V["{$name}_qty"]) . " " .  (empty($Unit) ? " NO" : $Unit);
                        $UnitPrice = floatval(!empty($updatedPrices[$key][$_K][$_V["{$name}_select"]]) ? $updatedPrices[$key][$_K][$_V["{$name}_select"]] : getProductPrice($_V["{$name}_select"]));
                        $Array[$key][$_K][$_V["{$name}_select"]] = [
                            "service"    => "Service",
                            "product"    => getProdName($_V["{$name}_select"]),
                            "qty"        => $Qty,
                            "unit_price" => (getProductPrice($_V["{$name}_select"], "otc") > 0) ? getProductPrice($_V["{$name}_select"], "otc") : $UnitPrice,
                            "mrc"        => $UnitPrice * floatval((isset($_V["{$name}_unit"]) && $Unit == "TB") ? $_V["{$name}_qty"] * 1024 : $_V["{$name}_qty"]),
                            "otc"        => floatval($_V["{$name}_qty"]) * getProductPrice($_V["{$name}_select"], "otc"),
                            "discount"   => $_DiscountedData[$key]["Data"][$_K][$_V["{$name}_select"]],
                        ];
                        $Sku_Data[$key]["groups"][$_K]["products"][$name] = [
                            "qty"        => floatval($_V["{$name}_qty"]),
                            "sku_code"   => getProductSku($_V["{$name}_select"]),
                            "unit_price" => $UnitPrice,
                            "discount"   => $_DiscountedData[$key]["Data"][$_K][$nam],
                            "otc"        => getProductPrice($_V["{$name}_select"], "otc"),
                            "is_billable" => 1
                        ];

                        if (preg_match("/otc/", $_K)) {
                            $Sku_Data[$key]["groups"][$_K]["group_name"] = $_K;
                            $Sku_Data[$key]["groups"][$_K]["group_id"] = getCrmGroupId($_k);
                            $Sku_Data[$key]["groups"][$_K]["group_quantity"] = 1;
                            $Array[$key][$_K]["otc"] = [
                                "service"    => "Service",
                                "product"    => getProdName($_V["{$name}_select"]),
                                "qty"        => 1 . " NO",
                                "unit_price" => 0,
                                "mrc"        => 0,
                                "otc"        => 0,
                                "discount"   => 0,
                            ];
                            $Sku_Data[$key]["groups"][$_K]["products"][$_K] = [
                                "qty"         => 1,
                                "sku_code"    => getProductSku($_V["{$name}_select"]),
                                "unit_price"  => 0,
                                "discount"    => 0,
                                "otc"         => 0,
                                "is_billable" => 1,
                            ];
                        }
                    }
                }
            }
        }
    }
}
// PPrint($calculation);

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
                    // $_Prices[$KEY]["MonthlyTotal"] += $val["mrc"];
                    $Sku_Data[$KEY]["phase_total_recurring"] += $val["mrc"];
                } else {
                    $Infrastructure[$KEY][] = $val["mrc"];
                    $DiscountedInfrastructure[$KEY][] =  $val["mrc"] - ($val["mrc"] *  ($val["discount"] / 100));
                    // $_Prices[$KEY]["MonthlyTotal"] += $val["mrc"];
                    $Sku_Data[$KEY]["phase_total_recurring"] += $val["mrc"];
                }

                if (!preg_match("/vm_/", $key)) {
                    $UnitPrice = floatval(!empty($updatedPrices[$KEY][$Key][$key]) ? $updatedPrices[$KEY][$Key][$key] : getProductPrice($key));
                    $_Prices[$KEY][$Key][$key]   = $UnitPrice;
                }
            }
        }
    }
    if (isset($VAL["otc"])) {
        $OTC = ((((!is_null($Infrastructure[$KEY])) ? array_sum($Infrastructure[$KEY]) : 0) + (!is_null($ManagedServices[$KEY]) ? array_sum($ManagedServices[$KEY]) : 0)) * 12) * 0.05;
        $Array[$KEY]["otc"]["otc"]["otc"] = $OTC;
        $Array[$KEY]["otc"]["otc"]["unit_price"] = $OTC;
        $Sku_Data[$KEY]["groups"]["otc"]["products"]["otc"]["otc"] = $OTC;
    }
}
// PPrint($DiscountedManagedServices);


function getVm($arr)
{
    return  "vCores : " . $arr['cpu'] .
        " | RAM "   . $arr['ram'] .
        " GB | Disk - " . preg_replace("/[a-zA-Z]| /", '', getProdName($arr['diskIops'])) .
        " IOPS - " . $arr['disk'] .
        " GB | OS : " . getProdName($arr['os']) .
        " | DB : " . getProdName($arr['db']);
}

function getVmPrice($arr, $sum = "true")
{
    global $updatedPrices, $_DiscountedData;

    if ($sum == "true") {
        // return 1;
        return array_sum([
            "vcore"   => $arr['cpu'] * (!empty($updatedPrices) ? $updatedPrices[$arr['key']][preg_replace("/_.*/", "", $arr['_K'])][$arr['_K']]["vcore"] :  getProductPrice("vcpu_static")),
            "ram"     => $arr['ram'] * (!empty($updatedPrices) ? $updatedPrices[$arr['key']][preg_replace("/_.*/", "", $arr['_K'])][$arr['_K']]["ram"] :  getProductPrice("vram_static")),
            "storage" => $arr['disk'] * (!empty($updatedPrices) ? $updatedPrices[$arr['key']][preg_replace("/_.*/", "", $arr['_K'])][$arr['_K']]["storage"] :   getProductPrice($arr['diskIops'])),
        ]);
    } elseif ($sum == "Discount") {
        $vcorePrice = (!empty($updatedPrices) ? $updatedPrices[$arr['key']][preg_replace("/_.*/", "", $arr['_K'])][$arr['_K']]["vcore"] :  getProductPrice("vcpu_static"));
        $ramPrice = (!empty($updatedPrices) ? $updatedPrices[$arr['key']][preg_replace("/_.*/", "", $arr['_K'])][$arr['_K']]["ram"] :  getProductPrice("vram_static"));
        $storagePrice = (!empty($updatedPrices) ? $updatedPrices[$arr['key']][preg_replace("/_.*/", "", $arr['_K'])][$arr['_K']]["storage"] :   getProductPrice($arr['diskIops']));

        $discountedVCore = $vcorePrice;
        $discountedRam = $ramPrice;
        $discountedStorage = $storagePrice;
        if (!empty($_DiscountedData[$arr['key']]["Data"][$arr['_K']])) {
            $discountedVCore   = floatval($arr["cpu"]) * ($vcorePrice - ($vcorePrice * (floatval($_DiscountedData[$arr['key']]["Data"][$arr['_K']]["vcore"]) / 100)));
            $discountedRam     = floatval($arr["ram"]) * ($ramPrice - ($ramPrice * (floatval($_DiscountedData[$arr['key']]["Data"][$arr['_K']]["ram"]) / 100)));
            $discountedStorage =  floatval($arr["disk"]) * ($storagePrice - ($storagePrice * (floatval($_DiscountedData[$arr['key']]["Data"][$arr['_K']]["storage"]) / 100)));
            return array_sum([
                "vcore"   => $discountedVCore,
                "ram"     => $discountedRam,
                "storage" => $discountedStorage,
            ]);
        }
    } else {
        return [
            "vcore"   => getProductPrice("vcpu_static"),
            "ram"     => getProductPrice("vram_static"),
            "storage" => getProductPrice($arr['diskIops']),
        ];
    }
}
// PPrint($Array);

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
                        "base" => $UnitPrice,
                        "upto100" => $upto100 > 0 ? $UnitPrice * 0.2 : 0,
                        "upto50" => $upto50 > 0 ? ($UnitPrice * 0.2) * 0.5 : 0,
                    ];

                    $mgmt_sum = [
                        "base" => 1,
                        "upto100" => $upto100,
                        "upto50" => $upto50,
                    ];

                    $mgmt_mrc = [
                        "base" => $UnitPrice * 1,
                        "upto100" => $upto100 > 0 ? $UnitPrice * 0.2  * $upto100 : 0,
                        "upto50" => $upto50 > 0 ? ($UnitPrice * 0.2) * 0.5 * $upto50 : 0,
                    ];

                    $MGMT[$str[0] . "_{$prodType}_mgmt"] = [
                        "service"    => "Service",
                        "product"    => $product_name,
                        "qty"        => array_sum($mgmt_sum) . " " . getUnitName($str[0] . "_{$prodType}_mgmt", "prod_int")["unit_name"],
                        "unit_price" => array_sum($mgmt_unit_cost),
                        "mrc"        => array_sum($mgmt_mrc),
                        "otc"        => $_V[""],
                        "discount"   => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                    ];

                    $Sku_Data[$str[0] . "_{$prodType}_mgmt_base"] = [
                        "qty"        => $mgmt_qty,
                        "sku_code"   => getProductSku($str[0] . "_{$prodType}_mgmt"),
                        "unit_price" => $mgmt_unit_cost["base"],
                        "discount"   => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                    ];
                    if ($mgmt_unit_cost["upto100"] > 0) {
                        $Sku_Data[$str[0] . "_{$prodType}_mgmt_upto100"] = [
                            "qty"        => $mgmt_qty,
                            "sku_code" => getProductSku($str[0] . "_{$prodType}_mgmt"),
                            "unit_price" => $mgmt_unit_cost["upto100"],
                            "discount"   => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                        ];
                    }
                    if ($mgmt_unit_cost["upto50"] > 0) {
                        $Sku_Data[$str[0] . "_{$prodType}_mgmt_base_upto50"] = [
                            "qty"        => $mgmt_qty,
                            "sku_code"   => getProductSku($str[0] . "_{$prodType}_mgmt"),
                            "unit_price" => $mgmt_unit_cost["upto50"],
                            "discount"   => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                        ];
                    }
                }
                if ($prodType == "os" && !empty($product_name)) {
                    $MGMT[$str[0] . "_{$prodType}_mgmt"] = [
                        "service"    => "Service",
                        "product"    => $product_name,
                        "qty"        => $VMQTY_SUM . " NO",
                        "unit_price" => $UnitPrice,
                        "mrc"        =>  $UnitPrice * $VMQTY_SUM,
                        "otc"        => $_V[""],
                        "discount"   => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
                    ];
                    $Sku_Data[$str[0] . "_{$prodType}_mgmt"] = [
                        "qty"        => $VMQTY_SUM,
                        "sku_code"   => getProductSku($str[0] . "_{$prodType}_mgmt"),
                        "unit_price" => $UnitPrice,
                        "discount"   => empty($_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"]) ? 0 : $_DiscountedData[$key]["Data"]["managed"][$str[0] . "_{$prodType}_mgmt"],
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
    global $key, $_DiscountedData, $CPU, $VMQTY, $con, $STATE, $updatedPrices;
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
                // $lic += array_sum($totalCores);
            } else {
                $lic = array_sum($VMQTY[$key][$val]);
            }
            $Array[$val] = [
                "service"    => "Service",
                "product"    => getProdName($val),
                "qty"        => ($lic) . " " . getUnitName($val, "prod_int")["unit_name"],
                "unit_price" => !empty($updatedPrices[$key]["software"][$val]) ? $updatedPrices[$key]["software"][$val] : getProductPrice($val),
                "mrc"        => $lic * (!empty($updatedPrices[$key]["software"][$val]) ? $updatedPrices[$key]["software"][$val] : getProductPrice($val)),
                "otc"        => $_V[""],
                "discount"   => empty($_DiscountedData[$key]["Data"]["software"][$val]) ? 0 : $_DiscountedData[$key]["Data"]["software"][$val],
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
        "service"    => "Service",
        "product"    => getProdName($key[0]),
        "qty"        => array_sum($arr) . " " . getUnitName($key[0], "prod_int")["unit_name"],
        "unit_price" =>  getProductPrice($key[0]),
        "mrc"        => array_sum($arr) * getProductPrice($key[0]),
        "otc"        => $_V[""],
        "discount"   => empty($_DiscountedData[$key]["Data"][$sec_cat]) ? 0 : $_DiscountedData[$key]["Data"][$sec_cat],
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
