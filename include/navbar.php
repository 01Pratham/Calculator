  <nav class="main-header navbar navbar-expand navbar-light" style="height: 4.1rem;">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="aside-bar nav-funcs " id="" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars aside-bar"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a id="notification-bell" class="nav-funcs " role="button"><i class="fas fa-bell" style="<?= (UserRole(12) || !employee($_SESSION['emp_code'])['applicable_discounting_percentage'] == 0) ? "" : 'opacity: 0' ?>"></i></a>
      </li>
      <?php if (UserRole(12) || !employee($_SESSION['emp_code'])['applicable_discounting_percentage'] == 0) { ?>
        <div id="notification-box" class="notification-box">
          Discount to be Approved
          <?php
          $Query = Query("SELECT * FROM `tbl_discount_data` WHERE `approved_status` = 'Remaining'");
          while ($n = mysqli_fetch_assoc($Query)) {
          ?>
            <a href="?edit_id=<?= $n['quot_id'] ?>" class="notifications-item">
              <div class="text">
                <h4><?= getEstimateDetails($n['quot_id'])['project_name'] ?></h4>
                <p><?= employee(getEstimateDetails($n['quot_id'])['emp_code'])["first_name"] ?></p>
              </div>
            </a>
          <?php
          }
          ?>
        </div>
      <?php } ?>
    </ul>
    <ul class="navbar-nav " style="margin-left: calc(100% - 12.6rem);">
      <li class="nav-item d-sm-inline-block">
        <input type="checkbox" name="" id="mode" hidden>
        <a id="modeIcon" class="nav-funcs " role="button" onclick="$('#mode').click()"><i class="fa fa-sun"></i></a>
        <!-- <label for="mode" class="except "><i class="fas fa-sun"></i></label> -->
      </li>
    </ul>
  </nav>

  <script>
    $(document).ready(function() {
      $("#notification-bell").on("click", function(e) {
        e.stopPropagation();
        $("#notification-box").toggleClass("show");
      });
      $(document).on("click", function(e) {
        if (!$("#notification-bell").is(e.target) && !$("#notification-box").has(e.target).length) {
          $("#notification-box").removeClass("show");
        }
        if (!$(".aside-bar").is(e.target) && !$("aside").has(e.target).length) {
          $("body").addClass("sidebar-collapse");
        }
      });
    });
  </script>
