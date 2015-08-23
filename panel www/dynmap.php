<?php
session_start();
ob_start();
?>
<html>
<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
</head>
<body style="text-align: center; font-family:Calibri">
<?
include 'menu.php';
@include 'informacje.php';
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 5px; padding-bottom:5px; width:900px; color: black; font-size: 110%;">
<div id="nazwa">Mapa serwera</div>
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

?>
<?php
include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];

?>
    
<?php
	
	
echo " <iframe src='http://".$adresdynmap."/#' width='895' height='700' 
  frameborder='1'>
    ups... twoja przeglądarka nie obsługuje ramek.
  </iframe>";

@include "stopka.php";
	mysql_close($connection);
}
else
{
	exit("<p class='calibri'>Musisz się najpierw <a class='link2' href='index.php'>zalogować!!</a></p><br>");
}
ob_flush();
?>
</div>
</body>