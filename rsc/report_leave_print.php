<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

require('config.php');
require('header.php');
include("menu.php");

/* Get filter values */
$salesperson = $_POST['salesperson'] ?? '-';
$month       = $_POST['month'] ?? '-';
$year        = $_POST['year'] ?? '-';

/* Report title */
$title = "Leave Application Report";

/* Staff name (if selected) */
$staffName = "All Staff";

if($salesperson != "-"){
    $tmp = mysqli_fetch_assoc(
        mysqli_query($samb,
            "SELECT staffname FROM staff
             WHERE salesperson='$salesperson'")
    );
    $staffName = $tmp['staffname'] ?? '';
}
?>

<div class="page-container">

<h2><?php echo $title; ?></h2>

<div style="margin-bottom:10px;">
    <strong><?php echo $sysname ?? ''; ?></strong><br>
    Date Print : <?php echo date("d/m/Y"); ?>
</div>

<div style="margin-bottom:10px;">
    <strong>Staff :</strong> <?php echo $staffName; ?><br>
    <strong>Month :</strong>
    <?php echo ($month=="-" ? "All" : date("F", mktime(0,0,0,$month,1))); ?><br>
    <strong>Year :</strong> <?php echo ($year=="-" ? "All" : $year); ?>
</div>

<table>

<tr>
    <th>Num.</th>
    <th>Staff</th>
    <th>Leave Type</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Reason</th>
    <th>Status</th>
</tr>

<?php
$no = 1;

/* ===== Build query (same style as report_sales) ===== */

if ($salesperson=="-" && $month=="-" && $year=="-") {

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            ORDER BY l.start_date";

}
elseif ($salesperson!="-" && $month=="-" && $year=="-") {

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            WHERE l.salesperson='$salesperson'
            ORDER BY l.start_date";

}
elseif ($salesperson=="-" && $month!="-" && $year=="-") {

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            WHERE MONTH(l.start_date)='$month'
            ORDER BY l.start_date";

}
elseif ($salesperson=="-" && $month!="-" && $year!="-") {

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            WHERE MONTH(l.start_date)='$month'
              AND YEAR(l.start_date)='$year'
            ORDER BY l.start_date";

}
elseif ($salesperson=="-" && $month=="-" && $year!="-") {

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            WHERE YEAR(l.start_date)='$year'
            ORDER BY l.start_date";

}
elseif ($salesperson!="-" && $month!="-" && $year=="-") {

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            WHERE l.salesperson='$salesperson'
              AND MONTH(l.start_date)='$month'
            ORDER BY l.start_date";

}
elseif ($salesperson!="-" && $month=="-" && $year!="-") {

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            WHERE l.salesperson='$salesperson'
              AND YEAR(l.start_date)='$year'
            ORDER BY l.start_date";

}
else { // staff + month + year

    $sql = "SELECT l.*, s.staffname
            FROM leave_application l
            JOIN staff s ON l.salesperson=s.salesperson
            WHERE l.salesperson='$salesperson'
              AND MONTH(l.start_date)='$month'
              AND YEAR(l.start_date)='$year'
            ORDER BY l.start_date";
}

$data1 = mysqli_query($samb, $sql);
$record_count = mysqli_num_rows($data1);

if($record_count == 0){
?>
<tr>
    <td colspan="7" style="text-align:center; font-style:italic;">
        No record found.
    </td>
</tr>
<?php
}
else{
    while($row = mysqli_fetch_array($data1))
    {
        $start = date("d-m-Y", strtotime($row['start_date']));
        $end   = date("d-m-Y", strtotime($row['end_date']));
?>

<tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $row['staffname']; ?></td>
    <td><?php echo $row['leave_type']; ?></td>
    <td><?php echo $start; ?></td>
    <td><?php echo $end; ?></td>
    <td><?php echo $row['reason']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>

<?php
    $no++;
    }
}
?>

</table>

<br>

<div style="text-align:center;">
    <strong>* End Report *</strong><br>
    Record Count : <?php echo $record_count; ?>
</div>

<br>

<div style="text-align:center;">
    <a href="javascript:window.print()">Print Report</a>
</div>

</div>

<?php require('footer.php'); ?>