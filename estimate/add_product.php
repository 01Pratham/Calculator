<?php
require "../model/database.php";
$id = $_POST["id"];
$prod = $_POST["prod"];
$name = $_POST["name"];
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
            <div class="row main-row">
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
    // "{$prod}_select[{$name}]"
    global $category, $name, $con, $id, $prod;
?>
    <div class="form-group px-2" id="<?= $prod . "_{$id}" ?>" style="width: 24%; ">
        <span class="fa fa-remove text-danger" style="position: absolute; margin: 4px 0px 0px -13px; cursor: pointer;" onclick="$(this).parent().remove()"></span>
        <select name="<?= "{$name}[{$category}][{$prod}_select]" ?>" id="<?= "{$prod}_select_{$id}" ?>" class="border-0 small Product-Select" style="width: 100%;">
            <?php
            $Query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `default_int` = '{$prod}'");
            while ($row = mysqli_fetch_assoc($Query)) {
                $tbl_ui = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_ui_options` WHERE `sec_category_name` = '{$row['sec_category']}'"));
                $input_box = ($tbl_ui['input_num'] != "True") ? false : true;
                $prodId = $row['id'];

                if ($tbl_ui['select_box'] != "True") {
                    echo "
                    <option value='{$row['default_int']}'>{$row['default_name']}</option>   
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
        <div class="row">

            <input type='number' aria-describedby="<?= "{$prod}unit_{$id}" ?>" class='form-control small col-md-8' id='<?= "{$prod}_qty_{$id}" ?>' <?= (!$input_box) ? "disabled" : '' ?> min=0 placeholder='Quantity' name='<?= "{$name}[{$category}][{$prod}_qty]" ?>'>
            <span class="input-group-text unit form-control col-4 bg-light p-1" id="<?= "{$prod}unit_{$id}" ?>">
                <?php
                // PPrint((getUnit($prodId)));
                if (count(getUnit($prodId)) == 1) {
                    echo getUnit($prodId)[0]["unit_name"];
                } else {
                ?>
                    <select name="<?= "{$name}[{$category}][{$prod}_unit]" ?>" id="<?= "{$prod}_unit_{$id}" ?>" style="width : 100%; background: transparent;" class="form-control border-0 ">
                        <?php
                        foreach (getUnit($prodId) as $arr) {
                            echo "<option value = '{$arr['id']}'>{$arr['unit_name']}</option>";
                        }
                        ?>
                    </select>
                <?php
                }
                ?>  
            </span>
        </div>

    </div>

    <script>
        $(".Product-Select").on("change", function() {
            let prod = $(this).val();
            let $this = $(this);
            $.ajax({
                url: "../model/getProductUnit.php",
                type: "post",
                data: {
                    action: "getUnit",
                    prod: prod,
                },
                success: function(response) {
                    // console.log($this);  
                    $this.parent().find(".unit").html(response);
                }
            })
        })
    </script>
<?php
}
?>