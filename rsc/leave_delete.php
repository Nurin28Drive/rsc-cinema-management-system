<?php
session_start();
require('config.php');

if($_SESSION['level']!="ADMIN"){
    header("Location:index2.php");
    exit();
}

$id=$_GET['id'];

$r=mysqli_fetch_assoc(
    mysqli_query($samb,
        "SELECT document FROM leave_application WHERE idleave='$id'")
);

if(!empty($r['document']) && file_exists($r['document'])){
    unlink($r['document']);
}

mysqli_query($samb,
    "DELETE FROM leave_application WHERE idleave='$id'");

header("Location:leave_admin.php");