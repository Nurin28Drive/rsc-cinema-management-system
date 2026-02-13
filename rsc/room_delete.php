<?php
//CONNECT TO DATABASE
require('config.php');
//GET THE ID RECORD FROM URL
$idroom= $_GET['idroom'];
//DELETE SQL COMMAND
$result = mysqli_query($samb, "DELETE FROM room WHERE idroom='$idroom'");
//DISPLAY MSG
echo "<script>alert('MOVIE ROOM HAVE BEEN SUCCESSFULLY DELETED');
window.location='room.php'</script>";
?>