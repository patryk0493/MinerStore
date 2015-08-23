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
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 0px; width:840px; color: black; font-size: 110%;">
<div id="nazwa">Ekipa serwera</div>
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

?>
<?php
include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];

?>
    
<?php

	function totime($timee) {
		$sek = $timee % 60;
		$timee -= $sek;
		$timee /= 60;
		if($timee == 0 ) return $sek."s";
		$min = $timee % 60;
		$timee -= $min;
		$timee /= 60;
		if($timee == 0 ) return $min."m ".$sek."s";
		return $timee."h ".$min."m ".$sek."s";
	}
	

	echo "<div style='width:850px'>";
	


    //umiejętności
	$query = "SELECT * FROM `ekipa`"; 
	$result=mysql_query($query);
	echo "<table id='menubez' style='width:825px'>";
	echo "<td style='width:5%'></td>
		<td class='st' style='width:15%'>Nick</td>
		<td class='st' style='width:15%'>Ranga</td>
		<td class='st' style='width:15%'>Skype</td>
		<td class='st' style='width:11%'>Gadu-Gadu</td>
		<td class='st' style='width:20%'>E-mail</td>";
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr>
			<td class='komorka'><img style='border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".$result_row[1]."/40.png'></td>
			<td class='komorka'>".$result_row[1]."</td>
			<td class='komorka'>".$result_row[2]."</td>
			<td class='komorka'>".$result_row[3]."</td>
			<td class='komorka'>".$result_row[4]."</td>
			<td class='komorka'>".$result_row[5]."</td>

		</tr>";
	}
	echo "</table><br><br>";

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