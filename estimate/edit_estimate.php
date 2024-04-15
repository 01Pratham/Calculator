<?php
if (isset($_GET['type'])) {
  include '../view/content-header.php';
  contentHeader('Estimate');
  // print_r($Editable);
  $_SESSION["rate_card_id"] = $_GET['list'];

?>

  <div class="content Main">
    <div class="product-container-fluid container-fluid">
      <div class="input-group p-2">
        <input type="text" id="search_product" class="form-control" placeholder="Search Product...">
      </div>
      <div class="row">
        <div class="category-container my-2 col-md-3" role="presentation">
          <button class=" mt-1" hidden id="SearchedProducts" role="tab" type="submit" onclick="return">
            Searched Products
          </button>
          <?php
          $first = true;
          $Query = mysqli_query($con, "SELECT DISTINCT `primary_category` FROM `product_list` WHERE `rate_card_id` = {$_GET['list']} AND `is_active` = '1'  ");
          while ($row = mysqli_fetch_array($Query)) {

          ?>
            <button class="product-tab-featured mt-1 <?= ($first) ? "active-category" : "" ?>" id="<?= $row['primary_category'] ?>" role="tab" type="submit" onclick="$('.product-tab-featured').removeClass('active-category'); $(this).addClass('active-category'); showProdsOnCategory($(this))">
              <?= ucwords(preg_replace("/_/", " ", $row['primary_category'])) ?>
            </button>
          <?php $first = false;
          } ?>
        </div>
        <div class="tabbed-product-container col-lg-9 mt-1" id="product-tab-featured-content" role="tabpanel">
          <div class="row my-2">
            <?php
            $first = true;
            $Query = mysqli_query($con, "SELECT DISTINCT `default_int`, `default_name`, `primary_category` , `sec_category` FROM `product_list` WHERE `rate_card_id` = {$_GET['list']} AND `is_active` = '1' ");
            while ($row = mysqli_fetch_array($Query)) {
              if ($row['primary_category'] == "virtual_machine" && !$first) continue;

              if ($row['primary_category'] == "virtual_machine") {
                $row['default_name'] = "Virtual Machine";
              }
            ?>
              <div class="product p-3" data-category="<?= $row['primary_category'] ?>" hidden="hidden" data-prod="<?= ($first && $row['default_int'] == "virtual_machine") ? "vm" : $row['default_int'] ?>" data-name='<?= $row['default_name'] ?>'>
                <div class="name except">
                  <i class="except fa fa-box"></i>
                  <strong class="mx-2">
                    <?= $row['default_name'] ?>
                  </strong>
                </div>
                <div class="dropdown bg-transparent">
                  <button class="service-info-picker-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add to estimate
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"></div>
                </div>
              </div>
            <?php
              if ($row['primary_category'] == "virtual_machine") {
                $first = false;
              }
            } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-2 Main">
      <form action="final_quotation.php" class="form1" id="form1" method="post">
        <div hidden>
          <?php if (isset($_GET['pot_id'])) { ?>
            <input type="hidden" name="quot_type" value="<?= $_GET['type'] ?>">
            <input type="hidden" name="product_list" value="<?= $_GET['list'] ?>">
            <input type="hidden" name="pot_id" value="<?= $_GET['pot_id'] ?>">
            <input type="hidden" name="edit_id" value="<?= $_GET['edit_id'] ?>">
            <input type="hidden" name="project_name" value="<?= $_GET['project_name'] ?>">
            <?php
            $p = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `id` = '{$_SESSION['edit_id']}' "));
            if ($p['pot_id'] != $_POST['pot_id']) {
              echo "<input type = 'hidden' name = 'old_pot' value = '{$p['pot_id']}'>";
            }
          } else { ?>

            <input type="hidden" name="quot_type" value="<?= $Editable['quot_type'] ?>">
            <input type="hidden" name="product_list" value="<?= $Editable['product_list'] ?>">
            <input type="hidden" name="pot_id" value="<?= $Editable['pot_id'] ?>">
            <input type="hidden" name="project_name" value="<?= $Editable['project_name'] ?>">
          <?php } ?>
          <input type="hidden" name="version" value=" <?php echo $data_query['version'] ?> ">
        </div>

        <div class="mytabs my-2 accent-blue" id="myTab">

          <input type="hidden" name="count_of_est" id="count_of_est" value="<?= empty($Editable["count_of_est"]) ? 1 : $Editable["count_of_est"] ?>">
          <?php
          require '../view/DC_DR.php';
          // require '../view/Loader.php';
          require '../view/Colocation.php';
          $getTypeQuot = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_quot_type` WHERE `id` = '{$_GET['type']}'"));
          $getTypeQuot['template_name'](1, 1);

          // PPrint($Editable[$name]);

          if ($Editable['count_of_est'] > 1) {
            foreach ($Editable as $i => $val) {
              if (is_array($val)) {
                if ($i == "1") {
                  continue;
                }
                $getTypeQuot['template_name']($i, $i . "1", 'ajax');
              }
            }
          }
          ?>
        </div>
        <div class="light py-2 rounded d-flex justify-content-center my-4">
          <button class="Next-Btn" name="proceed" formtarget="_blank">Proceed <i class="px-2 py-2  fa fa-angle-double-right"></i></button>
        </div>
      </form>
      <div class="except fab-container d-flex align-items-end flex-column">
        <div class="except fab shadow fab-content">
          <i class="except icons fa fa-ellipsis-v text-white" title="Actions"></i>
        </div>
        <?php
        $potQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `pot_id` = '{$_GET['pot_id']}' AND `emp_code` = '{$_SESSION['emp_code']}'"));
        if (!isset($_GET['edit_id']) && empty($potQuery['id'])) { ?>
          <div class="except sub-button shadow  btn btn-outline-success action" id="save">
            <i class="except icons fa fa-save"></i>
          </div>
        <?php } else { ?>
          <div class="except sub-button shadow btn btn-outline-info action" title="Update" id="update">
            <i class="except icons fa fa-files-o" title="Update"></i>
          </div>
        <?php } ?>
      </div>

    </div>
  </div>

  <script>
    function showProdsOnCategory($this) {
      let category = $this.prop("id");
      $("#SearchedProducts").attr("hidden", "true")
      $("#search_product").val("");
      $(".product").each(function() {
        if ($(this).data("category") === category) {
          $(this).removeAttr("hidden");
        } else {
          $(this).attr("hidden", "true");
        }
      })
    }
    $(document).ready(function() {
      addLineItemsToDropdownMenu()
      showProdsOnCategory($(".active-category"))
    })

    $(document).ready(function() {
      get_default();
      remove_arrow();
    })

    $(".action").click(function() {
      let act = $(this).prop('id');
      $.ajax({
        url: "../controller/getSerializedData.php",
        method: "post",
        dataType: "TEXT",
        data: $("#form1").serialize(),
        success: function(res) {
          $.ajax({
            url: '../model/saveToDB.php',
            dataType: "TEXT",
            method: "post",
            data: {
              action: act,
              emp_id: <?= $_SESSION['emp_code'] ?>,
              data: res,
              pot_id: '<?= $_GET['pot_id'] ?>',
              project_name: '<?= $_GET['project_name'] ?>',
              period: $('#period_1').val(),
            },
            success: function(response) {
              alert(response)
              if (act == "save") {
                window.location.href = "index.php?all";
              }
            }
          })
        }
      })
    })



    let List;
    $("#search_product").on({
      "input": function() {
        const search = $(this).val().toLowerCase();
        if (search !== "") {
          $(".product-tab-featured").removeClass("active-category")
          $("#SearchedProducts").removeAttr("hidden").addClass("active-category")
        }
        List = {
          [search]: []
        }
        $(".product").attr("hidden", "true")
        $(".product").each(function() {
          let name = $(this).data("name").toLowerCase()
          if (name.match(search)) {
            // List[search].push([$(this).data(d"name")]);
            // console.log($(this).data("name"));
            $(this).removeAttr("hidden")
          }
        })
      },
      blur: function() {
        if ($(this).val() === "") {
          $("#SearchedProducts").removeClass("active-category").attr("hidden", "true");
          let first = true
          $(".product-tab-featured").each(function() {
            if (first) {
              $(this).addClass("active-category");
              showProdsOnCategory($(this));
              first = false;
            }
          });
        }
      }
    })
  </script>
<?php
}
?>