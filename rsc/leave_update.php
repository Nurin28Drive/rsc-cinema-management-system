<?php
session_start();
require('config.php');

if($_SESSION['level']!="ADMIN"){
    header("Location:index2.php");
    exit();
}

/* ================= POST = UPDATE ================= */

if(isset($_POST['idleave'])){

    $idleave = $_POST['idleave'];
    $status  = $_POST['status'];
    $remark  = $_POST['admin_remark'] ?? "";

    if($status==="REJECTED" && trim($remark)===""){
        header("Location: leave_update.php?id=".$idleave);
        exit();
    }

    $remark = mysqli_real_escape_string($samb,$remark);

    $sql="UPDATE leave_application
          SET status='$status',
              admin_remark=".($remark===""?"NULL":"'$remark'")."
          WHERE idleave='$idleave'";

    mysqli_query($samb,$sql);

    header("Location:leave_admin.php");
    exit();
}

/* ================= GET = REVIEW PAGE ================= */

if(!isset($_GET['id'])){
    header("Location:leave_admin.php");
    exit();
}

require('header.php');
include("menu.php");

$id=$_GET['id'];

$data=mysqli_query($samb,
    "SELECT l.*, s.staffname
     FROM leave_application l
     JOIN staff s ON l.salesperson=s.salesperson
     WHERE idleave='$id'");

$row=mysqli_fetch_assoc($data);
?>

<div class="page-container">

<h2>Review Leave Application</h2>

<form method="post" action="leave_update.php" onsubmit="return validateReviewForm();">

<input type="hidden" name="idleave" value="<?php echo $row['idleave']; ?>">

<table style="max-width:600px;">

<tr>
  <td>Staff</td>
  <td><?php echo $row['staffname']; ?></td>
</tr>

<tr>
  <td>Leave Type</td>
  <td><input type="text" value="<?php echo $row['leave_type']; ?>" readonly></td>
</tr>

<tr>
  <td>Start Date</td>
  <td><input type="date" value="<?php echo $row['start_date']; ?>" readonly></td>
</tr>

<tr>
  <td>End Date</td>
  <td><input type="date" value="<?php echo $row['end_date']; ?>" readonly></td>
</tr>

<tr>
  <td>Reason</td>
  <td><textarea rows="3" readonly><?php echo $row['reason']; ?></textarea></td>
</tr>

<tr>
  <td>Supporting Document</td>
  <td>
    <?php if(!empty($row['document'])){ ?>
        <a href="<?php echo $row['document']; ?>" target="_blank">View uploaded document</a>
    <?php }else{ echo "-"; } ?>
  </td>
</tr>

<tr>
  <td>Admin Remark (required if rejected)</td>
  <td>
    <textarea name="admin_remark" id="admin_remark" rows="3"
              style="width:100%;"><?php
        echo htmlspecialchars($row['admin_remark'] ?? '');
    ?></textarea>
  </td>
</tr>

<tr>
  <td>Status</td>
  <td>
    <select name="status" id="status" required>
      <option value="PENDING"  <?php if($row['status']=="PENDING")  echo "selected"; ?>>PENDING</option>
      <option value="APPROVED" <?php if($row['status']=="APPROVED") echo "selected"; ?>>APPROVED</option>
      <option value="REJECTED" <?php if($row['status']=="REJECTED") echo "selected"; ?>>REJECTED</option>
    </select>
  </td>
</tr>

<tr>
  <td></td>
  <td>
    <input type="submit" value="Update Status">
    <a href="leave_admin.php">Back</a>
  </td>
</tr>

</table>
</form>
</div>

<script>
function validateReviewForm(){
    var status=document.getElementById("status").value;
    var remark=document.getElementById("admin_remark").value.trim();
    if(status==="REJECTED" && remark===""){
        alert("Please enter remark when rejecting the leave application.");
        return false;
    }
    return true;
}
</script>

<?php require('footer.php'); ?>