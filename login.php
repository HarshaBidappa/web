<?php
 
session_start(); 
 if(isset($_POST['submit']))
 {
	$email=$_POST['email'];
	$password=$_POST['password'];
	 require_once('database.php');
	 $query=mysql_query("select email,password from register where email='$email' and password='$password'") or die(mysql_error());
	 
	 if(mysql_num_rows($query)==1)
	 {
		$_SESSION['email']=$email;
		$_SESSION['password']=$password;
		header('location:index.php?user='.$email);
	 }
	 else
	 {
		header('location:index.php?user='.$email);
	 }
 }

?>

 
 


