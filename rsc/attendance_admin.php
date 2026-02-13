<?php
session_start();
require("config.php");

if($_SESSION['level']!="ADMIN"){
    header("Location:index2.php");
    exit();
}

require("header.php");
include("menu.php");
?>

<style>
.status-present{ color:#1b7f3a; font-weight:600; }     /* green */
.status-late{ color:#b97700; font-weight:600; }        /* amber */
.status-early{ color:#1f5fbf; font-weight:600; }       /* blue */
.status-absent{ color:#b00020; font-weight:600; }      /* red */
</style>

<div class="page-container">

<h2>Manage Attendance Records</h2>

<table>

<tr>
    <th>No</th>
    <th>Staff</th>
    <th>Date</th>
    <th>Check-In Time</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$no = 1;

$sql = "
    SELECT a.*, s.staffname
    FROM attendance a
    JOIN staff s ON a.salesperson = s.salesperson
    ORDER BY a.attend_date DESC, a.checkin_time DESC
";

$data = mysqli_query($samb,$sql);

while($row = mysqli_fetch_assoc($data)){
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['staffname']; ?> (<?php echo $row['salesperson']; ?>)</td>
    <td><?php echo $row['attend_date']; ?></td>
    <td><?php echo $row['checkin_time']; ?></td>
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
    <td>
        <a href="attendance_update.php?id=<?php echo $row['idattendance']; ?>">Edit</a>
    </td>
</tr>

<?php } ?>

</table>

</div>

<?php require("footer.php"); ?>