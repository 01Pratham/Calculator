<?php

require "../controller/DiscountingTableController.php";
require "../controller/Currency_Format.php";

// PPrint($Array);

$OTC = [];
foreach ($Array as $KEY => $VAL) {
    $no = 1;
    echo "<table class='final-tbl table except' id='final-tbl{$KEY}'>";
    echo "
    <tr>
            <th class='Head colspan except noExl' colspan='8' style='font-size: 30px;'>
                <div class='row except d-flex justify-content-between'>
                    <div class='except'></div>
                    <div class='except'>
                        {$VAL['HEAD']}
                    </div>
                    <div class='col-2 except input-group'>
                        <input type='number' min=0 max=100 name='' class='form-control col-md-10 ' id='DiscountPercetage_{$KEY}' data-percentage = '" . (!empty($_DiscountedData[$KEY]['percentage']) ? $_DiscountedData[$KEY]['percentage'] * 100 : 0) . "' aria-describedby='perce_{$KEY}' value='" . number_format($_DiscountedData[$KEY]['percentage'] * 100, 2, '.', "") . "'>
                        <button class='input-group-text form-control bg-light col-2 p-0 d-flex justify-content-center' id='perce_{$KEY}' style='cursor : pointer'> % </button>
                    </div>
                </div>
            </th>
        </tr>
    ";
    if (is_array($VAL)) {
        foreach ($VAL as $_K => $_V) {
            if (is_array($_V)) {
                tblHead($_K);
                if (preg_match("/managed/", $_K)) $Class = "Managed_{$KEY}";
                else $Class = "Infrastructure_{$KEY}";
                $no += 1;
                foreach ($_V as $_k => $_v) {
                    $DiscountingId = $_k;
                    $trId = $_k;
                    $group = preg_match("/compute/",$_K) ? $_k : $_K;
                    tblRow($_v);
                }

                if (preg_match("/otc/", $_K)) $OTC[$KEY] = true;
                else  $OTC[$KEY] = false;
            }
        }
    }
    Total($KEY);
    echo "</table>";


?>

    <script>
        $("#perce_<?= $KEY ?>").on("click", function() {
            var $obj = {
                action: "Discount",
                discountVal: $("#DiscountPercetage_<?= $KEY ?>").val() / 100,
                Total: "<?= $_Prices[$KEY]['MonthlyTotal'] ?>",
                data: `<?= (json_encode($Products[$KEY])) ?>`,
                regionId: "<?= $Region[$KEY] ?>",
            };
            DiscountingAjax($obj, <?= $KEY ?>);
            // console.log("hi");

        })
        $(document).ready(function() {
            totalInfra(<?= $KEY ?>)
        })
    </script>

<?php
}

function tblRow($arr)
{
    global $KEY, $DiscountingId, $Class, $trId, $group;

    $discount = $arr["discount"] / 100;
?>
    <tr id="<?= $trId ?>">
        <td><?= $arr["service"] ?></td>
        <td class="text-left final"><?= $arr["product"] ?></td>
        <td class="qty"><?= $arr["qty"] ?></td>
        <td class='cost unshareable'><?= INR($arr["unit_price"]) ?></td>
        <td class=" MRC mrc_<?= $KEY . " $Class" ?> unshareable " data-MRC="<?= $arr["mrc"] ?>" data-discId="<?= $DiscountingId ?>"><?= INR($arr["mrc"]) ?></td>
        <td class="discount" data-percentage="<?= $arr["discount"] ?>" data-key="<?= $KEY ?>" data-discId="<?= $DiscountingId ?>" data-group = "<?= $group ?>"><?= number_format($arr["discount"], 2, '.', "") . " %"  ?></td>
        <td class="DiscountedMrc <?= $Class ?>"><?= INR($arr["mrc"] - ($arr["mrc"] * $discount)) ?></td>
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
    global $ManagedServices, $Infrastructure, $Period, $OTC;
    $j = $KEY;
    $total = ((!is_null($Infrastructure[$KEY])) ? array_sum($Infrastructure[$KEY]) : 0) + (!is_null($ManagedServices[$KEY]) ? array_sum($ManagedServices[$KEY]) : 0);
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
            <td class='colspan unshareable ' id="infraTotal_<?= $j ?>" colspan='2'><?php INR(array_sum($Infrastructure[$KEY])); ?></td>
            <td class='colspan unshareable ' id="DiscInfra_<?= $j ?>" colspan='2'><?php ""; ?></td>
        </tr>
    <?php
        $i++;
    }

    if (!empty($ManagedServices[$KEY])) {
    ?>
        <tr>
            <td class='unshareable'><?= $i ?></td>
            <td class='colspan  final unshareable' colspan='3'> Managed Services</td>
            <td class='colspan unshareable ' colspan='2' id="MngTotal_<?= $j ?>"><?php INR(array_sum($ManagedServices[$KEY])); ?></td>
            <td class='colspan unshareable ' colspan='2' id="DiscMng_<?= $j ?>"><?php ""; ?></td>
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
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly_<?= $j ?>'><?php INR($total) ?></th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='DiscTotal_<?= $j ?>'><?php "" ?></th>
    </tr>
    <tr>
        <th class=' final unshareable' style='background-color: rgb(255, 226, 182);'> </th>
        <th class=' final colspan except unshareable' colspan='3' style='background-color: rgb(255, 226, 182);'> Total [ For <?= $Period[$KEY] ?> Months ]</th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);' id="MonthlyTotal_<?= $j ?>" data-period="<?= $Period[$KEY] ?>"><?php INR($total * $Period[$KEY]); ?></th>
        <th class=' colspan except unshareable MonthlyDiscounted' colspan='2' style='background-color: rgb(255, 226, 182);' id="MonthlyDiscounted_<?= $j ?>" data-period="<?= $Period[$KEY] ?>"><?php "" ?></th>
    </tr>

<?php
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
            let $thisMrc;
            if (key.match(/compute/g)) {
                $thisMrc = $("#" + key)
                MRC = $thisMrc.find(".mrc_" + j).data("mrc");
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
                Object.keys(object.Obj[key]).forEach(function(prodKey) {
                    $thisMrc = $("#" + prodKey)
                    MRC = $thisMrc.find(".mrc_" + j).data("mrc");
                    discountPercentage = object.Obj[key][prodKey];
                    DiscountedMRC = MRC - (MRC * (discountPercentage / 100));
                    $thisMrc.find(".discount").html(discountPercentage.toFixed(2) + " %").data("percentage", discountPercentage);
                    $thisMrc.find(".DiscountedMrc").html(INR(DiscountedMRC));
                    if ($thisMrc.find(".DiscountedMrc").hasClass("Infrastructure_" + j)) {
                        DiscountedInfra += DiscountedMRC;
                    } else if ($thisMrc.find(".DiscountedMrc").hasClass("Managed_" + j)) {
                        DiscountedMng += DiscountedMRC;
                    }
                    // console.log(prodKey,discountPercentage)
                })
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
    foreach ($Array as $KEY => $VAL) {
        echo $KEY . " : {
                'percentage' : '',
                'Data' : {} 
            },";
    }
    echo "}; \n";
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
            // let otc_perc = "<?= getProdName("otc") ?>".replace(/otc|-/g, '');
            let period = parseFloat($("#MonthlyTotal_" + j).data("period"))
            $("#MonthlyDiscounted_" + j).html(INR(
                (parseFloat(infraTotal) +
                    parseFloat(mngTotal)) * period
            )).data("value", ((parseFloat(infraTotal) + parseFloat(mngTotal)) * period));
        } else if (type == "total") {
            $("#infraTotal_" + j).html(INR(infraTotal));
            $("#MngTotal_" + j).html(INR(mngTotal));

            $("#total_monthly_" + j).html(INR(
                parseFloat(infraTotal) +
                parseFloat(mngTotal)
            ))
            // let otc_perc = "<?= getProdName("otc") ?>".replace(/otc|-/g, '');
            // $("#final_otc_" + j + ",#otc_" + j).html(INR(
            //     ((parseFloat(infraTotal) +
            //         parseFloat(mngTotal)) * 12) * parseFloat(otc_perc)
            // ))
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
                let group = $(this).data("group")

                if(group.match(/compute/)){
                    DiscountedData[j]["Data"][group]["CPU"] = percentage * 100
                    DiscountedData[j]["Data"][group]["RAM"] = percentage * 100
                    DiscountedData[j]["Data"][group]["Disk"] = percentage * 100
                }else{
                    DiscountedData[j]["Data"][group][discountID] = percentage * 100
                }


                let DiscTotal = parseFloat($("#DiscTotal_" + j).html().replace(/₹|,| /g, ''))
                let total_monthly = parseFloat($("#total_monthly_" + j).html().replace(/₹|,| /g, ''))
                let TotalDiscountPercentage = 100 - (100 * (DiscTotal / total_monthly));
                DiscountedData[j]["percentage"] = TotalDiscountPercentage / 100
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
                DiscountedData[j]["percentage"] = TotalDiscountPercentage / 100
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