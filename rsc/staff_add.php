<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

/* ===== INSERT PROCESS ===== */
if(isset($_POST['staffid']))
{
    $idstaff = $_POST['staffid'];
    $name    = $_POST['staffname'];
    $pass    = $_POST['pass'];

    mysqli_query($samb,
        "INSERT INTO staff
         (salesperson,staffname,pass,level)
         VALUES ('$idstaff','$name','$pass','STAFF')"
    );

    echo "<script>
        alert('New staff record added');
        window.location='staff.php';
    </script>";
    exit;
}
?>

<div class="page-container">

<h2>New Staff Registration</h2>

<form method="post" action="staff_add.php">

    <label>Staff Full Name</label><br>
    <input type="text"
           name="staffname"
           placeholder="Example: RAZMI BIN RAZMAN"
           required
           autofocus
           style="width:320px;padding:6px;"><br><br>

    <label>Staff Username</label><br>
    <input type="text"
           name="staffid"
           placeholder="Example: man88"
           pattern="[A-Za-z0-9_]{1,10}"
           title="1 to 10 characters only"
           required
           style="width:320px;padding:6px;"><br><br>

    <label>Password</label><br>
    <input type="text"
           name="pass"
           placeholder="Example: Abc1234"
           required
           style="width:320px;padding:6px;"><br><br>

    <input type="submit"
           value="Add New Staff"
           class="btn">

</form>

</div>

<?php require('footer.php'); ?>