<?php
include("security.php");
include("config.php");

$salesperson = $_SESSION['salesperson'];

$leave_type = $_POST['leave_type'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$reason = $_POST['reason'];

if ($end_date < $start_date) {
    echo "<script>alert('End date must be after start date');
    window.location='leave_apply.php';</script>";
    exit;
}

/* File upload handling */
$uploadDir = "uploads/leave_docs/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$file = $_FILES['document'];
$allowed = ['pdf','jpg','jpeg','png'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    echo "<script>alert('Invalid file type');
    window.location='leave_apply.php';</script>";
    exit;
}

$filename = time().'_'.$file['name'];
$path = $uploadDir.$filename;

move_uploaded_file($file['tmp_name'], $path);

/* Insert leave record */
mysqli_query($samb,
    "INSERT INTO leave_application
     (salesperson, leave_type, start_date, end_date, reason, document)
     VALUES
     ('$salesperson','$leave_type','$start_date','$end_date','$reason','$path')"
);

echo "<script>alert('Leave application submitted successfully');
window.location='leave_my.php';</script>";