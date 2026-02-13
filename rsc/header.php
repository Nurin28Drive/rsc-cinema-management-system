<?php
include "config.php";

/* Auto theme unless page overrides it */
if (!isset($themeClass)) {

    $role = $_SESSION['level'] ?? '';

    if ($role === "ADMIN") {
        $themeClass = "theme-admin";
    } else if ($role !== "") {
        $themeClass = "theme-staff";
    } else {
        $themeClass = "";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="rsc-logo-no-bg.png" />
<title>Royal Seat Cinemas – Management System</title>

<style>
/* Header uses the same CSS variables as menu.php */

/* ===== Global theme variables (shared by ALL pages including login) ===== */

:root{
  --primary:#1f1450;
  --primary-dark:#160d3a;
  --accent:#f2c94c;
  --bg:#e9ebf3;
  --card:#ffffff;
  --text:#1f1f1f;
  --border:#d1d5e3;
}

/* ===============================
   ROLE BASED THEME OVERRIDES
   =============================== */

/* Home theme */
body.theme-home{
  --primary:#6b2fa3;       /* royal purple */
  --primary-dark:#4b1f73;
  --accent:#ffd36a;
  --bg:#f5effb;
  --card:#ffffff;
}

/* Admin theme */
body.theme-admin{
  --primary:#1f1450;
  --primary-dark:#160d3a;
  --accent:#f2c94c;
}

/* Staff theme */
body.theme-staff{
  --primary:#0f4c81;       /* deep teal-blue */
  --primary-dark:#0b355a;  /* darker teal */
  --accent:#4fd1c5;        /* soft cyan accent */
}

html, body{
  height:100%;
}

body{
  display:flex;
  flex-direction:column;
  font-family:"Lato",sans-serif;
  background:var(--bg);
  color:var(--text);
}

/* ===== Application header ===== */

.app-header{
  width:100%;
  background:linear-gradient(90deg,var(--primary),var(--primary-dark));
  padding:14px 20px;
  display:flex;
  align-items:center;
  border-bottom:3px solid var(--accent);
  box-sizing:border-box;
}

.app-header img{
  height:60px;
  margin-right:15px;
}

.app-header .title{
  color:#ffffff;
  font-size:20px;
  font-weight:600;
  letter-spacing:0.5px;
}

.app-header .subtitle{
  font-size:12px;
  color:var(--accent);
}

/* ===== Accessibility tools ===== */

.access-bar{
  margin-left:auto;
  display:flex;
  gap:8px;
}

.access-btns button{
  background:var(--accent);
  border:none;
  padding:4px 8px;
  border-radius:4px;
  cursor:pointer;
  font-size:12px;
  font-weight:600;
  color:var(--primary);
}

.access-btns button:hover{
  opacity:0.85;
}

/* ===== High contrast mode ===== */

.high-contrast{
  background:#000 !important;
  color:#fff !important;
}

.high-contrast .page-container{
  background:#000 !important;
  color:#fff !important;
}

.high-contrast table th{
  background:#000 !important;
  color:#fff !important;
}

.high-contrast table td{
  background:#000 !important;
  color:#fff !important;
  border-color:#fff !important;
}
</style>
</head>

<body class="<?php echo $themeClass ?? ''; ?>">

<!-- ===== Application Header ===== -->
<div class="app-header">

  <?php if(!empty($logo)){ ?>
    <img src="<?php echo $logo; ?>" alt="RSC Logo">
  <?php } ?>

  <div>
    <div class="title">Royal Seat Cinemas</div>
    <div class="subtitle">Cinema Management Information System</div>
  </div>

  <div class="access-bar">
    <?php include "zoom.php"; ?>
    <?php include "color.php"; ?>
  </div>

</div>