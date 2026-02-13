<?php
include("security.php");
require("config.php");
include("header.php");
include("menu.php");

$salesperson = $_SESSION['salesperson'];

/* ================================
   Auto mark Absent for yesterday
   (working days only)
   ================================ */

date_default_timezone_set("Asia/Kuala_Lumpur");

$yesterday = '2026-01-26'; // test data
//$yesterday = date('Y-m-d', strtotime('-1 day'));
$dayOfWeek = date('N', strtotime($yesterday)); // 1=Mon ... 7=Sun

if($dayOfWeek <= 5){

    $chkAbsent = mysqli_query($samb,
        "SELECT idattendance
         FROM attendance
         WHERE salesperson='$salesperson'
           AND attend_date='$yesterday'"
    );

    if(mysqli_num_rows($chkAbsent) == 0){

        mysqli_query($samb,
            "INSERT INTO attendance
             (salesperson, attend_date, checkin_time, checkout_time, status)
             VALUES
             ('$salesperson','$yesterday',NULL,NULL,'Absent')"
        );
    }
}

?>

<style>
.status-present{ color:#1b7f3a; font-weight:600; }     /* green */
.status-late{ color:#b97700; font-weight:600; }        /* amber */
.status-early{ color:#1f5fbf; font-weight:600; }       /* blue */
.status-absent{ color:#b00020; font-weight:600; }      /* red */
</style>

<div class="page-container">

<h2>My Attendance Records</h2>

<table>

<tr>
    <th>No</th>
    <th>Date</th>
    <th>Check-In Time</th>
    <th>Check-Out Time</th>
    <th>Status</th>
</tr>

<?php
$no = 1;

$sql = "SELECT *
        FROM attendance
        WHERE salesperson = '$salesperson'
        ORDER BY attend_date DESC";

$data = mysqli_query($samb,$sql);

while($row = mysqli_fetch_assoc($data)){
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['attend_date']; ?></td>
    <td>
        <?php
        echo ($row['checkin_time']==NULL) ? '-' : $row['checkin_time'];
        ?>
    </td>
    <td>
        <?php
        echo ($row['checkout_time']==NULL) ? '-' : $row['checkout_time'];
        ?>
    </td>
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

<?php } ?>

</table>

</div>

<?php include("footer.php"); ?>