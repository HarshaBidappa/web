<?php 	include("database.php");

		$title = $_POST['txttitle'];
		$email = $_POST['txtemail'];
		$location = $_POST['txtlocation'];
		$date = $_POST['txtdate'];
		$content = $_POST['txtcontent'];

		if($title != ""){
			$sql = "select max(id) as id from feedback";
			$rs = mysql_query($sql);
			$id = 0;
			while($row = mysql_fetch_array($rs)){
				$id = $row['id'];
			}
			if($id == ""){
				$id = 0;
			}
			$id = $id + 1;
			$sql = "insert into feedback values(".$id.",'".ESQ($title)."','".ESQ($email)."','".ESQ($location)."','".ESQ($date)."','".ESQ($content)."')";
			mysql_query($sql);
			
		}
		header('location:index.php');
?>