<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

// GET ID FROM URL
$IdMov = $_GET['idmovie'];

/* ===== UPDATE PROCESS ===== */
if(isset($_POST['update']))
{
    $title   = $_POST['title'];
    $dateadd = $_POST['dateadd'];

    mysqli_query($samb,
        "UPDATE movie
         SET title='$title',
             screen=screen,
             dateadd='$dateadd'
         WHERE idmovie='$IdMov'"
    );

    echo "<script>
        alert('Movie record successfully updated');
        window.location='movie.php';
    </script>";
    exit;
}

/* ===== LOAD RECORD ===== */
$result = mysqli_query($samb,
    "SELECT * FROM movie WHERE idmovie='$IdMov'"
);

$row = mysqli_fetch_assoc($result);

$title   = $row['title'];
$dateadd = $row['dateadd'];
$screen  = $row['screen'];
?>

<div class="page-container">

<h2>Update Movie Record</h2>

<form method="post">

    <label>Movie Title</label><br>
    <input type="text"
           name="title"
           value="<?php echo $title; ?>"
           required
           autofocus
           style="width:320px;padding:6px;"><br><br>

    <label>Date Added</label><br>
    <input type="date"
           name="dateadd"
           value="<?php echo $dateadd; ?>"
           required
           style="width:200px;padding:6px;"><br><br>

    <label>Current Poster / Screen</label><br>
    <img src="picture/<?php echo $screen; ?>"
         width="120"
         style="border-radius:6px;box-shadow:0 2px 6px rgba(0,0,0,.2);"><br>
    <small style="color:#777;">Poster cannot be updated in this screen.</small><br><br>

    <input type="submit"
           name="update"
           value="Update Movie Record"
           class="btn">

</form>

</div>

<?php require('footer.php'); ?>