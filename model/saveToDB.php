<?php
session_start();
require("database.php");

if ($_POST['action'] == 'Delete') {
  deleteEstimate($con, $_POST['id']);
} elseif (preg_match("/Discount/", $_POST['action'])) {
  updateDiscountTbl($con, $_POST);
} else {
  saveEstmt($con);
}

function deleteEstimate($con, $id)
{
  $stmt = mysqli_prepare($con, "DELETE FROM `tbl_saved_estimates` WHERE `id` = ?");
  mysqli_stmt_bind_param($stmt, 'i', $id);
  if (mysqli_stmt_execute($stmt)) {
    echo "deleted";
  } else {
    echo "Error deleting data";
  }
  mysqli_stmt_close($stmt);
}

function saveEstmt($con)
{
  $empCode = $_SESSION['emp_code'];
  $projectId = $_POST['pot_id'];
  $projectName = $_POST['project_name'];
  $version = empty($_POST['version']) ? 1 : $_POST['version'];
  $date = date('Y-m-d H:i:s');
  $data = $_POST['data'];
  $prices = $_POST['priceData'];
  if ($_POST['action'] == 'save_as') {
    $version++;
  }
  $stmt = null;
  if ($_POST['action'] == 'update') {
    $Total = (isset($_POST['total'])) ? "`total_upfront`='{$_POST['total']}' ," : ('');
    // $discountedData = (isset($_POST['discountedData'])) ? "`discountdata` = '{$_POST['discountedData']}' ," : ("");
    $discounted_upfront = (isset($_POST['discounted_upfront'])) ? "`discounted_upfront` = '{$_POST['discounted_upfront']}' " : ('');
    $data = (isset($_POST['data'])) ? "`data` = '{$_POST['data']}' ," : ("");
    $priceData = (isset($_POST['priceData'])) ? "`prices` = '{$_POST['priceData']}' ," : ("");
    $total = (isset($_POST['total'])) ? "`total_upfront` = '{$_POST['total']}' " : ("");
    $pot_id = (isset($_POST['pot_id'])) ? "`pot_id` = '{$_POST['pot_id']}' ," : ("");
    $project_name = (isset($_POST['project_name'])) ? "`project_name` = '{$_POST['project_name']}' ," : ("");
    $period = (isset($_POST['period'])) ? "`contract_period` = '{$_POST['period']}' ," : ("");
    $lastUpdated = "`last_changed_by` = '{$_SESSION['emp_code']}',";

    $stmt = mysqli_query(
      $con,
      "UPDATE `tbl_saved_estimates` SET 
                {$Total}
                {$data}
                {$priceData}
                {$lastUpdated}
                {$pot_id}
                {$project_name}
                {$period}
                {$total}
                {$discounted_upfront}
                WHERE `id` = '{$_SESSION['edit_id']}'"
    );
  } else {
    $stmt = mysqli_query($con, "INSERT INTO `tbl_saved_estimates`(
            `emp_code`,
            `pot_id`,
            `project_name`,
            `version`,
            `owner`,
            `last_changed_by`,
            `date_created`,
            `date_updated`,
            `contract_period`,
            `total_upfront`,
            `data`,
            `prices`
        ) VALUES ('{$empCode}', '{$projectId}', '{$projectName}', '{$version}', '{$empCode}', '{$empCode}', '{$date}', '{$date}', '{$_POST['period']}', '{$_POST['total']}', '{$data}', '{$prices}')");
  }

  if ($stmt) {
    $insertId = (mysqli_insert_id($con)) ? mysqli_insert_id($con) : $_SESSION['edit_id'];
    $_SESSION['edit_id'] = $insertId;

    $arr = array(
      "Message" => "Data Stored Successfully",
      "quotationID" => $insertId
    );
    echo json_encode($arr);
  } else {
    echo 'Error while storing data';
  }
}



function updateDiscountTbl($con, $data)
{
  $checkQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_discount_data` WHERE `quot_id` = '{$data['id']}'"));
  if (!empty($checkQuery)) {
    if ($data['action'] == "UpdateDiscountingStatus") {
      $query = mysqli_query($con, "UPDATE `tbl_discount_data` SET `approved_status`='{$data['status']}' , `approved_by`='{$data['approved_by']}'  WHERE `quot_id` = '{$data['id']}'");
    } else {
      $query = mysqli_query($con, "UPDATE `tbl_discount_data` SET `discounted_data` = '{$data['discountedData']}' , `discounted_mrc` = '{$data['discounted_upfront']}' WHERE `quot_id` = '{$data['id']}'");
    }
  } else {
    // $Q =  "INSERT INTO `tbl_discount_data`(`quot_id`, `discounted_data`, `approved_status` , `approved_by`) VALUES ('{$data['id']}','{$data['discountedData']}','' , '{$data['approved_by']}')";
    $query = mysqli_query($con, "INSERT INTO `tbl_discount_data`(`quot_id`, `discounted_data`, `approved_status` , `discounted_mrc` , `approved_by`) VALUES ('{$data['id']}','{$data['discountedData']}','' , '{$data['discounted_upfront']}' , '{$data['approved_by']}')");
    //add new row to tbl_discounts and get the discount_id for use in tbl_quote_items
  }

  if ($query) {

    $insertId = (mysqli_insert_id($con)) ? mysqli_insert_id($con) : $data['id'];
    $arr = array(
      "Message" => "Discounting {$data['status']} Successfully",
      "quotationID" => $insertId
    );
    echo json_encode($arr); 
  } else {
    echo 'Error while storing data';
  }
    // print_r($data);
}
