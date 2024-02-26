<?php

function DC_DR($name, $id, $type = '', $cloneId = '')
{
    // echo $name." ". $id." " .$type." " . $cloneId;
    session_start();
    $SESSION['post_data'] = $_POST;
    // require "colocation.php";
    require "../model/editable.php";
    global $Editable, $con, $EstmtDone;
    // print_r($Editable);  

    ?>


    <section class="est_div align-center Main mt-2" id="est_div_<?= $id ?>">
        <div class="contain-btn btn-link shadow-sm light " id="contain-btn_<?= $id ?>">
            <?php
            if ($type == "ajax" || $type == "clone") {
                ?>
                <input class="add-estmt btn btn-link except text-primary" type="button" role="button" title="Remove Estimate"
                    id="rem-estmt_<?= $id ?>" style="z-index: 1;" value="&times;">
                <?php
            } else {
                ?>
                <input class="add-estmt btn btn-link except text-primary" type="button" role="button" title="Add Estimate"
                    id="add-estmt" style="z-index: 1;" value="&plus;">
                <script>
                    $('#add-estmt').click(function () {
                        add_estmt();
                    })
                </script>
                <?php
            }
            ?>
            <input type="checkbox" id="checkHead_<?= $id ?>" class="head-btn d-none">
            <label class="text-left text-primary pt-3" for="checkHead_<?= $id ?>" id="estmtHead_<?= $id ?>"
                style="z-index: 1;">
                <h6 class="OnInput">Your Estimate</h6>
            </label>
            <span class="float-right">
                <select name="region[<?= $name ?>]" id="region_<?= $id ?>" class="border-0 text-primary">
                    <?php
                    $reg = mysqli_query($con, "SELECT * FROM `tbl_region`");
                    while ($reg_row = mysqli_fetch_array($reg)) {
                        if ($reg_row["id"] == 0) {
                        } else {
                            if ($Editable['region'][$name] == $reg_row["id"]) {
                                echo "<option selected  value = '{$reg_row['id']}'>{$reg_row['region']}</option>";
                            } else {
                                echo "<option value = '{$reg_row['id']}' >{$reg_row['region']} </option>";
                            }
                        }
                    }
                    ?>
                </select>
                <select name="EstType[<?= $name ?>]" id="EstType_<?= $id ?>" class="border-0 text-primary">
                    <option <?= ($Editable['EstType'][$name] == "DC") ? "selected" : '' ?> value="DC">DC</option>
                    <option <?= ($Editable['EstType'][$name] == "DR") ? "selected" : '' ?> value="DR">DR</option>
                </select>
                <i class="fa fa-copy except text-primary  pt-2 m-1" title="Copy Estimate"
                    style="z-index: 1; cursor: pointer;" id="coptI_<?= $id ?>">
                    <input class="add-estmt btn btn-link except m-0 p-0" type="button" role="button"
                        id="clone-est_<?= $id ?>" style="z-index: 5; font-size: 20px;">
                </i>
            </span>
            <script>
                $('#coptI_<?= $id ?>').click(() => {
                    $('#coptI_<?= $id ?> input').click()
                })
            </script>
        </div>
        <div class="show my-1 except" id="estmt_collapse_<?= $id ?>">
            <div class="tab card card-body">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <input type="text" class="form-control EstmtName" id="estmtname_<?= $id ?>" data-id="<?= $id ?>" data-name="<?= $id ?>"
                            placeholder="Your Estimate" name="estmtname[<?= $name ?>]" required
                            value="<?= $Editable["estmtname"][$name] ?>" onload="addLineItemsToDropdownMenu()"
                            onchange="addLineItemsToDropdownMenu()">
                    </div>
                    <div class="col-md-3 input-group ">
                        <input type="number" min=0 class="form-control small col-8 text-sm-left" id="period_<?= $id ?>"
                            placeholder="Contract Period" min=1 name="period[<?= $name ?>]" required
                            value="<?= $Editable['period'][$name] ?>" aria-describedby="PeriodUnit_<?= $id ?>"
                            style="font-size:15">
                        <span class="input-group-text form-control col-4 bg-light" id="PeriodUnit_<?= $id ?>">Months</span>
                    </div>
                </div>
                <div id="virtual_machine_<?= $id ?>">
                    <input type="hidden" name="count_of_vm[<?= $name ?>]" id="count_of_vm_<?= $name ?>" value="1">

                    <?php
                    require 'Components/VirtualMachine.php';

                    vmContent($name, $id, 0, "", $cloneId);
                    if ($Editable['vmname'][$name] != null) {
                        if (count($Editable['vmname'][$name]) > 1) {
                            foreach ($Editable["vmqty"][$name] as $i => $val) {
                                if ($i == 0) {
                                    continue;
                                }
                                vmContent($name, $id, $i, 'ajax', $cloneId);
                            }
                        }
                    }

                    ?>
                </div>

                <?php
                // require 'Components/Storage.php';
                // require 'Components/Backup.php';
                // require 'Components/Network.php';
                // require 'Components/Security.php';
                // require 'Components/ManagedServices.php';
                // require 'Components/DRServices.php';
                ?>
            </div>
        </div>

    </section>
    <script src="../javascript/main.js"></script>
    <script src="../javascript/jquery-3.6.4.js"></script>

    <script>
        get_default();

        changeOnInput('#estmtHead_<?= $id ?> .OnInput', '#estmtname_<?= $id ?>', 'Your Estimate')

        $('#add-vm_<?= $name ?>').click(function () {
            name = $(this).prop('id')
            name = name.replace('add-vm_', '')
            add_vm("Null", name, <?= $id ?>);
        })
        <?php

        // if ($Editable['vmname'][$name] != null) {
        //     if (count($Editable['vmname'][$name]) > 1) {
        //         for ($i = 1; $i < $Editable['count_of_vm'][$name]; $i++) {
        //             if ($i == ($Editable['count_of_vm'][$name] - 1) && $_POST['lastEst'] == "true") {
        //                 echo "add_vm({$i} , {$name},{$id}, '', true);\n  ";
        //             } else {
    
        //                 echo "add_vm({$i} , {$name},{$id},);\n  ";
        //             }
        //         }
        //     }
        // }
        ?>



        $('#checkHead_<?= $id ?>').on('input', function () {
            if ($("#estmt_collapse_<?= $id ?>").hasClass('show')) {
                $("#estmt_collapse_<?= $id ?>").removeClass('show')
                $("#estmt_collapse_<?= $id ?>").addClass('hiddenDiv')
            } else {
                $("#estmt_collapse_<?= $id ?>").removeClass('hiddenDiv')
                $("#estmt_collapse_<?= $id ?>").addClass('show')
            }
        })

        $('#rem-estmt_<?= $id ?>').click(function () {
            $("#est_div_<?= $id ?>").remove();
        })

        validate_input('.sec-check');
        validate_input('.check-off');
        validate_input('.ip-check');


        $('#age-type_<?= $id ?>').on('change', function () {
            if ($(this).val() === "Customized") {
                $('#ageqty_<?= $id ?>').attr('style', 'display : inline-block');
                $(this).addClass('col-md-6');
            } else {
                $('#ageqty_<?= $id ?>').attr('style', 'display : none');
                $(this).removeClass('col-md-6');
            }
        })


        $('#bandwidthType_<?= $id ?>').on('change', function () {
            let i = $(this).val().match(/Volume/g);
            // console.log(i)
            if (i != null && i[0] === 'Volume') {
                $("#BandwidthUnit_<?= $id ?>").html("GB");
            } else {
                $("#BandwidthUnit_<?= $id ?>").html("Mbps");
            }
        })


        $(document).ready(function () {
            $('.mytabs').find('.strg-select').each(function () {
                // console.log($(this));
                if ($(this).val() == 'TB') {
                    $(this).parent().find('.lblIops').each(function () {
                        let lbl_val = $(this).prop('id');
                        lbl_val = lbl_val * 1000;
                        $(this).html((lbl_val));
                    })
                }
                $(this).on("change", function () {
                    if ($(this).val() == 'GB') {
                        $(this).parent().find('.lblIops').each(function () {
                            let lbl_val = $(this).prop('id');
                            $(this).html(lbl_val);
                        })
                    } else if ($(this).val() == 'TB') {
                        $(this).parent().find('.lblIops').each(function () {
                            let lbl_val = $(this).prop('id');
                            lbl_val = lbl_val * 1000;
                            $(this).html((lbl_val));
                        })
                    }
                })
            })
        })

        $('#EstType_<?= $id ?>').on("change", function () {
            if ($(this).val() == "DR") {
                $('.DR_<?= $name ?>').removeClass('d-none');
            } else {
                $('.DR_<?= $name ?>').addClass('d-none');
            }
        })
        $(document).ready(function () {
            if ($("#EstType_<?= $id ?>").val() == "DR") {
                $('.DR_<?= $name ?>').removeClass('d-none');
            } else {
                $('.DR_<?= $name ?>').addClass('d-none');
            }
        })

        $('#clone-est_<?= $id ?>').click(function () {
            add_estmt('clone', <?= $id ?>);
        })


        if ($('#hsm_type_<?= $id ?>').val() === "Dedicated HSM") {
            $('#hsm_type_<?= $id ?>').parent().find('.hide span').html("Keys");
        } else if ($('#hsm_type_<?= $id ?>').val() === "Shared HSM") {
            $('#hsm_type_<?= $id ?>').parent().find('.hide span').html("Devices");
        }
        $('#hsm_type_<?= $id ?>').on('change', function () {
            if ($(this).val() === "Dedicated HSM") {
                $(this).parent().find('.hide span').html("Keys");
            } else {
                $(this).parent().find('.hide span').html("Devices");
            }
        })

        $(document).ready(function () {
            $('.Checked').each(function () {
                $(this).attr("checked", "true")
                $(this).parent().find('input[type="number"]').attr('required', 'true')
                let id = $(this).parent().find('select').prop('id');
                if ($("#" + id + " option").length > 1) {
                    if ($("#" + id).val() === '') {
                        // console.log($("#" + id + " option").length);
                        $("#" + id).attr('required', 'true');
                    }
                } else {
                    // console.log(id)
                }
            })
            // validate_input('.Checked');
            $('.replink').addClass('d-none');
        })
    </script>
    <?php
}
?>