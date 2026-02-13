<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

require('config.php');
require('header.php');
include("menu.php");

/* Get filter values */
$month = $_POST['month'] ?? '-';
$year  = $_POST['year']  ?? '-';

/* Decide report title */
$title = "Ticket Sales Report";

if ($month != "-" && $year == "-") {
    $title = "Monthly Ticket Sales Report";
}
elseif ($month == "-" && $year != "-") {
    $title = "Yearly Ticket Sales Report";
}
elseif ($month != "-" && $year != "-") {
    $title = "Monthly & Yearly Ticket Sales Report";
}
?>

<div class="page-container">

<h2><?php echo $title; ?></h2>

<div style="margin-bottom:10px;">
    <strong><?php echo $sysname ?? ''; ?></strong><br>
    Date Print : <?php echo date("d/m/Y"); ?>
</div>

<table>

<tr>
    <th>Num.</th>
    <th>Sales Man</th>
    <th>Movie Title</th>
    <th>Date Sale</th>
    <th>Time Sale</th>
    <th>Seat Number</th>
    <th>Category</th>
    <th>Price (RM)</th>
</tr>

<?php
$no   = 1;
$sum  = 0;

/* Build query based on your existing logic */
if ($month == "-" && $year == "-") {

    $sql = "SELECT * FROM sales ORDER BY datesale";

} elseif ($month != "-" && $year == "-") {

    $sql = "SELECT * FROM sales
            WHERE MONTH(datesale) = '$month'
            ORDER BY datesale";

} elseif ($month != "-" && $year != "-") {

    $sql = "SELECT * FROM sales
            WHERE MONTH(datesale) = '$month'
              AND YEAR(datesale)  = '$year'
            ORDER BY datesale";

} else { // $month == "-" && $year != "-"

    $sql = "SELECT * FROM sales
            WHERE YEAR(datesale) = '$year'
            ORDER BY datesale";
}

$data1 = mysqli_query($samb, $sql);
$record_count = mysqli_num_rows($data1);

if($record_count == 0){
?>
<tr>
    <td colspan="8" style="text-align:center; font-style:italic;">
        No record found.
    </td>
</tr>
<?php
}
else{
    while($info1 = mysqli_fetch_array($data1))
    {
    /* Movie */
    $dataMovie = mysqli_query($samb,
        "SELECT * FROM movie
         WHERE idmovie='{$info1['idmovie']}'");
    $infoMovie = mysqli_fetch_array($dataMovie);

    /* Staff */
    $dataStaff = mysqli_query($samb,
        "SELECT * FROM staff
         WHERE salesperson='{$info1['salesperson']}'");
    $infoStaff = mysqli_fetch_array($dataStaff);

    /* Category */
    $dataCat = mysqli_query($samb,
        "SELECT * FROM categories
         WHERE idcategory='{$info1['idcategory']}'");
    $infoCat = mysqli_fetch_array($dataCat);

    $datesale = date("d-m-Y", strtotime($info1['datesale']));
    $timesale = date("g:i a", strtotime($info1['timesale']));
?>

<tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $infoStaff['staffname']; ?></td>
    <td><?php echo $infoMovie['title']; ?></td>
    <td><?php echo $datesale; ?></td>
    <td><?php echo $timesale; ?></td>
    <td><?php echo $info1['idseat']; ?></td>
    <td><?php echo $infoCat['category']; ?></td>
    <td>
        <?php
            echo number_format($infoCat['price'], 2);
            $sum += $infoCat['price'];
        ?>
    </td>
</tr>

<?php
        $no++;
    }
}
?>

<tr>
    <th colspan="7" style="text-align:right;">Grand Total</th>
    <th><?php echo number_format($sum, 2); ?></th>
</tr>

</table>

<br>

<div style="text-align:center;">
    <strong>* End Report *</strong><br>
    Record Count : <?php echo $record_count; ?>
</div>

<br>

<div style="text-align:center;">
    <a href="javascript:window.print()">Print Report</a>
</div>

</div>

<?php require('footer.php'); ?>