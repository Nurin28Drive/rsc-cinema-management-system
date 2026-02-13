<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

<h2>Ticket Categories & Prices</h2>

<table>

<tr>
  <th colspan="4">
    <a href="price_add.php">+ Add New Category</a>
  </th>
</tr>

<tr>
  <th>Num.</th>
  <th>Category</th>
  <th>Price (RM)</th>
  <th>Action</th>
</tr>

<?php
$data1 = mysqli_query($samb,
    "SELECT * FROM categories ORDER BY price ASC");

$no = 1;

while($info1 = mysqli_fetch_array($data1))
{
?>
<tr>
  <td><?php echo $no; ?></td>
  <td><?php echo $info1['category']; ?></td>
  <td><?php echo number_format($info1['price'],2); ?></td>
  <td>
    <a href="price_update.php?idcat=<?php echo $info1['idcategory']; ?>">Update</a> |
    <a href="price_delete.php?idcat=<?php echo $info1['idcategory']; ?>"
       onclick="return confirm('Delete this category?');">Delete</a>
  </td>
</tr>
<?php
  $no++;
}
?>

</table>

</div>

<?php require('footer.php'); ?>