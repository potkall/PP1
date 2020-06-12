<!DOCTYPE html>
<?php
session_start();



if ($_POST['user']==="Paradygmaty"&&$_POST['pass']==="Programowania")
{
    
  //oczywiście tutaj najpierw dane z bazy, nie było to elementem zadania, dlatego skróciłem
	$_SESSION['userid'] = 1;
	$_SESSION['user_name'] = "Kris Potecki";
	$_SESSION['stanowisko']="Student";
	$_SESSION['firma']="WSINF";
	$_SESSION['login']="Paradygmaty";
	$_SESSION['email']="wsinf@potkal.pl";
	
    $_SESSION['token'] = "abcdefgh123456";
    $_SESSION['authenticated'] = true;
		
    header("Location: index.php");
}
else
{
	
	header("Location: login.php?proby=err");
}


?>
