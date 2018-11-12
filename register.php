<?php 	include("database.php");

		$title = $_POST['txttitle'];
		$contact = $_POST['txtcontact'];
		$email = $_POST['txtemail'];
		$password = $_POST['txtpassword'];
		$address = $_POST['txtaddress'];
		$location = $_POST['txtlocation'];

		if($title != ""){
			$sql = "select max(id) as id from register";
			$rs = mysql_query($sql);
			$id = 0;
			while($row = mysql_fetch_array($rs)){
				$id = $row['id'];
			}
			if($id == ""){
				$id = 0;
			}
			$id = $id + 1;
			$sql = "insert into register values(".$id.",'".ESQ($title)."','".ESQ($contact)."','".ESQ($email)."','".ESQ($password)."','".ESQ($address)."','".ESQ($location)."')";
			mysql_query($sql);
			
		}
		header('location:index.php');
?>