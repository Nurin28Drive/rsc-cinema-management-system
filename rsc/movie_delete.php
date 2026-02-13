<?php
//CONNECT TO DATABASE
require('config.php');
//GET ID FROM URL
$IdMov = $_GET['idmovie'];
//SQL DELETE COMMAND
$result = mysqli_query($samb, "DELETE FROM movie WHERE idmovie='$IdMov'");
//DISPLAY  MSG
echo "<script>alert('MOVIE RECORD HAVE BEEN SUCCESSFULLY DELETED');
window.location='movie.php'</script>";
?>