<?php 	include("database.php");

		$date = $_POST['txtdate'];
		$type = $_POST['txttype'];
		$title = $_POST['txttitle'];
		$contact = $_POST['txtcontact'];
		$email = $_POST['txtemail'];
		$address = $_POST['txtaddress'];
		$location = $_POST['txtlocation'];
		$status = $_POST['txtstatus'];

		if($date != ""){
			$sql = "select max(sid) as sid from service";
			$rs = mysql_query($sql);
			$sid = 0;
			while($row = mysql_fetch_array($rs)){
				$sid = $row['sid'];
			}
			if($sid == ""){
				$sid = 0;
			}
			$sid = $sid + 1;
			$sql = "insert into service values(".$sid.",'".ESQ($date)."','".ESQ($type)."','".ESQ($title)."','".ESQ($contact)."','".ESQ($email)."','".ESQ($address)."','".ESQ($location)."','".ESQ($status)."')";
			mysql_query($sql);
			
		}
		header('location:index.php?user='.$email);
?>