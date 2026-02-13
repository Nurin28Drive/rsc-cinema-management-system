<?php
$role = $_SESSION['level'];
$current = basename($_SERVER['PHP_SELF']);

$breadcrumbMap = [

    "index2.php"                      => ["Home"],

    // Attendance
    "attendance.php"                  => ["Attendance","Check-In / Check-Out"],
    "attendance_my.php"               => ["Attendance","My Attendance Record"],
    "attendance_admin.php"            => ["Attendance","Manage Attendance"],
    "attendance_update.php"           => ["Attendance","Edit Attendance"],

    // Leave
    "leave_apply.php"                 => ["Leave","Apply Leave"],
    "leave_my.php"                    => ["Leave","My Leave Application"],
    "leave_admin.php"                 => ["Leave","Manage Leave Application"],
    "leave_update.php"                => ["Leave","Review Leave Application"],

    // Reports
    "report_attendance.php"           => ["Reports","Attendance Report"],
    "report_attendance_print.php"     => ["Reports","Attendance Report"],
    "report_leave.php"                => ["Reports","Leave Report"],
    "report_leave_print.php"          => ["Reports","Leave Report"],
    "report_sales.php"                => ["Reports","Ticket Sales Report"],
    "report_sale_print.php"           => ["Reports","Ticket Sales Report"],

    // Sales (operational)
    "sales.php"                       => ["Sales","Sales Ticket"],
    "sales_seat.php"                  => ["Sales","Sales Ticket"],
    "sales_list.php"                  => ["Sales","Ticket Sold List"],

    // Staff
    "staff.php"                       => ["Staff","Staff List"],
    "import_staff.php"                => ["Staff","Import Staff"],
    "staff_add.php"                   => ["Staff","Add Staff"],
    "staff_update.php"                => ["Staff","Edit Staff"],

    // Cinema setup
    "movie.php"                       => ["Cinema Setup","Movie"],
    "movie_add.php"                   => ["Cinema Setup","Add Movie"],
    "movie_update.php"                => ["Cinema Setup","Edit Movie"],

    "price.php"                       => ["Cinema Setup","Price"],
    "price_add.php"                   => ["Cinema Setup","Add Price"],
    "price_update.php"                => ["Cinema Setup","Edit Price"],

    "room.php"                        => ["Cinema Setup","Room"],
    "room_add.php"                    => ["Cinema Setup","Add Room"],
    "room_update.php"                 => ["Cinema Setup","Edit Room"],

    "schedule.php"                    => ["Cinema Setup","Schedule"],
    "schedule_add.php"                => ["Cinema Setup","Add Schedule"],
    "schedule_update.php"             => ["Cinema Setup","Edit Schedule"]
];

$crumbs = $breadcrumbMap[$current] ?? ["Page"];
?>

<style>
*{ box-sizing:border-box; }

:root{
  --primary:#1f1450;
  --primary-dark:#160d3a;
  --accent:#f2c94c;
  --bg:#e9ebf3;
  --card:#ffffff;
  --text:#1f1f1f;
  --border:#d1d5e3;
}

body{
  margin:0;
  font-family:"Lato",sans-serif;
  background:var(--bg);
  color:var(--text);
}

/* ===== Top navigation ===== */

.topnav{
  background:linear-gradient(90deg,var(--primary),var(--primary-dark));
  padding:0 18px;
  display:flex;
  align-items:center;
  height:52px;
}

.topnav a,
.dropbtn{
  color:#f0f0f0;
  text-decoration:none;
  padding:0 14px;
  line-height:52px;
  font-size:14.5px;
  border:none;
  background:none;
  cursor:pointer;
}

.topnav a:hover,
.dropdown:hover .dropbtn{
  color:var(--accent);
}

/* ===== Dropdown ===== */

.dropdown{
  position:relative;
}

.dropdown-content{
  display:none;
  position:absolute;
  top:52px;
  left:0;
  background:#ffffff;
  min-width:190px;
  box-shadow:0 4px 12px rgba(0,0,0,0.15);
  border-radius:4px;
  z-index:99;
}

.dropdown-content a{
  display:block;
  padding:9px 14px;
  color:#333;
  line-height:normal;
  text-decoration:none;
  font-size:14px;
}

.dropdown-content a:hover{
  background:#f2f3fb;
  color:var(--primary);
}

.dropdown:hover .dropdown-content{
  display:block;
}

/* right side role */
.topnav .role{
  margin-left:auto;
  color:var(--accent);
  font-weight:bold;
}

/* ===== Breadcrumb ===== */

.breadcrumb{
  background:#ffffff;
  padding:10px 18px;
  font-size:14px;
  border-bottom:2px solid var(--primary);
}

.breadcrumb span{ color:#555; }

.breadcrumb span.active{
  color:var(--primary);
  font-weight:600;
}

/* ===== Content card ===== */

.page-container{
  background:var(--card);
  padding:20px;
  border-radius:8px;
  box-shadow:0 6px 16px rgba(0,0,0,0.08);
  margin:12px 8px;
}

/* ===== Tables ===== */

table{
  border-collapse:collapse;
  width:100%;
  background:#ffffff;
}

th{
  background:var(--primary);
  color:#fff;
  padding:10px;
  text-align:center;
}

th a{
  color:var(--accent);
  text-decoration:none;
  font-weight:600;
}

th a:hover{ text-decoration:underline; }

td{
  padding:9px;
  text-align:center;
  border-bottom:1px solid var(--border);
}

tr:nth-child(even){ background:#eef1fb; }
tr:hover{
  background:#dfe4fa;
  transition:background .15s;
}

.poster-thumb{
  width:120px;
  height:auto;
  border-radius:6px;
  box-shadow:0 2px 6px rgba(0,0,0,0.2);
}

/* ===== Print mode ===== */
@media print {
  .topnav,
  .breadcrumb {
    display: none !important;
  }

  body{
    background:white;
  }

  .page-container{
    box-shadow:none;
    margin:0;
  }
}
</style>

<?php
/* =========================================================
   Hide navigation & breadcrumb when PRINT_MODE is enabled
   ========================================================= */
if (empty($PRINT_MODE)) {
?>

<!-- ===== TOP NAVIGATION ===== -->

<div class="topnav">

  <a href="index2.php">Home</a>

<?php if($role=="ADMIN"){ ?>

  <!-- Attendance -->
  <div class="dropdown">
    <button class="dropbtn">Attendance ▾</button>
    <div class="dropdown-content">
      <a href="attendance_admin.php">Manage Attendance</a>
    </div>
  </div>

  <!-- Leave -->
  <div class="dropdown">
    <button class="dropbtn">Leave ▾</button>
    <div class="dropdown-content">
      <a href="leave_admin.php">Manage Leave</a>
    </div>
  </div>

  <!-- Staff -->
  <div class="dropdown">
    <button class="dropbtn">Staff ▾</button>
    <div class="dropdown-content">
      <a href="staff.php">Staff List</a>
      <a href="import_staff.php">Staff Import</a>
    </div>
  </div>

  <!-- Cinema setup -->
  <div class="dropdown">
    <button class="dropbtn">Cinema Setup ▾</button>
    <div class="dropdown-content">
      <a href="movie.php">Movie Setup</a>
      <a href="price.php">Price Setup</a>
      <a href="room.php">Room Setup</a>
      <a href="schedule.php">Movie Schedule</a>
    </div>
  </div>

  <!-- Sales (operational) -->
  <div class="dropdown">
    <button class="dropbtn">Sales ▾</button>
    <div class="dropdown-content">
      <a href="sales.php">Sales Ticket</a>
      <a href="sales_list.php">Ticket Sold List</a>
    </div>
  </div>

  <!-- Reports -->
  <div class="dropdown">
    <button class="dropbtn">Reports ▾</button>
    <div class="dropdown-content">
      <a href="report_attendance.php">Attendance Report</a>
      <a href="report_leave.php">Leave Report</a>
      <a href="report_sales.php">Ticket Sales Report</a>
    </div>
  </div>

<?php } else { ?>

  <a href="attendance.php">Check-In / Check-Out</a>
  <a href="attendance_my.php">My Attendance</a>
  <a href="leave_apply.php">Apply Leave</a>
  <a href="leave_my.php">My Leave</a>

  <!-- Sales (operational) -->
  <div class="dropdown">
    <button class="dropbtn">Sales ▾</button>
    <div class="dropdown-content">
      <a href="sales.php">Sales Ticket</a>
      <a href="sales_list.php">Ticket Sold List</a>
    </div>
  </div>

<?php } ?>

  <a href="signout.php" onclick="return confirm('Are you sure you want to sign out?');">
    Sign Out
  </a>
  
  <span class="role"><?= $role ?></span>

</div>

<!-- ===== BREADCRUMB ===== -->

<div class="breadcrumb">
<?php
$last = count($crumbs)-1;
foreach($crumbs as $i=>$c){
    if($i>0) echo " &gt; ";
    if($i==$last)
        echo "<span class='active'>$c</span>";
    else
        echo "<span>$c</span>";
}
?>
</div>

<?php
} // end PRINT_MODE check
?>