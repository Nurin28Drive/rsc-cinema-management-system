<?php
session_start();

// CONNECT TO DATABASE
require('config.php');

/* login page theme */
$themeClass = "theme-home";

// RECALL HEADER FILE
require('header.php');

// LOGIN PROCESS
if (isset($_POST['salesperson'])) {

    $user = $_POST['salesperson'];
    $pass = $_POST['pass'];

    $query = mysqli_query($samb,
        "SELECT * FROM staff
         WHERE salesperson='$user' AND pass='$pass'"
    );

    $row = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) == 0 || $row['pass'] != $pass) {

        echo "<script>
            alert('Sales Person ID or Password is incorrect');
            window.location='index.php';
        </script>";
        exit;

    } else {

        $_SESSION['salesperson'] = $row['salesperson'];
        $_SESSION['level']       = $row['level'];

        header("Location: index2.php");
        exit;
    }
}
?>

<style>
/* only for login page layout */
.login-wrapper{
  min-height:60vh;
  display:flex;
  justify-content:center;
  align-items:center;
}

.login-card{
  width:360px;
}

.login-card h2{
  margin-top:0;
  text-align:center;
}

.login-card label{
  font-weight:600;
  display:block;
  margin-bottom:4px;
}

.login-card input[type=text],
.login-card input[type=password]{
  width:100%;
  padding:8px;
  margin-bottom:14px;
  border:1px solid #d1d5e3;
  border-radius:4px;
}

.login-card input[type=submit]{
  width:100%;
  padding:10px;
  background:var(--primary);
  color:#ffffff;
  border:none;
  border-radius:4px;
  font-weight:600;
  cursor:pointer;
}

.login-card input[type=submit]:hover{
  background:var(--primary-dark);
}
</style>

<div class="login-wrapper">

  <div class="page-container login-card">

    <h2>Staff Login</h2>

    <form method="POST" action="index.php">

        <label>Sales Person ID</label>
        <input type="text"
               name="salesperson"
               placeholder="Enter your staff ID"
               required
               autofocus>

        <label>Password</label>
        <input type="password"
               name="pass"
               placeholder="Enter your password"
               required>

        <input type="submit" value="Sign In">

    </form>

  </div>

</div>

<?php require('footer.php'); ?>