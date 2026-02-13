<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

<h2>Staff List</h2>

<table>
<tr>
  <th colspan="5">
  <!--<th colspan="5" style="text-align:left;">-->
    <a href="staff_add.php">+ Register New Staff</a>
  </th>
</tr>
<tr>
  <th>Num.</th>
  <th>Staff Name</th>
  <th>User Name</th>
  <th>Password</th>
  <th>Action</th>
</tr>

<?php
$data1 = mysqli_query($samb,"SELECT * FROM staff");
$no=1;

while ($info1 = mysqli_fetch_array($data1))
{
?>
<tr>
  <td><?php echo $no; ?></td>
  <td><?php echo $info1['staffname']; ?></td>
  <td><?php echo $info1['salesperson']; ?></td>
  <td><?php echo $info1['pass']; ?></td>
  <td>
    <a href="staff_update.php?staffid=<?php echo $info1['salesperson'];?>">Update</a>
    <?php if ($info1['level']!="ADMIN") { ?>
      | <a href="staff_delete.php?staffid=<?php echo $info1['salesperson'];?>"
           onclick="return confirm('Delete this staff?')">Delete</a>
    <?php } ?>
  </td>
</tr>
<?php
  $no++;
}
?>

</table>

</div>

<?php require('footer.php'); ?>