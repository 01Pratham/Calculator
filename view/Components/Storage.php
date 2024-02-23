<div class="contain-btn btn-link border-bottom">
    <button class="btn btn-link col-md-11 text-left" data-toggle="collapse" type="button" id="strHead_<?= $id ?>" role="button" aria-expanded="true" aria-controls="str_collapse_<?= $id ?>">
        <i class="fa fa-hdd mr-2"></i>Storage Solutions :
    </button>
</div>
<div class="collapse show py-1 " id="str_collapse_<?= $id ?>">
    <?php
    $StrgQuery = mysqli_query($con, "SELECT DISTINCT `sec_category` FROM `product_list` WHERE `primary_category` = 'storage'");
    while ($strg = mysqli_fetch_assoc($StrgQuery)) {
        if (preg_match("/archiv|backup|offline/", $strg['sec_category'])) {
        } else {
            $CategoryName =  preg_replace('/_/', ' ', $strg['sec_category']);
            $new_name = ucwords( $CategoryName );
    ?>
            <div class="mx-3">
                <h6><small><?= $new_name ?> : </small></h6>
            </div>
            <div class='row'>
                <?php
                $query = mysqli_query($con, "SELECT DISTINCT `product`, `prod_int` FROM `product_list` WHERE `sec_category` = '{$strg['sec_category']}'");
                while ($types = mysqli_fetch_assoc($query)) {
                    $IopsUnit = preg_replace("/$new_name|IOPS per GB| /", '', $types['product'])
                ?>
                    <div class="form-switch form-group form-check col-md-2">
                        <label style='cursor:pointer' class='h6'> <span class="lblIops" id="<?= $IopsUnit ?>"><?= $IopsUnit ?></span> IOPS / </label>
                        <select name='<?= $types['prod_int'] . "_unit[" . $name . "]" ?>' id='<?= $types['prod_int'] . "_unit_" . $id ?>' class='strg-select'>
                            <option <?=($Editable[$types['prod_int'] . "_unit"][$name] == "GB") ? "selected" : ''?> value='GB'> GB </option>
                            <option <?=($Editable[$types['prod_int'] . "_unit"][$name] == "TB") ? "selected" : ''?> value='TB'>TB</option>
                        </select>
                        <input type='checkbox' class='<?= ($Editable[$types['prod_int']][$name] == "on") ? "Checked" : "" ?> iops-check check' id="<?= $types['prod_int'] . "_check_" . $id ?>" name="<?= $types['prod_int'] . "[" . $name . "]" ?>">
                        <input type='Number' step="0.1" min=0 name='<?= $types['prod_int'] . "_qty[" . $name . "]" ?>' id='<?= $types['prod_int'] . "_qty_" . $id ?>' class="strg hide form-control" min=0 placeholder="Quantity" value="<?= $Editable[$types['prod_int'] . "_qty"][$name] ?>">
                    </div>
                <?php } ?>

            </div>
    <?php
        }
    }
    ?>
</div>