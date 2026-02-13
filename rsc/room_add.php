<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

/* ADD ROOM */
if(isset($_POST['roomname']))
{
    $roomname = $_POST['roomname'];

    mysqli_query($samb,
        "INSERT INTO room (roomname)
         VALUES ('$roomname')"
    );

    echo "<script>
        alert('New movie room added successfully');
        window.location='room.php';
    </script>";
    exit;
}
?>

<div class="page-container">

<h2>Add New Movie Room</h2>

<form method="post">

    <label style="font-weight:600;">Room Name</label><br>
    <input type="text"
           name="roomname"
           placeholder="Example: Luxury"
           required
           autofocus
           style="
             width:100%;
             max-width:300px;
             padding:8px;
             margin-top:6px;
             margin-bottom:16px;
           ">

    <br>

    <input type="submit"
           value="Add Movie Room"
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