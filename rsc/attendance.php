<?php
include("security.php");
require("config.php");

date_default_timezone_set("Asia/Kuala_Lumpur");

include("header.php");
include("menu.php");

$salesperson = $_SESSION['salesperson'];
$today = date("Y-m-d");

/* get staff name */
$staffQ = mysqli_query($samb,
    "SELECT staffname FROM staff WHERE salesperson='$salesperson'");
$staff  = mysqli_fetch_assoc($staffQ);

/* get today attendance row */
$chk = mysqli_query($samb,
    "SELECT *
     FROM attendance
     WHERE salesperson='$salesperson'
       AND attend_date='$today'");

$attendance = mysqli_fetch_assoc($chk);
?>

<div class="page-container">

<h2>Attendance Check-In</h2>

<div style="max-width:520px;margin:auto;">

<div style="
    padding:14px;
    background:#f7f8fd;
    border-left:6px solid #1f1450;
    border-radius:6px;
    margin-bottom:18px;
">

<strong>Staff :</strong> <?php echo $staff['staffname']; ?> (<?php echo $salesperson; ?>)<br>
<strong>Date :</strong> <?php echo date("d M Y"); ?><br>
<strong>Time :</strong> <span id="clock"></span>

</div>

<?php
/* -------------------------
   No record → Check in
   ------------------------- */
if(!$attendance){
?>

<form method="post" action="attendance_process.php">

    <div style="
        padding:18px;
        background:#ffffff;
        border-radius:8px;
        border:1px solid #d1d5e3;
        text-align:center;
    ">

        <p style="margin-bottom:16px;color:#555;">
            Click the button below to record your attendance.
        </p>

        <input type="submit" value="Check In Now"
               style="
                 padding:12px 28px;
                 font-size:15px;
                 background:#1f1450;
                 color:white;
                 border:none;
                 border-radius:6px;
                 cursor:pointer;
               ">

    </div>

</form>

<?php
}
/* -------------------------
   Checked in but not yet checkout → Check out
   ------------------------- */
else if($attendance['checkout_time'] === NULL){
?>

<form method="post" action="attendance_checkout_process.php">

    <div style="
        padding:18px;
        background:#ffffff;
        border-radius:8px;
        border:1px solid #d1d5e3;
        text-align:center;
    ">

        <p style="margin-bottom:10px;color:#555;">
            You checked in at
            <strong><?php echo $attendance['checkin_time']; ?></strong>
        </p>

        <input type="submit" value="Check Out Now"
               style="
                 padding:12px 28px;
                 font-size:15px;
                 background:#198754;
                 color:white;
                 border:none;
                 border-radius:6px;
                 cursor:pointer;
               ">

    </div>

</form>

<?php
}
/* -------------------------
   Completed
   ------------------------- */
else{
?>

<div style="
    padding:16px;
    background:#e6f4ea;
    border:1px solid #b7dfc1;
    border-radius:6px;
    color:#256029;
    text-align:center;
    font-weight:600;
">
    Attendance completed.<br>
    Check-in : <?php echo $attendance['checkin_time']; ?><br>
    Check-out : <?php echo $attendance['checkout_time']; ?><br>
    Status : <?php echo $attendance['status']; ?>
</div>

<?php } ?>

</div>

</div>

<script>
function updateClock(){
    const now = new Date();
    document.getElementById("clock").innerHTML =
        now.toLocaleTimeString();
}
setInterval(updateClock,1000);
updateClock();
</script>

<?php include("footer.php"); ?>