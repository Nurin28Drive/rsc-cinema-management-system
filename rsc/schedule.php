<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

<h2>Movie Schedule</h2>

<table>

<tr>
  <th colspan="9">
    <a href="schedule_add.php">+ Add New Movie Schedule</a>
  </th>
</tr>

<tr>
  <th>No.</th>
  <th>Movie Title</th>
  <th>Date</th>
  <th>Start Time</th>
  <th>End Time</th>
  <th>Duration</th>
  <th>Poster</th>
  <th>Room Number</th>
  <th>Action</th>
</tr>

<?php

/* ------------------------------------------
   Improved query using JOIN (DR4 quality)
------------------------------------------- */

$sql = "
    SELECT 
        s.*,
        m.title,
        m.screen,
        r.idroom,
        r.roomname
    FROM schedule s
    JOIN movie m   ON s.idmovie = m.idmovie
    JOIN room  r   ON s.idroom  = r.idroom
    ORDER BY s.dateshow, s.timeshow
";

$data = mysqli_query($samb, $sql);

$no = 1;

while($row = mysqli_fetch_assoc($data))
{
    // Duration calculation
    $time1 = new DateTime($row['timeshow']);
    $time2 = new DateTime($row['timeend']);
    $diff  = $time1->diff($time2);
    $duration = $diff->format("%h hour %i minute");
?>

<tr>
  <td><?php echo $no; ?></td>

  <td><?php echo $row['title']; ?></td>

  <td><?php echo $row['dateshow']; ?></td>

  <td><?php echo $row['timeshow']; ?></td>

  <td><?php echo $row['timeend']; ?></td>

  <td><?php echo $duration; ?></td>

  <td>
    <img src="picture/<?php echo $row['screen']; ?>" class="poster-thumb">
  </td>

  <!-- Room Number = idroom (as agreed) -->
  <td>
      <?php echo $row['idroom']; ?>
      <br>
      <small style="color:#666;">
        <?php echo $row['roomname']; ?>
      </small>
  </td>

  <td>
    <a href="schedule_update.php?idschedule=<?php echo $row['idschedule']; ?>">
      Update
    </a>
    |
    <a href="schedule_delete.php?idschedule=<?php echo $row['idschedule']; ?>"
       onclick="return confirm('Delete this schedule?');">
      Delete
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