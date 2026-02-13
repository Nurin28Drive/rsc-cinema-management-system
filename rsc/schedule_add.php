<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

require('config.php');
require('header.php');
include("menu.php");

/* SAVE NEW SCHEDULE */
if(isset($_POST['idmovie']))
{
    $dateshow = $_POST['dateshow'];
    $timeshow = $_POST['timeshow'];
    $timeend  = $_POST['timeend'];
    $idmovie  = $_POST['idmovie'];
    $idroom   = $_POST['idroom'];

    /* basic validation */
    if($timeend <= $timeshow){
        echo "<script>
              alert('Ending time must be later than starting time.');
              window.history.back();
              </script>";
        exit;
    }

    mysqli_query($samb,
        "INSERT INTO schedule
        (dateshow, timeshow, timeend, idmovie, idroom)
        VALUES
        ('$dateshow','$timeshow','$timeend','$idmovie','$idroom')"
    );

    echo "<script>
          alert('New movie schedule added successfully');
          window.location='schedule.php';
          </script>";
    exit;
}
?>

<div class="page-container">

<h2>Add Movie Schedule</h2>

<form method="post">

    <!-- Movie -->
    <label style="font-weight:600;">Movie Title</label><br>

    <select name="idmovie"
            required
            style="width:100%;max-width:420px;
                   padding:8px;margin-top:6px;margin-bottom:14px;">

        <option value="" disabled selected>-- Choose Movie Title --</option>

        <?php
        $dataMovie = mysqli_query($samb,"SELECT * FROM movie ORDER BY title ASC");
        while($infoMovie = mysqli_fetch_array($dataMovie)){
            echo "<option value='{$infoMovie['idmovie']}'>
                    {$infoMovie['title']}
                  </option>";
        }
        ?>
    </select>

    <br>

    <!-- Room -->
    <label style="font-weight:600;">Cinema Room</label><br>

    <select name="idroom"
            required
            style="width:100%;max-width:300px;
                   padding:8px;margin-top:6px;margin-bottom:14px;">

        <option value="" disabled selected>-- Choose Cinema Room --</option>

        <?php
        $dataRoom = mysqli_query($samb,"SELECT * FROM room ORDER BY idroom ASC");
        while($infoRoom = mysqli_fetch_array($dataRoom)){
            echo "<option value='{$infoRoom['idroom']}'>
                    Room {$infoRoom['idroom']} – {$infoRoom['roomname']}
                  </option>";
        }
        ?>
    </select>

    <br>

    <!-- Date -->
    <label style="font-weight:600;">Show Date</label><br>
    <input type="date"
           name="dateshow"
           required
           style="width:200px;
                  padding:8px;margin-top:6px;margin-bottom:14px;">

    <br>

    <!-- Time start -->
    <label style="font-weight:600;">Start Time</label><br>
    <input type="time"
           name="timeshow"
           required
           style="width:200px;
                  padding:8px;margin-top:6px;margin-bottom:14px;">

    <br>

    <!-- Time end -->
    <label style="font-weight:600;">End Time</label><br>
    <input type="time"
           name="timeend"
           required
           style="width:200px;
                  padding:8px;margin-top:6px;margin-bottom:18px;">

    <br>

    <input type="submit"
           value="Add Schedule"
           style="
             padding:8px 16px;
             background:#1f1450;
             color:#ffffff;
             border:none;
             border-radius:4px;
             cursor:pointer;
           ">

</form>

</div>

<?php require('footer.php'); ?>