<?php date_default_timezone_set("Asia/Kuala_Lumpur");?>
<?php
//CONNECT TO DATABASE
require('config.php');
//GET THE VALUE SESSION
session_start();
//GET THE ID FROM URL
$Nreceipt=$_GET['id'];

//CONNECT THE OTHER TABLE USING FOREIGN KEY
//SALE TABLE 
$dataSales=mysqli_query($samb, "SELECT * FROM sales
WHERE idsales='$Nreceipt'");
$infoSales=mysqli_fetch_array($dataSales);

//SCHEDULE TABLE 
$dataSchedule=mysqli_query($samb, "SELECT * FROM schedule
WHERE idschedule='$infoSales[idschedule]'");
$infoSchedule=mysqli_fetch_array($dataSchedule);

//MOVIE TABLE
$dataMovie=mysqli_query($samb, "SELECT * FROM movie
WHERE idmovie='$infoSales[idmovie]'");
$infoMovie=mysqli_fetch_array($dataMovie);

//ROOM TABLE 
$dataRoom=mysqli_query($samb, "SELECT * FROM room
WHERE idroom='$infoSales[idroom]'");
$infoRoom=mysqli_fetch_array($dataRoom);

/*SEAT TABLE 
$dataSeat=mysqli_query($samb, "SELECT * FROM seat
WHERE idseat='$infoSales[idseat]'");
$infoSeat=mysqli_fetch_array($dataSeat);*/

//CATEGORIES TABLE
$dataCat=mysqli_query($samb, "SELECT * FROM categories
WHERE idcategory='$infoSales[idcategory]'");
$infoCat=mysqli_fetch_array($dataCat);

//STAFF TABLE
$dataStaff=mysqli_query($samb, "SELECT * FROM staff
WHERE salesperson='$infoSales[salesperson]'");
$infoStaff=mysqli_fetch_array($dataStaff);

//REARRANGE DATE/TIME FORMAT
$datesale = date("d-m-Y", strtotime($infoSales['datesale']));
$dateshow = date("d-m-Y", strtotime($infoSchedule['dateshow']));
$timesale = date("g:i a", strtotime($infoSales['timesale']));
$timeshow = date("g:i a", strtotime($infoSchedule['timeshow']));
?>

<html>
<body>
<title>INVOICE <?php echo $sysname;?></title>
<table width="500" border="1" align="left">

	<tr>
	<td colspan="2" valign="middle" align="center"><b>
	<?php echo $sysname;?><br>
	<font size="2">Ticket Number : <?php echo $Nreceipt; ?>
	</b></td>
	</tr>
	
	<tr>
	<td width="300">MOVIE TITLE : <br>
	<font size="5"><?php echo $infoMovie['title']; ?></td>
	<td width="300">ROOM/SEAT : <br>
	<font size="6"><?php echo $infoRoom['roomname']; ?>
	<br><?php echo $infoSales['idseat']; ?>
	</td>
	</tr>
	
	<tr>
	<td>NET TICKET PRICE : <br>
	RM<?php echo $infoCat['price'];?><br>
	(<?php echo $infoCat['category'];?>)</td>
	<td>DATE/TIME : <br>
	<font size="5"><?php echo $dateshow; ?>
	<br><?php echo $timeshow; ?>
	</td>
	</tr>
	
	<tr>
	<td><font size="2">DATE/TIME PURCHASE : <br>
	<?php echo $datesale; ?>
	<br><?php echo $timesale; ?>
	</td>
	<td><font size="2">SOLD BY : <br>
	<?php echo $infoStaff['staffname']; ?>
	</td>
	
	<tr>
	<td colspan="2" valign="middle" align="center"><b>
	<a href="javascript:window.print()">Print Ticket</a> |
	<a href="index2.php">Back To Main Menu</a>
	</td>
	</tr>
	
	</table>
	</body>
	</html>