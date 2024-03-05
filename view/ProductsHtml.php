<?php

function ProductsHtml(  $Array)
{
    global $Editable;
    $id = $Array["id"];
    $prod = $Array["prod"];
    $name = $Array["name"];
    $category = ($Array["category"]);
    $request = $Array["request"];
    // PPrint($Array);
    if ($request === "prod") {
        // echo "SELECT * FROM `product_list` WHERE `default_int` = '{$prod}'";
        elem([
            "id" => $id,
            "prod" => $prod,
            "name" => $name,
            "category" => $category,
            "request" => $request
        ]);
    } else {
?>
        <div id="<?= $category . "_{$id}" ?>">
            <div class="contain-btn btn-link border-bottom " id='<?= $category ?>_head_<?= $id ?>'>
                <a class="btn btn-link text-left" id="<?= $category ?>_head_<?= $id ?>" data-toggle="collapse" href="#<?= $category . "collapse_{$id}" ?>" role="button" aria-expanded="true" aria-controls="<?= $category . "collapse_{$id}" ?>">
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
                    <?php elem([
                        "id" => $id,
                        "prod" => $prod,
                        "name" => $name,
                        "category" => $category,
                        "request" => $request
                    ]) ?>
                </div>
            </div>
        </div>

        <script src="../javascript/main.js"></script>
        <script src="../javascript/jquery-3.6.4.js"></script>

    <?php
    }
}

function elem($Array)
{
    // "{$prod}_select[{$name}]"
    global $Editable, $con;

    $id = $Array["id"];
    $prod = $Array["prod"];
    $name = $Array["name"];
    $category = ($Array["category"]);
    $request = $Array["request"];
    ?>
    <div class="form-group col-md-3 px-2 light Product-group" id="<?= $prod . "_{$id}" ?>">
        <span class="fa fa-remove text-danger" style="position: absolute; margin: 4px 0px 0px -7px; cursor: pointer; z-index : 1;" onclick="$(this).parent().remove()"></span>
        <select name="<?= "{$name}[{$category}][{$prod}_select]" ?>" id="<?= "{$prod}_select_{$id}" ?>" class="border-0 small Product-Select col-md-12">
            <?php
            $Query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `default_int` = '{$prod}'");
            while ($row = mysqli_fetch_assoc($Query)) {
                $tbl_ui = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_ui_options` WHERE `sec_category_name` = '{$row['sec_category']}'"));
                $input_box = ($tbl_ui['input_num'] == "False") ? false : true;
                $prodId = $row['id'];

                if ($tbl_ui['select_box'] != "True") {
                    echo "
                    <option value='{$row['default_int']}'>{$row['default_name']}</option>   
                ";
                    break;
                } else {
            ?>
                    <option value="<?= $row['prod_int'] ?>" <?= ($Editable[$name][$category]["{$prod}_select"] == $row['prod_int']) ? "selected" : "" ?>>
                        <?= $row['product'] ?>
                    </option>
            <?php
                }
            }
            ?>
        </select>
        <div class="input-group">
            <input type='number' aria-describedby="<?= "{$prod}unit_{$id}" ?>" class='form-control small col-md-8' id='<?= "{$prod}_qty_{$id}" ?>' <?= (!$input_box) ? "disabled" : '' ?> min=0 placeholder='Quantity' name='<?= "{$name}[{$category}][{$prod}_qty]" ?>' value="<?= $Editable[$name][$category]["{$prod}_qty"] ?>">
            <span class="input-group-text text-centers unit form-control col-4 bg-light p-1" id="<?= "{$prod}unit_{$id}" ?>">
                <?php
                // PPrint((getProductUnit($prodId)));
                if (count(getProductUnit($prodId)) == 1) {
                    echo getProductUnit($prodId)[0]["unit_name"];
                } else {
                ?>
                    <select name="<?= "{$name}[{$category}][{$prod}_unit]" ?>" id="<?= "{$prod}_unit_{$id}" ?>" style="width : 100%; background: transparent;" class="form-control border-0 ">
                        <?php
                        foreach (getProductUnit($prodId) as $arr) {
                            if (($Editable[$name][$category]["{$prod}_select"] == $row["prod_int"])) {
                                echo "<option value = '{$arr['id']}' Selected>{$arr['unit_name']}</option>";
                            }else{
                                echo "<option value = '{$arr['id']}'>{$arr['unit_name']}</option>";
                            }
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
        });
    </script>
<?php
}
?>