<?php


require '../model/database.php';
if ( $_POST['login_btn'] == 'Login') {
    $UserName = $_POST['login_uname'];
    $user_pass = md5($_POST['login_pass']);

    $login_query = mysqli_query($con, "SELECT * FROM `login_master` where `username` LIKE '%{$UserName}%' AND `password` LIKE '{$user_pass}' ;");
    $login_data = mysqli_fetch_assoc($login_query);

    
    
    if (!empty($login_data['id'])) {
        session_start();
        $_SESSION['uname'] = $UserName;
        $_SESSION['emp_code'] = $login_data['employee_code'];
        $_SESSION['crmId'] = $login_data['crm_user_id'];
        try{
            header('Location: ../index.php');
        }catch(Exception  $e){

        }
        // echo "<script>window.location.href = '../index.php';</script>";

    } 
    else {
        echo "<script>alert('Please enter Valid Information'); window.location.href = '../login.php';</script>";
    }
}
