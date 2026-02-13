<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

<h2>Movie Rooms</h2>

<table>

<tr>
  <th colspan="4">
    <a href="room_add.php">+ Add New Movie Room</a>
  </th>
</tr>

<tr>
  <th>Num.</th>
  <th>Room Number</th>
  <th>Room Name</th>
  <th>Action</th>
</tr>

<?php
$data1 = mysqli_query($samb, "SELECT * FROM room ORDER BY idroom ASC");
$no = 1;

while($info1 = mysqli_fetch_array($data1))
{
?>
<tr>
  <td><?php echo $no; ?></td>
  <td><?php echo $info1['idroom']; ?></td>
  <td><?php echo $info1['roomname']; ?></td>
  <td>
    <a href="room_update.php?idroom=<?php echo $info1['idroom']; ?>">Update</a> |
    <a href="room_delete.php?idroom=<?php echo $info1['idroom']; ?>"
       onclick="return confirm('Delete this room?');">Delete</a>
  </td>
</tr>
<?php
  $no++;
}
?>

</table>

</div>

<?php require('footer.php'); ?>