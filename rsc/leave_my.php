<?php
include("security.php");
require("config.php");
include("header.php");
include("menu.php");

$salesperson = $_SESSION['salesperson'];
?>

<div class="page-container">

<h2>My Leave Applications</h2>

<table>

<tr>
    <th>No</th>
    <th>Leave Type</th>
    <th>Start</th>
    <th>End</th>
    <th>Reason</th>
    <th>Status</th>
    <th>Admin Remark</th>
</tr>

<?php
$no=1;

$sql = "SELECT *
        FROM leave_application
        WHERE salesperson='$salesperson'
        ORDER BY start_date DESC";

$data = mysqli_query($samb,$sql);

while($row=mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['leave_type']; ?></td>
    <td><?php echo $row['start_date']; ?></td>
    <td><?php echo $row['end_date']; ?></td>
    <td><?php echo $row['reason']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo empty($row['admin_remark']) ? "-" : $row['admin_remark']; ?></td>
</tr>
<?php } ?>

</table>

</div>

<?php include("footer.php"); ?>