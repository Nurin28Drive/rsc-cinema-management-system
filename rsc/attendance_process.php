<?php
include("security.php");
require("config.php");

date_default_timezone_set("Asia/Kuala_Lumpur");

$salesperson = $_SESSION['salesperson'];
$today = date("Y-m-d");
$time  = date("H:i:s");

$workStart = "09:00:00";

/* prevent duplicate check-in */
$chk = mysqli_query($samb,
    "SELECT idattendance
     FROM attendance
     WHERE salesperson='$salesperson'
       AND attend_date='$today'");

if(mysqli_num_rows($chk) > 0){
    header("Location:attendance.php");
    exit();
}

/* status */
$status = ($time > $workStart) ? "Late" : "Present";

/* insert check-in only */
mysqli_query($samb,
    "INSERT INTO attendance
     (salesperson, attend_date, checkin_time, status)
     VALUES
     ('$salesperson','$today','$time','$status')"
);

header("Location:attendance.php");
exit();