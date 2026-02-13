<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

if($_SESSION['level']!="ADMIN"){
    header("Location:index2.php");
    exit();
}
?>

<div class="page-container">

<h2>Manage Leave Applications</h2>

<table>

<tr>
    <th>No</th>
    <th>Staff</th>
    <th>Leave Type</th>
    <th>Start</th>
    <th>End</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$no=1;

$sql="SELECT l.*, s.staffname
      FROM leave_application l
      JOIN staff s ON l.salesperson=s.salesperson
      ORDER BY l.start_date DESC";

$data=mysqli_query($samb,$sql);

while($row=mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['staffname']; ?></td>
    <td><?php echo $row['leave_type']; ?></td>
    <td><?php echo $row['start_date']; ?></td>
    <td><?php echo $row['end_date']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td>
        <a href="leave_update.php?id=<?php echo $row['idleave']; ?>">Review</a> |
        <a href="leave_delete.php?id=<?php echo $row['idleave']; ?>"
           onclick="return confirm('Delete this leave application?');">Delete</a>
    </td>
</tr>
<?php } ?>

</table>
</div>

<?php require('footer.php'); ?>