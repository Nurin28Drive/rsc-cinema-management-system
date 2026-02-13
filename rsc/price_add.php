<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

/* ADD PROCESS */
if(isset($_POST['category']))
{
    $category = $_POST['category'];
    $price    = $_POST['price'];

    mysqli_query($samb,
        "INSERT INTO categories (category, price)
         VALUES ('$category', '$price')"
    );

    echo "<script>
        alert('New category and price added successfully');
        window.location='price.php';
    </script>";
    exit;
}
?>

<div class="page-container">

<h2>Add New Movie Category & Price</h2>

<form method="post">

    <label style="font-weight:600;">Category Name</label><br>
    <input type="text"
           name="category"
           placeholder="Example: Adult"
           required
           autofocus
           style="width:100%;max-width:350px;
                  padding:8px;margin-top:6px;margin-bottom:14px;">

    <br>

    <label style="font-weight:600;">Price (RM)</label><br>
    <input type="number"
           name="price"
           step="0.01"
           min="0"
           placeholder="Example: 30.00"
           required
           style="width:100%;max-width:200px;
                  padding:8px;margin-top:6px;margin-bottom:18px;">

    <br>

    <input type="submit"
           value="Add Category"
           style="padding:8px 16px;
                  background:#1f1450;
                  color:#ffffff;
                  border:none;
                  border-radius:4px;
                  cursor:pointer;">

</form>

</div>

<?php require('footer.php'); ?>