<?php
session_start();
include("security.php");
require("config.php");
require("header.php");

$salesperson = $_SESSION['salesperson'];
$role        = $_SESSION['level'];

$staffName = "";
$q = mysqli_query($samb,"SELECT staffname FROM staff WHERE salesperson='$salesperson'");
$r = mysqli_fetch_assoc($q);
$staffName = $r['staffname'] ?? "";

date_default_timezone_set("Asia/Kuala_Lumpur");
$today = date("Y-m-d");

include("menu.php");
?>

<div class="page-container">

<h2>Welcome, <?php echo $staffName; ?> 👋</h2>
<p>You are logged in as <strong><?php echo $role; ?></strong>.</p>

<hr>

<?php if($role == "STAFF"){ ?>

<?php
$att = mysqli_query($samb,
    "SELECT * FROM attendance
     WHERE salesperson='$salesperson'
       AND attend_date='$today'"
);
$attInfo = mysqli_fetch_assoc($att);
?>

<h3>Today Attendance Status</h3>

<?php if($attInfo){ ?>

    <p>
        You have checked in at
        <strong><?php echo date("g:i a",strtotime($attInfo['checkin_time'])); ?></strong><br>
        Status :
        <strong><?php echo $attInfo['status']; ?></strong>
    </p>

<?php }else{ ?>

    <p style="color:#c0392b;">
        You have not checked in today.
    </p>

<?php } ?>


<?php } else { ?>

<?php
$totalToday = mysqli_fetch_row(
    mysqli_query($samb,
        "SELECT COUNT(*) FROM attendance
         WHERE attend_date='$today'")
)[0];

$lateToday = mysqli_fetch_row(
    mysqli_query($samb,
        "SELECT COUNT(*) FROM attendance
         WHERE attend_date='$today' AND status='LATE'")
)[0];

$pendingLeave = mysqli_fetch_row(
    mysqli_query($samb,
        "SELECT COUNT(*) FROM leave_application
         WHERE status='PENDING'")
)[0];
?>

<h3>Today Overview</h3>

<ul>
    <li>Total staff checked-in today : <strong><?php echo $totalToday; ?></strong></li>
    <li>Total late today : <strong><?php echo $lateToday; ?></strong></li>
    <li>Pending leave applications : <strong><?php echo $pendingLeave; ?></strong></li>
</ul>

<?php } ?>

<hr>

<div style="font-size:13px;color:#666;">
System date : <?php echo date("d M Y, g:i a"); ?>
</div>

</div>

<?php require("footer.php"); ?>