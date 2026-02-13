<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

require('config.php');
require('header.php');
include("menu.php");

/* Get schedule id */
if(!isset($_GET['idschedule'])){
    header("Location:schedule.php");
    exit;
}

$IdSch = $_GET['idschedule'];

/* Update process */
if(isset($_POST['update']))
{
    $idmovie  = $_POST['idmovie'];
    $idroom   = $_POST['idroom'];
    $dateshow = $_POST['dateshow'];
    $timeshow = $_POST['timeshow'];
    $timeend  = $_POST['timeend'];

    if($timeend <= $timeshow){
        echo "<script>
              alert('Ending time must be later than starting time.');
              window.history.back();
              </script>";
        exit;
    }

    mysqli_query($samb,
        "UPDATE schedule
         SET dateshow='$dateshow',
             timeshow='$timeshow',
             timeend='$timeend',
             idmovie='$idmovie',
             idroom='$idroom'
         WHERE idschedule='$IdSch'"
    );

    echo "<script>
          alert('Schedule record successfully updated');
          window.location='schedule.php';
          </script>";
    exit;
}

/* Get current schedule */
$dataSchedule = mysqli_query($samb,
    "SELECT * FROM schedule WHERE idschedule='$IdSch'"
);
$infoSchedule = mysqli_fetch_array($dataSchedule);
?>

<div class="page-container">

<h2>Update Movie Schedule</h2>

<form method="post">

    <!-- Movie -->
    <label style="font-weight:600;">Movie Title</label><br>

    <select name="idmovie"
            required
            style="width:100%;max-width:420px;
                   padding:8px;margin-top:6px;margin-bottom:14px;">

        <?php
        $dataMovie = mysqli_query($samb,"SELECT * FROM movie ORDER BY title ASC");
        while($m = mysqli_fetch_array($dataMovie)){

            $selected = ($m['idmovie'] == $infoSchedule['idmovie'])
                        ? "selected" : "";

            echo "<option value='{$m['idmovie']}' $selected>
                    {$m['title']}
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

        <?php
        $dataRoom = mysqli_query($samb,"SELECT * FROM room ORDER BY idroom ASC");
        while($r = mysqli_fetch_array($dataRoom)){

            $selected = ($r['idroom'] == $infoSchedule['idroom'])
                        ? "selected" : "";

            echo "<option value='{$r['idroom']}' $selected>
                    Room {$r['idroom']} – {$r['roomname']}
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
           value="<?php echo $infoSchedule['dateshow']; ?>"
           style="width:200px;
                  padding:8px;margin-top:6px;margin-bottom:14px;">

    <br>

    <!-- Start time -->
    <label style="font-weight:600;">Start Time</label><br>
    <input type="time"
           name="timeshow"
           required
           value="<?php echo $infoSchedule['timeshow']; ?>"
           style="width:200px;
                  padding:8px;margin-top:6px;margin-bottom:14px;">

    <br>

    <!-- End time -->
    <label style="font-weight:600;">End Time</label><br>
    <input type="time"
           name="timeend"
           required
           value="<?php echo $infoSchedule['timeend']; ?>"
           style="width:200px;
                  padding:8px;margin-top:6px;margin-bottom:18px;">

    <br>

    <input type="submit"
           name="update"
           value="Update Schedule"
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