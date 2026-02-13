<?php
//CONNECT TO DATABASE
require('config.php');
//GET THE ID RECORD FROM URL
$IdSch= $_GET['idschedule'];
//DELETE SQL COMMAND
$result = mysqli_query($samb, "DELETE FROM schedule WHERE idschedule='$IdSch'");
//DISPLAY MSG
echo "<script>alert('MOVIE SCHEDULE HAVE BEEN SUCCESSFULLY DELETED');
window.location='schedule.php'</script>";
?>