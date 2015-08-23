<?
session_start();
?>
<html>
<html>
<head>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="text-align: center">
<?php
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
require '../admin/menu.php';
?>
<br>
<form method="POST">
<input class="button" style="width:500px" type="text" name="komenda">
<input class="button" type="submit" value="Wykonaj Komendę" name="start">
</form>
<?php
if($_POST['start']!="" && $_POST['komenda']!= ""){
	require '../include/rcon_execute.php';
  require '../config/rcon_config.php';
  $r = new minecraftRcon($server, $rconPort, $rconPass);
   if (!$r->Auth()){
   $r->mcSendCommand($_POST['komenda']);
   }
}
} else {
exit("Brak dostepu!");
}
?>
</body>