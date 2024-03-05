<?php

require "../controller/finalTableController.php";
require "../controller/Currency_Format.php";
// PPrint($_POST);
$OTC = [];

foreach ($Array as $KEY => $VAL) {
    $no = 1;
    echo "<table class='final-tbl table except' id='final-tbl{$KEY}'>";
    echo "
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr>
            <th class='Head colspan except noExl' colspan='8' style='font-size: 30px;'>
                <div class='row except d-flex justify-content-between'>
                    <div class='except'></div>
                    <div class='except'>
                        {$VAL['HEAD']}
                    </div>
                    <div class='col-2 except input-group'>
                        <input type='number' min=0 max=100 name='' class='form-control col-md-10 ' id='DiscountPercetage_{$KEY} ' disabled aria-describedby='perce_{$KEY} ' value='" . number_format($_DiscountedData[$KEY]['percentage'] * 100, 2, '.', "") . "'>
                        <button class='input-group-text form-control bg-light col-2 p-0 d-flex justify-content-center ' id='perce_{$KEY} ' style='cursor : pointer'> % </button>
                    </div>
                </div>
            </th>
        </tr>
    ";
    if (is_array($VAL)) {
        foreach ($VAL as $_K => $_V) {
            if (is_array($_V)) {
                tblHead($_K);
                $no += 1;
                foreach ($_V as $_k => $_v) {
                    tblRow($_v);
                }
                if (preg_match("/otc/", $_K)) $OTC[$KEY] = true;
                else  $OTC[$KEY] = false;
            }
        }
    }
    Total($KEY);
    echo "</table>";
}




function tblRow($arr)
{
    $discount = $arr["discount"] / 100;
?>
    <tr>
        <td><?= $arr["service"] ?></td>
        <td class="text-left"><?= $arr["product"] ?></td>
        <td><?= $arr["qty"] ?></td>
        <td><?= INR($arr["unit_price"]) ?></td>
        <td><?= INR($arr["mrc"]) ?></td>
        <td><?= number_format($arr["discount"], 2, '.', "") . " %"   ?></td>
        <td><?= INR($arr["mrc"] - ($arr["mrc"] * $discount)) ?></td>
        <td><?= $arr["otc"] ?></td>
    </tr>
<?php
}


function tblHead($Service)
{
    global $no;
?>
    <tr>
        <th class='Head except' id='sr'><?php echo 'A.' . $no; ?></th>
        <th class='Head except' id='comp'><?= ucwords($Service) . " Services" ?></th>
        <th class='Head except' id='unit'>Unit</th>
        <th class='Head unshareable except' id='cost'>Cost/Unit</th>
        <th class='Head unshareable except' id='mrc'>Monthly Cost</th>
        <th class='Head unshareable except' id='disc-head'>Discount %</th>
        <th class='Head unshareable except' id='discMrc-head'>Discounted Price</th>
        <th class='Head unshareable except' id='otc'>OTC</th>
    </tr>
<?php
}
function Total($KEY)
{
    global $ManagedServices, $Infrastructure, $Period, $OTC , $DiscountedInfrastructure , $DiscountedManagedServices;
    $total = ((!is_null($Infrastructure[$KEY])) ? array_sum($Infrastructure[$KEY]) : 0) + (!is_null($ManagedServices[$KEY]) ? array_sum($ManagedServices[$KEY]) : 0);
    $DiscountedTotal = ((!is_null($DiscountedInfrastructure[$KEY])) ? array_sum($DiscountedInfrastructure[$KEY]) : 0) + (!is_null($DiscountedManagedServices[$KEY]) ? array_sum($DiscountedManagedServices[$KEY]) : 0);
    $j = $KEY;
?>
    <tr>
        <th class='except unshareable' style='background: rgba(212,212,212,1); '> Sr No . </th>
        <th class=' final colspan except unshareable' colspan='3' style='background: rgba(212,212,212,1); '> Description </th>
        <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>MRC</th>
        <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>Discounted MRC</th>
    </tr>
    <?php
    $i = 1;
    if (!empty($Infrastructure[$KEY])) {
    ?>
        <tr>
            <td class='unshareable'><?= $i ?></td>
            <td class='colspan  final unshareable' colspan='3'> Infrastructure</td>
            <td class='colspan unshareable ' colspan='2'><?php INR(array_sum($Infrastructure[$KEY])); ?></td>
            <td class='colspan unshareable ' colspan='2'><?php INR(array_sum($DiscountedInfrastructure[$KEY])); ?></td>
        </tr>
    <?php
        $i++;
    }

    if (!empty($ManagedServices[$KEY])) {
    ?>
        <tr>
            <td class='unshareable'><?= $i ?></td>
            <td class='colspan  final unshareable' colspan='3'> Managed Services</td>
            <td class='colspan unshareable ' colspan='2'><?php INR(array_sum($ManagedServices[$KEY])); ?></td>
            <td class='colspan unshareable ' colspan='2'><?php INR(array_sum($DiscountedManagedServices[$KEY]));  ?></td>
        </tr>
    <?php
        $i++;
    }
    if ($OTC[$KEY]) {
    ?>
        <tr>
            <td class='unshareable'><?= $i ?></td>
            <td class='colspan final unshareable' colspan='3'> One Time Cost </td>
            <td class='colspan unshareable' colspan='2' id="final_otc_<?= $j ?>"> </td>
            <td class='colspan unshareable' colspan='2'></td>
        </tr>
    <?php } ?>
    <tr>
        <th class=' final unshareable' style='background-color: rgb(255, 207, 203);'> </th>
        <th class=' final colspan except unshareable' colspan='3' style='background-color: rgb(255, 207, 203);'> Total [ Monthly ]</th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly'><?php INR($total) ?></th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly'><?php INR($DiscountedTotal) ?></th>
    </tr>
    <tr>
        <th class=' final unshareable' style='background-color: rgb(255, 226, 182);'> </th>
        <th class=' final colspan except unshareable' colspan='3' style='background-color: rgb(255, 226, 182);'> Total [ For <?= $Period[$KEY] ?> Months ]</th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);'><?php INR($total * $Period[$KEY]); ?></th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);'><?php INR($DiscountedTotal * $Period[$KEY]) ?></th>
    </tr>

<?php
}
?>