<?php
include("security.php");
include("header.php");
include("menu.php");
?>

<div class="page-container">

<h2>Staff Leave Application</h2>

<form method="post"
      action="leave_process.php"
      enctype="multipart/form-data"
      onsubmit="return validateLeaveForm();">

<table style="max-width:520px;">

<tr>
  <td><strong>Leave Type</strong></td>
  <td>
    <select name="leave_type" required style="width:100%;padding:8px;">
      <option value="">-- Select Leave Type --</option>
      <option value="Annual Leave">Annual Leave</option>
      <option value="Medical Leave">Medical Leave</option>
      <option value="Emergency Leave">Emergency Leave</option>
    </select>
  </td>
</tr>

<tr>
  <td><strong>Start Date</strong></td>
  <td>
    <input type="date" name="start_date" id="start_date" required style="width:100%;padding:8px;">
  </td>
</tr>

<tr>
  <td><strong>End Date</strong></td>
  <td>
    <input type="date" name="end_date" id="end_date" required style="width:100%;padding:8px;">
  </td>
</tr>

<tr>
  <td><strong>Reason</strong></td>
  <td>
    <textarea name="reason" rows="4" style="width:100%;padding:8px;"></textarea>
  </td>
</tr>

<tr>
  <td><strong>Supporting Document</strong></td>
  <td>
    <input type="file" name="document" required accept=".pdf,.jpg,.jpeg,.png">
    <div style="font-size:12px;color:#666;">PDF / JPG / PNG only</div>
  </td>
</tr>

<tr>
  <td></td>
  <td>
    <input type="submit" value="Submit Leave Application">
  </td>
</tr>

</table>
</form>
</div>

<script>
function validateLeaveForm(){
    var s = document.getElementById("start_date").value;
    var e = document.getElementById("end_date").value;
    if(s && e && e < s){
        alert("End date cannot be earlier than start date.");
        return false;
    }
    return true;
}
</script>

<?php include("footer.php"); ?>