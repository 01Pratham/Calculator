<?php

$Sku_Data = array();
require_once "../controller/calculations.php";
// print_r($_DiscountedData);
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
                        <input type="number" min=0 max=100 name="" class="form-control col-md-10 " id="DiscountPercetage_<?= $j ?>" disabled aria-describedby="perce_<?= $j ?>" value="<?= floatval($_DiscountedData[$j]["percentage"]) ?>">
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
                $compute[$j][$i] = "vCores {$cpu[$j][$i]} | RAM  {$ram[$j][$i]} GB | Disk - " . preg_replace("/[^a-zA-Z]| /", "", getProdName($diskType[$j][$i])) . " IOPS/GB -  {$disk[$j][$i]} GB";
                $price = (($product_prices['vcpu_static'] * intval($cpu[$j][$i])) +
                    ($product_prices['vram_static'] * intval($ram[$j][$i])) +
                    ($product_prices[$diskType[$j][$i]] * intval($disk[$j][$i])));

                $vCore[$j][$i] = $cpu[$j][$i];
                $vRam[$j][$i] = $ram[$j][$i];
                $vDisk[$j][$i] = $disk[$j][$i];

                $DISK[explode("_", $db[$j][$i])[0]][] = intval($disk[$j][$i]) * intval($vmqty[$j][$i]);
                $DISK[explode("_", $os[$j][$i])[0]][] = intval($disk[$j][$i]) * intval($vmqty[$j][$i]);
                $VMQTY[explode("_", $db[$j][$i])[0]][] = intval($vmqty[$j][$i]);
                $VMQTY[explode("_", $os[$j][$i])[0]][] = intval($vmqty[$j][$i]);

                array_push($vcore_data, $vCore[$j][$i]);
                if (!empty($av_type[$j][$i])) {
                    $av = true;
                } else {
                }
                $Service = !empty($vmname[$j][$i]) ? ($vmname[$j][$i]) : ('Virtual Machine') . ' - ' . $state[$j][$i];

                $ProdName = $compute[$j][$i] . ' | OS : ' . getProdName($os[$j][$i]) . ' | DB : ' . getProdName($db[$j][$i]);

                $DiscountingId = "VM{$i}_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow($Service, $ProdName, $vmqty[$j][$i], $price);

                $Infrastructure['VM' . $i] = GroupPrice()['VM' . $i];
                $Infrastructure['VM' . $i][$vmname[$j][$i]] = intval($vmqty[$j][$i]) * $price;
            }
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
            if (!empty($vmqty[$j])) {
                $os_data = (!empty($os[$j])) ? array_values(array_unique($os[$j])) : null;
                $db_data = (!empty($db[$j])) ? array_values(array_unique($db[$j])) : null;
                foreach ($vmqty[$j] as $i => $val) {

                    foreach ($osArr as $k => $int) {
                        if ($os_data[$i] == $int) {
                            $DiscountingId = "{$int}_{$j}";
                            $cal = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_os_calculation` WHERE `product_int` = '{$os_data[$i]}'"));
                            if (!empty($cal)) {
                                list($variableName, $value) = explode(' = ', $cal['calculation']);
                            } else {
                                $core_devide = '';
                            }
                            $$variableName = $value;
                            $totalDisc[$Class][$DiscountingId] = tblRow("Database", getProdName($os_data[$i]), get_os($os_data[$i], $core_devide), $product_prices[$int], " Lic.");
                        }
                    }
                }
                foreach ($vmqty[$j] as $i => $val) {
                    foreach ($dbArr as $k => $int) {
                        if ($db_data[$i] == $int) {
                            $core_devide = NULL;
                            $DiscountingId = "{$int}_{$j}";
                            $cal = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_os_calculation` WHERE `product_int` = '{$db_data[$i]}'"));
                            if (!empty($cal['calculation'])) {
                                list($variableName, $value) = explode(' = ', $cal['calculation']);
                                $$variableName = $value;
                            }
                            $totalDisc[$Class][$DiscountingId] = tblRow("Database", getProdName($db_data[$i]), get_DB($db_data[$i], $core_devide), $product_prices[$int], " Lic.");
                        }
                    }
                }
                $Sku_Data[$estmtname[$j]] = SkuList();
            }
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
                $DiscountingId = "backup_age_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Software", 'Backup Agent', array_sum($agentqty[$j]), $product_prices['veeam']);

                $Infrastructure['Software']['veeam'] = array_sum($agentqty[$j]) * $product_prices['veeam'];
                $Sku_Data[$estmtname[$j]]['Software'][$product_sku['veeam']] = [
                    "qty" => array_sum($agentqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(array_sum($agentqty[$j]), $product_prices['veeam']) : 0
                ];
            }
            if (isset($drm_tool[$j])) {
                $drm_tool_qty = (!empty($vmqty[$j])) ? array_sum($vmqty[$j]) : 0;
                $DiscountingId = "drm_tool_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Software", 'DRM Tool', $drm_tool_qty, $product_prices[$drm_type[$j]]);
                $Infrastructure['Software']['DRM Tool'] = $drm_tool_qty * $product_prices[$drm_type[$j]];
                $Sku_Data[$estmtname[$j]]['Software'][$product_sku[$drm_type[$j]]] = [
                    "qty" => $drm_tool_qty,
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($drm_tool_qty, $product_prices[$drm_type[$j]]) : 0
                ];
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
                    $DiscountingId = $int . "_" . $j;
                    $totalDisc[$Class][$DiscountingId] = tblRow(
                        "Additional Storage",

                        $strgName,

                        intval($EstmDATA[$int . "_qty"][$j]),

                        get_strg(
                            $EstmDATA[$int . "_unit"][$j],
                            $product_prices[$int]
                        ),

                        $EstmDATA[$int . "_unit"][$j]
                    );
                    $Infrastructure['Storage Solution'][$int] = get_strg($EstmDATA[$int . "_unit"][$j], $product_prices[$int]) * intval($EstmDATA[$int . "_qty"][$j]);
                    $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku[$int]] = [
                        "qty" => ($EstmDATA[$int . "_unit"][$j] == 'TB') ? intval(intval($EstmDATA[$int . "_qty"][$j])) * 1024 : intval(intval($EstmDATA[$int . "_qty"][$j])),
                        "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(intval($EstmDATA[$int . "_qty"][$j]), get_strg($EstmDATA[$int . "_unit"][$j], $product_prices[$int])) : 0
                    ];
                }
            }
            if (!empty($backupstrg[$j])) {

                $DiscountingId = "backup_gb_{$j}";
                $backupunit[$j] = $EstmDATA['backup_unit'] ?? "backup_gb";
                $totalDisc[$Class][$DiscountingId] = tblRow("Backup Storage", getProdName($backupunit[$j]), $backupstrg[$j], get_strg('GB', $product_prices[$backupunit[$j]]), "GB");
                $Infrastructure['Storage Solution']['Backup Space'] = get_strg('GB', $product_prices[$backupunit[$j]]) * $backupstrg[$j];
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['backup_gb']] = [
                    "qty" => ($backupunit[$j] == 'TB') ? intval($backupstrg[$j]) * 1024 : intval($backupstrg[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($backupstrg[$j], get_strg('GB', $product_prices[$backupunit[$j]])) : 0
                ];
            }
            if (!empty($arc_strg[$j])) {
                $DiscountingId = "arc_strg_gb_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Archival Storage", 'Archival Space', $arc_strg[$j], get_strg($archival_unit[$j], $product_prices['arc_strg']), $archival_unit[$j]);
                $Infrastructure['Storage Solution']['Archival Space'] = get_strg($archival_unit[$j], $product_prices['arc_strg'], $arc_strg[$j]);
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['arc_strg']] = [
                    "qty" => ($archival_unit[$j] == 'TB') ? intval($arc_strg[$j]) * 1024 : intval($arc_strg[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($arc_strg[$j], get_strg($archival_unit[$j], $product_prices['arc_strg'])) : 0
                ];
            }
            if (isset($tape_lib[$j])) {
                $DiscountingId = "tl_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Offline Backup', 'Offline Backup Solution Tape Library', $tlqty[$j], $product_prices['tl']);
                $Infrastructure['Storage Solution']['Offline Backup Solution Tape Library'] = intval($tlqty[$j]) * $product_prices['tl'];
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['tl']] = [
                    "qty" => $tlqty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($tlqty[$j], $product_prices['tl']) : 0
                ];
            }

            if (isset($tape_cart[$j])) {
                $DiscountingId = "tc_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Offline Backup', 'Offline Backup Solution Tape Cartridge', $tcqty[$j], $product_prices['tc']);
                $Infrastructure['Storage Solution']['Offline Backup Solution Tape Cartridge'] = intval($tcqty[$j]) * $product_prices['tc'];
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['tc']] = [
                    "qty" => $tcqty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($tcqty[$j], $product_prices['tc']) : 0
                ];
            }

            if (isset($fire_cab[$j])) {
                $DiscountingId = "fc_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Offline Backup', 'Offline Backup Solution Fireproof cabinate', $fcqty[$j], $product_prices['fc']);
                $Infrastructure['Storage Solution']['Offline Backup Solution Fireproof cabinate'] = intval($fcqty[$j]) * $product_prices['fc'];
                $Sku_Data[$estmtname[$j]]['Storage Solution'][$product_sku['fc']] = [
                    "qty" => $fcqty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($fcqty[$j], $product_prices['fc']) : 0
                ];
            }
        }
        if (isset($rack[$j]) || isset($rated[$j]) || isset($metered[$j]) || isset($cage[$j]) || isset($bio[$j]) || isset($pdu[$j]) || isset($cctv[$j])) {
            $c = 'A.' . $no = $no + 1;
            $c .= ' +';
            tblHead("Colocation Services");
            if (isset($rack[$j])) {
                $DiscountingId = "rack_space_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Rack Space', $rackqty[$j], $product_prices['rack_space'], "U");
                $Infrastructure['Colocation']['Rack Space'] = ($rackqty[$j] * $product_prices['rack_space']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['rack_space']] = [
                    "qty" => ($rackqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(($rackqty[$j]), $product_prices['rack_space']) : 0
                ];
            }
            if (isset($metered[$j])) {
                $DiscountingId = "metered_power_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Metered Power', $meteredqty[$j], $product_prices['metered_power'], "Power Unit");
                $Infrastructure['Colocation']['metered_power'] = ($meteredqty[$j] * $product_prices['metered_power']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['metered_power']] = [
                    "qty" => ($meteredqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(($meteredqty[$j]), $product_prices['metered_power']) : 0
                ];
            }
            if (isset($rated[$j])) {
                $DiscountingId = "rated_power_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Rated Power', $ratedqty[$j], $product_prices['rated_power'], "Power Unit");
                $Infrastructure['Colocation']['rated_power'] = ($ratedqty[$j] * $product_prices['rated_power']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['rated_power']] = [
                    "qty" => ($ratedqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(($ratedqty[$j]), $product_prices['rated_power']) : 0
                ];
            }

            if (isset($cage[$j])) {
                $DiscountingId = "cage_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Cage For RACK', $cageqty[$j], $product_prices['cage']);
                $Infrastructure['Colocation']['cage'] = ($cageqty[$j] * $product_prices['cage']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['cage']] = [
                    "qty" => ($cageqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(($cageqty[$j]), $product_prices['cage']) : 0
                ];
            }
            if (isset($bio[$j])) {
                $DiscountingId = "bio_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Bio-matrix for Cage', $bioqty[$j], $product_prices['bio']);
                $Infrastructure['Colocation']['bio'] = ($bioqty[$j] * $product_prices['bio']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['bio']] = [
                    "qty" => ($bioqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(($bioqty[$j]), $product_prices['bio']) : 0
                ];
            }
            if (isset($pdu[$j])) {
                $DiscountingId = "pdu_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'PDU Meter', $pduqty[$j], $product_prices['pdu']);
                $Infrastructure['Colocation']['pdu'] = ($pduqty[$j] * $product_prices['pdu']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['pdu']] = [
                    "qty" => ($pduqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(($pduqty[$j]), $product_prices['pdu']) : 0
                ];
            }

            if (isset($cctv[$j])) {
                $DiscountingId = "cctv_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'CCTV Camera fo Rack', $cctvqty[$j], $product_prices['cctv']);
                $Infrastructure['Colocation']['cctv'] = ($cctvqty[$j] * $product_prices['cctv']);
                $Sku_Data[$estmtname[$j]]['Colocation'][$product_sku['cctv']] = [
                    "qty" => ($cctvqty[$j]),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(($cctvqty[$j]), $product_prices['cctv']) : 0
                ];
            }
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
                    $DiscountingId = "{$vers}_{$j}";
                    $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Public IP Address : ' . strtoupper($vers), array_sum($qty), $product_prices[$vers]);
                    $Infrastructure['Network Solution'][$vers] = array_sum($qty) * $product_prices[$vers];
                    $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku[$vers]] = [
                        "qty" => array_sum($qty),
                        "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(array_sum($qty), $product_prices[$vers]) : 0
                    ];
                }
            }
            if (!empty($bandwidth[$j])) {
                $bandInt = ($bandwidthType[$j] == 'Speed Based Internet Bandwidth') ? 'speed_band' : 'volume_band';
                $bandUnit = ($bandwidthType[$j] == 'Speed Based Internet Bandwidth') ? ' Mbps' : ' GB';
                $DiscountingId = "{$bandInt}_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', $bandwidthType[$j], $bandwidth[$j], $product_prices[$bandInt], $bandUnit);
                $Infrastructure['Network Solution']['bandwidth'] = intval($product_prices[$bandInt]) * intval($bandwidth[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku[$bandInt]] = [
                    "qty" => $bandwidth[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($bandwidth[$j], $product_prices[$bandInt]) : 0
                ];
            }
            if (!empty($ccptqty[$j])) {
                $DiscountingId = "cross_connect_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', "Cross Connect and Port Termination", $ccptqty[$j], $product_prices['cross_connect']);
                $Infrastructure['Network Solution']['cross_connect'] = intval($product_prices['cross_connect']) * intval($ccptqty[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['cross_connect']] = [
                    "qty" => $ccptqty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($ccptqty[$j], $product_prices["cross_connect"]) : 0
                ];
            }

            if (isset($rep_link[$j])) {
                $DiscountingId = "{$rep_link_type[$j]}_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', getProdName($rep_link_type[$j]) . ' Replication Link', $rep_link_qty[$j], get_Price($rep_link_type[$j]), "Mbps");
                $Infrastructure['Network Solution']['rep_link'] = intval($rep_link_qty[$j]) * get_Price($rep_link_type[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution']['CNPP000000000000'] = [
                    "qty" => $rep_link_qty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($rep_link_qty[$j], get_Price($rep_link_type[$j])) : 0
                ];
            }

            if (!empty($ipsec[$j])) {
                $DiscountingId = "ipsec_vpn_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Virtual Private Network (VPN) : IPSEC', $ipsecqty[$j], $product_prices['ipsec_vpn']);
                $Infrastructure['Network Solution']['ipsec_vpn'] = intval($ipsecqty[$j]) * $product_prices['ipsec_vpn'];
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ipsec_vpn']] = [
                    "qty" => $ipsecqty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($ipsecqty[$j], $product_prices['ipsec_vpn']) : 0
                ];
            }

            if (!empty($sslvpn[$j])) {
                $DiscountingId = "ssl_vpn_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Virtual Private Network (VPN) : SSL', $sslvpnqty[$j], $product_prices['ssl_vpn']);
                $Infrastructure['Network Solution']['sslvpn'] = intval($sslvpnqty[$j]) * $product_prices['ssl_vpn'];
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku['ssl_vpn']] = [
                    "qty" => $sslvpnqty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($sslvpnqty[$j], $product_prices['ssl_vpn']) : 0
                ];
            }

            if (!empty($lb[$j])) {
                $DiscountingId = "{$lb[$j]}_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', 'Load Balancer', $lbqty[$j], get_Price($lb[$j]));
                $Infrastructure['Network Solution']['lb'] = get_Price($lb[$j]) * intval($lbqty[$j]);
                $Sku_Data[$estmtname[$j]]['Network Solution'][$product_sku[$lb[$j]]] = [
                    "qty" => $lbqty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($lbqty[$j], get_Price($lb[$j])) : 0
                ];
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
                // $avPrice = (preg_match('/HIPS/', $newAV)) ? 1200 : 300;
                $DiscountingId = "av_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow('Services', getProdName($newAV), array_sum($av_count), $product_prices[$newAV]);
                $Infrastructure['Security Solution']['av'] = $product_prices[$newAV] * array_sum($av_count);
                $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku[$newAV]] = [
                    "qty" => array_sum($av_count),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(array_sum($av_count), $product_prices[$newAV]) : 0
                ];
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
                    $DiscountingId = $cat . "_" . $j;
                    $totalDisc[$Class][$DiscountingId] = tblRow(
                        "Services",

                        $secArr[$cat][($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j]],

                        intval($EstmDATA[$cat . "_qty"][$j]),

                        $product_prices[($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j]]
                    );

                    // echo $cat ." => " . $prod[($EstmDATA[$cat."_select"][$j] == '')?$cat:$EstmDATA[$cat."_select"][$j]]."<br>";

                    $Infrastructure['Security Solution'][$cat] = $product_prices[($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j]] * intval($EstmDATA[$cat . "_qty"][$j]);
                    $Sku_Data[$estmtname[$j]]['Security Solution'][$product_sku[($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j]]] = [
                        "qty" => $EstmDATA[$cat . "_qty"][$j],
                        "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(intval($EstmDATA[$cat . "_qty"][$j]), $product_prices[($EstmDATA[$cat . "_select"][$j] == '') ? $cat : $EstmDATA[$cat . "_select"][$j]]) : 0
                    ];


                    if (preg_match("/fw/", $cat)) {
                        if (isset($EstmDATA[$cat . "_check"])) {
                            $totalFirewalls[$cat] =   $EstmDATA[$cat . "_qty"][$j];
                        }
                    }
                }
            }
        }

        // print_r($EstmDATA);        

        if (isset($osmgmt[$j]) || isset($dbmgmt[$j]) || isset($strgmgmt[$j]) || isset($backup_mgmt[$j]) || isset($lbmgmt[$j]) || isset($fvmgmt[$j]) || isset($wafmgmt[$j]) || !empty($bandwidth[$j]) || isset($EstmDATA['emagic'][$j]) || isset($EstmDATA["otc"][$j])) {
            $f = 'A.' . $no = $no + 1;
            tblHead("Managed Services");
            $DiscountingId = "OTC";
            // tblRow('Services', 'One Time Infrastructure Setup', '', '', "", 1);
            if (isset($EstmDATA["otc"][$j])) {
        ?>
                <tr>
                    <td><?php echo "Service"; ?></td>
                    <td class='final'><?php echo 'One Time Infrastructure Setup' ?></td>
                    <td class='qty'></td>
                    <td class='cost unshareable'></td>
                    <td class="MRC mrc_<?= $j ?> unshareable"></td>
                    <td class='discount unshareable' id='disc'></td>
                    <td class='DiscountedMrc unshareable'></td>
                    <td class='unshareable' id="otc_<?= $j ?>"></td>
                </tr>


        <?php
            }
            $Class = "Managed_{$j}";

            $replication_mgmt = isset($rep_link_mgmt[$j]) ? (!empty($vmqty[$j]) ? array_sum($vmqty[$j]) : 0) : 0;

            $OS_MGMT = [];
            if (isset($osmgmt[$j]) && !empty($os[$j])) {
                foreach ($os[$j] as $i => $val) {
                    foreach ($osArr as $k => $int) {
                        if ($os[$j][$i] == $int) {
                            $str = explode("_", $os[$j][$i]);
                            $product_name = getProdName($str[0] . "_mgmt");

                            $DISK_SUM = array_sum($DISK[$str[0]]);
                            $VMQTY_SUM = array_sum($VMQTY[$str[0]]);
                            $os_mgmt_qty = ($DISK_SUM * $VMQTY_SUM) <= (100 * $VMQTY_SUM) ? ($DISK_SUM * $VMQTY_SUM) : 1;
                            $REM = $DISK_SUM - 100;
                            $upto100 = $upto50 = 0;

                            if (($DISK_SUM * $VMQTY_SUM) > (100 * $VMQTY_SUM)) {
                                $upto100 = floor($REM / 100);
                                $upto50 = floor(($REM - ($upto100 * 100)) / 50);
                            }

                            $os_mgmt_unit_cost = [
                                "base" => 5500,
                                "upto100" => $upto100 > 0 ? 1100 : 0,
                                "upto50" => $upto50 > 0 ? 550 : 0,
                            ];

                            $os_mgmt_mrc = [
                                "base" => 5500 * 1,
                                "upto100" => $upto100 > 0 ? 1100 * $upto100 : 0,
                                "upto50" => $upto50 > 0 ? 550 * $upto50 : 0,
                            ];

                            $OS_MGMT[$str[0] . "_mgmt"] = [
                                "product_name" => $product_name,
                                "qty" => $os_mgmt_qty,
                                "per_unit" => $os_mgmt_unit_cost,
                                "mrc" => $os_mgmt_mrc,
                            ];
                        }
                    }
                }
            }

            $DB_MGMT = [];
            if (isset($dbmgmt[$j]) && !empty($db[$j])) {
                foreach ($db[$j] as $i => $val) {
                    foreach ($dbArr as $k => $int) {
                        if ($db[$j][$i] == $int) {
                            $str = explode("_", $db[$j][$i]);
                            $product_name = getProdName($str[0] . "_db_mgmt");

                            $DISK_SUM = array_sum($DISK[$str[0]]);
                            $db_mgmt_qty = ($DISK_SUM * $VMQTY_SUM) <= (100 * $VMQTY_SUM) ? ($DISK_SUM * $VMQTY_SUM) : 1;
                            $REM = $DISK_SUM - 100;
                            $upto100 = $upto50 = 0;

                            if (($DISK_SUM * $VMQTY_SUM) > (100 * $VMQTY_SUM)) {
                                $upto100 = floor($REM / 100);
                                $upto50 = floor(($REM - ($upto100 * 100)) / 50);
                            }

                            $db_mgmt_unit_cost = [
                                "base" => 5500,
                                "upto100" => $upto100 > 0 ? 1100 : 0,
                                "upto50" => $upto50 > 0 ? 550 : 0,
                            ];

                            $db_mgmt_mrc = [
                                "base" => 5500 * 1,
                                "upto100" => $upto100 > 0 ? 1100 * $upto100 : 0,
                                "upto50" => $upto50 > 0 ? 550 * $upto50 : 0,
                            ];

                            $DB_MGMT[$str[0] . "_db_mgmt"] = [
                                "product_name" => $product_name,
                                "qty" => $db_mgmt_qty,
                                "per_unit" => $db_mgmt_unit_cost,
                                "mrc" => $db_mgmt_mrc,
                            ];
                        }
                    }
                }
            }

            $strgmgmtqty = [];
            if (isset($strgmgmt[$j])) {
                foreach ($strgArr as $int => $strgName) {
                    if (isset($EstmDATA[$int])) {
                        $qty = $EstmDATA[$int . "_unit"][$j] == "GB" ? floatval($EstmDATA[$int . "_qty"][$j]) : floatval($EstmDATA[$int . "_qty"][$j]) * 1024;
                        array_push($strgmgmtqty, $qty);
                    }
                }
            }

            $backmgmtqty = isset($backup_mgmt[$j]) && !empty($backupstrg[$j]) ? (!empty($vmqty[$j]) ? array_sum($vmqty[$j]) : 0) : 0;

            $lbmgmtqty = isset($lbmgmt[$j]) && !empty($lbqty[$j]) ? $lbqty[$j] : 0;

            $fvmgmtqty = isset($fvmgmt[$j]) ? (!empty($totalFirewalls) ? array_sum($totalFirewalls) : 0) : 0;

            $wafmgmtqty = isset($wafmgmt[$j]) && !empty($EstmDATA["waf_qty"][$j]) ? $EstmDATA["waf_qty"][$j] : 0;

            $bandwidth_monitoring = !empty($bandwidth[$j]) ? 1 : 0;

            $emagicqty = isset($EstmDATA['emagic'][$j]) ? [intval($lbmgmtqty), intval($fvmgmtqty), intval($wafmgmtqty), (!empty($vmqty[$j]) ? array_sum($vmqty[$j]) : 0), intval($ccptqty[$j]), $bandwidth_monitoring] : [];

            $managed_services = array(
                'st_mg' => floor(array_sum($strgmgmtqty) / 1000) * $product_prices['strg_mgmt'],
                'back_mg' => intval($backmgmtqty) * intval  ($product_prices['backup_mgmt']),
                'rep_mgmt' => $replication_mgmt * $product_prices['rep_mgmt'],
                'dr_drill' => intval($drill_qty[$j]) * $product_prices['dr_drill'],
                'lb_mgmt' => intval($lbmgmtqty) * intval($product_prices['virt_lb_mgmt']),
                'fw_mgmt' => (isset($EstmDATA["utm_check"][$j])) ?
                    $product_prices['utm_mgmt'] * intval($fvmgmtqty) :
                    $product_prices['vfirewall_mgmt'] * intval($fvmgmtqty),
                'waf_mgmt' => intval($wafmgmtqty) * intval($product_prices['esds_waf_mgmt']),
                'emagic' => (isset($EstmDATA['emagic'][$j])) ? array_sum($emagicqty) * intval($product_prices['emagic']) : 0
            );
            if (!empty($OS_MGMT)) {
                foreach ($OS_MGMT as $prod_int => $arr) {
                    $DiscountingId = $prod_int . "_{$j}";
                    $totalDisc[$Class][$DiscountingId] = tblRow("Services", $arr["product_name"], $arr["qty"], $arr["per_unit"], "NO", $arr["mrc"]);
                    $managed_services[$prod_int] = $arr["mrc"];
                    $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku[$prod_int]] = [
                        "qty" => $arr["qty"],
                        "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($arr["qty"], $product_prices[$prod_int]) : 0
                    ];
                }
            }
            if (!empty($DB_MGMT)) {
                foreach ($DB_MGMT as $prod_int => $arr) {
                    $DiscountingId = $prod_int . "_{$j}";
                    $totalDisc[$Class][$DiscountingId] = tblRow("Services", $arr["product_name"], $arr["qty"], $arr["per_unit"], "NO", $arr["mrc"]);
                    $managed_services[$prod_int] = $arr["mrc"];
                    $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku[$prod_int]] = [
                        "qty" => $arr["qty"],
                        "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($arr["qty"], $product_prices[$prod_int]) : 0
                    ];
                }
            }
            if (isset($strgmgmt[$j])) {
                $DiscountingId = "strg_mgmt_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Service", "Storage Management Per TB", intval(array_sum($strgmgmtqty) / 1000), $product_prices['strg_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['strg_mgmt']] = [
                    "qty" =>  intval(array_sum($strgmgmtqty) / 1000),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(intval(array_sum($strgmgmtqty) / 1000), $product_prices['strg_mgmt']) : 0
                ];
            }
            if (isset($backup_mgmt[$j])) {
                $DiscountingId = "backup_mgmt_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Service", 'Backup Management - per Instance', $backmgmtqty, $product_prices['backup_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['backup_mgmt']] = [
                    "qty" => $backmgmtqty,
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($backmgmtqty, $product_prices['backup_mgmt']) : 0
                ];
            }
            if (isset($rep_link_mgmt[$j])) {
                $DiscountingId = "rep_mgmt_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Service", 'Replication Service Management', $replication_mgmt, $product_prices['rep_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['rep_mgmt']] = [
                    "qty" => $replication_mgmt,
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($replication_mgmt, $product_prices['rep_mgmt']) : 0
                ];
            }

            if (isset($dr_drill[$j])) {
                $DiscountingId = "dr_drill_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Service", 'DR Drill Per Year', $drill_qty[$j], $product_prices['dr_drill']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['dr_drill']] = [
                    "qty" => $drill_qty[$j],
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($drill_qty[$j], $product_prices['dr_drill']) : 0
                ];
            }

            if (isset($lbmgmt[$j])) {
                $DiscountingId = "lb_mg_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Service", 'Load Balancer Management', $lbmgmtqty, $product_prices['virt_lb_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['virt_lb_mgmt']] = [
                    "qty" => $lbmgmtqty,
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($lbmgmtqty, $product_prices['virt_lb_mgmt']) : 0
                ];
            }
            if (isset($fvmgmt[$j])) {
                $INT = (isset($utm[$j])) ? 'utm_mgmt' : 'vfirewall_mgmt';
                $DiscountingId = "{$INT}_{$j}";
                $name = (isset($EstmDATA["utm_check"][$j]) ? 'vUTM ' : '') . "Firewall Management";
                $price = (isset($EstmDATA["utm_check"][$j])) ? ($product_prices[$INT]) : ($product_prices[$INT]);
                // echo $product_prices['fv_mg'];
                $totalDisc[$Class][$DiscountingId] = tblRow("Service", $name, $fvmgmtqty, $price);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['vfirewall_mgmt']] = [
                    "qty" => $fvmgmtqty,
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($fvmgmtqty, $price) : 0
                ];
            }
            if (isset($wafmgmt[$j])) {
                $DiscountingId = "waf_mg_{$j}";
                //  print_r($product_prices);
                $totalDisc[$Class][$DiscountingId] = tblRow("Service", "Web Application Firewall Management", $wafmgmtqty, $product_prices['esds_waf_mgmt']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['esds_waf_mgmt']] = [
                    "qty" => $wafmgmtqty,
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage($wafmgmtqty, $product_prices['esds_waf_mgmt']) : 0
                ];
            }

            if (isset($EstmDATA['emagic'][$j])) {
                $info = "<i class='fa fa-info-circle  float-right' title='
Load Balancer - $emagicqty[0]
Internal & External Firewall - $emagicqty[1]
Web App Firewall - $emagicqty[2]
VM Quantity - $emagicqty[3]
Cross Connect & Port Termination - $emagicqty[4] 
Bandwidth Monitoring - $emagicqty[5] '></i>";
                $name = 'eMagic Monitoring ' . $emagic_type[$j];
                $DiscountingId = "emagic_{$j}";
                $totalDisc[$Class][$DiscountingId] = tblRow("Services", $name, array_sum($emagicqty), $product_prices['emagic']);
                $Sku_Data[$estmtname[$j]]['Managed Services'][$product_sku['emagic']] = [
                    "qty" => array_sum($emagicqty),
                    "discount" => (!empty($_DiscountedData)) ? GetDiscountedPercentage(array_sum($emagicqty), $product_prices['emagic']) : 0
                ];
            }
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

        $total[$j] = array(($newInfra != null) ? array_sum($newInfra) : 0, ($managed_services != null) ? array_sum($managed_services) : 0);

        $period = $EstmDATA['period'];
        if (empty($period[$j])) {
            $period[$j] = 1;
        }

        $push_total[$j]['infra'] = $newInfra;
        $push_total[$j]['service'] = $managed_services;

        ?>
        <tr>
            <th class='except unshareable' style='background: rgba(212,212,212,1); '> Sr No . </th>
            <th class=' final colspan except unshareable' colspan='3' style='background: rgba(212,212,212,1); '> Description </th>
            <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>MRC</th>
            <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>Discounted MRC</th>
        </tr>
        <?php
        $m = 0;
        if ($newInfra != null) {
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
                <td class='colspan unshareable ' colspan='2'><?php INR(($newInfra != null) ? array_sum($newInfra) : 0);
                                                                ?></td>
                <td class='colspan unshareable ' colspan='2'><?php if (!empty($_DiscountedData)) {
                                                                    INR(array_sum($totalDisc["Infrastructure_{$j}"]));
                                                                }
                                                                ?></td>
            </tr>
        <?php }
        if ($managed_services != null) {
        ?>
            <tr>
                <td class='unshareable'>
                    <?= $m = $m + 1 ?>
                </td>
                <td class='colspan final unshareable' colspan='3'> Managed Services [ <?= $f ?> ] </td>
                <td class='colspan unshareable' colspan='2'><?php INR(($managed_services != null) ? array_sum($managed_services) : 0);
                                                            ?></td>
                <td class='colspan unshareable' colspan='2'><?php if (!empty($_DiscountedData)) {
                                                                INR(array_sum($totalDisc["Managed_{$j}"]));
                                                            }
                                                            ?></td>
            </tr>

        <?php
        }
        if (isset($EstmDATA["otc"][$j])) {
        ?>
            <tr>
                <td class='unshareable'>
                    <?= $m = $m + 1 ?>
                </td>
                <td class='colspan final unshareable' colspan='3'> One Time Cost </td>
                <td class='colspan unshareable' colspan='2'>
                    <?= INR((array_sum($total[$j]) * 12) * 0.05); ?>
                </td>
                <td class='colspan unshareable' colspan='2'>
                    <?= INR((array_sum($total[$j]) * 12) * 0.05); ?>
                </td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <th class=' final unshareable' style='background-color: rgb(255, 207, 203);'> </th>
            <th class=' final colspan except unshareable' colspan='3' style='background-color: rgb(255, 207, 203);'> Total [ Monthly ]</th>
            <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly'><?php INR(array_sum($total[$j]));
                                                                                                                                    $MothlyTotal[$j] = array_sum($total[$j]); ?></th>
            <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly'><?php if (!empty($_DiscountedData)) {
                                                                                                                                        INR(array_sum($totalDisc["Infrastructure_{$j}"]) + array_sum($totalDisc["Managed_{$j}"]));
                                                                                                                                    }  ?></th>
        </tr>
        <tr>
            <th class=' final unshareable' style='background-color: rgb(255, 226, 182);'> </th>
            <th class=' final colspan except unshareable' colspan='3' style='background-color: rgb(255, 226, 182);'> Total [ For <?= $period[$j] ?> Months ]</th>
            <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);'><?php INR(array_sum($total[$j]) * intval($period[$j]));
                                                                                                                array_push($ProjectTotal, array_sum($total[$j]) * intval($period[$j]));
                                                                                                                ?></th>
            <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);'><?php if (!empty($_DiscountedData)) {
                                                                                                                    INR((array_sum($totalDisc["Infrastructure_{$j}"]) + array_sum($totalDisc["Managed_{$j}"])) * $period[$j]);
                                                                                                                } ?></th>
        </tr>
    </table>
<?php
    $I_M[$j] = $Infrastructure;
    $I_M[$j]['Managed Services'] = $managed_services;

    $I_M[$j]['MonthlyTotal'] = $MothlyTotal[$j];
}

function tblRow($Service, $Product, $Quantity, $Price, $Unit = "NO", $MRC = "")
{

    global $j, $DiscountingId, $_DiscountedData;
    // echo gettype($OTC);
    if (empty($MRC)) {
        $MRC = floatval($Price) * floatval($Quantity);
    }
?>
    <tr>
        <td><?php echo $Service; ?></td>
        <td class='final'><?php echo $Product; ?></td>
        <td class='qty'><?php echo $Quantity . " " . $Unit; ?></td>
        <td class='cost unshareable'><?php INR(floatval($Price)); ?></td>
        <td class="mrc_<?= $j ?> unshareable"><?php INR($MRC); ?></td>
        <?php
        if (!empty($_DiscountedData[$j]["Data"][$DiscountingId])) {
            if (is_array($_DiscountedData[$j]["Data"][$DiscountingId])) {
                $percentage =  array_sum($_DiscountedData[$j]["Data"][$DiscountingId]) / count($_DiscountedData[$j]["Data"][$DiscountingId]);
            } else {
                $percentage = ($_DiscountedData[$j]["Data"][$DiscountingId]);
            }
        }
        ?>
        <td class='discount unshareable' id='disc'><?= round($percentage, 2) ?> %</td>
        <?php
        if (!empty($_DiscountedData[$j]["Data"][$DiscountingId])) {
            $DiscMRC = ($MRC - ($MRC * ($percentage / 100)));
        } else {
            $DiscMRC = ($MRC);
        }
        ?>
        <td class='discountPrice unshareable' id='discPrice'><?= INR($DiscMRC) ?></td>
        <td class='unshareable' id='otc'><?php (!empty($OTC)) ? INR($OTC) : '' ?></td>
    </tr>
<?php
    return $DiscMRC;
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
        <th class='Head unshareable except' id='discMrc-head'>Discounted Price</th>
        <th class='Head unshareable except' id='otc'>OTC</th>
    </tr>
<?php
}
?>