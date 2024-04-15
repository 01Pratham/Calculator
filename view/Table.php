<?php

require "../controller/finalTableController.php";
require "../controller/Currency_Format.php";
// PPrint($Array);
$is_OTC = [];
/*
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
        <tr hidden></tr>
*/
foreach ($Array as $KEY => $VAL) {
    $is_OTC[$KEY] = false;
    $no = 1;
    echo "<table class='final-tbl table except' id='final-tbl{$KEY}'> ";
    echo "
        <tr class = 'noExl'>
            <th class='Head colspan except' colspan='8' style='font-size: 30px;'>
                <div class='row except d-flex justify-content-between'>
                    <div class='except'></div>
                    <div class='except'>
                        {$VAL['HEAD']}
                    </div>
                    <div class='col-2 except input-group'>
                        <input type='number' min=0 max=100 name='' class='form-control col-md-10 ' id='DiscountPercetage_{$KEY} ' disabled aria-describedby='perce_{$KEY} ' value='" . number_format(floatval($_DiscountedData[$KEY]['percentage']) * 100, 2, '.', "") . "'>
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
                if (preg_match("/otc/", $_K)) {
                    $is_OTC[$KEY] = true;
                }
            }
        }
    }
    $ProjectTotal[] = Total($KEY);
    echo "</table>";
}




function tblRow($arr)
{
    global  $KEY, $_K, $_k;
    $discount = $arr["discount"] / 100;
?>
    <tr data-key="<?= $KEY ?>" data-group="<?= $_K ?>" data-cat="<?= $_k ?>">
        <td style="border: 1px solid #575757;"><?= $arr["service"] ?></td>
        <td style="border: 1px solid #575757;" class="text-left"><?= $arr["product"] ?></td>
        <td style="border: 1px solid #575757;white-space: nowrap;" class="qty"><?= $arr["qty"] ?></td>
        <td style="border: 1px solid #575757;white-space: nowrap;" class="Unit" data-unit=<?= $arr["unit_price"] ?>><?= INR($arr["unit_price"]) ?></td>
        <td style="border: 1px solid #575757;white-space: nowrap;" class="MRC text-nowrap"><?= INR($arr["mrc"]) ?></td>
        <td style="border: 1px solid #575757;" class="percent" data-percent="<?= $arr["discount"] ?>"><?= number_format($arr["discount"], 2, '.', "") . " %"   ?></td>
        <td style="border: 1px solid #575757;white-space: nowrap;" class="DiscountedMrc text-nowrap"><?= INR($arr["mrc"] - ($arr["mrc"] * $discount)) ?></td>
        <td style="border: 1px solid #575757;white-space: nowrap;" class="text-nowrap"><?= INR($arr["otc"]) ?></td>
    </tr>
<?php
}


function tblHead($Service)
{
    global $no;
?>
    <tr>
        <th class='Head except' id='sr' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) "><?php echo 'A.' . $no; ?></th>
        <th class='Head except' id='comp' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) "><?= (strlen($Service) < 4 ? strtoupper($Service) : ucwords($Service))  . " Services" ?></th>
        <th class='Head except' id='unit' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) ">Unit</th>
        <th class='Head unshareable except' id='cost' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) ">Cost/Unit</th>
        <th class='Head unshareable except' id='mrc' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) ">Monthly Cost</th>
        <th class='Head unshareable except' id='disc-head' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) ">Discount %</th>
        <th class='Head unshareable except' id='discMrc-head' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) ">Discounted Price</th>
        <th class='Head unshareable except' id='otc' style="border: 1px solid #575757; background-color: rgb(199, 239, 255) ">OTC</th>
    </tr>
<?php
}
function Total($KEY)
{
    global $ManagedServices, $is_OTC, $Infrastructure, $Period, $OTC, $DiscountedInfrastructure, $DiscountedManagedServices;
    $total = ((!is_null($Infrastructure[$KEY])) ? array_sum($Infrastructure[$KEY]) : 0) + (!is_null($ManagedServices[$KEY]) ? array_sum($ManagedServices[$KEY]) : 0);
    $DiscountedTotal = ((!is_null($DiscountedInfrastructure[$KEY])) ? array_sum($DiscountedInfrastructure[$KEY]) : 0) + (!is_null($DiscountedManagedServices[$KEY]) ? array_sum($DiscountedManagedServices[$KEY]) : 0);
    $j = $KEY;

?>
    <tr>
        <th class='except unshareable' style='border: 1px solid #575757; background: rgba(212,212,212,1); '> Sr No . </th>
        <th class='final colspan except unshareable' colspan='3' style='border: 1px solid #575757; background: rgba(212,212,212,1); '> Description </th>
        <th class='colspan except unshareable' style='border: 1px solid #575757; background: rgba(212,212,212,1);' colspan='2'>MRC</th>
        <th class='colspan except unshareable' style='border: 1px solid #575757; background: rgba(212,212,212,1);' colspan='2'>Discounted MRC</th>
    </tr>
    <?php
    $i = 1;
    if (!empty($Infrastructure[$KEY])) {
    ?>
        <tr>
            <td style="border: 1px solid #575757;" class='unshareable'><?= $i ?></td>
            <td style="border: 1px solid #575757;" class='colspan  final unshareable' colspan='3'> Infrastructure</td>
            <td style="border: 1px solid #575757;white-space: nowrap;" class='colspan unshareable ' colspan='2'><?php INR(array_sum($Infrastructure[$KEY])); ?></td>
            <td style="border: 1px solid #575757;white-space: nowrap;" class='colspan unshareable ' colspan='2'><?php INR(array_sum($DiscountedInfrastructure[$KEY])); ?></td>
        </tr>
    <?php
        $i++;
    }

    if (!empty($ManagedServices[$KEY])) {
    ?>
        <tr>
            <td style="border: 1px solid #575757;" class='unshareable'><?= $i ?></td>
            <td style="border: 1px solid #575757;" class='colspan  final unshareable' colspan='3'> Managed Services</td>
            <td style="border: 1px solid #575757;white-space: nowrap;" class='colspan unshareable ' colspan='2'><?php INR(array_sum($ManagedServices[$KEY])); ?></td>
            <td style="border: 1px solid #575757;white-space: nowrap;" class='colspan unshareable ' colspan='2'><?php INR(array_sum($DiscountedManagedServices[$KEY]));  ?></td>
        </tr>
    <?php
        $i++;
    }
    if ($is_OTC[$KEY]) {
    ?>
        <tr>
            <td style="border: 1px solid #575757;" class='unshareable'><?= $i ?></td>
            <td style="border: 1px solid #575757;" class='colspan final unshareable' colspan='3'> One Time Cost </td>
            <td style="border: 1px solid #575757;white-space: nowrap;" class='colspan unshareable' colspan='2' id="final_otc_<?= $j ?>"><?= INR($OTC) ?></td>
            <td style="border: 1px solid #575757;white-space: nowrap;" class='colspan unshareable' colspan='2'></td>
        </tr>
    <?php } ?>
    <tr>
        <th class=' final unshareable' style='border: 1px solid #575757; background-color: rgb(255, 207, 203);'> </th>
        <th class=' final colspan except unshareable' colspan='3' style='border: 1px solid #575757; background-color: rgb(255, 207, 203);'> Total [ Monthly ]</th>
        <th class=' colspan except unshareable' colspan='2' style='border: 1px solid #575757; background-color: rgb(255, 207, 203);white-space: nowrap;' id='total_monthly'><?php INR($total) ?></th>
        <th class=' colspan except unshareable' colspan='2' style='border: 1px solid #575757; background-color: rgb(255, 207, 203);white-space: nowrap;' id='total_monthly'><?php INR($DiscountedTotal) ?></th>
    </tr>
    <tr>
        <th class=' final unshareable' style='border: 1px solid #575757; background-color: rgb(255, 226, 182);'> </th>
        <th class=' final colspan except unshareable' colspan='3' style='border: 1px solid #575757; background-color: rgb(255, 226, 182);'> Total [ For <?= $Period[$KEY] ?> Months ]</th>
        <th class=' colspan except unshareable' colspan='2' style='border: 1px solid #575757; background-color: rgb(255, 226, 182);white-space: nowrap;'><?php INR($total * $Period[$KEY]); ?></th>
        <th class=' colspan except unshareable' colspan='2' style='border: 1px solid #575757; background-color: rgb(255, 226, 182);white-space: nowrap;'><?php INR($DiscountedTotal * $Period[$KEY]) ?></th>
    </tr>

<?php
    return $total;
}
?>