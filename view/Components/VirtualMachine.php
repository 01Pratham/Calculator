<?php

if (!function_exists("vmContent")) {

    function vmContent($name, $id, $count, $type = '', $cloneId = '')
    {
        require '../model/editable.php';

        // echo  $name . " " . $id . " " . $count . " " . $type . " " . $cloneId
?>

        <div class="contain-btn btn-link border-bottom" id='vmHead_<?= $id ?>'>
            <a class="btn btn-link text-left" id="vmHead_<?= $id ?>" data-toggle="collapse" href="#vm_collapse_<?= $id ?>" role="button" aria-expanded="true" aria-controls="vm_collapse_<?= $id ?>">
                <i class="fa fa-desktop"></i>
                <h6 class="d-inline-block ml-1">Virtual Machine : </h6>
                <h6 class="d-inline-block ml-1 OnInput"></h6>
            </a>
            <?php
            if ($type == "ajax") {
            ?>
                <input type="button" value=" Remove " class="add-estmt btn btn-link float-right except" id="rem-vm_<?= $id ?>" data-toggle="button" aria-pressed="flase" autocomplete="on">
            <?php
            } else {
            ?>
                <input type="button" value=" Add VM " class="add-estmt btn btn-link float-right except" id="add-vm_<?= $name ?>" data-toggle="button" aria-pressed="flase" autocomplete="on">
            <?php
            }
            ?>
        </div>
        <div class="collapse show py-1" id="vm_collapse_<?= $id ?>">
            <div class="row">
                <div class="col-9">
                    <h6><small>VM Name :</small></h6>
                    <input type="text" class="form-control" id="vmname_<?= $id ?>" placeholder="Virtual Machine" name="<?= "{$name}[compute_{$id}][vmname]" ?>" value="<?= $Editable[$name]["compute_{$id}"]['vmname'] ?>">
                </div>
                <div class="col-3">
                    <h6><small>Quantity :</small></h6>
                    <input type="number" class="form-control small" id="vmqty_<?= $id ?>" min=0 placeholder="Quantity" value="<?= ($Editable[$name]["compute_{$id}"]['vmqty'] != 0) ? $Editable[$name]["compute_{$id}"]['vmqty'] : 0; ?>" name="<?= "{$name}[compute_{$id}][vmqty]" ?>">
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group col-md-9 px-2">
                    <h6><small>Instance :</small></h6>
                    <div class="row flexComp">
                        <div class="col-4 input-group">
                            <span class="input-group-text form-control col-5 bg-transparent border-right-0 text-sm" id="vcpu_lbl_<?= $id ?>">vCPU </span>
                            <span class="input-group-text form-control col-1 bg-transparent border-right-0 border-left-0 text-sm" id="vcpu_lbl_<?= $id ?>"> : </span>
                            <input type="number" class="form-control small col-6 text-sm-left border-left-0" id="vcpu_<?= $id ?>" min=0 placeholder="Quantity" value="<?= !empty($Editable[$name]["compute_{$id}"]['vcpu']) ? $Editable[$name]["compute_{$id}"]['vcpu'] : 1 ?>" name="<?= "{$name}[compute_{$id}][vcpu]" ?>">
                        </div>
                        <div class="col-4 input-group">
                            <span class="input-group-text form-control col-5 bg-transparent border-right-0 text-sm" id="ram_<?= $id ?>">vRAM </span>
                            <span class="input-group-text form-control col-1 bg-transparent border-right-0 border-left-0 text-sm" id="ram_<?= $id ?>"> : </span>
                            <input type="number" class="form-control small col-6 text-sm-left border-left-0" id="ram_<?= $id ?>" min=0 placeholder="Quantity" value="<?= !empty($Editable[$name]["compute_{$id}"]['ram']) ? $Editable[$name]["compute_{$id}"]['ram'] : 2 ?>" name="<?= "{$name}[compute_{$id}][ram]" ?>">
                        </div>
                        <div class="col-4 input-group">
                            <span class="input-group-text form-control col-5 p-0 bg-transparent border-0 " id="inst_disk_<?= $id ?>">
                                <select name="<?= "{$name}[compute_{$id}][vmDiskIOPS]" ?>" id="disk_<?= $id ?>" class="form-control p-0 text-sm  border-right-0">
                                    <?php
                                    $strQuery = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `sec_category` = 'block_storage'");
                                    while ($strg = mysqli_fetch_assoc($strQuery)) {
                                        $iops = preg_replace("/Block Storage | IOPS per GB/", '', $strg['product']) . " IOPS/GB";
                                        if ($Editable[$name]["compute_{$id}"]["vmDiskIOPS"] == $strg['prod_int']) {
                                            echo '<option selected value = "' . $strg['prod_int'] . '">' . $iops . '</option>';
                                        } else {
                                            echo '<option value = "' . $strg['prod_int'] . '">' . $iops . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </span>
                            <span class="input-group-text form-control col-1 bg-transparent border-right-0 border-left-0 text-sm" id="inst_disk_<?= $id ?>"> : </span>
                            <input type="number" class="form-control small col-6 text-sm-left border-left-0" id="inst_disk_<?= $id ?>" min=0 placeholder="Quantity" value="<?= !empty($Editable[$name]["compute_{$id}"]['inst_disk']) ? $Editable[$name]["compute_{$id}"]['inst_disk'] : 100 ?>" name="<?= "{$name}[compute_{$id}][inst_disk]" ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3 px-2">
                    <h6><small>VM State :</small></h6>
                    <select name="<?= "{$name}[compute_{$id}][state]" ?>" id="state_<?= $id ?>" class="form-control">
                        <option <?= ($Editable[$name]["compute_{$id}"]["state"] == "Standalone") ? "selected" : '' ?> value="Standalone">Standalone</option>
                        <option <?= ($Editable[$name]["compute_{$id}"]["state"] == "Active") ? "selected" : '' ?> value="Active" class="single">Active</option>
                        <option <?= ($Editable[$name]["compute_{$id}"]["state"] == "Passive") ? "selected" : '' ?> value="Passive" class="single">Passive</option>
                        <option <?= ($Editable[$name]["compute_{$id}"]["state"] == "Active-Active") ? "selected" : '' ?> value="Active-Active" class="multiple">Active-Active</option>
                        <option <?= ($Editable[$name]["compute_{$id}"]["state"] == "Active-Passive") ? "selected" : '' ?> value="Active-Passive" class="multiple">Active-Passive</option>
                    </select>
                    <script>
                        $('#vmqty_<?= $id ?>').on("input", function() {
                            if ($(this).val() < 2) {
                                $('#state_<?= $id ?> .multiple').attr("hidden", "true");
                                $('#state_<?= $id ?> .single').removeAttr("hidden");
                            } else {
                                $('#state_<?= $id ?> .single').attr("hidden", "true");
                                $('#state_<?= $id ?> .multiple').removeAttr('hidden');
                            }
                        })
                        if ($('#vmqty_<?= $id ?>').val() < 2) {
                            $('#state_<?= $id ?> .multiple').attr("hidden", "true");
                            $('#state_<?= $id ?> .single').removeAttr("hidden");
                        } else {
                            $('#state_<?= $id ?> .single').attr("hidden", "true");
                            $('#state_<?= $id ?> .multiple').removeAttr('hidden');
                        }
                    </script>
                </div>

                <div class="form-group col-md-3 px-2">
                    <h6><small>Operating System :</small></h6>
                    <select name="<?= "{$name}[compute_{$id}][os]" ?>" id="os_<?= $id ?>" class="form-control">
                        <option value="" hidden>Select OS</option>
                        <?php create_opt('os', $Editable[$name]["compute_{$id}"]['os']) ?>
                    </select>
                    <input type="hidden" id="osLic_<?= $id ?>">
                </div>
                <div class="form-group col-md-3 px-2">
                    <h6><small>Database :</small></h6>
                    <select name="<?= "{$name}[compute_{$id}][database]" ?>" id="db_<?= $id ?>" class="form-control">
                        <option value="" hidden>Select DB</option>
                        <option value="NA">NA</option>
                        <?php create_opt('db', $Editable[$name]["compute_{$id}"]['database']) ?>
                        <option value="Other" contenteditable="true">Other</option>
                    </select>
                    <input type="hidden" id="osLic_<?= $id ?>">
                </div>
                <div class="form-group col-md-3 px-2">
                    <select name="<?= "{$name}[compute_{$id}][ip_public_type]" ?>" id="ip_public<?= $id ?>" class="border-0 small" style="width: 100%;">
                        <option <?= ($Editable[$name]["compute_{$id}"]["ip_public_type"] == "ipv4") ? "selected" : '' ?> value="ipv4">Public IP : IPv6</option>
                        <option <?= ($Editable[$name]["compute_{$id}"]["ip_public_type"] == "ipv6") ? "selected" : '' ?> value="ipv6">Public IP : IPv4</option>
                    </select>
                    <input type="number" class="form-control small" id="ip_public_<?= $id ?>" min=0 placeholder="Quantity" value="<?= ($Editable[$name]["compute_{$id}"]['ip_public'] != 0) ? $Editable[$name]["compute_{$id}"]['ip_public'] : 0; ?>" name="<?= "{$name}[compute_{$id}][ip_public]" ?>">
                </div>
                <div class="form-group col-md-3 px-2">
                    <h6><small>Anti-Virus : </small></h6>
                    <select name="<?= "{$name}[compute_{$id}][virus_type]" ?>" id="virus_type_<?= $id ?>" class="form-control">
                        <option value="">Select Antivirus</option>
                        <?php
                        create_opt('av', $Editable[$name]["compute_{$id}"]['virus_type']);
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <script src="../javascript/main.js"></script>
        <script src="../javascript/jquery-3.6.4.js"></script>

        <script>
            changeOnInput('#vmHead_<?= $id ?> .OnInput', '#vmname_<?= $id ?>')
            <?php
            if (!empty($cloneId)) {
            ?>

                $('#vm_collapse_<?= $id ?>').find("select,input").each(function() {
                    if ($(this).prop('type') === "button") {

                    } else if ($(this).prop('type') === "checkbox") {
                        let newId = $(this).prop('id')
                        let oldId = newId.replace(/<?= $id ?>/g, <?= $cloneId ?>);
                        if ($("#" + oldId).prop('checked')) {
                            $("#" + newId).attr("checked", $("#" + oldId).prop('checked'));
                        }
                    } else if ($(this).prop("type") == "hidden") {

                    } else {
                        let newId = $(this).prop('id');
                        let oldId = newId.replace(/<?= $id ?>/g, <?= $cloneId ?>);
                        if ($("#" + newId).prop("type") == "hidden") {
                            // console.log("yes");
                        } else
                        if ($("#" + oldId).val() != "") {
                            $("#" + newId).val($("#" + oldId).val());
                        }
                    }
                })
            <?php
            } else {
            ?>

                $(document).ready(function() {
                    // mySeries(<?= $name . ',' . $id . " , '' , " . $count ?>);
                })

            <?php
            }
            if ($_POST['lastVM'] == "true") {
            }
            ?>

            $("#os_<?= $id ?> , #vcpu_<?= $id ?>").on("input", function() {
                if ($("#os_<?= $id ?>").val().search(/win/g) == 0) {
                    let cpu = parseInt($("#vcpu_<?= $id ?>").val());
                    let qty = parseInt($("#vmqty_<?= $id ?>").val());
                    $("#osLic_<?= $id ?>").val((cpu * qty) / 2);
                    console.log((cpu * qty) / 2);
                } else {
                    let qty = parseInt($("#vmqty_<?= $id ?>").val());
                    $("#osLic_<?= $id ?>").val(qty);
                }
            })
        </script>



<?php }
}

?>