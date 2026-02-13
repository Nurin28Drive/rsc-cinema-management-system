<?php
session_start();
require("config.php");

if($_SESSION['level']!="ADMIN"){
    header("Location:index2.php");
    exit();
}

/* =========================
   POST : update record
   ========================= */
if(isset($_POST['idattendance'])){

    $idattendance = $_POST['idattendance'];
    $attend_date  = $_POST['attend_date'];
    $checkin_time = $_POST['checkin_time'];
    $status       = $_POST['status'];

    mysqli_query($samb,
        "UPDATE attendance
         SET attend_date='$attend_date',
             checkin_time='$checkin_time',
             status='$status'
         WHERE idattendance='$idattendance'"
    );

    header("Location:attendance_admin.php");
    exit();
}

/* =========================
   GET : show edit page
   ========================= */

if(!isset($_GET['id'])){
    header("Location:attendance_admin.php");
    exit();
}

$id = $_GET['id'];

$data = mysqli_query($samb,
    "SELECT a.*, s.staffname
     FROM attendance a
     JOIN staff s ON a.salesperson=s.salesperson
     WHERE a.idattendance='$id'"
);

$row = mysqli_fetch_assoc($data);

require("header.php");
include("menu.php");
?>

<div class="page-container">

<h2>Edit Attendance Record</h2>

<form method="post" action="attendance_update.php">

<input type="hidden" name="idattendance"
       value="<?php echo $row['idattendance']; ?>">

<table style="max-width:600px;">

<tr>
    <td>Staff</td>
    <td><?php echo $row['staffname']; ?> (<?php echo $row['salesperson']; ?>)</td>
</tr>

<tr>
    <td>Date</td>
    <td>
        <input type="date" name="attend_date"
               value="<?php echo $row['attend_date']; ?>" required>
    </td>
</tr>

<tr>
    <td>Check-In Time</td>
    <td>
        <input type="time" name="checkin_time"
               value="<?php echo $row['checkin_time']; ?>" required>
    </td>
</tr>

<tr>
    <td>Status</td>
    <td>
        <select name="status" required>
            <option value="Present" <?php if($row['status']=="Present") echo "selected"; ?>>Present</option>
            <option value="Late" <?php if($row['status']=="Late") echo "selected"; ?>>Late</option>
            <option value="Absent" <?php if($row['status']=="Absent") echo "selected"; ?>>Absent</option>
        </select>
    </td>
</tr>

<tr>
    <td></td>
    <td>
        <input type="submit" value="Update">
        <a href="attendance_admin.php">Back</a>
    </td>
</tr>

</table>

</form>

</div>

<?php require("footer.php"); ?>