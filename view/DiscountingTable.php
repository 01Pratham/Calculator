<?php

require "../controller/DiscountingTableController.php";
require "../controller/Currency_Format.php";

$is_OTC = [];
foreach ($Array as $KEY => $VAL) {
    $is_OTC[$KEY] = false;
    $no = 1;
    echo "<table class='final-tbl table except' id='final-tbl{$KEY}'>";
    echo "
    <tr>
        <th class='Head colspan except noExl' colspan='10' style='font-size: 30px;'>
            <div class='row except d-flex justify-content-between'>
                <div class='except'></div>
                <div class='except'>
                    {$VAL['HEAD']}
                </div>
                <div class='col-2 except input-group'>
                    <input type='number' min=0 max=100 name='' class='form-control col-md-10 ' id='DiscountPercetage_{$KEY}' data-percentage = '" . (!empty($_DiscountedData[$KEY]['percentage']) ? floatval($_DiscountedData[$KEY]['percentage']) * 100 : 0) . "' aria-describedby='perce_{$KEY}' value='" . number_format(floatval($_DiscountedData[$KEY]['percentage']) * 100, 2, '.', "") . "'>
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
                    $group = preg_match("/vm/", $_K) ? $_k : $_K;

                    if (preg_match("/vm/", $_K)) {
                        foreach ($_v as $__k => $__v) {
                            $trId = $_k . $__k;
                            $product = $__k;
                            $rowspan = ($__k == "vcore") ? 3 : '';
                            tblRow($__v, $rowspan);
                        }
                    } else {
                        $trId = $_k;
                        $product = $_k;
                        tblRow($_v, 1);
                    }
                }
                if (preg_match("/otc/", $_K)) {
                    $is_OTC[$KEY] = true;
                }
            }
        }
    }
    $Total[$KEY] = Total($KEY);
    echo "</table>";
?>

    <script>
        $("#perce_<?= $KEY ?>").on("click", function() {
            var $obj = {
                action: "Discount",
                discountVal: $("#DiscountPercetage_<?= $KEY ?>").val() / 100,
                Total: "<?= $Total[$KEY] ?>",
                data: `<?= (json_encode($Products[$KEY])) ?>`,
                regionId: "<?= $Region[$KEY] ?>",
            };
            DiscountingAjax($obj, <?= $KEY ?>);
        })
        $(document).ready(function() {
            // totalInfra(<?= $KEY ?>)
        })
    </script>

<?php
}

function tblRow($arr, $rowspan = '')
{
    global $KEY, $DiscountingId, $Class, $trId, $group, $_K, $product, $_k;
    $discount = $arr["discount"] / 100;
?>
    <tr id="<?= preg_replace("/ /", "", $trId) . "_" . $KEY ?>" data-key="<?= $KEY ?>" data-group="<?= $_K ?>" data-cat="<?= $_k ?>" data-product="<?= $product ?>">
        <td <?= !empty($rowspan) ? "rowspan = '$rowspan'" : "hidden" ?>><?= $arr["service"] ?></td>
        <td class="text-left final"><?= $arr["product"] ?></td>
        <td class="qty" <?= !empty($rowspan) ? "rowspan = '$rowspan'" : "hidden" ?>><?= $arr["qty"] ?></td>
        <td class='cost unshareable' contenteditable="true" data-unit=<?= $arr["actual_price"] ?> data-changed="<?= $arr["unit_price"] ?>"><?= INR($arr["unit_price"]) ?></td>
        <td class="text-nowrap MRC mrc_<?= $KEY . " $Class ";
                                        echo (floatval($arr["otc"]) > 0) ? "hasOTC" : ""; ?> unshareable  " data-MRC="<?= $arr["mrc"] ?>" data-discId="<?= $DiscountingId ?>"><?= INR($arr["mrc"]) ?></td>
        <td class="discount" data-percentage="<?= !empty($arr["discount"]) ? $arr["discount"] : 0  ?>" data-key="<?= $KEY ?>" data-discId="<?= $DiscountingId ?>" data-group="<?= $group ?>"><?= number_format($arr["discount"], 2, '.', "") . " %"  ?></td>
        <td class="discountAmmt text-nowrap"><?= INR(floatval($arr["mrc"]) * (floatval($arr["discount"]) / 100)) ?></td>
        <td class="DiscountedMrc text-nowrap <?= $Class ?>" contenteditable="true" data-discounted-mrc="<?= $arr["mrc"] - ($arr["mrc"] * $discount)  ?>" data-key="<?= $KEY ?>" data-discId="<?= $DiscountingId ?>" data-group="<?= $group ?>"><?= INR($arr["mrc"] - ($arr["mrc"] * $discount)) ?></td>
        <td class="text-nowrap Otc"><?= INR($arr["otc"]) ?></td>
        <td class="text-nowrap DiscountedOtc"><?= INR((floatval($arr["otc"]) > 0) ? $arr["otc"] - ($arr["otc"] * $discount) : 0) ?></td>
    </tr>
<?php
}


function tblHead($Service)
{
    global $no;
?>
    <tr>
        <th class='Head except' id='sr'><?php echo 'A.' . $no; ?></th>
        <th class='Head except' id='comp'><?= (strlen($Service) < 4 ? strtoupper($Service) : ucwords($Service))  . " Services"  ?></th>
        <th class='Head except' id='unit'>Unit</th>
        <th class='Head unshareable except' id='cost'>Cost</th>
        <th class='Head unshareable except' id='mrc'>Monthly Cost</th>
        <th class='Head unshareable except' id='disc-head'>Discount %</th>
        <th class='Head unshareable except' id='disc-head'>Discount Ammount</th>
        <th class='Head unshareable except' id='discMrc-head'>Discounted Price</th>
        <th class='Head unshareable except' id='otc'>OTC</th>
        <th class='Head unshareable except' id='otc'>Discounted OTC</th>
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
        <th class='except unshareable' style='background: rgba(212,212,212,1); '>Sr No .</th>
        <th class=' final colspan except unshareable' colspan='3' style='background: rgba(212,212,212,1); '> Description </th>
        <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>MRC</th>
        <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>Discount Ammount</th>
        <th class='colspan except unshareable' style='background: rgba(212,212,212,1);' colspan='2'>Discounted MRC</th>
    </tr>
    <?php
    $i = 1;
    if (!empty($Infrastructure[$KEY])) {
    ?>
        <tr>
            <td class='unshareable'><?= $i ?></td>
            <td class='colspan  final unshareable' colspan='3'> Infrastructure</td>
            <td class='colspan unshareable ' colspan='2' id="infraTotal_<?= $j ?>"><?php INR(array_sum($Infrastructure[$KEY])); ?></td>
            <td class='colspan unshareable ' colspan='2' id="discAmmtInfra_<?= $j ?>"><?php INR(array_sum($Infrastructure[$KEY]) - array_sum($DiscountedInfrastructure[$KEY])); ?></td>
            <td class='colspan unshareable ' colspan='2' id="DiscInfra_<?= $j ?>"><?php INR(array_sum($DiscountedInfrastructure[$KEY])); ?></td>
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
            <td class='colspan unshareable ' colspan='2' id="discAmmtMng_<?= $j ?>"><?php INR(array_sum($ManagedServices[$KEY]) - array_sum($DiscountedManagedServices[$KEY])); ?></td>
            <td class='colspan unshareable ' colspan='2' id="DiscMng_<?= $j ?>"><?php INR(array_sum($DiscountedManagedServices[$KEY]));  ?></td>
        </tr>
    <?php
        $i++;
    }
    if ($is_OTC[$KEY]) {
    ?>
        <tr>
            <td class='unshareable'><?= $i ?></td>
            <td class='colspan final unshareable' colspan='3'> One Time Cost </td>
            <td class='colspan unshareable' colspan='2' id="final_otc_<?= $j ?>"><?= INR($OTC) ?></td>
            <td class='colspan unshareable' colspan='2' id="discAmmtOtc_<?= $j ?>"></td>
            <td class='colspan unshareable' colspan='2'></td>
        </tr>
    <?php } ?>
    <tr>
        <th class=' final unshareable' style='background-color: rgb(255, 207, 203);'> </th>
        <th class=' final colspan except unshareable' colspan='3' style='background-color: rgb(255, 207, 203);'> Total [ Monthly ]</th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='total_monthly_<?= $j ?>' data-value="<?= $total ?>"><?php INR($total) ?></th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='totalDiscAmmt_<?= $j ?>' data-value="<?= $total ?>"><?php INR($total - $DiscountedTotal) ?></th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 207, 203);' id='DiscTotal_<?= $j ?>' data-value="<?= $DiscountedTotal ?>"><?php INR($DiscountedTotal) ?></th>
    </tr>
    <tr>
        <th class=' final unshareable' style='background-color: rgb(255, 226, 182);'> </th>
        <th class=' final colspan except unshareable' colspan='3' style='background-color: rgb(255, 226, 182);'> Total [ For <?= $Period[$KEY] ?> Months ]</th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);' id="MonthlyTotal_<?= $j ?>" data-period="<?= $Period[$KEY] ?>" data-value="<?= $total * $Period[$KEY] ?>"><?php INR($total * $Period[$KEY]); ?></th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);' id="MonthlyDiscAmmt_<?= $j ?>" data-period="<?= $Period[$KEY] ?>"><?php INR(($total * $Period[$KEY]) - ($DiscountedTotal * $Period[$KEY])); ?></th>
        <th class=' colspan except unshareable' colspan='2' style='background-color: rgb(255, 226, 182);' id="MonthlyDiscounted_<?= $j ?>" data-period="<?= $Period[$KEY] ?>"><?php INR($DiscountedTotal * $Period[$KEY]) ?></th>
    </tr>

<?php
    return $total;
}
?>





<script>
    const sum = (obj) => Object.values(obj).reduce((a, b) => a + b, 0);

    function updateTotalHtml(object) {
        let DiscountedInfra = 0,
            DiscountedMng = 0,
            DiscountedMRC = 0,
            DiscountedTotal = 0,
            discountPercentage = 0,
            DiscAmmtInfra = 0,
            DiscAmmtMng = 0,
            j = object.j;
        // console.log(object.Obj)
        Object.keys(object.Obj).forEach(function(key) {
            let $Parent;
            if (key.match(/vm/g)) {
                Object.keys(object.Obj[key]).forEach(function(prodKey) {
                    $Parent = $(`#${key+prodKey}_${j}`)
                    MRC = $Parent.find(".mrc_" + j).data("mrc");
                    discountPercentage = object.Obj[key][prodKey];
                    DiscountedMRC = MRC - (MRC * (discountPercentage / 100));
                    $Parent.find(".discount").html(discountPercentage.toFixed(2) + " %").data("percentage", discountPercentage);
                    $Parent.find(".discountAmmt").html(INR(MRC - DiscountedMRC));
                    $Parent.find(".DiscountedMrc").html(INR(DiscountedMRC)).data("discountedMrc", DiscountedMRC);
                    if ($Parent.find(".DiscountedMrc").hasClass("Infrastructure_" + j)) {
                        DiscountedInfra += DiscountedMRC;
                        DiscAmmtInfra += (MRC - DiscountedMRC);
                    } else if ($Parent.find(".DiscountedMrc").hasClass("Managed_" + j)) {
                        DiscountedMng += DiscountedMRC;
                        DiscAmmtMng += (MRC - DiscountedMRC);
                    }
                })
            } else {
                Object.keys(object.Obj[key]).forEach(function(prodKey) {
                    $Parent = $("#" + prodKey + "_" + j)
                    MRC = $Parent.find(".mrc_" + j).data("mrc");
                    discountPercentage = object.Obj[key][prodKey];
                    DiscountedMRC = MRC - (MRC * (discountPercentage / 100));
                    $Parent.find(".discount").html(discountPercentage.toFixed(2) + " %").data("percentage", discountPercentage);
                    $Parent.find(".discountAmmt").html(INR(MRC - DiscountedMRC));
                    $Parent.find(".DiscountedMrc").html(INR(DiscountedMRC)).data("discountedMrc", DiscountedMRC);
                    if ($Parent.find(".DiscountedMrc").hasClass("Infrastructure_" + j)) {
                        DiscountedInfra += DiscountedMRC;
                        DiscAmmtInfra += (MRC - DiscountedMRC);
                    } else if ($Parent.find(".DiscountedMrc").hasClass("Managed_" + j)) {
                        DiscountedMng += DiscountedMRC;
                        DiscAmmtMng += (MRC - DiscountedMRC);
                    }
                })
            }
        })
        DiscountedMRC = parseFloat(DiscountedInfra) + parseFloat(DiscountedMng);
        DiscountedTotal = parseFloat(DiscountedMRC) * parseFloat($("#MonthlyDiscounted_" + j).data("period"));
        $("#DiscInfra_" + j).html(INR(DiscountedInfra));
        $("#discAmmtInfra_" + j).html(INR(DiscAmmtInfra));
        $("#discAmmtMng_" + j).html(INR(DiscAmmtMng));
        $("#DiscMng_" + j).html(INR(DiscountedMng));
        $("#DiscTotal_" + j).html(INR(DiscountedMRC));
        $("#totalDiscAmmt_" + j).html(INR(parseFloat($("#total_monthly_" + j).data("value")) - DiscountedMRC));
        $("#MonthlyDiscAmmt_" + j).html(INR(parseFloat($("#MonthlyTotal_" + j).data("value")) - DiscountedTotal));
        $("#MonthlyDiscounted_" + j).html(INR(DiscountedTotal)).data("value", DiscountedTotal);
        DiscountedData[object.j]["percentage"] = object.DATA.discountVal;
        DiscountedData[object.j]["Data"] = object.Obj;
    }

    <?php
    echo "let DiscountedData = {";
    foreach ($Array as $KEY => $VAL) {
        if (is_array($VAL)) {
            echo $KEY . " : {
            'percentage' : '',
            'Data' : { ";
            foreach ($VAL as $K => $V) {
                if (is_array($V)) {
                    if (preg_match("/vm/", $K)) {
                        foreach ($V as $k => $V) {
                            echo "$k : {
                                CPU : '',
                                RAM : '',
                                Disk : ''
                            },\n";
                        }
                        continue;
                    }
                    echo "$K : {},\n";
                }
            }
            echo " },\n";
            echo "}, \n";
        }
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
                console.log(Obj)
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
            )).data("value", parseFloat(infraTotal) + parseFloat(mngTotal))
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
            )).data("value", parseFloat(infraTotal) + parseFloat(mngTotal))
            let period = parseFloat($("#MonthlyTotal_" + j).data("period"))
            $("#MonthlyTotal_" + j).html(INR(
                (parseFloat(infraTotal) +
                    parseFloat(mngTotal)) * period
            ))
        }
        let percentage = 100 - (100 * ($("#DiscTotal_" + j).data("value") / $("#total_monthly_" + j).data("value")))
        if (isNaN(percentage)) {
            percentage = 0;
        }
        $("#DiscountPercetage_" + j).val(percentage.toFixed(2)).data("percentage", percentage);
        // console.log(percentage)
    }


    let FirstFocused = true;
    $(".discount").on({
        "click focus": function() {
            if (FirstFocused && $(this).prop("contenteditable") == "true") {
                $(this).text($(this).data("percentage"))
                FirstFocused = false;
            }
        },
        "blur": function() {
            let percentage = parseFloat($(this).data("percentage"));
            let newPerc = parseFloat($(this).html().replace(/ |%/g, ""));
            FirstFocused = true;
            let $Mrc = $(this).parent().find(".MRC");

            if (isNaN(newPerc) || newPerc > 99) {
                alert("Please Enter a valid Percentage");
                $(this).html(percentage.toFixed(2) + " %");
            } else {
                percentage = newPerc / 100;
                let Mrc;
                if ($Mrc.hasClass("hasOTC")) {
                    Mrc = parseFloat($(this).parent().find(".Otc").html().replace(/,|₹| /g, ""));
                } else {
                    Mrc = parseFloat($Mrc.html().replace(/,|₹| /g, ""));
                }
                let discountedMrc = Mrc - (Mrc * percentage);

                if (discountedMrc <= 0 && percentage > 0) {
                    alert("Please Enter a Valid Percentage");
                } else {
                    if ($Mrc.hasClass("hasOTC")) {
                        $(this).parent().find(".DiscountedOtc").html(INR(discountedMrc));
                    } else {
                        $(this).parent().find(".DiscountedMrc").html(INR(discountedMrc));
                        $(this).parent().find(".discountAmmt").html(INR(Mrc - discountedMrc));
                    }
                }

                let j = $(this).data("key");
                let discountID = $(this).data("discid");
                let group = $(this).data("group");

                if (group.match(/vm/g)) {
                    let product = $(this).parent().data("product");
                    DiscountedData[j]["Data"][group][product] = percentage * 100;
                } else {
                    try {
                        DiscountedData[j]["Data"][group][discountID] = percentage * 100;
                    } catch (Error) {
                        DiscountedData[j]["Data"][group] = {
                            [discountID]: percentage * 100
                        };
                    }
                }
                totalInfra(j, "discountedTotal");
                $(this).html(newPerc.toFixed(2) + " %").data("percentage", newPerc);
            }
        },
    })


    $(".DiscountedMrc").on({
        "click focus": function() {
            if (FirstFocused && $(this).prop("contenteditable") == "true") {
                $(this).html($(this).data("discountedMrc"))
                FirstFocused = false;
            }
        },
        "blur": function() {
            let $this = $(this)
            let $Parent = $(this).parent()
            let val = parseFloat($this.html().replace(/₹|,| /g, ''));
            let Monthly = $Parent.find(".MRC").data("mrc");
            let percentage = 0;
            let j = $this.data("key")

            try {
                percentage = parseFloat(100 - (100 * (val / Monthly)));
                if (isNaN(percentage)) {
                    percentage = 0;
                } else if (percentage > 99 || Monthly <= 0) {
                    $this.html(INR($this.data("discountedMrc")));
                    return;
                }
                totalInfra(j, "discountedTotal")
                let discountID = $this.data("discid")
                let group = $this.data("group")
                if (group.match(/vm/g)) {
                    let product = $Parent.data("product");
                    if (product.match(/vcore/g)) {
                        DiscountedData[j]["Data"][group]["vcore"] = percentage
                    }
                    if (product.match(/ram/g)) {
                        DiscountedData[j]["Data"][group]["ram"] = percentage
                    }
                    if (product.match(/storage/g)) {
                        DiscountedData[j]["Data"][group]["storage"] = percentage
                    }
                } else {
                    try {
                        DiscountedData[j]["Data"][group][discountID] = percentage
                    } catch (Error) {
                        DiscountedData[j]["Data"][group] = {
                            [discountID]: percentage
                        };
                    }
                }
                $Parent.find(".discount").html(`${percentage.toFixed(2)} %`).data("percentage", percentage);
                $this.html(INR(val));
            } catch (e) {
                // console.log("Error");
                $this.html(INR($this.data("discountedMrc")));
            }
            totalInfra(j, "discountedTotal")
        },
    }).keypress(function(e) {
        let key = e.keyCode || e.charCode;
        if (key == 13) { // if enter key is pressed            
            $(this).blur();
            $(this).html();
        }
    });



    let $_Prices = JSON.parse('<?= json_encode($_Prices) ?>');

    $(".cost").keypress(function(e) {
        let key = e.keyCode || e.charCode;
        if (key == 13) { // if enter key is pressed            
            $(this).blur();
            $(this).html();
        }
    })

    FirstFocused = true;

    $(".cost").on({
        "click focus": function() {
            if (FirstFocused) {
                $(this).text($(this).data("newunit"))
                FirstFocused = false;
            }
        },
        blur: function() {
            let $this = $(this);
            let $MRC = $this.parent().find(".MRC");
            let $Qty = $this.parent().find(".qty");
            let $Parent = $this.parent();
            let $name = $this.parent().find(".final")
            let val = parseFloat($this.html().replace(/,|₹| /g, ""));
            let qty = parseFloat($Qty.html().replace(/[a-zA-Z]| /g, ""));
            let newMrc, unit;
            if ($this.data('unit') < val) {
                if ($Parent.data("group").match(/vm/g)) {
                    unit = parseFloat($name.html().split(":")[1].replace(/[a-zA-Z]/g, ""));
                    // console.log(unit)
                    $_Prices[$Parent.data("key")][$Parent.data("group")][$Parent.data("cat")][$Parent.data("product")] = val;
                    newMrc = (val * unit) * qty;
                } else {
                    $_Prices[$Parent.data("key")][$Parent.data("group")][$Parent.data("cat")] = val;
                    newMrc = val * qty;
                }

                $this.data("newunit", val).html(INR(val));
                $MRC.html(INR(newMrc));
                $Parent.find(".discount").removeAttr("contenteditable");
            } else {
                $this.html(INR($this.data('unit')));
                if ($Parent.data("group").match(/vm/g)) {
                    unit = parseFloat($name.html().split(":")[1].replace(/[a-zA-Z]/g, ""));
                    $MRC.html(INR((parseFloat($this.data('unit')) * unit) * qty));
                } else {
                    $MRC.html(INR(parseFloat($this.data('unit')) * qty));
                }
            }

        }
    });
</script>

<?php
if (!empty($_DiscountedData)) {
    echo "
    <script>
        let _Data = '{$data_query['discounted_data']}';
        let __DATA = JSON.parse(_Data);";
    foreach ($_DiscountedData as  $key => $arr) {
        // echo "updateTotalHtml({'Obj':__DATA[" . $key . "]['Data'], 'j':" . $key . ", 'DATA': { discountVal : '" . $_DiscountedData[$key]["percentage"] . "'}});";
    }
    echo "
    </script>";
}

?>