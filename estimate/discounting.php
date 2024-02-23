<?php
if (isset($_GET['id'])) {
    session_start();
    if (!isset($_SESSION['emp_code'])) {
        require "../view/session_expired.php";
        exit();
    }
    $ProjectTotal = array();
    $MothlyTotal = array();
    $_SESSION["edit_id"] = $_GET['id']; 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        require '../controller/constants.php';
        require '../model/database.php';
        require '../controller/json_format.php';
        require '../controller/Currency_Format.php';
        require '../view/includes/header.php';
        ?>
        <link rel="stylesheet" href="../css/submit.css">
    </head>

    <body class="sidebar-mini layout-fixed sidebar-collapse" data-new-gr-c-s-check-loaded="14.1111.0" data-gr-ext-installed style="height: auto; overflow-x: hidden;">
        <?php
        require "../view/includes/nav.php";
        if (UserRole(3) || employee($_SESSION['emp_code'])["applicable_discounting_percentage"] != 0) {
        ?>
            <div class="content-wrapper except bg-transparent">
                <div id="loader" class="except">
                    <div class="except cube-folding">
                        <span class="except leaf1"></span>
                        <span class="except leaf2"></span>
                        <span class="except leaf3"></span>
                        <span class="except leaf4"></span>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#loader").addClass("d-none")
                    });
                </script>
                <?php
                require '../view/content-header.php';
                contentHeader('Quotation / Discounting');
                ?>
                <div class="content Main except ">
                    <div class="container-fluid except full" style="zoom : 65%">
                        <div class="errors except container" style="max-width: 2020px; margin: auto; "> </div>

                        <?php
                        if (isset($_GET["id"])) {
                            $Quer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `id` = '{$_GET['id']}'"));
                            $data_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_discount_data` WHERE `quot_id` = '{$_GET['id']}'"));
                            if (!empty($Quer['data'])) {
                                require "../controller/constants.php";
                                $_Prices = json_decode($Quer['prices'], true);
                                $_Data = json_decode($Quer['data'], true);
                                $_SESSION['post_data'] = $_Data;
                                $_DiscountedData = json_decode($data_query["discounted_data"], true);
                                require '../view/DiscountingTable.php';
                            }
                        }
                        ?>
                        <div class="container except d-flex justify-content-center mt-3 py-3">
                            <button class="btn btn-outline-success btn-lg mx-1 export" id="export"><i class="fa fa-file-excel-o pr-2"></i> Export</button>
                            <!-- <button class="btn btn-outline-primary btn-lg mx-1" id="push" onclick="Push()"><i class="fab fa-telegram-plane pr-2" aria-hidden="true"></i>Push</button> -->
                            <!-- <button class="btn btn-outline-success btn-lg mx-1 export" id="exportShareable"><i class="fa fa-file-excel-o pr-2"></i> Export as Shareable</button> -->
                            <button class="btn btn-outline-danger btn-lg mx-1 save" id="update"><i class="fas fa-refresh pr-2"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            require '../view/includes/footer.php';
            ?>
            <script src="../javascript/jquery-3.6.4.js"></script>
            <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


            <script>
                $('.nav-link').removeClass('active')
                $('#create').addClass('active');

                $(document).ready(function() {
                    $("#loader").addClass("d-none");
                })

                function Push() {
                    $.ajax({
                        type: 'POST',
                        url: "../controller/push.php",
                        dataType: "TEXT",
                        data: {
                            action: 'push',

                        },
                        success: function(response) {
                            alert(response);
                        }
                    })
                }
                <?php
                if (UserRole("3")) { ?>
                    $('.discount').attr('contentEditable', 'true')
                    var mrc = $('#vm-mrc').html();
                    $(".discount").keypress(function(e) {
                        var key = e.keyCode || e.charCode;
                        if (key == 13) {
                            $(this).blur();
                            $(this).html();
                        }
                    })

                <?php
                }
                $i = 1;
                echo "let sheetNames = {";
                foreach ($estmtname as $key => $val) {
                    echo "'sheet{$i}' : '{$val}' ,";
                    $i++;
                }
                echo "sheet{$i} : 'Summary Sheet'";
                echo "}";
                ?>

                $(document).ready(function() {
                    $("#export").click(function() {
                        var tables = document.querySelectorAll('table');
                        convertTablesToExcel(Array.from(tables), "unShareable", sheetNames, "<?= $EstmDATA['project_name'] ?>");
                    });
                    $("#exportShareable").click(function() {
                        var tables = document.querySelectorAll('table');
                        convertTablesToExcel(Array.from(tables), "Shareable", sheetNames, "<?= $EstmDATA['project_name'] ?>");
                    });
                });

                function remAlert() {
                    $('.alert').remove();
                }
                $('.save').click(function() {
                    let TotalDiscountedMrc = 0;
                    $(".MonthlyDiscounted").each(function(){
                        TotalDiscountedMrc += $(this).data('value')
                    });
                    $.ajax({
                        type: "POST",
                        url: '../model/saveToDB.php',
                        data: {
                            'action': "Discount",
                            'emp_id': <?= $_SESSION['emp_code'] ?>,
                            'id': '<?= $_GET['id'] ?>',
                            "discountedData": JSON.stringify(DiscountedData),
                            "discounted_upfront": TotalDiscountedMrc
                        },
                        dataType: "TEXT",
                        success: function(response) {
                            alert(response);
                        }
                    });
                })

                $(document).ready(function() {
                    $('.full').find('.mng_qty').each(function() {
                        var tr_val = $(this).html()
                        if (tr_val == "0 NO") {
                            $(this).parent().find('td').each(function() {
                                $(this).addClass('bg-danger')
                            })
                        }
                    })
                })
                // window.addEventListener('beforeunload',
                //     function(e) {
                //         let conf = confirm("Are You sure want to unsave this Estimate ? ");
                //         if (conf) {} else {
                //             e.preventDefault();
                //             e.returnValue = '';
                //         }
                //     });
            </script>
        <?php } else {
            require "../view/PageNotFound.php";
        } ?>
    </body>

    </html>


<?php

}
?>