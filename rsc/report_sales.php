<?php
session_start();

require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

<h2>Transaction Sales Report</h2>

<form method="post" action="report_sale_print.php">

    <!-- Month -->
    <label style="font-weight:600;">Month (optional)</label><br>

    <select name="month"
            style="width:220px;
                   padding:8px;
                   margin-top:6px;
                   margin-bottom:16px;">

        <!-- IMPORTANT: keep '-' for backend -->
        <option value="-" selected>All Months</option>

        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>

    <br>

    <!-- Year -->
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
        for($y = $currentYear; $y >= 2019; $y--){
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
        Tip: Leave both fields as "All" to print the full sales report.
    </div>

</form>

</div>

<?php require('footer.php'); ?>