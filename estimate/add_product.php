<?php
require "../model/database.php";
$id = $_POST["id"];
$prod = $_POST["prod"];
$category = ($_POST["category"]);
// PPrint($_POST);
if ($_POST["request"] === "prod") {
    ?>
    <div class="form-group col-md-3 px-2">
        <spna class="remove">

        </spna>
        <select name="<?= "{$category}_select[{$name}][]" ?>" id="<?= "{$category}_select_{$id}" ?>" class="border-0 small"
            style="width: 100%;">
            <?php
            $Query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `sec_category` = '{$prod}'");
            while ($row = mysqli_fetch_assoc($Query)) {
                ?>
                <option value="<?= $row['prod_int'] ?>">
                    <?= $row['product'] ?>
                </option>

                <?php
            }
            ?>
        </select>
        <input type="number" class="form-control small" id="<?= "{$category}_qty_{$id}" ?>" min=0 placeholder="Quantity"
            name="<?= "{$category}_qty[{$name}][]" ?>">
    </div>
    <?php
} else {
    ?>
    <div id="<?= $category . "_{$id}" ?>">
        <div class="contain-btn btn-link border-bottom" id='vmHead_<?= $id ?>'>
            <a class="btn btn-link text-left" id="vmHead_<?= $id ?>" data-toggle="collapse" href="#vm_collapse_<?= $id ?>"
                role="button" aria-expanded="true" aria-controls="vm_collapse_<?= $id ?>">
                <i class="fa fa-desktop"></i>
                <h6 class="d-inline-block ml-1">
                    <?= ucwords($category) ?> Services :
                </h6>
                <h6 class="d-inline-block ml-1 OnInput"></h6>
            </a>

            <input type="button" value=" Remove " class="add-estmt btn btn-link float-right except remove"
                id="rem-vm_<?= $id ?>" data-toggle="button" aria-pressed="flase" autocomplete="on">

        </div>
        <div class="collapse show py-1" id="<?= $category . "collapse_{$id}" ?>">
            <div class="row">
                <div class="form-group col-md-3 px-2">
                    <select name="<?= "{$category}_select[{$name}][]" ?>" id="<?= "{$category}_select_{$id}" ?>"
                        class="border-0 small" style="width: 100%;">
                        <?php
                        $Query = mysqli_query($con, "SELECT * FROM `product_list` WHERE `sec_category` = '{$prod}'");
                        while ($row = mysqli_fetch_assoc($Query)) {
                            ?>
                            <option value="<?= $row['prod_int'] ?>">
                                <?= $row['product'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <input type="number" class="form-control small" id="<?= "{$category}_qty_{$id}" ?>" min=0
                        placeholder="Quantity" name="<?= "{$category}_qty[{$name}][]" ?>">
                </div>
            </div>
        </div>
    </div>

    <script src="../javascript/main.js"></script>
    <script src="../javascript/jquery-3.6.4.js"></script>

    <?php
}
?>