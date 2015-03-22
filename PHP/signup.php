<?php

define('DB_HOST', 'ruumiderent1.cloudapp.net');
define('DB_NAME', 'ruumiderentdb');
define('DB_USER','guest');
define('DB_PASSWORD','guest');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());


function NewUser()
{
	$fullname = $_POST['name']; 
	$userName = $_POST['user']; 
	$email = $_POST['email'];
	$password = $_POST['pass']; 
	$password_hash = hash('sha512','pass');
	$query = "INSERT INTO WebsiteUsers (fullname,userName,email,pass) VALUES ('$fullname','$userName','$email','$password_hash')"; 
	$data = mysql_query ($query)or die(mysql_error()); if($data) 
	{ 
		echo "New user has been created"; 
	} 
} 
function SignUp() 
{ 
	if(!empty($_POST['user']))  

{ 
	$query = mysql_query("SELECT * FROM WebsiteUsers WHERE userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysql_error()); 

	if(!$row = mysql_fetch_array($query) or die(mysql_error())) 
		{ 
			newuser(); 
		} 
		else 
		{ 
			echo "You are already registered"; 
		} 
} 
} 
if(isset($_POST['submit'])) 
{ 
	SignUp(); 
} 
?>

