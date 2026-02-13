<?php
session_start();

require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

<h2>Leave Application Report</h2>

<form method="post" action="report_leave_print.php">

    <!-- Staff (optional) -->
    <label style="font-weight:600;">Staff (optional)</label><br>

    <select name="salesperson"
            style="width:220px;
                   padding:8px;
                   margin-top:6px;
                   margin-bottom:16px;">

        <!-- IMPORTANT: keep '-' for backend -->
        <option value="-" selected>All Staff</option>

        <?php
        $s = mysqli_query($samb,"SELECT salesperson, staffname FROM staff ORDER BY staffname");
        while($r = mysqli_fetch_assoc($s)){
            echo "<option value='{$r['salesperson']}'>
                    {$r['staffname']} ({$r['salesperson']})
                  </option>";
        }
        ?>
    </select>

    <br>

    <!-- Month (optional) -->
    <label style="font-weight:600;">Month (optional)</label><br>

    <select name="month"
            style="width:220px;
                   padding:8px;
                   margin-top:6px;
                   margin-bottom:16px;">

        <!-- IMPORTANT: keep '-' for backend -->
        <option value="-" selected>All Months</option>

        <?php
        for($m=1;$m<=12;$m++){
            echo "<option value='$m'>".date("F", mktime(0,0,0,$m,1))."</option>";
        }
        ?>
    </select>

    <br>

    <!-- Year (optional) -->
    <label style="font-weight:600;">Year (optional)</label><br>

    <select name="year"
            style="width:220px;
                   padding:8px;
                   margin-top:6px;
                   margin-bottom:20px;">

        <!-- IMPORTANT: keep '-' for backend -->
        <option value="-" selected>All Years</option>

        <?php
        $currentYear = date('Y');
        for($y = $currentYear; $y >= $currentYear-3; $y--){
            echo "<option value='$y'>$y</option>";
        }
        ?>
    </select>

    <br>

    <input type="submit"
           value="Generate Report"
           style="
             padding:8px 18px;
             background:#1f1450;
             color:#ffffff;
             border:none;
             border-radius:4px;
             cursor:pointer;
           ">

    <div style="margin-top:10px;color:#666;font-size:13px;">
        Tip: You may filter by staff, by month, by year, both month & year, or leave all as "All".
    </div>

</form>

</div>

<?php require('footer.php'); ?>