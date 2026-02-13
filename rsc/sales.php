<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

date_default_timezone_set("Asia/Kuala_Lumpur");
$dateNow = date("Y-m-d");
?>

<div class="page-container">

<h2>Today's Movie Schedule</h2>

<table>

<tr>
  <th>Num.</th>
  <th>Title</th>
  <th>Date Show</th>
  <th>Time Start</th>
  <th>Duration</th>
  <th>Poster</th>
  <th>Room</th>
  <th>Action</th>
</tr>

<?php
$data1 = mysqli_query($samb,
    "SELECT * FROM schedule
     WHERE dateshow='$dateNow'
     ORDER BY timeshow ASC"
);

$no = 1;

while($info1 = mysqli_fetch_array($data1))
{
    /* Movie */
    $dataMovie = mysqli_query($samb,
        "SELECT * FROM movie
         WHERE idmovie='{$info1['idmovie']}'"
    );
    $infoMovie = mysqli_fetch_array($dataMovie);

    /* Room */
    $dataRoom = mysqli_query($samb,
        "SELECT * FROM room
         WHERE idroom='{$info1['idroom']}'"
    );
    $infoRoom = mysqli_fetch_array($dataRoom);

    /* Duration */
    $time1 = new DateTime($info1['timeshow']);
    $time2 = new DateTime($info1['timeend']);
    $diff  = $time1->diff($time2);
    $deffTime = $diff->format("%h hour %i minute");

    $showdate = date("d-m-Y", strtotime($info1['dateshow']));
?>
<tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $infoMovie['title']; ?></td>
    <td><?php echo $showdate; ?></td>
    <td><?php echo $info1['timeshow']; ?></td>
    <td><?php echo $deffTime; ?></td>

    <!-- Poster -->
    <td>
        <img src="picture/<?php echo $infoMovie['screen']; ?>"
             style="width:110px;
                    height:auto;
                    border-radius:6px;">
    </td>

    <!-- Room Number + Name -->
    <td>
        Room <?php echo $infoRoom['idroom']; ?>
        – <?php echo $infoRoom['roomname']; ?>
    </td>

    <td>
        <a href="sales_seat.php?idschedule=<?php echo $info1['idschedule']; ?>">
            Get Ticket
        </a>
    </td>
</tr>
<?php
    $no++;
}
?>

</table>

</div>

<?php require('footer.php'); ?>