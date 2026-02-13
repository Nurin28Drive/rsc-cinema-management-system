<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['salesperson'])) {
    header("Location: index.php");
    exit;
}