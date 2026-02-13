<?php
require('config.php');
$idstaff = $_GET['staffid'];
//EXECUTE SQL COMMAND DELETE
$result = mysqli_query($samb, "DELETE FROM staff
WHERE salesperson='$idstaff'");
echo "<script>alert('RECORD DELETED');
window.location='staff.php'</script>";
?>