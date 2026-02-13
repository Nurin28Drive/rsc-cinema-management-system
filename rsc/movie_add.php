<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

/* ===== INSERT PROCESS ===== */
if(isset($_POST['title']))
{
    $screen = $_FILES['screen']['name'];

    $imageArr = explode('.', $screen);
    $random   = rand(10000,99999);
    $newnamepic = $imageArr[0].$random.'.'.$imageArr[1];
    $uploadPath = "picture/".$newnamepic;

    move_uploaded_file($_FILES["screen"]["tmp_name"], $uploadPath);

    $title   = $_POST['title'];
    $dateadd = $_POST['dateadd'];

    mysqli_query($samb,
        "INSERT INTO movie(idmovie,title,screen,dateadd)
         VALUES(NULL,'$title','$newnamepic','$dateadd')"
    );

    echo "<script>
        alert('New movie added');
        window.location='movie.php';
    </script>";
    exit;
}
?>

<div class="page-container">

<h2>Add New Movie</h2>

<form method="post" enctype="multipart/form-data">

    <label>Movie Title</label><br>
    <input type="text"
           name="title"
           placeholder="Example: MOANA"
           required
           autofocus
           style="width:320px;padding:6px;"><br><br>

    <label>Date Added</label><br>
    <small style="color:#777;">Today's date (cannot be changed)</small><br>
    <input type="date"
           name="dateadd"
           readonly
           value="<?php echo date('Y-m-d'); ?>"
           style="width:200px;padding:6px;"><br><br>

    <label>Movie Poster / Screen Promo</label><br>
    <input type="file"
           name="screen"
           accept="image/*"
           required><br><br>

    <input type="submit"
           value="Add New Movie"
           class="btn">

</form>

</div>

<?php require('footer.php'); ?>