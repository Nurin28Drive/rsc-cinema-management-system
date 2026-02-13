<?php
//CONNECT TO DATABASE
require('config.php');
//GET ID FROM URL
$IdCat = $_GET['idcat'];
//EXECUTE SQL COMMAND TO DELETE RECORD
$result = mysqli_query($samb, "DELETE FROM categories WHERE idcategory='$IdCat'");
//DISPLAY MSG
echo "<script>alert('RECORD HAVE BEEN SUCCESSFULLY DELETED');
window.location='price.php'</script>";
?>