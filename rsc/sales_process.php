<?php
//CONNECT TO DATABASE
require('config.php');

//GET THE TIME NOW
date_default_timezone_set("Asia/Kuala_Lumpur");
$dateNow=date("Y-m-d");
$timeNow=date("H:i:s");

//ACCEPT THE POST VALUES
if(isset($_POST['idmovie']))
{
	
	$idmovie=$_POST['idmovie'];
	$idschedule=$_POST['idschedule'];
	$idseat=$_POST['idseat'];
	$idcategory=$_POST['idcategory'];
	$idstaff=$_POST['idstaff'];
	$idroom=$_POST['idroom'];
	
	//ADD RECORD TO SALES TABLE
	$result1 = mysqli_query($samb,
	"INSERT INTO sales (idsales,idmovie,idschedule,idseat,idroom,idcategory,timesale,datesale,salesperson)
	VALUES(NULL,'$idmovie','$idschedule','$idseat','$idroom','$idcategory','$timeNow','$dateNow','$idstaff')") or die (mysqli_error($samb));
	
	$last_id = mysqli_insert_id($samb);
	
	//DISPLAY MSG 
	echo "<script>alert('SALES SUCCESSFULLY DONE');
	window.location='sale_receipt.php?id=$last_id'</script>";
}
?>