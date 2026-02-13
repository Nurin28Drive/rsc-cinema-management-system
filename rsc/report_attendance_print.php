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

/* Staff name */
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

<style>
.status-present{ color:#1b7f3a; font-weight:600; }     /* green */
.status-late{ color:#b97700; font-weight:600; }        /* amber */
.status-early{ color:#1f5fbf; font-weight:600; }       /* blue */
.status-absent{ color:#b00020; font-weight:600; }      /* red */
</style>

<div class="page-container">

<h2>Attendance Report</h2>

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
    <th>Date</th>
    <th>Check-in Time</th>
    <th>Status</th>
</tr>

<?php
$no = 1;

/* ===== Build query (same structure as leave & sales reports) ===== */

if ($salesperson=="-" && $month=="-" && $year=="-") {

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            ORDER BY a.attend_date";

}
elseif ($salesperson!="-" && $month=="-" && $year=="-") {

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            WHERE a.salesperson='$salesperson'
            ORDER BY a.attend_date";

}
elseif ($salesperson=="-" && $month!="-" && $year=="-") {

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            WHERE MONTH(a.attend_date)='$month'
            ORDER BY a.attend_date";

}
elseif ($salesperson=="-" && $month!="-" && $year!="-") {

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            WHERE MONTH(a.attend_date)='$month'
              AND YEAR(a.attend_date)='$year'
            ORDER BY a.attend_date";

}
elseif ($salesperson=="-" && $month=="-" && $year!="-") {

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            WHERE YEAR(a.attend_date)='$year'
            ORDER BY a.attend_date";

}
elseif ($salesperson!="-" && $month!="-" && $year=="-") {

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            WHERE a.salesperson='$salesperson'
              AND MONTH(a.attend_date)='$month'
            ORDER BY a.attend_date";

}
elseif ($salesperson!="-" && $month=="-" && $year!="-") {

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            WHERE a.salesperson='$salesperson'
              AND YEAR(a.attend_date)='$year'
            ORDER BY a.attend_date";

}
else { // staff + month + year

    $sql = "SELECT a.*, s.staffname
            FROM attendance a
            JOIN staff s ON a.salesperson=s.salesperson
            WHERE a.salesperson='$salesperson'
              AND MONTH(a.attend_date)='$month'
              AND YEAR(a.attend_date)='$year'
            ORDER BY a.attend_date";
}

$data1 = mysqli_query($samb, $sql);
$record_count = mysqli_num_rows($data1);

if($record_count == 0){
?>
<tr>
    <td colspan="5" style="text-align:center; font-style:italic;">
        No record found.
    </td>
</tr>
<?php
}
else{
    while($row = mysqli_fetch_array($data1))
    {
        $date = date("d-m-Y", strtotime($row['attend_date']));

        if ($row['checkin_time'] === NULL) {
            $time = '-';
        } else {
            $time = date("g:i a", strtotime($row['checkin_time']));
        }
?>

<tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $row['staffname']; ?></td>
    <td><?php echo $date; ?></td>
    <td><?php echo $time; ?></td>
    <td>
        <?php
        $class = '';

        $statusText = $row['status'];

        if(strpos($statusText,'Absent') !== false){
            $class = 'status-absent';
        }
        else if(strpos($statusText,'Early Leave') !== false){
            $class = 'status-early';
        }
        else if(strpos($statusText,'Late') !== false){
            $class = 'status-late';
        }
        else if(strpos($statusText,'Present') !== false){
            $class = 'status-present';
        }
        ?>
        <span class="<?php echo $class; ?>">
            <?php echo $row['status']; ?>
        </span>
    </td>
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