<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");
?>

<div class="page-container">

  <h2>Import Staff Records</h2>
  <p style="color:#555;">
    Upload a CSV file containing staff information to import records into the system.
  </p>

  <form action="import_process.php"
        method="post"
        enctype="multipart/form-data">

      <label style="font-weight:600;">Select CSV File</label><br>
      <input type="file"
             name="file"
             id="file"
             accept=".csv"
             required
             style="margin-top:6px;margin-bottom:16px;">

      <br>

      <input type="submit"
             name="Import"
             value="Upload and Import"
             style="padding:8px 16px;
                    background:#1f1450;
                    color:#fff;
                    border:none;
                    border-radius:4px;
                    cursor:pointer;">

  </form>

</div>

<?php require('footer.php'); ?>