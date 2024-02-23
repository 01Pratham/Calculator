<?php
error_reporting(E_ERROR | E_PARSE);
// echo 'hi';
session_start();
$EstmDATA = $_SESSION['post_data'];
// if (isset($EstmDATA['proceed'])) {

    // $form1 = $EstmDATA['form1'];
    $estmtname = $EstmDATA['estmtname'];
    $i = 1;
    $t=false;
    foreach ($estmtname as $K => $V){
        foreach ($estmtname as $k => $v){
            if($V == $v && $K != $k){
                $estmtname[$k] = $v." - ".$i;
                $t = true;
            }
        }    
        if($t){
            $i++;
        }
    }
    $instance = $EstmDATA['instance'];

    $cpu = $EstmDATA['vcpu'];
    $ram = $EstmDATA['ram'];
    $disk = $EstmDATA['inst_disk'];
    $diskType = $EstmDATA['vmDiskIOPS'];

    $vmname = $EstmDATA['vmname'];
    $back_soft = $EstmDATA['backup_soft'];

    $vmqty = $EstmDATA['vmqty'];
    $region =  $EstmDATA['region'];
    $sector = $EstmDATA['sector'];
    $os = $EstmDATA['os'];
    $db = $EstmDATA['database'];
    $series = $EstmDATA['series'];
    $ip_public = $EstmDATA['ip_public'];
    $publicip_vers = $EstmDATA["ip_public_type"];
    $ip_private = $EstmDATA['ipprivate'];
    $privateip_vers = $EstmDATA["privateipversion"];
    $state = $EstmDATA["state"];
    $av_type = $EstmDATA["virus_type"];
    


    // $strgunit03 = $EstmDATA['03strgunit'];
    // $strgunit1 = $EstmDATA['1strgunit'];
    // $strgunit3 = $EstmDATA['3strgunit'];
    // $strgunit5 = $EstmDATA['5strgunit'];
    // $strgunit8 = $EstmDATA['8strgunit'];
    // $strgunit10 = $EstmDATA['10strgunit'];
    $drm_type = $EstmDATA['drm_type'];
    $agenttype = $EstmDATA['age_qty_type'];
    $backupstrg = $EstmDATA['backup_strg'];
    // $backupunit = $EstmDATA['backup_unit'];
    $tape_lib = $EstmDATA['tape_lib'];

    $tape_cart = $EstmDATA['tape_cart'];

    $fire_cab = $EstmDATA['fire_cab'];

    $bandwidth = $EstmDATA['bandwidth'];
    $bandwidthType = $EstmDATA['bandwidthType'];

    // $vpn = $EstmDATA['vpn'];
    $ipsec = $EstmDATA['ipsec'];
    $ipsecqty = $EstmDATA['ipsecqty'];
    $sslvpn = $EstmDATA['sslvpn'];
    $sslvpnqty = $EstmDATA['sslvpnqty'];

    $lb = $EstmDATA['load_balancer'];

    $ccptqty = $EstmDATA['ccptqty'];
    
    // $utm = $EstmDATA['utm'];
    
    // $ext_firewall = $EstmDATA['extfirewall'];
    // $efv_throughput = $EstmDATA['efv_throughput'];

    // $int_fv = $EstmDATA['intfirewall'];
    // $ifv_throughput = $EstmDATA['ifv_throughput'];

    // $ddos = $EstmDATA['ddos'];
    // $ddos_throughput = $EstmDATA['ddos_throughput'];

    // $waf = $EstmDATA['waf'];
    // $waf_name = $EstmDATA['waf_type'];

    // $tfa = $EstmDATA['tfa'];
    $arc_strg = $EstmDATA["arc_strg"];
    $archival_unit = $EstmDATA["archival_unit"];

    // $ssl = $EstmDATA['ssl'];
    // $sslcert = $EstmDATA['ssl-check'];

    // $hsmtype = $EstmDATA['hsm_type'];

    // $siem = $EstmDATA['siem'];
    // $siem_name = $EstmDATA['siem_name'];

    // $pim = $EstmDATA['pim'];

    // $vtm = $EstmDATA['vtm'];

    // $vapt = $EstmDATA['vapt'];
    // $vapt_type = $EstmDATA['vapt_type'];
    // $vapt_frequency = $EstmDATA['vapt_frequency'];

    // $dlp = $EstmDATA['dlp'];
    // $dlpqty = $EstmDATA['dlpqty'];

    // $edr = $EstmDATA['edr'];
    // $edrqty = $EstmDATA['edrqty'];

    // $dam = $EstmDATA['dam'];
    // $damqty = $EstmDATA['damqty'];

    // $sor = $EstmDATA['sor'];
    // $sorqty = $EstmDATA['sorqty'];

    // $hsm = $EstmDATA['hsm'];

    // $iam = $EstmDATA['iam'];


    $osmgmt = $EstmDATA['osmgmt'];
    $backup_mgmt = $EstmDATA['backmgmt'];
    $dbmgmt = $EstmDATA['dbmgmt'];
    $strgmgmt = $EstmDATA['strgmgmt'];
    $lbmgmt = $EstmDATA['lb_mgmt'];
    $fvmgmt = $EstmDATA['fv_mgmt'];
    $wafmgmt = $EstmDATA['wafmgmt'];


    $drm_tool = $EstmDATA['drm'];
    $dr_drill = $EstmDATA['dr_drill'];
    $drill_qty = $EstmDATA['drillqty'];
    $rep_link = $EstmDATA['rep_link'];
    $rep_link_type = $EstmDATA['rep_link_type'];
    $rep_link_qty = $EstmDATA['rep_link_qty'];
    $rep_link_mgmt = $EstmDATA['rep_link_mgmt'];


    $publicip_qty = $EstmDATA["ip_public"];
    $privateip_qty = $EstmDATA["private_ipqty"];
    $iops03qty = $EstmDATA['03iopsqty'];
    $iops1qty = $EstmDATA['1iopsqty'];
    $iops3qty = $EstmDATA['3iopsqty'];
    $iops5qty = $EstmDATA['5iopsqty'];
    $iops8qty = $EstmDATA['8iopsqty'];

    $iops10qty = $EstmDATA['10iopsqty'];

    $tlqty = $EstmDATA['tlqty'];

    $tcqty = $EstmDATA['tcqty'];
    $fcqty = $EstmDATA['fcqty'];

    $vpnqty = $EstmDATA['vpnqty'];

    $lbqty = $EstmDATA['lbqty'];
    $extfvqty = $EstmDATA['extfvqty'];
    $intfvqty = $EstmDATA['intfvqty'];
    $ddosqty = $EstmDATA['ddosqty'];
    $wafqty = $EstmDATA['wafqty'];
    $tfaqty = $EstmDATA['tfaqty'];
    $sslqty = $EstmDATA['sslqty'];
    $pimqty = $EstmDATA['pimqty'];
    $vtmqty = $EstmDATA['vtmqty'];
    $vaptqty = $EstmDATA['vaptqty'];
    $hsmqty = $EstmDATA['hsmqty'];
    $iamqty = $EstmDATA['iamqty'];
    $period = $EstmDATA['period'];

    $emagic_type = $EstmDATA['emagic_type'];

    $rack = $EstmDATA['rack'];    $rackqty = $EstmDATA['rackqty'];
    $rated = $EstmDATA['rated'];    $ratedqty = $EstmDATA['ratedqty'];
    $metered = $EstmDATA['metered'];    $meteredqty = $EstmDATA['meteredqty'];
    $cage = $EstmDATA['cage'];    $cageqty = $EstmDATA['cageqty'];
    $bio = $EstmDATA['bio'];    $bioqty = $EstmDATA['bioqty'];
    $pdu = $EstmDATA['pdu'];    $pduqty = $EstmDATA['pduqty'];
    $cctv = $EstmDATA['cctv'];    $cctvqty = $EstmDATA['cctvqty'];

// }
