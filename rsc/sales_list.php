<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

require('config.php');
require('header.php');
include("menu.php");

/* today */
$today = date("Y-m-d");
?>

<div class="page-container">

<h2>Ticket Sold List (Today)</h2>

<table>

<tr>
    <th>No.</th>
    <th>Ticket No.</th>
    <th>Date / Time Sold</th>
    <th>Staff</th>
    <th>Movie Title</th>
    <th>Date / Time Show</th>
    <th>Seat No.</th>
    <th>Room</th>
    <th>Price (RM)</th>
    <th>Action</th>
</tr>

<?php

$sql = "
SELECT
    s.idsales,
    s.datesale,
    s.timesale,
    s.idseat,

    st.staffname,

    m.title,

    sc.dateshow,
    sc.timeshow,

    r.idroom,
    r.roomname,

    c.price

FROM sales s
JOIN staff st     ON s.salesperson = st.salesperson
JOIN schedule sc  ON s.idschedule  = sc.idschedule
JOIN movie m      ON s.idmovie     = m.idmovie
JOIN room r       ON s.idroom      = r.idroom
JOIN categories c ON s.idcategory  = c.idcategory

/* 👉 ONLY TODAY */
WHERE s.datesale = '$today'

ORDER BY s.timesale DESC
";

$data = mysqli_query($samb, $sql);

$no  = 1;
$sum = 0;
$count_rec = mysqli_num_rows($data);

/* ===== no record handling ===== */
if($count_rec == 0){
?>
<tr>
    <td colspan="10" style="text-align:center; font-style:italic;">
        No record found for today.
    </td>
</tr>
<?php
}
else{

while($row = mysqli_fetch_assoc($data))
{
    $datesale = date("d-m-Y", strtotime($row['datesale']));
    $timesale = date("g:i a", strtotime($row['timesale']));

    $dateshow = date("d-m-Y", strtotime($row['dateshow']));
    $timeshow = date("g:i a", strtotime($row['timeshow']));
?>
<tr>
    <td><?php echo $no++; ?></td>

    <td><?php echo $row['idsales']; ?></td>

    <td>
        <?php echo $datesale; ?><br>
        <?php echo $timesale; ?>
    </td>

    <td><?php echo $row['staffname']; ?></td>

    <td><?php echo $row['title']; ?></td>

    <td>
        <?php echo $dateshow; ?><br>
        <?php echo $timeshow; ?>
    </td>

    <td><?php echo $row['idseat']; ?></td>

    <td>
        Room <?php echo $row['idroom']; ?>
        – <?php echo $row['roomname']; ?>
    </td>

    <td>
        <?php
            echo number_format($row['price'], 2);
            $sum += $row['price'];
        ?>
    </td>

    <td>
        <a href="sale_receipt.php?id=<?php echo $row['idsales']; ?>" target="_blank">
            Print Ticket
        </a>
    </td>
</tr>
<?php
}
}
?>

<tr>
    <th colspan="8" style="text-align:right;">Grand Total</th>
    <th><?php echo number_format($sum,2); ?></th>
    <th></th>
</tr>

</table>

<br>

<div style="text-align:center;">
    <strong>* End of List *</strong><br>
    Record Count : <?php echo $count_rec; ?>
</div>

</div>

<?php require('footer.php'); ?>