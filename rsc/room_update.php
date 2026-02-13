<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

/* GET ROOM ID */
$IdRoom = $_GET['idroom'];

/* UPDATE PROCESS */
if(isset($_POST['update']))
{
    $roomname = $_POST['roomname'];

    mysqli_query($samb,
        "UPDATE room
         SET roomname = '$roomname'
         WHERE idroom = '$IdRoom'"
    );

    echo "<script>
        alert('Room record successfully updated');
        window.location='room.php';
    </script>";
    exit;
}

/* GET CURRENT RECORD */
$result = mysqli_query($samb,
    "SELECT * FROM room WHERE idroom='$IdRoom'"
);

$res = mysqli_fetch_array($result);
$roomname = $res['roomname'];
?>

<div class="page-container">

<h2>Update Movie Room</h2>

<p style="color:#666;margin-bottom:14px;">
Room Number : <b><?php echo $IdRoom; ?></b>
</p>

<form method="post">

    <label style="font-weight:600;">Room Name</label><br>

    <input type="text"
           name="roomname"
           value="<?php echo $roomname; ?>"
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
           name="update"
           value="Update Room"
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