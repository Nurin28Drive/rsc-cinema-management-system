<?php
include("security.php");
require("config.php");

date_default_timezone_set("Asia/Kuala_Lumpur");

$salesperson = $_SESSION['salesperson'];
$today = date("Y-m-d");
$time  = date("H:i:s");

/* office end time */
$workEnd = "17:00:00";

/* get today attendance */
$q = mysqli_query($samb,
    "SELECT idattendance, status
     FROM attendance
     WHERE salesperson='$salesperson'
       AND attend_date='$today'
       AND checkout_time IS NULL"
);

if(mysqli_num_rows($q) == 0){
    header("Location:attendance.php");
    exit();
}

$row = mysqli_fetch_assoc($q);

$newStatus = $row['status'];

/* early leave rule */
if($time < $workEnd){

    if(strpos($newStatus, 'Early Leave') === false){
        $newStatus = $newStatus . " + Early Leave";
    }
}

mysqli_query($samb,
    "UPDATE attendance
     SET checkout_time='$time',
         status='$newStatus'
     WHERE idattendance='".$row['idattendance']."'");

header("Location:attendance.php");
exit();