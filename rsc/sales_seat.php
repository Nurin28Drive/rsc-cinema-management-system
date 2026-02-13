<?php
session_start();
//CONNECT TO DATABASE
require('config.php');
//RECALL HEADER FILE
require('header.php');
include ("menu.php");

//GET THE SALESMAN LOGIN ID
$saleMan = $_SESSION['salesperson'];
//TIME NOW
date_default_timezone_set("Asia/Kuala_Lumpur");
$timeNow = date('h:i:sa');
//GET ID MOVIE SCHEDULE TO URL
$IdSch = $_GET['idschedule'];

//GET THE RECORD FROM FOREIGN KEY
$dataSchedule = mysqli_query($samb, "SELECT * FROM schedule
WHERE idschedule='$IdSch'");
$infoSchedule = mysqli_fetch_array($dataSchedule);

//MOVIE TABLE 
$dataMovie = mysqli_query($samb, "SELECT * FROM movie
WHERE idmovie = '$infoSchedule[idmovie]'");
$infoMovie = mysqli_fetch_array($dataMovie);

// ROOM TABLE
$dataRoom = mysqli_query($samb, "SELECT * FROM room
WHERE idroom = '$infoSchedule[idroom]'");
$infoRoom = mysqli_fetch_array($dataRoom);

//TABLE STAFF
$dataStaff = mysqli_query($samb, "SELECT * FROM staff
WHERE salesperson = '$saleMan'");
$infoStaff = mysqli_fetch_array($dataStaff);
?>

<html>
<body>
<link rel="stylesheet" href="csstable.css">
<u><h2>MOVIE TICKET SALES FORM</h2></u>
<form method="POST" action="sales_process.php">
<table id="table">

	<tr>
	<th colspan="18">SELECT TICKET & CATEGORY </th>
	</tr>
	
	<tr>
	<th>SALES NAME : </th>
	<td><?php echo $infoStaff['staffname'];?></td>
	</tr>
	
	<tr>
	<th>MOVIE TITLE : </th>
	<td><?php echo $infoMovie['title'];?></td>
	</tr>
	
	<tr>
	<th>ROOM : </th>
	<td><?php echo $infoRoom['roomname'];?></td>
	</tr>
	
	<tr>
	<th>DATE SHOW : </th>
	<td><?php echo $infoSchedule['dateshow']?></td>
	</tr>
	
	<tr>
	<th>TIME SHOW : </th>
	<td><?php echo $infoSchedule['timeshow'];?></td>
	</tr>
	
	<tr>
	<th>SEAT : </th>
	<td><select name="idseat" required>
	<?php
	//LIST OF ARRAY SEAT NUMBER
	for ($v=1; $v<=25; $v++)
	{
		$data2 = mysqli_query($samb, "SELECT * FROM sales
		WHERE idschedule = '$IdSch' AND idseat = 'A$v' ");
		$num = mysqli_num_rows($data2);
		if ($num==0)
		{
			echo "<option hidden selected> -- PICK SEAT NUMBER -- </option>";
			echo "<option>A$v</option>";
		}
	}
	?>
	</select></td>
	</tr>
	
	<tr>
	<th> CATEGORY : </th>
	<td><select name="idcategory" required>
	<?php
	$data3 = mysqli_query($samb, "SELECT * FROM categories");
	while ($info3 = mysqli_fetch_array($data3))
	{
		echo "<option hidden SELECTED> -- PICK CATEGORY -- </option>";
		echo "<option value='$info3[idcategory]'>$info3[category]</option>";
	}
	?>
	</select></td>
	</tr>
	
	<tr>
	<th colspan ="10"><br>
	<button type="submit">SELL</button>
	<button type="reset">RESET</button><br><br>
	*Make sure all field is fill</th>
	</tr>
	
	<input hidden type="text" name="idstaff" value="<?php echo $infoStaff['salesperson'];?>"/>
	<input hidden type="text" name="idmovie" value="<?php echo $infoMovie['idmovie'];?>"/>
	<input hidden type="text" name="idroom" value="<?php echo $infoRoom['idroom'];?>"/>
	<input hidden type="text" name="idschedule" value="<?php echo $IdSch; ?>"/>
	
	</form>
	</div>
	</table>
	<br>
	</center>
	<?php require('footer.php'); ?>
	</html>