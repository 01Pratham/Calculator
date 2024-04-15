<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Location: index.php");
    unset($_SESSION['post_data']);
}
if (!isset($_SESSION['emp_code'])) {
    require "../view/session_expired.php";
    exit();
}
$_SESSION['post_data'] = $_POST;

$ProjectTotal = array();
$MothlyTotal = array();
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
    <link rel="stylesheet" href="../css/loader.css">
</head>

<body class="sidebar-mini layout-fixed sidebar-collapse" data-new-gr-c-s-check-loaded="14.1111.0" data-gr-ext-installed style="height: auto; overflow-x: hidden;">
    <?php
    require "../view/includes/nav.php";
    // PPrint($_SERVER);

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
                $("#loader").addClass("d-none");
            })
        </script>
        <?php
        require '../view/content-header.php';

        contentHeader('Quotation');
        ?>
        <div class="content Main except ">
            <div class="container-fluid except full" style="zoom : 65%">
                <div class="errors except container" style="max-width: 2020px; margin: auto; "> </div>
                <?php
                if (!empty($_SESSION['edit_id'])) {
                    $EDITID = !empty($_POST['edit_id']) ? $_POST['edit_id'] : $_SESSION['edit_id'];
                    $D = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_discount_data` WHERE `quot_id` = '" . $EDITID . "'"));
                    if (!empty($D)) {
                        $_DiscountedData = json_decode($D['discounted_data'], true);
                        if ($D["approved_status"] == "Approved" || intval($D["discounted_mrc"]) == 0) {
                            $DISC = true;
                        } else {
                            $DISC = false;
                        }
                    } else {
                        $DISC = null;
                    }
                }
                ?>
                <div class="except" id="tbl_div">
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

                    <?php
                    require '../view/Table.php';
                    require '../view/summary_table.php';
                    ?>
                </div>
                <div class="container except d-flex justify-content-center mt-3 py-3">
                    <button class="btn btn-outline-danger btn-lg mx-1 export" id="pdf"><i class="fa fa-file-pdf-o pr-2"></i> Export PDF</button>
                    <?php
                    if (UserRole(1)) {
                    ?>
                        <button class="btn btn-outline-success btn-lg mx-1 export" id="export"><i class="fa fa-file-excel-o pr-2"></i> Export</button>
                    <?php
                    }
                    if (is_null($DISC)) {
                    ?>
                        <button class="btn btn-outline-primary btn-lg mx-1" id="push" onclick="Push()"><i class="fab fa-telegram-plane pr-2" aria-hidden="true"></i>Push</button>
                    <?php
                    } elseif ($DISC) {
                    ?>
                        <button class="btn btn-outline-primary btn-lg mx-1" id="push" onclick="Push()"><i class="fab fa-telegram-plane pr-2" aria-hidden="true"></i>Push</button>
                        <?php
                    } else {
                        if (UserRole(12) || employee($_SESSION['emp_code'])['applicable_discounting_percentage']) { ?>
                            <button class="btn btn-outline-success btn-lg mx-1" id="push" onclick="updateStatus('Approved' , <?= $_SESSION['emp_code'] ?>)"><i class="fa fa-check pr-2" aria-hidden="true"></i>Approve</button>
                            <button class="btn btn-outline-danger btn-lg mx-1" id="push" onclick="updateStatus('Rejected' , <?= $_SESSION['emp_code'] ?>)"><i class="fa fa-times pr-2" aria-hidden="true"></i>Reject</button>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-outline-primary btn-lg mx-1" id="push" onclick="updateStatus('Remaining')"><i class="fab fa-telegram-plane pr-2" aria-hidden="true"></i>Send for Approval</button>
                        <?php
                        }
                    }
                    if (UserRole(1)) {
                        ?>
                        <button class="btn btn-outline-success btn-lg mx-1 export" id="exportShareable"><i class="fa fa-file-excel-o pr-2"></i> Export as Shareable</button>
                    <?php
                    }
                    $query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tbl_saved_estimates` WHERE `id` = '{$_SESSION['edit_id']}'"));
                    if (isset($_SESSION["edit_id"])) {
                    ?>
                        <button class="btn btn-outline-danger btn-lg mx-1 save" id="update"><i class="fas fa-refresh pr-2"></i> Update</button>
                        <a class="btn btn-outline-info btn-lg mx-1" id="Discount" target="_blank" href="discounting.php?id=<?= $_SESSION['edit_id'] ?>"><i class="fa fa-calculator pr-2" aria-hidden="true"> Discounting</i></a>
                    <?php
                    } else { ?>
                        <button class="btn btn-outline-danger btn-lg mx-1 save" id="save"><i class="fas fa-save pr-2"></i> Save</button>
                    <?php } ?>

                </div>
                <?php
                $temp =  json_encode(json_template($Sku_Data, $I_M), JSON_PRETTY_PRINT);
                // PPrint($temp)
                ?>
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
        let $_Prices = JSON.parse('<?= json_encode($_Prices) ?>');

        function updateStatus(status, approved_by = '') {
            $.ajax({
                type: 'POST',
                url: "../model/saveToDB.php",
                dataType: "TEXT",
                data: {
                    id: '<?= $_SESSION['edit_id'] ?>',
                    action: 'UpdateDiscountingStatus',
                    status: status,
                    approved_by: approved_by
                },
                success: function(response) {
                    alert(response);
                    window.location.reload()
                }
            })
        }
        <?php
        echo "let sheetNames = {";
        $i = 1;
        foreach ($estmtname as $key => $val) {
            echo "'sheet{$i}' : '{$val}' ,";
            $i++;
        }
        echo "sheet{$i} : 'Summary Sheet'
            }
            ";
        ?>
        <?php if (UserRole(1)) { ?>
            $(document).ready(function() {
                $("#export").click(function() {
                    var tables = document.querySelectorAll('table');
                    convertTablesToExcel(Array.from(tables), "unShareable", sheetNames, "<?= $_POST['project_name'] ?>");
                });
                $("#exportShareable").click(function() {
                    var tables = document.querySelectorAll('table');
                    convertTablesToExcel(Array.from(tables), "Shareable", sheetNames, "<?= $_POST['project_name'] ?>");
                });
            });
        <?php } else {
            // echo '$(".export").remove();';
        } ?>

        function insertBrTags(string) {
            if (string.length > 160) {
                let chunks = [];
                for (let i = 0; i < string.length; i += 160) {
                    chunks.push(string.substr(i, 160));
                }
                return chunks.join("<br>");
            }
            return string;
        }

        $("#pdf").click(function() {
            // var htmlContent = $("#tbl_div").find("*:not(.noExl)").prop('outerHTML');;
            var content = $("#tbl_div").clone();
            // Remove elements with the class .except
            content.find('.noExl').remove();
            content.find(".final-tbl").attr("style", "zoom:75%; width:100%")
            content.find(".line td").each(function() {
                let line = $(this).html();
                if (line.length > 160) {
                    let new_line = insertBrTags(line)
                    $(this).html(new_line);
                }
            })
            // Get the HTML content of the modified element
            let htmlContent = content.prop('outerHTML');
            // console.log(htmlContent)
            $.ajax({
                url: '../controller/getPDF.php',
                method: 'POST',
                data: {
                    htmlContent: htmlContent.replace(/₹/g, "<span style='font-family: DejaVu Sans; sans-serif; background: transparent;'>&#8377;</span>")
                },
                success: function(response) {
                    window.open(response, '_blank')
                    setTimeout(function() {
                        $.ajax({
                            url: '../controller/getPDF.php',
                            method: 'POST',
                            data: {
                                deleteFileUrl: response
                            },
                            success: function(res) {
                                return;
                            }
                        })
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
        $('.save').click(function() {
            if ($(this).prop("id") == "save") {
                $("#loader").removeAttr("hidden")
            }
            saveToDb($(this).prop("id"));
        })

        function saveToDb(act, ty = "btn") {
            $.ajax({
                type: "POST",
                url: '../model/saveToDB.php',
                data: {
                    'action': act,
                    'emp_id': <?= $_SESSION['emp_code'] ?>,
                    'data': '<?= json_encode($EstmDATA) ?>',
                    'priceData': JSON.stringify($_Prices),
                    'total': '<?= array_sum($ProjectTotal) ?>',
                    'pot_id': '<?= $_POST['pot_id'] ?>',
                    'project_name': '<?= $_POST['project_name'] ?>',
                    'period': '<?= $_POST[1]["period"] ?>',
                },
                dataType: "TEXT",
                success: function(response) {
                    const jsonObj = JSON.parse(response)
                    if (ty == "btn") {
                        alert(jsonObj.Message)
                        location.reload()
                    }
                }
            });
        }

        <?php
        if (isset($_SESSION["edit_id"])) {
        ?>
            saveToDb("update", "auto");
        <?php } ?>

        function Push() {
            $.ajax({
                type: 'POST',
                url: "../controller/push.php",
                dataType: "TEXT",
                data: {
                    action: 'push',
                    data: '<?= base64_encode($temp) ?>'
                },
                success: function(response) {
                    alert(response);
                }
            });
        }
    </script>
</body>

</html>