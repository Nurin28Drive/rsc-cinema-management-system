<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

/* ===== UPDATE PROCESS ===== */
if(isset($_POST['update']))
{
    $IdStaff   = $_POST['salesperson'];
    $staffname = $_POST['staffname'];
    $pass      = $_POST['pass'];
    $level     = $_POST['level'];

    mysqli_query($samb,
        "UPDATE staff SET
            staffname='$staffname',
            pass='$pass',
            level='$level'
         WHERE salesperson='$IdStaff'"
    );

    echo "<script>
        alert('Record successfully updated');
        window.location='staff.php';
    </script>";
    exit;
}

/* ===== LOAD DATA ===== */
$IdStaff = $_GET['staffid'];

$result = mysqli_query($samb,
    "SELECT * FROM staff WHERE salesperson='$IdStaff'"
);

$row = mysqli_fetch_assoc($result);

$staffname = $row['staffname'];
$pass      = $row['pass'];
$level     = $row['level'];
?>

<div class="page-container">

<h2>Update Staff Record</h2>

<p><strong>User ID:</strong> <?php echo $IdStaff; ?></p>

<form method="post" action="staff_update.php">

    <label>Staff Full Name</label><br>
    <input type="text"
           name="staffname"
           value="<?php echo $staffname; ?>"
           required
           style="width:300px;padding:6px;"><br><br>

    <label>Password</label><br>
    <input type="text"
           name="pass"
           value="<?php echo $pass; ?>"
           required
           style="width:300px;padding:6px;"><br><br>

    <input type="hidden" name="level" value="<?php echo $level; ?>">
    <input type="hidden" name="salesperson" value="<?php echo $IdStaff; ?>">

    <input type="submit"
           name="update"
           value="Update Staff Record"
           class="btn">

</form>

</div>

<?php require('footer.php'); ?>