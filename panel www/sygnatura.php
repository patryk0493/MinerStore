<?php
session_start();
ob_start();
?>
<html>
<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body style="text-align: center">
<?
include 'menu.php';
@include 'informacje.php';
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 0px; width:800px; color: black; font-size: 100%;">
<div id="nazwa">Generator sygnatur</div>
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];


	
	
	echo "<p class='calibri'> Oto sygnatury wygenerowane dla twojego konta, jeśli nie wydzisz obrazka - kliknij poniżej, poczekaj chwilę, nastepnie wróć tutaj i odśwież stronę.</p><br>";
	echo "<a class='link2' href='sygna.php?nick=$player'>Generuj</a><br>
	<img style='border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='stats/$player.png'></img><br><br>
	<input class='button' style='width:450px; height=30px' type='text' name='nazwa' readonly='readonly' value='[img]http://".$adres."/stats/$player.png[/img]'/><br><br>
	
	<a class='link2' href='sygna2.php?nick=$player'>Generuj</a><br>
	<img style='border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='stats/".$player."2.png'></img><br><br>
	<input class='button' style='width:450px; height=30px' type='text' name='nazwa' readonly='readonly' value='[img]http://".$adres."/stats/".$player."2.png[/img]'/><br><br>";
	

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