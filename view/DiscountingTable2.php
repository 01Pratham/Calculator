<?php
$Sku_Data = array();
require_once "../controller/calculations.php";
foreach ($estmtname as $j => $_Key) {
    $no = 0;
    $Infrastructure = array();
    $antiVirus = false;
    $product_prices = priceTbl($region[$j])["product_prices"];
    $product_sku = priceTbl($region[$j])["product_sku"];
?>
    <table class='final-tbl table except' id="final-tbl<?= $j ?>">
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr>
            <th class='Head colspan except noExl' colspan='8' style='font-size: 30px;'>
                <div class="row except d-flex justify-content-between">
                    <div class="except"></div>
                    <div class="except">
                        <?= $estmtname[$j] ?>
                    </div>
                    <div class="col-2 except input-group">
                        <input type="number" min=0 max=100 name="" class="form-control col-md-10 " id="DiscountPercetage_<?= $j ?>" aria-describedby="perce_<?= $j ?>" oninput="
                                    if($(this).val() >100){
                                        $(this).addClass('border-danger');
                                        $('#perce_<?= $j ?>').attr('disabled' , true);
                                    }
                                    else{
                                        $(this).removeClass('border-danger');
                                        $('#perce_<?= $j ?>').removeAttr('disabled');
                                    }" onfocus="$(this).val($(this).data('percentage'))" onblur="
                                    let val = parseFloat($(this).val());    
                                    $(this).data('percentage',val).val(val.toFixed(2))" value="<?= floatval($_DiscountedData[$j]["percentage"]) ?>" data-percentage="<?= floatval($_DiscountedData[$j]["percentage"]) * 100 ?>" step="0.01">
                        <button class="input-group-text form-control bg-light col-2 p-0 d-flex justify-content-center " id="perce_<?= $j ?>" style="cursor : pointer"> % </button>
                    </div>
                </div>
            </th>
        </tr>
        <?php

        $Class = "Infrastructure_{$j}";
        if (!empty($vmqty[$j][0])) {
            $no + 1;
            $a = 'A.' . $no . ' +';
            tblHead('eNlight Cloud Hosting');

            $vm_total = array();
            $vcore_data = array();
            foreach ($vmqty[$j] as $i => $val) {
                $compute[$j][$i] = "vCores {$cpu[$j][$i]} | RAM  {$ram[$j][$i]} GB | Disk -" . preg_replace("/Block Storage|IOPS per GB| /", "", getProdName($diskType[$j][$i])) . " IOPS -  {$disk[$j][$i]} GB";
                $price = (($product_prices['vcpu_static'] * intval($cpu[$j][$i])) +
                    ($product_prices['vram_static'] * intval($ram[$j][$i])) +
                    ($product_prices[$diskType[$j][$i]] * intval($disk[$j][$i])));

                $vCore[$j][$i] = $cpu[$j][$i];
                $vRam[$j][$i] = $ram[$j][$i];
                $vDisk[$j][$i] = $disk[$j][$i];

                array_push($vcore_data, $vCore[$j][$i]);
                if (!empty($av_type[$j][$i])) {
                    $av = true;
                } else {
                }
                $Service = !empty($vmname[$j][$i]) ? ($vmname[$j][$i]) : ('Virtual Machine') . ' - ' . $region[$j][$i] . ' - ' . $sector[$j][$i] . ' ' . $state[$j][$i];

                $ProdName = $compute[$j][$i] . ' | OS : ' . getProdName($os[$j][$i]) . ' | DB : ' . getProdName($db[$j][$i]);

                $DiscountingId = "VM{$i}_{$j}";
                $arr = tblRow($Service, $ProdName, $vmqty[$j][$i], $_Prices[$j]["VM{$i}"][$vmname[$j][$i]]);
                // echo $product_prices['cpu'];
                $Products[$j][$DiscountingId][] = array(
                    "product" => 'CPU',
                    "SKU" => $product_sku['vcpu_static'],
                    "Quantity" => $cpu[$j][$i],
                    "MRC" => ($product_prices['vcpu_static'] * intval($cpu[$j][$i]))
                );
                $Products[$j][$DiscountingId][] = array(
                    "product" => 'RAM',
                    "SKU" => $product_sku['vram_static'],
                    "Quantity" => $ram[$j][$i],
                    "MRC" => ($product_prices['vram_static'] * intval($ram[$j][$i]))
                );
                $Products[$j][$DiscountingId][] = array(
                    "product" => 'Disk',
                    "SKU" => $product_sku[$diskType[$j][$i]],
                    "Quantity" => $disk[$j][$i],
                    "MRC" => ($product_prices[$diskType[$j][$i]] * intval($disk[$j][$i]))
                );
                $Products[$j][$DiscountingId]["QTY"] = $vmqty[$j][$i];
            }
            $Infrastructure['VM' . $i] = GroupPrice()['VM' . $i];
            $Infrastructure['VM' . $i][$vmname[$j][$i]] = intval($vmqty[$j][$i]) * $price;
        }

        $softLic = false;
        foreach ($vmqty[$j] as $i => $vl) {
            if (!empty($os[$j][$i]) || !empty($os[$j][$i])) {
                $softLic = true;
                break;
            } else {
                $softLic = false;
            }
        }
        if ($softLic || !empty($agenttype[$j]) || isset($drm_tool[$j])) {
            $b = 'A.' . $no = $no + 1;
            $b .= ' +';
            tblHead("Software Licenses");

            $os_data = (!empty($os[$j])) ? array_values(array_unique($os[$j])) : null;
            $db_data = (!empty($db[$j])) ? array_values(array_unique($db[$j])) : null;
            foreach ($vmqty[$j] as $i => $val) {
                foreach ($osArr as $k => $int) {
                    if ($os_data[$i] == $int) {
                        $DiscountingId = "{$int}_{$j}";
                        $SKU = $product_sku[$int];
                        $cal = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_os_calculation` WHERE `product_int` = '{$os_data[$i]}'"));
                        if (!empty($cal)) {
                            list($variableName, $value) = explode(' = ', $cal['calculation']);
                        } else {
                            $core_devide = '';
                        }
                        $$variableName = $value;
                        $Products[$j][$DiscountingId] = tblRow("Database", getProdName($os_data[$i]), get_os($os_data[$i], $core_devide),  PriceOs($os_data[$i], "os"), " Lic.");
                    }
                }
            }

            foreach ($vmqty[$j] as $i => $val) {
                foreach ($dbArr as $k => $int) {
                    if ($db_data[$i] == $int) {
                        $core_devide = NULL;
                        $DiscountingId = "{$int}_{$j}";
                        $SKU = $product_sku[$int];
                        $cal = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_os_calculation` WHERE `product_int` = '{$db_data[$i]}'"));
                        if (!empty($cal['calculation'])) {
                            list($variableName, $value) = explode(' = ', $cal['calculation']);
                            $$variableName = $value;
                        }
                        $Products[$j][$DiscountingId] = tblRow("Database", getProdName($int), get_DB($int, $core_devide), PriceOs($int, "db"), " Lic.");
                    }
                }
            }

            $Sku_Data[$estmtname[$j]] = SkuList();

            if (!empty($agenttype[$j])) {
                if ($agenttype[$j] == 'All VM') {
                    $agentqty[$j] = $vmqty[$j];
                } elseif ($agenttype[$j] == 'DB VM') {
                    foreach ($vmqty[$j] as $i => $val) {
                        if ($db[$i] != 'NA') {
                            $agentqty[$j][$i] = $vmqty[$j][$i];
                        }
                    }
                } elseif ($agenttype[$j] == 'Customized') {
                    $agentqty[$j][$i] = $EstmDATA['ageqty'][$j];
                }
                $SKU = $product_sku['veeam'];
                $DiscountingId = "backup_age_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Software", 'Backup Agent', array_sum($agentqty[$j]), $_Prices[$j]['Software']['veeam']);
                $Sku_Data[$estmtname[$j]]['Software'][$product_sku['veeam']] = array_sum($agentqty[$j]);
            }
            if (isset($drm_tool[$j])) {
                $SKU = $product_sku['drm_tool'];
                $DiscountingId = "drm_tool_{$j}";
                $drm_tool_qty = (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0;
                $Products[$j][$DiscountingId] = tblRow("Software", 'DRM Tool', $drm_tool_qty, $_Prices[$j]['Software']['DRM Tool']);
                $Sku_Data[$estmtname[$j]]['Software'][$product_sku['drm_tool']] = $drm_tool_qty;
            }
        }
        foreach ($strgArr as $int => $strgName) {
            if (isset($EstmDATA[$int])) {
                $strgServ = true;
                break;
            } else {
                $strgServ = false;
            }
        }
        if ($strgServ || !empty($backupstrg[$j]) || !empty($arc_strg[$j]) || isset($tape_lib[$j]) || isset($tape_cart[$j]) || isset($fire_cab[$j])) {

            $c = 'A.' . $no = $no + 1;
            $c .= ' +';

            tblHead("Storage and Backup Services");
            foreach ($strgArr as $int => $strgName) {
                if (isset($EstmDATA[$int])) {
                    $SKU = $product_sku[$int];
                    $DiscountingId = $int . "_" . $j;
                    $Products[$j][$DiscountingId] = tblRow(
                        "Additional Storage",

                        $strgName,

                        intval($EstmDATA[$int . "_qty"][$j]),

                        $_Prices[$j]["Storage Solution"][$int],

                        $EstmDATA[$int . "_unit"][$j]
                    );

                    $Infrastructure['Storage Solution'][$int] = get_strg($EstmDATA[$int . "_unit"][$j], $product_prices[$int]) * intval($EstmDATA[$int . "_qty"][$j]);
                    $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku[$int]] = ($EstmDATA[$int . "_unit"][$j] == 'TB') ? intval(intval($EstmDATA[$int . "_qty"][$j])) * 1024 : intval(intval($EstmDATA[$int . "_qty"][$j]));
                }
            }
            if (!empty($backupstrg[$j])) {
                $backupunit[$j] = $EstmDATA['backup_unit'][$j] ?? "backup_gb";
                $SKU = $product_sku[$backupunit[$j]];
                $DiscountingId = "backup_gb_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Backup Storage", getProdName($backupunit[$j]),  get_strg($backupunit[$j], 1, $backupstrg[$j]), $_Prices[$j]['Storage Solution']['Backup Space'], 'GB');
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['backup_gb']] = ($backupunit[$j] == 'TB') ? intval($backupstrg[$j]) * 1024 : intval($backupstrg[$j]);
            }
            if (!empty($arc_strg[$j])) {
                $SKU = $product_sku['arc_strg'];
                $DiscountingId = "arc_strg_gb_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Archival Storage", 'Archival Space',  get_strg($archival_unit[$j], 1, $arc_strg[$j]), $_Prices[$j]['Storage Solution']['Archival Space'], 'GB');
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['arc_strg']] = ($archival_unit[$j] == 'TB') ? intval($arc_strg[$j]) * 1024 : intval($arc_strg[$j]);
            }
            if (isset($tape_lib[$j])) {
                $SKU = $product_sku['tl'];
                $DiscountingId = "tl_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Offline Backup', 'Offline Backup Solution Tape Library', $tlqty[$j], $_Prices[$j]['Storage Solution']['Offline Backup Solution Tape Library']);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['tl']] = $tlqty[$j];
            }

            if (isset($tape_cart[$j])) {
                $SKU = $product_sku['tc'];
                $DiscountingId = "tc_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Offline Backup', 'Offline Backup Solution Tape Cartridge', $tcqty[$j], $_Prices[$j]['Storage Solution']['Offline Backup Solution Tape Cartridge']);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['tc']] = $tcqty[$j];
            }

            if (isset($fire_cab[$j])) {
                $SKU = $product_sku['fc'];
                $DiscountingId = "fc_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Offline Backup', 'Offline Backup Solution Fireproof cabinate', $fcqty[$j], $_Prices[$j]['Storage Solution']['Offline Backup Solution Fireproof cabinate']);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['fc']] = $fcqty[$j];
            }
        }

        if (isset($rack[$j]) || isset($rated[$j]) || isset($metered[$j]) || isset($cage[$j]) || isset($bio[$j]) || isset($pdu[$j]) || isset($cctv[$j])) {
            $c = 'A.' . $no = $no + 1;
            $c .= ' +';
            tblHead("Colocation Services");
            if (isset($rack[$j])) {
                $SKU = $product_sku['rack_space'];
                $DiscountingId = "rack_space_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Rack Space', $rackqty[$j], $_Prices[$j]['Colocation']['Rack Space'], "U");
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['rack_space']] = ($rackqty[$j]);
            }
            if (isset($metered[$j])) {
                $SKU = $product_sku['metered_power'];
                $DiscountingId = "metered_power_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Metered Power', $meteredqty[$j], $_Prices[$j]['Colocation']['metered_power'], "Power Unit");
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['metered_power']] = ($meteredqty[$j]);
            }
            if (isset($rated[$j])) {
                $SKU = $product_sku['rated_power'];
                $DiscountingId = "rated_power_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Rated Power', $ratedqty[$j], $_Prices[$j]['Colocation']['rated_power'], "Power Unit");
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['rated_power']] = ($ratedqty[$j]);
            }

            if (isset($cage[$j])) {
                $SKU = $product_sku['cage'];
                $DiscountingId = "cage_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Cage For RACK', $cageqty[$j], $_Prices[$j]['Colocation']['cage']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['cage']] = ($cageqty[$j]);
            }
            if (isset($bio[$j])) {
                $SKU = $product_sku['bio'];
                $DiscountingId = "bio_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Bio-matrix for Cage', $bioqty[$j], $_Prices[$j]['Colocation']['bio']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['bio']] = ($bioqty[$j]);
            }
            if (isset($pdu[$j])) {
                $SKU = $product_sku['pdu'];
                $DiscountingId = "pdu_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'PDU Meter', $pduqty[$j], $_Prices[$j]['Colocation']['pdu']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['pdu']] = ($pduqty[$j]);
            }

            if (isset($cctv[$j])) {
                $SKU = $product_sku['cctv'];
                $DiscountingId = "cctv_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'CCTV Camera fo Rack', $cctvqty[$j], $_Prices[$j]['Colocation']['cctv']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['cctv']] = ($cctvqty[$j]);
            }
        }
        if ($ip_private[$j] != NULL) {
            $private_data[$j] = array_unique($ip_private[$j]);
        }
        if ($ip_public[$j] != NULL) {
            $public_data[$j] = array_unique($ip_public[$j]);
        }

        if ($ip_public[$j] != NULL) {
            $public_data[$j] = array_unique($ip_public[$j]);
        }
        $IpAddress = array();
        foreach ($vmqty[$j] as $i => $v) {
            if (!empty($publicip_qty[$j][$i]) || intval($publicip_qty[$j][$i]) != 0) {
                $isIp = true;
                $IpAddress[$publicip_vers[$j][$i]][] = $publicip_qty[$j][$i];
                break;
            } else {
                $isIp = false;
            }
        }

        if ($isIp || !empty($bandwidth[$j]) || !empty($ccptqty[$j]) || !empty($vpn[$j]) || !empty($lb[$j]) || !empty($rep_link_type[$j])) {
            $d = 'A.' . $no = $no + 1;
            $d .= ' +';
            tblHead("Network and Connectivity Services");
            if ($isIp) {
                foreach ($IpAddress as $vers => $qty) {
                    $SKU = $product_sku[$vers];
                    $DiscountingId = "{$vers}_{$j}";
                    $Products[$j][$DiscountingId] = tblRow('Services', 'Public IP Address : ' . $vers, array_sum($qty), $_Prices[$j]['Network Solution'][$vers]);
                    $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ip']] = array_sum($qty);
                }
            }
            if (!empty($bandwidth[$j])) {
                $bandInt = ($bandwidthType[$j] == 'Speed Based Internet Bandwidth') ? 'speed_band' : 'volume_band';
                $bandUnit = ($bandwidthType[$j] == 'Speed Based Internet Bandwidth') ? ' Mbps' : ' GB';
                $SKU = $product_sku[$bandInt];
                $DiscountingId = "{$bandInt}_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', $bandwidthType[$j], $bandwidth[$j], $_Prices[$j]['Network Solution']['bandwidth'], $bandUnit);
                $Infrastructure['Network Solution']['bandwidth'] = intval($product_prices[$bandInt]) * intval($bandwidth[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku[$bandInt]] = $bandwidth[$j];
            }
            if (!empty($ccptqty[$j])) {
                $SKU = $product_sku["cross_connect"];
                $DiscountingId = "cross_connect_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', "Cross Connect and Port Termination", $ccptqty[$j], $_Prices[$j]['Network Solution']["cross_connect"]);
                $Infrastructure['Network Solution']["cross_connect"] = intval($product_prices["cross_connect"]) * intval($ccptqty[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku["cross_connect"]] = $ccptqty[$j];
            }

            if (isset($rep_link[$j])) {
                $SKU = $product_sku[$rep_link_type[$j]];
                $DiscountingId = "{$rep_link_type[$j]}_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', getProdName($rep_link_type[$j]) . ' Replication Link', $rep_link_qty[$j], $_Prices[$j]['Network Solution']['rep_link'], "Mbps");
                $Infrastructure['Network Solution']['rep_link'] = intval($rep_link_qty[$j]) * get_Price($rep_link_type[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution']['CNPP000000000000'] = $rep_link_qty[$j];
            }

            if (!empty($ipsec[$j])) {
                $SKU = $product_sku['ipsec_vpn'];
                $DiscountingId = "ipsec_vpn_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Virtual Private Network (VPN) : IPSEC', $ipsecqty[$j], $_Prices[$j]['Network Solution']['ipsec_vpn']);
                $Infrastructure['Network Solution']['ipsec_vpn'] = intval($ipsecqty[$j]) * $product_prices['ipsec_vpn'];
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ipsec_vpn']] = $ipsecqty[$j];
            }

            if (!empty($sslvpn[$j])) {
                $SKU = $product_sku['ssl_vpn'];
                $DiscountingId = "ssl_vpn_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Virtual Private Network (VPN) : SSL', $sslvpnqty[$j], $_Prices[$j]['Network Solution']['sslvpn']);
                $Infrastructure['Network Solution']['sslvpn'] = intval($sslvpnqty[$j]) * $product_prices['ssl_vpn'];
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ssl_vpn']] = $sslvpnqty[$j];
            }

            if (!empty($lb[$j])) {
                $SKU = $lb[$j];
                $DiscountingId = "{$lb[$j]}_{$j}";
                $Products[$j][$DiscountingId] = tblRow('Services', 'Load Balancer', $lbqty[$j], $_Prices[$j]['Network Solution']['lb']);
                $Infrastructure['Network Solution']['lb'] = get_Price($lb[$j]) * intval($lbqty[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$lb[$j]] = $lbqty[$j];
            }
        }
        if (!empty($vmqty[$j])) {
            $av_count = array();
            foreach ($vmqty[$j] as $i => $val) {
                if (!empty($av_type[$j][$i])) {
                    // $av_type[ $j ][ $key ] = $val;
                    $newAV = $av_type[$j][$i];
                    // echo $vmqty[ $j ][ $i ];
                    array_push($av_count, $vmqty[$j][$i]);
                } else {
                    unset($av_type[$j][$i]);
                }
            }
        }
        foreach ($secArr as $cat => $prod) {
            if (isset($EstmDATA[$cat . "_check"])) {
                $secServ = true;
                break;
            } else {
                $secServ = false;
            }
        }
        if (!empty($newAV) || $secServ) {
            $e = 'A.' . $no = $no + 1;
            tblHead('Security Solution');

            if (!empty($newAV)) {
                $DiscountingId = "av_{$j}";
                $SKU = $product_sku[$newAV];
                $Products[$j][$DiscountingId] = tblRow('Services', getProdName($newAV), array_sum($av_count), $_Prices[$j]["Security Solution"]["av"]);
                $Infrastructure['Security Solution']['av'] = $product_prices[$newAV];
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku[$newAV]] = array_sum($av_count);
            }

            $totalFirewalls = array();
            foreach ($secArr as $cat => $prod) {

                if (isset($EstmDATA[$cat . "_check"][$j])) {
                    $calQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_calculation` WHERE `sec_cat_name` = '{$cat}'"));
                    if (!empty($calQuery)) {
                        $itemsArr = explode(",", $calQuery["calculation"]);
                        // print_r($itemsArr);
                        $calculation = array();
                        foreach ($itemsArr as $item) {
                            if (preg_match("/vm/", $item)) {
                                $calculation[$item] = (!empty($$item[$j])) ? array_sum($$item[$j]) : 0;
                            } else {
                                $calculation[$item] = (!empty($EstmDATA[$item][$j])) ? $EstmDATA[$item][$j] : 0;
                            }
                        }
                        // print_r($calculation);
                        $EstmDATA[$cat . "_qty"][$j] = array_sum($calculation);
                    }

                    $SKU = get_Price(($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j], 'sku_code');
                    $DiscountingId = $cat . "_" . $j;

                    $Products[$j][$DiscountingId] = tblRow(
                        "Services",

                        $secArr[$cat][($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j]],

                        intval($EstmDATA[$cat . "_qty"][$j]),

                        $_Prices[$j]["Security Solution"][$cat]
                    );
                    if (preg_match("/fw/", $cat)) {
                        if (isset($EstmDATA[$cat . "_check"])) {
                            $totalFirewalls[$cat] =   $EstmDATA[$cat . "_qty"][$j];
                        }
                    }

                    $Infrastructure['Storage Solution'][$cat] = $product_prices[($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j]];
                    $Sku_Data[$estmtname[$j]]['Storage Solution'][$cat] = $EstmDATA[$cat . "_qty"][$j];
                }
            }
        }
        if (isset($osmgmt[$j]) || isset($dbmgmt[$j]) || isset($strgmgmt[$j]) || isset($backup_mgmt[$j]) || isset($lbmgmt[$j]) || isset($fvmgmt[$j]) || isset($wafmgmt[$j]) || !empty($bandwidth[$j]) || isset($EstmDATA['emagic'][$j]) || isset($EstmDATA["otc"][$j])) {
            $f = 'A.' . $no = $no + 1;
            tblHead("Managed Services");
            $DiscountingId = "OTC";
            if (isset($EstmDATA["otc"][$j])) {
        ?>
                <tr>
                    <td><?php echo "Service"; ?></td>
                    <td class='final'><?php echo 'One Time Infrastructure Setup' ?></td>
                    <td class='qty'></td>
                    <td class='cost unshareable'></td>
                    <td class="MRC mrc_<?= $j ?> unshareable"></td>
                    <td class=' unshareable' id='disc'></td>
                    <td class='  unshareable'></td>
                    <td class='unshareable' id="otc_<?= $j ?>"></td>
                </tr>


        <?php
            }
            $Class = "Managed_{$j}";

            if (isset($rep_link_mgmt[$j])) {
                $replication_mgmt = (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0;
            } else {
                $replication_mgmt = 0;
            }
            if (isset($osmgmt[$j]) && !empty($os[$j])) {
                foreach ($os[$j] as $i => $val) {
                    foreach ($osArr as $k => $int) {
                        if ($os[$j][$i] == $int) {
                            $str = explode("_", $os[$j][$i]);
                            $osInt[] = $str[0];
                            $os_mgmt_name[] = getProdName($int);
                            $os_mgmt_qty[$str[0]][] = $vmqty[$j][$i];
                            $osmgmtINT[$str[0]] = $str[0] . '_mgmt';
                        }
                    }
                }
                $os_mgmt_data = (!empty($osInt)) ? array_values(array_unique($osInt)) : null;
            }

            if (isset($dbmgmt[$j]) && !empty($db[$j])) {
                foreach ($db[$j] as $i => $val) {
                    foreach ($dbArr as $k => $int) {
                        if ($db[$j][$i] == $int) {
                            $str = explode("_", $db[$j][$i]);
                            $dbInt[] = $str[0];
                            $db_mgmt_name[] = getProdName($int);
                            $db_mgmt_qty[$str[0]][] = intval(($disk[$j][$i] * $vmqty[$j][$i]) / 100);
                            $dbmgmtINT[$str[0]] = $str[0] . '_db_mgmt';
                        }
                    }
                }
                $db_mgmt_data = (!empty($dbInt)) ? array_values(array_unique($dbInt)) : null;
            }
            $strgmgmtqty = array();
            if (isset($strgmgmt[$j])) {
                foreach ($strgArr as $int => $strgName) {
                    if (isset($EstmDATA[$int])) {
                        ($EstmDATA[$int . "_unit"][$j] == "GB") ? array_push($strgmgmtqty, floatval($EstmDATA[$int . "_qty"][$j])) : array_push($strgmgmtqty, (floatval($EstmDATA[$int . "_qty"][$j]) * 1024));
                    }
                }
            } else {
            }

            if (isset($backup_mgmt[$j]) && !empty($backupstrg[$j])) {
                $backmgmtqty = (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0;
            } else
                $backmgmtqty = 0;

            if (isset($lbmgmt[$j]) && !empty($lbqty[$j])) {
                $lbmgmtqty = $lbqty[$j];
            } else
                $lbmgmtqty = 0;
            if (isset($fvmgmt[$j])) {
                if (!empty($totalFirewalls)) {
                    $fvmgmtqty = array_sum($totalFirewalls);
                } else {
                    $fvmgmtqty = 0;
                }
            } else
                $fvmgmtqty = 0;
            if (isset($wafmgmt[$j]) && !empty($EstmDATA["waf_qty"][$j])) {
                $wafmgmtqty = $EstmDATA["waf_qty"][$j];
            } else {
                $wafmgmtqty = 0;
            }

            if (!empty($bandwidth[$j])) {
                $bandwidth_monitoring = 1;
            } else
                $bandwidth_monitoring = 0;

            if (isset($EstmDATA['emagic'][$j])) {
                $emagicqty = array(intval($lbmgmtqty), intval($fvmgmtqty), intval($wafmgmtqty), (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0, intval($ccptqty[$j]), $bandwidth_monitoring);
            }

            $newInfra = array();
            foreach ($Infrastructure as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $p) {
                        array_push($newInfra, $p);
                    }
                } else {
                    array_push($newInfra, $val);
                }
            }
            $period = $EstmDATA['period'];
            if (empty($period[$j])) {
                $period[$j] = 1;
            }
            if (isset($osmgmt[$j]) && !empty($os_mgmt_name)) {
                for ($i = 0; $i < count($os_mgmt_data); $i++) {
                    $SKU = $product_sku[$osmgmtINT[$os_mgmt_data[$i]]];
                    $DiscountingId = $osmgmtINT[$os_mgmt_data[$i]] . "_$j";
                    $Products[$j][$DiscountingId] = tblRow("Services", getProdName($osmgmtINT[$os_mgmt_data[$i]]), array_sum($os_mgmt_qty[$os_mgmt_data[$i]]), $_Prices[$j]['Managed Services'][$osmgmtINT[$os_mgmt_data[$i]]]);
                    $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku[$osmgmtINT[$os_mgmt_data[$i]]]] = array_sum($os_mgmt_qty[$os_mgmt_data[$i]]);
                }
            }
            if (isset($dbmgmt[$j]) && !empty($db_mgmt_data)) {
                for ($i = 0; $i < count($db_mgmt_data); $i++) {
                    $SKU = $product_sku[$dbmgmtINT[$db_mgmt_data[$i]]];
                    $DiscountingId = $dbmgmtINT[$db_mgmt_data[$i]] . "_$j";
                    $Products[$j][$DiscountingId] = tblRow("Service", getProdName($dbmgmtINT[$db_mgmt_data[$i]]), array_sum($db_mgmt_qty[$db_mgmt_data[$i]]), $_Prices[$j]['Managed Services'][$dbmgmtINT[$db_mgmt_data[$i]]]);
                    $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku[$dbmgmtINT[$db_mgmt_data[$i]]]] = array_sum($db_mgmt_qty[$db_mgmt_data[$i]]);
                    $managed_services[$dbmgmtINT[$db_mgmt_data[$i]]] = array_sum($db_mgmt_qty[$db_mgmt_data[$i]]) * intval($product_prices[$dbmgmtINT[$db_mgmt_data[$i]]]);
                }
            }
            if (isset($strgmgmt[$j])) {
                $SKU = $product_sku['strg_mgmt'];
                $DiscountingId = "strg_mgmt_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Service", "Storage Management Per TB", floor(array_sum($strgmgmtqty) / 1024), $_Prices[$j]['Managed Services']["st_mg"]);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['strg_mgmt']] = floor(array_sum($strgmgmtqty) / 1024);
            }
            if (isset($backup_mgmt[$j])) {
                $SKU = $product_sku['backup_mgmt'];
                $DiscountingId = "backup_mgmt_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Service", 'Backup Management - per Instance', $backmgmtqty, $_Prices[$j]['Managed Services']["back_mg"]);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['backup_mgmt']] = $backmgmtqty;
            }
            if (isset($rep_link_mgmt[$j])) {
                $SKU = $product_sku['rep_mgmt'];
                $DiscountingId = "rep_mgmt_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Service", 'Replication Service Management', $replication_mgmt, $_Prices[$j]['Managed Services']['rep_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['rep_mgmt']] = $replication_mgmt;
            }

            if (isset($dr_drill[$j])) {
                $SKU = $product_sku['dr_drill'];
                $DiscountingId = "dr_drill_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Service", 'DR Drill Per Year', $drill_qty[$j], $_Prices[$j]['Managed Services']["dr_drill"]);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['dr_drill']] = $drill_qty[$j];
            }

            if (isset($lbmgmt[$j])) {
                $SKU = $product_sku['virt_lb_mgmt'];
                $DiscountingId = "lb_mg_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Service", 'Load Balancer Management', $lbmgmtqty, $_Prices[$j]['Managed Services']['lb_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['virt_lb_mgmt']] = $lbmgmtqty;
            }
            if (isset($fvmgmt[$j])) {
                $name = (isset($EstmDATA["utm_check"][$j]) ? 'vUTM ' : '') . "Firewall Management";
                $INT = (isset($utm[$j])) ? 'utm_mgmt' : 'vfirewall_mgmt';
                $SKU = $product_sku[$INT];
                $DiscountingId = "{$INT}_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Service", $name, $fvmgmtqty, $_Prices[$j]['Managed Services']["fw_mgmt"]);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku[$INT]] = $fvmgmtqty;
            }
            if (isset($wafmgmt[$j])) {
                $SKU = $product_sku['esds_waf_mgmt'];
                $DiscountingId = "waf_mg_{$j}";
                $Products[$j][$DiscountingId] = tblRow("Service", "Web Application Firewall Management", $wafmgmtqty, $_Prices[$j]['Managed Services']['waf_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['esds_waf_mgmt']] = $wafmgmtqty;
            }

            if (isset($EstmDATA['emagic'][$j])) {
                $SKU = $product_sku['emagic'];
                $DiscountingId = "emagic_{$j}";
                $name = 'eMagic Monitoring ' . $emagic_type[$j];
                $Products[$j][$DiscountingId] = tblRow("Services", $name, array_sum($emagicqty), $_Prices[$j]['Managed Services']['emagic']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['emagic']] = array_sum($emagicqty);
                $info = '';
            }
        }
        ?>
        <tr>
            <th class='except unshareable' style='background: rgba(212,212,212,1); '> Sr No . </th>
            <th class='final colspan except unshareable' colspan='3' style='background: rgba(212,212,212,1); '> Description </th>
            <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>MRC</th>
            <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>Discounted MRC</th>
        </tr>
        <?php
        $m = 0;
        if (!empty($Infrastructure)) {
        ?>
            <tr>
                <td class='unshareable'>
                    <?= $m + 1 ?>
                </td>
                <td class='colspan  final unshareable' colspan='3'> Infrastructure [ <?= $a . ' ' ?>
                    <?= $b . ' ' ?>
                    <?= $c . ' ' ?>
                    <?= $d . ' ' ?>
                    <?= $e . ' ' ?> ]</td>
                <td class='colspan unshareable ' id="infraTotal_<?= $j ?>" colspan='2'></td>
                <td class='colspan unshareable ' colspan='2' id="DiscInfra_<?= $j ?>"></td>
            </tr>
        <?php }
        ?>
        <tr>
            <td class='unshareable'>
                <?= $m = $m + 1 ?>
            </td>
            <td class='colspan final unshareable' colspan='3'> Managed Services [ <?= $f ?> ] </td>
            <td class='colspan unshareable' colspan='2' id="MngTotal_<?= $j ?>"></td>
            <td class='colspan unshareable' colspan='2' id="DiscMng_<?= $j ?>"></td>
        </tr>

        <tr>
            <td class='unshareable'>
                <?= $m = $m + 1 ?>
            </td>
            <td class='colspan final unshareable' colspan='3'> One Time Cost </td>
            <td class='colspan unshareable' colspan='2' id="final_otc_<?= $j ?>"> </td>
            <td class='colspan unshareable' colspan='2'></td>
        </tr>
        <tr>
            <th class='final unshareable' style='background-color: rgb(255, 207, 203);'> </th>
            <th class='final colspan except unshareable' colspan='3' style='background-color: rgb(255, 207, 203);'> Total [ Monthly ]</th>
            <th class='colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly_<?= $j ?>'></th>
            <th class='colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='DiscTotal_<?= $j ?>'></th>
        </tr>
        <tr>
            <th class='final unshareable' style='background-color: rgb(255, 226, 182);'> </th>
            <th class='final colspan except unshareable' colspan='3' style='background-color: rgb(255, 226, 182);'> Total [ For <?= $period[$j] ?> Months ]</th>
            <th class='colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);' id="MonthlyTotal_<?= $j ?>" data-period="<?= $period[$j] ?>"></th>
            <th class='colspan except unshareable MonthlyDiscounted' colspan='2' style='background-color: rgb(255, 226, 182);' id="MonthlyDiscounted_<?= $j ?>" data-period="<?= $period[$j] ?>"></th>
        </tr>
    </table>
    <input type="hidden" name="" id="Months_<?= $j ?>" value="<?= $period[$j] ?>">

    <script>
        $("#perce_<?= $j ?>").on("click", function() {
            var $obj = {
                action: "Discount",
                discountVal: $("#DiscountPercetage_<?= $j ?>").val() / 100,
                Total: "<?= $_Prices[$j]['MonthlyTotal'] ?>",
                data: "<?= base64_encode(json_encode($Products[$j])) ?>",
                regionId: "<?= $region[$j] ?>"
            };
            DiscountingAjax($obj, <?= $j ?>);
        })
        $(document).ready(function() {
            totalInfra(<?= $j ?>)
        })
    </script>
<?php
    $I_M[$j] = $Infrastructure;
    $I_M[$j]['Managed Services'] = $managed_services;
    // print_r($Products);
}



function tblRow($Service, $Product, $Quantity, $MRC, $Unit = "NO", $OTC = '')
{
    global $j, $DiscountingId, $SKU, $Class, $_DiscountedData;
    // echo gettype($OTC);
?>
    <tr id="<?= $DiscountingId ?>">
        <td><?php echo $Service; ?></td>
        <td class='final'><?php echo $Product ?></td>
        <td class='qty'><?php echo $Quantity . " " . $Unit; ?></td>
        <td class='cost unshareable'><?php
                                        try {
                                            $P = floatval($MRC) / floatval($Quantity);
                                            INR($P);
                                        } catch (DivisionByZeroError  $e) {
                                            INR(0);
                                        }
                                        ?></td>
                <td class="MRC mrc_<?= $j ?> unshareable <?= $Class ?>" data-MRC="<?= $MRC ?>" data-discId="<?= $DiscountingId ?>">
            <?php
            try {
                INR($MRC);
            } catch (TypeError $e) {
                INR(0);
            }
            ?></td>
        <?php
        if (!empty($_DiscountedData[$j]["Data"][$DiscountingId])) {
            if (is_array($_DiscountedData[$j]["Data"][$DiscountingId])) {
                $percentage =  array_sum($_DiscountedData[$j]["Data"][$DiscountingId]) / count($_DiscountedData[$j]["Data"][$DiscountingId]);
            } else {
                $percentage = ($_DiscountedData[$j]["Data"][$DiscountingId]);
            }
        }
        ?>
        <td class='discount unshareable' id='disc' data-percentage="<?= $percentage ?>" data-key="<?= $j ?>" data-discId="<?= $DiscountingId ?>">
            <?= $percentage ?> %
        </td>
        <td class='DiscountedMrc unshareable <?= $Class ?>'><?php
                                                            INR(($MRC - ($MRC * $percentage)));
                                                            ?></td>
        <td class='unshareable' <?= (!empty($OTC)) ? "id='otc{$j}'" : '' ?>><?php (!empty($OTC)) ? INR($OTC) : '' ?></td>
    </tr>
<?php
    $arr = array(
        "Product" => $Product,
        "SKU" => $SKU,
        "Quantity" => $Quantity,
        "MRC" => $MRC
    );

    return $arr;
}


function tblHead($Service)
{
    global $no;
?>
    <tr>
        <th class='Head except' id='sr'><?php echo 'A.' . $no; ?></th>
        <th class='Head except' id='comp'><?= $Service ?></th>
        <th class='Head except' id='unit'>Unit</th>
        <th class='Head unshareable except' id='cost'>Cost/Unit</th>
        <th class='Head unshareable except' id='mrc'>Monthly Cost</th>
        <th class='Head unshareable except' id='disc-head'>Discount %</th>
        <th class='Head unshareable except' id='discCost'>Discounted Price</th>
        <th class='Head unshareable except' id='otc'>OTC</th>
    </tr>
<?php
}
function PriceOs($SW, $Feild)
{
    global  $$Feild, $j, $_Prices, $vmqty;
    foreach ($vmqty[$j] as $i => $val) {
        if ($$Feild[$j][$i] == $SW) {
            $Price[] = $_Prices[$j]["VM{$i}"][$Feild];
        }
    }
    return array_sum($Price);
}
?>
<script>
    
    const sum = (obj) => Object.values(obj).reduce((a, b) => a + b, 0);

    function updateTotalHtml(object) {
        let DiscountedInfra = 0,
            DiscountedMng = 0,
            DiscountedMRC = 0,
            DiscountedTotal = 0,
            discountPercentage = 0
            j = object.j;
        Object.keys(object.Obj).forEach(function(key) {
            let $thisMrc = $("#" + key)
            MRC = $thisMrc.find(".mrc_" + j).data("mrc");
            if (typeof object.Obj[key] === "object") {
                let vmAvgPerc = (sum(object.Obj[key]) / Object.keys(object.Obj[key]).length);
                let DiscountedMRC = MRC - (MRC * (vmAvgPerc / 100));
                $thisMrc.find(".discount").html(vmAvgPerc.toFixed(2) + " %").data("percentage", vmAvgPerc);
                $thisMrc.find(".DiscountedMrc").html(INR(DiscountedMRC));
                if ($thisMrc.find(".DiscountedMrc").hasClass("Infrastructure_" + j)) {
                    DiscountedInfra += DiscountedMRC;
                } else if ($thisMrc.find(".DiscountedMrc").hasClass("Managed_" + j)) {
                    DiscountedMng += DiscountedMRC;
                }
            } else {
                discountPercentage = object.Obj[key];
                DiscountedMRC = MRC - (MRC * (discountPercentage / 100));
                $thisMrc.find(".discount").html(discountPercentage.toFixed(2) + " %").data("percentage", discountPercentage);
                $thisMrc.find(".DiscountedMrc").html(INR(DiscountedMRC));
                if ($thisMrc.find(".DiscountedMrc").hasClass("Infrastructure_" + j)) {
                    DiscountedInfra += DiscountedMRC;
                } else if ($thisMrc.find(".DiscountedMrc").hasClass("Managed_" + j)) {
                    DiscountedMng += DiscountedMRC;
                }
            }
        })
        DiscountedMRC = parseFloat(DiscountedInfra) + parseFloat(DiscountedMng);
        DiscountedTotal = parseFloat(DiscountedMRC) * parseFloat($("#MonthlyDiscounted_" + j).data("period"));
        $("#DiscInfra_" + j).html(INR(DiscountedInfra));
        $("#DiscMng_" + j).html(INR(DiscountedMng));
        $("#DiscTotal_" + j).html(INR(DiscountedMRC));
        $("#MonthlyDiscounted_" + j).html(INR(DiscountedTotal)).data("value", DiscountedTotal);
        DiscountedData[object.j]["percentage"] = object.DATA.discountVal;
        DiscountedData[object.j]["Data"] = object.Obj;
    }
    <?php
    echo "let DiscountedData = {";
    foreach ($estmtname as $j => $_Key) {
        echo $j . " : {
                'percentage' : '',
                'Data' : {} 
            },";
    }
    echo "}";
    ?>

    function DiscountingAjax(DATA, j) {
        $.ajax({
            type: "post",
            url: "../controller/discounting.php",
            dataType: "TEXT",
            data: DATA,
            success: function(res) {
                let Obj = JSON.parse(res)
                updateTotalHtml({
                    "Obj": Obj,
                    "j": j,
                    "DATA": DATA
                });
                $(".discount").attr("Contenteditable", "true");
            }
        })
    }

    function totalInfra(j, type = "total") {
        let Infrastructure = [];
        let Managed = [];
        $(".Managed_" + j + " , .Infrastructure_" + j + "").each(function() {
            let valHTML = $(this).html();
            let val = valHTML.replace(/₹|,|\n| /g, '');
            if (type == "total") {
                if ($(this).hasClass("Infrastructure_" + j) && val !== '' && $(this).hasClass("MRC")) {
                    Infrastructure.push(parseFloat(val));
                }
                if ($(this).hasClass("Managed_" + j) && val !== '' && $(this).hasClass("MRC")) {
                    Managed.push(parseFloat(val));
                }
            } else if (type == "discountedTotal") {
                if ($(this).hasClass("Infrastructure_" + j) && val !== '' && $(this).hasClass("DiscountedMrc")) {
                    Infrastructure.push(parseFloat(val));
                }
                if ($(this).hasClass("Managed_" + j) && val !== '' && $(this).hasClass("DiscountedMrc")) {
                    Managed.push(parseFloat(val));
                }
            }
        })

        infraTotal = Infrastructure.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
        mngTotal = Managed.reduce((accumulator, currentValue) => accumulator + currentValue, 0);

        if (type == "discountedTotal") {
            $("#DiscInfra_" + j).html(INR(infraTotal));
            $("#DiscMng_" + j).html(INR(mngTotal));

            $("#DiscTotal_" + j).html(INR(
                parseFloat(infraTotal) +
                parseFloat(mngTotal)
            ))
            let otc_perc = "<?= getProdName("otc") ?>".replace(/otc|-/g, '');
            let period = parseFloat($("#MonthlyTotal_" + j).data("period"))
            $("#MonthlyDiscounted_" + j).html(INR(
                (parseFloat(infraTotal) +
                    parseFloat(mngTotal)) * period
            )).data("value", ((parseFloat(infraTotal) +parseFloat(mngTotal)) * period));
        } else if (type == "total") {
            $("#infraTotal_" + j).html(INR(infraTotal));
            $("#MngTotal_" + j).html(INR(mngTotal));

            $("#total_monthly_" + j).html(INR(
                parseFloat(infraTotal) +
                parseFloat(mngTotal)
            ))
            let otc_perc = "<?= getProdName("otc") ?>".replace(/otc|-/g, '');
            $("#final_otc_" + j + ",#otc_" + j).html(INR(
                ((parseFloat(infraTotal) +
                    parseFloat(mngTotal)) * 12) * parseFloat(otc_perc)
            ))
            let period = parseFloat($("#MonthlyTotal_" + j).data("period"))
            $("#MonthlyTotal_" + j).html(INR(
                (parseFloat(infraTotal) +
                    parseFloat(mngTotal)) * period
            ))
        }
    }
    let FirstFocused = true;
    $(".discount").on({
        "click": function() {
            if (FirstFocused) {
                $(this).text($(this).data("percentage"))
                FirstFocused = false;
            }
        },
        "focus": function() {
            if (FirstFocused) {
                $(this).text($(this).data("percentage"))
                FirstFocused = false;
            }
        },
        "blur": function() {
            let percentage = parseFloat($(this).data("percentage"));
            let newPerc = parseFloat($(this).html().replace(/ |%/g, ""));
            FirstFocused = true;
            if (newPerc > 99) {
                alert("Please Enter valid Percentage");
                $(this).html(percentage.toFixed(2) + " %")
            }
            if (!isNaN(newPerc)) {
                percentage = ((newPerc === percentage) ? parseFloat(percentage) : parseFloat(newPerc)) / 100;
                let Mrc = $(this).parent().find(".MRC").html().replace(/,|₹| /g, "")
                Mrc = parseFloat(Mrc)
                let discountedMrc = Mrc - (Mrc * percentage)
                if (discountedMrc <= 0 && percentage > 0) {
                    alert("Please Enter Valid Percentage")
                } else {
                    $(this).parent().find(".DiscountedMrc").html(INR(discountedMrc))
                }
                let j = $(this).data("key")
                totalInfra(j, "discountedTotal")
                let discountID = $(this).data("discid")
                DiscountedData[j]["Data"][discountID] = percentage * 100
                
                
                let DiscTotal = parseFloat($("#DiscTotal_" + j).html().replace(/₹|,| /g, ''))
                let total_monthly = parseFloat($("#total_monthly_" + j).html().replace(/₹|,| /g, ''))
                let TotalDiscountPercentage = 100 - (100 * (DiscTotal / total_monthly));
                DiscountedData[j]["percentage"] = TotalDiscountPercentage
                $("#DiscountPercetage_" + j).val(TotalDiscountPercentage.toFixed(2)).data("percentage", TotalDiscountPercentage)
                $(this).html(isNaN(newPerc.toFixed(2)) ? 0 : newPerc.toFixed(2) + " %").data("percentage", isNaN(newPerc.toFixed(2)) ? 0 : newPerc)

            } else {
                let Mrc = $(this).parent().find(".MRC").html().replace(/₹|,| /g, '')
                Mrc = parseFloat(Mrc)
                $(this).parent().find(".DiscountedMrc").html(INR(isNaN(Mrc) ? 0 : Mrc))
                let j = $(this).data("key")
                totalInfra(j, "discountedTotal")
                let discountID = $(this).data("discid")
                DiscountedData[j]["Data"][discountID] = Mrc
                
                let DiscTotal = parseFloat($("#DiscTotal_" + j).html().replace(/₹|,| /g, ''))
                let total_monthly = parseFloat($("#total_monthly_" + j).html().replace(/₹|,| /g, ''))
                let TotalDiscountPercentage = 100 - (100 * (DiscTotal / total_monthly));
                DiscountedData[j]["percentage"] = TotalDiscountPercentage
                $("#DiscountPercetage_" + j).val(TotalDiscountPercentage.toFixed(2)).data("percentage", TotalDiscountPercentage)
            }
        },
    })
</script>


<?php
if (!empty($_DiscountedData)) {
    echo "
    <script>
        let _Data = '{$data_query['discounted_data']}';
        let __DATA = JSON.parse(_Data);";
    foreach ($_DiscountedData as  $key => $arr) {
        echo "updateTotalHtml({'Obj':__DATA[" . $key . "]['Data'], 'j':" . $key . ", 'DATA': { discountVal : " . $_DiscountedData[$key]["percentage"] . "}});";
    }
    echo "
    </script>";
}

?>