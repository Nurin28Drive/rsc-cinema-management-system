<?php 
require('config.php');
if(isset($_POST["Import"])){
	$filename = $_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0){
		$file = fopen($filename, "r");
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
			//INSERT NEW RECORD 
			$save = "INSERT INTO staff (salesperson, staffname, pass, level)
			values ('".$getData[0]."','".$getData[1]."','".$getData[2]."',
			'".$getData[3]."')";
			$result = mysqli_query($samb,$save);
			if(!isset($result)){
				echo "<script type=\"text/javascript\">
				alert(\"CSV FILE FAILED TO UPLOAD\");
				window.location = \"import_staff.php\" </script>";
			}
			else {
				echo "<script type=\"text/javascript\">
				alert(\"CSV FILE SUCCESSFULLY UPLOADED\");
				window.location = \"staff.php\"
				</script>";
		}
		}
		fclose($file);
	}
}
?>