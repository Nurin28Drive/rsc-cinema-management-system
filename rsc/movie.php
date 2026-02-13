<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

<h2>Movie List</h2>

<table>
<tr>
  <th colspan="5">
    <a href="movie_add.php">+ Add New Movie</a>
  </th>
</tr>

<tr>
  <th>Num.</th>
  <th>Title</th>
  <th>Poster</th>
  <th>Date Added</th>
  <th>Action</th>
</tr>

<?php
$data1 = mysqli_query($samb, "SELECT * FROM movie ORDER BY dateadd ASC");
$no = 1;

while($info1 = mysqli_fetch_array($data1))
{
?>
<tr>
  <td><?php echo $no; ?></td>
  <td><?php echo $info1['title']; ?></td>
  <td>
    <img src="picture/<?php echo $info1['screen']; ?>" class="poster-thumb">
  </td>
  <td><?php echo $info1['dateadd']; ?></td>
  <td>
    <a href="movie_update.php?idmovie=<?php echo $info1['idmovie']; ?>">Update</a> |
    <a href="movie_delete.php?idmovie=<?php echo $info1['idmovie']; ?>"
       onclick="return confirm('Delete this movie?');">Delete</a>
  </td>
</tr>
<?php
  $no++;
}
?>

</table>

</div>

<?php require('footer.php'); ?>