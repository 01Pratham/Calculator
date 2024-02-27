<?php
require "../model/database.php";
$id = $_POST["id"];
$prod = $_POST["prod"];
$category = ($_POST["category"]);
// PPrint($_POST);
if ($_POST["request"] === "prod") {
    // echo "SELECT * FROM `product_list` WHERE `default_int` = '{$prod}'";
    elem();
} else {
?>
    <div id="<?= $category . "_{$id}" ?>">
        <div class="contain-btn btn-link border-bottom" id='vmHead_<?= $id ?>'>
            <a class="btn btn-link text-left" id="vmHead_<?= $id ?>" data-toggle="collapse" href="#vm_collapse_<?= $id ?>" role="button" aria-expanded="true" aria-controls="vm_collapse_<?= $id ?>">
                <i class="fa fa-desktop"></i>
                <h6 class="d-inline-block ml-1">
                    <?= ucwords($category) ?> Services :
                </h6>
                <h6 class="d-inline-block ml-1 OnInput"></h6>
            </a>
            <input type="button" value=" Remove " class="add-estmt btn btn-link float-right except remove" id="rem-vm_<?= $id ?>" data-toggle="button" aria-pressed="flase" autocomplete="on">
        </div>
        <div class="collapse show py-1" id="<?= $category . "collapse_{$id}" ?>">
            <div class="row">
                <?php elem() ?>
            </div>
        </div>
    </div>

    <script src="../javascript/main.js"></script>
    <script src="../javascript/jquery-3.6.4.js"></script>

<?php
}


function elem()
{
    global $category, $name, $con, $id, $prod;
?>
    <div class="form-group col-md-3 px-2" id="<?= $prod . "_{$id}" ?>">
        <span class="fa fa-remove text-danger" style="position: absolute; margin: 4px 0px 0px -13px;" onclick="$(this).parent().remove()"></span>
        <select name="<?= "{$category}_select[{$name}][]" ?>" id="<?= "{$category}_select_{$id}" ?>" class="border-0 small" style="width: 100%;">
            <?php
            $Query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `default_int` = '{$prod}'");
            while ($row = mysqli_fetch_assoc($Query)) {
                $tbl_ui = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_ui_options` WHERE `sec_category_name` = '{$row['sec_category']}'"));
                $input_box = ($tbl_ui['input_num'] != "True") ? false : true;
                if ($tbl_ui['select_box'] != "True") {
                    echo "
                    <option value=''>{$row['default_name']}</option>
                ";  
                    break;
                } else {
                ?>
                    <option value="<?= $row['prod_int'] ?>">
                        <?= $row['product'] ?>
                    </option>   
                <?php
                }
            }
            ?>
        </select>

        <input type='number'  aria-describedby="PeriodUnit_<?= $id ?>" class='form-control small' id='<?= '{$category}_qty_{$id}' ?>' <?= (!$input_box) ? "disabled" : '' ?> min=0 placeholder='Quantity' name='<?= "{$category}_qty[{$name}][]" ?>'>
        <span class="input-group-text form-control col-4 bg-light" id="<?= "{$prod}unit_{$id}" ?>">
        <?php
            if(count(getUnit($row[$id]))>1){
                echo getUnit($row[$id])[0]["unit"];
            }else{
                ?>
                <select name="<?= "{$category}_unit[{$name}][]" ?>" id="<?= "{$category}_unit_{$id}" ?>">
                <?php
                    foreach (getUnit($row[$id]) as $arr){
                        echo "<option value = '{$arr['id']}'>{$arr['unit_name']}<option>";
                    }
                ?>
                </select>
                <?php
            }
        ?>    
    </span>

    </div>
<?php
}
?>