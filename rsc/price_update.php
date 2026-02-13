<?php
session_start();
require('config.php');
require('header.php');
include("menu.php");

/* GET ID */
$IdCat = $_GET['idcat'];

/* UPDATE PROCESS */
if(isset($_POST['update']))
{
    $category = $_POST['category'];
    $price    = $_POST['price'];

    mysqli_query($samb,
        "UPDATE categories
         SET category='$category',
             price='$price'
         WHERE idcategory='$IdCat'"
    );

    echo "<script>
        alert('Record successfully updated');
        window.location='price.php';
    </script>";
    exit;
}

/* GET CURRENT RECORD */
$result = mysqli_query($samb,
    "SELECT * FROM categories WHERE idcategory='$IdCat'"
);

$res = mysqli_fetch_array($result);
$category = $res['category'];
$price    = $res['price'];
?>

<div class="page-container">

<h2>Update Movie Category & Price</h2>

<form method="post">

    <label style="font-weight:600;">Category Name</label><br>
    <input type="text"
           name="category"
           value="<?php echo $category; ?>"
           required
           autofocus
           style="width:100%;max-width:350px;
                  padding:8px;margin-top:6px;margin-bottom:14px;">

    <br>

    <label style="font-weight:600;">Price (RM)</label><br>
    <input type="number"
           step="0.01"
           min="0"
           name="price"
           value="<?php echo $price; ?>"
           required
           style="width:100%;max-width:200px;
                  padding:8px;margin-top:6px;margin-bottom:18px;">

    <br>

    <input type="submit"
           name="update"
           value="Update Record"
           style="padding:8px 16px;
                  background:#1f1450;
                  color:#fff;
                  border:none;
                  border-radius:4px;
                  cursor:pointer;">

</form>

</div>

<?php require('footer.php'); ?>