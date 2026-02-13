<?php require('config.php'); ?>

<style>
.app-footer{
  margin-top:auto;
  padding:12px 20px;
  background:var(--primary,#1f1450);
  color:#ffffff;
  text-align:center;
  font-size:13px;
  border-top:2px solid var(--accent,#f2c94c);
}
</style>

<div class="app-footer">
  © <?php echo date("Y"); ?> <?php echo $sysname; ?>. All rights reserved.
</div>

</body>
</html>