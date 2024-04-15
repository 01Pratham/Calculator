<?php

function DC_DR($name, $id, $type = '', $cloneId = '')
{
    // echo $name." ". $id." " .$type." " . $cloneId;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // echo session_status();
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
                <input onclick="$(this).parent().parent().remove()" class="add-estmt btn btn-link except text-primary" type="button" role="button" title="Remove Estimate" id="rem-estmt_<?= $id ?>" style="z-index: 1;" value="&times;">
            <?php
            } else {
            ?>
                <input class="add-estmt btn btn-link except text-primary" type="button" role="button" title="Add Estimate" id="add-estmt" style="z-index: 1;" value="&plus;">
                <script>
                    $('#add-estmt').click(function() {
                        add_estmt();
                    })
                </script>
            <?php
            }
            ?>
            <!-- <input class="add-estmt btn btn-link except text-primary" type="button" role="button" title="Clone Estimate" id="add-estmt" style="z-index: 1;" value=""> -->

            <input type="checkbox" id="checkHead_<?= $id ?>" class="head-btn d-none">
            <label class="text-left text-primary pt-3" for="checkHead_<?= $id ?>" id="estmtHead_<?= $id ?>" style="z-index: 1;">
                <h6 class="OnInput">Your Estimate</h6>
            </label>
            <span class="float-right pt-2">
                <select name="<?= $name ?>[region]" id="region_<?= $id ?>" class="border-0 text-primary">
                    <?php
                    $reg = mysqli_query($con, "SELECT * FROM `tbl_region`");
                    while ($reg_row = mysqli_fetch_array($reg)) {
                        if ($reg_row["id"] == 0) {
                        } else {
                            if ($Editable[$name]['region'] == $reg_row["id"]) {
                                echo "<option selected  value = '{$reg_row['id']}'>{$reg_row['region']}</option>";
                            } else {
                                echo "<option value = '{$reg_row['id']}' >{$reg_row['region']} </option>";
                            }
                        }
                    }
                    ?>
                </select>
                <!-- <select name="<?= $name ?>[EstType]" id="EstType_<?= $id ?>" class="border-0 text-primary">
                    <option <?= ($Editable['EstType'][$name] == "DC") ? "selected" : '' ?> value="DC">DC</option>
                    <option <?= ($Editable['EstType'][$name] == "DR") ? "selected" : '' ?> value="DR">DR</option>
                </select> -->
            <!-- <i class="fa fa-copy except text-primary  pt-2 m-1" title="Copy Estimate" style="z-index: 1; cursor: pointer;" id="coptI_<?= $id ?>">
                    <input class="add-estmt btn btn-link except m-0 p-0" type="button" role="button" id="clone-est_<?= $id ?>" style="z-index: 5; font-size: 20px;">
                </i> -->
                <button class="clone-estmt btn btn-link except text-primary" type="button" role="button" title="Clone Estimate" id="clone-estmt_<?= $id ?>" data-id="<?= $id ?>" data-name="<?= $name ?>" style="z-index: 1;" onclick="event.preventDefault(); cloneEst($(this));"><i class="fa fa-copy except"></i></button>
                <script>
                    // $("#clone-estmt_<?= $id ?>").click(function(e) {
                    //     cloneEst(e, $(this));
                    // });
                </script>
            </span>
        </div>
        <div class="show my-1 except" id="estmt_collapse_<?= $id ?>">
            <div class="tab card card-body">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <input type="text" class="form-control EstmtName" id="estmtname_<?= $id ?>" data-id="<?= $id ?>" data-name="<?= $name ?>" placeholder="Your Estimate" name="<?= $name ?>[estmtname]" required value="<?= $Editable[$name]["estmtname"] ?>" onload="addLineItemsToDropdownMenu()" onchange="addLineItemsToDropdownMenu()">
                    </div>
                    <div class="col-md-3 input-group ">
                        <input type="number" min=0 class="form-control small col-8 text-sm-left" id="period_<?= $id ?>" placeholder="Contract Period" min=1 name="<?= $name ?>[period]" required value="<?= $Editable[$name]['period'] ?>" aria-describedby="PeriodUnit_<?= $id ?>" style="font-size:15">
                        <span class="input-group-text form-control col-4 bg-light" id="PeriodUnit_<?= $id ?>">Months</span>
                    </div>
                </div>
                <div id="virtual_machine_<?= $id ?>">
                    <input type="hidden" name="<?= $name ?>[count_of_virtual_machine]" id="count_of_virtual_machine_<?= $name ?>" value="<?= !empty($Editable[$name]['count_of_virtual_machine']) ? $Editable[$name]['count_of_virtual_machine'] : 0 ?>">

                    <?php
                    require 'Components/VirtualMachine.php';

                    if ($Editable[$name]['count_of_virtual_machine'] > 0) {
                        $i = 1;
                        foreach ($Editable[$name] as $key => $val) {
                            if (preg_match("/vm/", $key)) {
                                $new_id = preg_replace("/vm_/", "", $key);
                                vmContent($name, $new_id, $i, 'ajax', $cloneId);
                                $i++;
                            }
                        }
                    }

                    ?>
                </div>

                <?php

                require "../view/ProductsHtml.php";

                foreach ($Editable[$name] as $key => $val) {
                    $i = 1;
                    if (preg_match("/vm/", $key) || !is_array($val)) {
                        continue;
                    }

                ?>

                    <div id="<?= $key . "_{$id}" ?>">
                        <div class="contain-btn btn-link border-bottom " id='<?= $key ?>_head_<?= $id ?>'>
                            <a class="btn btn-link text-left" id="<?= $key ?>_head_<?= $id ?>" data-toggle="collapse" href="#<?= $key . "collapse_{$id}" ?>" role="button" aria-expanded="true" aria-controls="<?= $key . "collapse_{$id}" ?>">
                                <i class="fa fa-box"></i>
                                <h6 class="d-inline-block ml-1">
                                    <?= ucwords($key) ?> :
                                </h6>
                                <h6 class="d-inline-block ml-1 OnInput"></h6>
                            </a>
                            <input type="button" value=" Remove " class="add-estmt btn btn-link float-right except remove" id="rem-vm_<?= $id ?>" data-toggle="button" aria-pressed="flase" autocomplete="on" onclick="$(this).parent().parent().remove()">
                        </div>
                        <div class="collapse show py-1" id="<?= $key . "collapse_{$id}" ?>">
                            <div class="row main-row">
                                <?php
                                foreach ($val as $K => $V) {
                                    if (preg_match("/qty/", $K)) {
                                        $product = preg_replace("/_qty/", "", $K);
                                        elem([
                                            "id" => $id,
                                            "prod" => $product,
                                            "name" => $name,
                                            "category" => $key,
                                            "request" => 'prod'
                                        ]);
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>

    </section>
    <script src="../javascript/main.js"></script>
    <script src="../javascript/jquery-3.6.4.js"></script>

    <script>
        get_default();

        changeOnInput('#estmtHead_<?= $id ?> .OnInput', '#estmtname_<?= $id ?>', 'Your Estimate')

        $('#add-vm_<?= $name ?>').click(function() {
            name = $(this).prop('id')
            name = name.replace('add-vm_', '')
            add_vm("Null", name, <?= $id ?>);
        })

        $('#checkHead_<?= $id ?>').on('input', function() {
            if ($("#estmt_collapse_<?= $id ?>").hasClass('show')) {
                $("#estmt_collapse_<?= $id ?>").removeClass('show')
                $("#estmt_collapse_<?= $id ?>").addClass('hiddenDiv')
            } else {
                $("#estmt_collapse_<?= $id ?>").removeClass('hiddenDiv')
                $("#estmt_collapse_<?= $id ?>").addClass('show')
            }
        })

        // $('#rem-estmt_<?= $id ?>').click(function() {
        //     $("#est_div_<?= $id ?>").remove();
        // })

        $(".rem-est").click(function() {
            $(this).parent().parent().remove()
        })

        validate_input('.sec-check');
        validate_input('.check-off');
        validate_input('.ip-check');


        $('#age-type_<?= $id ?>').on('change', function() {
            if ($(this).val() === "Customized") {
                $('#ageqty_<?= $id ?>').attr('style', 'display : inline-block');
                $(this).addClass('col-md-6');
            } else {
                $('#ageqty_<?= $id ?>').attr('style', 'display : none');
                $(this).removeClass('col-md-6');
            }
        })


        $('#bandwidthType_<?= $id ?>').on('change', function() {
            let i = $(this).val().match(/Volume/g);
            // console.log(i)
            if (i != null && i[0] === 'Volume') {
                $("#BandwidthUnit_<?= $id ?>").html("GB");
            } else {
                $("#BandwidthUnit_<?= $id ?>").html("Mbps");
            }
        })


        $(document).ready(function() {
            $('.mytabs').find('.strg-select').each(function() {
                // console.log($(this));
                if ($(this).val() == 'TB') {
                    $(this).parent().find('.lblIops').each(function() {
                        let lbl_val = $(this).prop('id');
                        lbl_val = lbl_val * 1000;
                        $(this).html((lbl_val));
                    })
                }
                $(this).on("change", function() {
                    if ($(this).val() == 'GB') {
                        $(this).parent().find('.lblIops').each(function() {
                            let lbl_val = $(this).prop('id');
                            $(this).html(lbl_val);
                        })
                    } else if ($(this).val() == 'TB') {
                        $(this).parent().find('.lblIops').each(function() {
                            let lbl_val = $(this).prop('id');
                            lbl_val = lbl_val * 1000;
                            $(this).html((lbl_val));
                        })
                    }
                })
            })
        })

        $('#EstType_<?= $id ?>').on("change", function() {
            if ($(this).val() == "DR") {
                $('.DR_<?= $name ?>').removeClass('d-none');
                d
            } else {
                $('.DR_<?= $name ?>').addClass('d-none');
            }
        })
        $(document).ready(function() {
            if ($("#EstType_<?= $id ?>").val() == "DR") {
                $('.DR_<?= $name ?>').removeClass('d-none');
            } else {
                $('.DR_<?= $name ?>').addClass('d-none');
            }
        })

        if ($('#hsm_type_<?= $id ?>').val() === "Dedicated HSM") {
            $('#hsm_type_<?= $id ?>').parent().find('.hide span').html("Keys");
        } else if ($('#hsm_type_<?= $id ?>').val() === "Shared HSM") {
            $('#hsm_type_<?= $id ?>').parent().find('.hide span').html("Devices");
        }
        $('#hsm_type_<?= $id ?>').on('change', function() {
            if ($(this).val() === "Dedicated HSM") {
                $(this).parent().find('.hide span').html("Keys");
            } else {
                $(this).parent().find('.hide span').html("Devices");
            }
        })

        $(document).ready(function() {
            $('.Checked').each(function() {
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