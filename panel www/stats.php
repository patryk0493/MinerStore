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
<body style="text-align: center; font-family:Calibri">
<?
include 'menu.php';
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 0px; width:800px; color: black; font-size: 110%;">
<div id="nazwa">Statystyki</div>
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
	

	echo "<center><div class=szerokosc><br> ";
	echo "<table><tr><td><h2 class=st2>Ogólne</h2>";
	$query = "SELECT COUNT( `name` ) FROM `players`";
	$result=mysql_query($query);
	echo "<div class=info>Liczba zarejestrowanych graczy: ".mysql_result($result,0,0);
	$query = "SELECT `PLAYTIME` FROM `players`";
	$result=mysql_query($query);
	$suma = 0;
	while($result_row = mysql_fetch_row(($result))) {
			$suma += $result_row[0];
	}
	echo "<br>Czas graczy spędzony w grze: ".totime($suma);
	$query = "SELECT SUM(`LOGIN`) FROM `players`";
	$result=mysql_query($query);
	echo "<br>Wszystkich logowań: ".mysql_result($result,0,0);
	$query = "SELECT SUM(`KILLS_TOTAL`) FROM `players`";
	$result=mysql_query($query);
	echo "<br>Wszystkich zabójstw: ".mysql_result($result,0,0);
	$query = "SELECT SUM(`DEATHS_TOTAL`) FROM `players`";
	$result=mysql_query($query);
	echo "<br>Wszystkich śmierci: ".mysql_result($result,0,0);
	$query = "SELECT SUM(`LEVEL`) FROM `players`";
	$result=mysql_query($query);
	echo "<br>Suma leveli: ".mysql_result($result,0,0);
	$query = "SELECT SUM(`ENCHANTING_TOTAL`) FROM `players`";
	$result=mysql_query($query);
	echo "<br>Suma enchantowanych itemów: ".mysql_result($result,0,0);
	$query = "SELECT SUM(`COMMAND`) FROM `players`";
	$result=mysql_query($query);
	echo "<br>Suma użytych komend: ".mysql_result($result,0,0);
	
	
	$query = "SELECT `MOVE` FROM `players`";
	$result=mysql_query($query);
	$suma = 0;
	while($result_row = mysql_fetch_row(($result))) {
			$suma += $result_row[0];
	}
	echo "<br>Przebyta odległość: ".$suma."</div>";
	echo "<h2 class=st2>Bloki</h2>";
	$query = "SELECT SUM(`BLOCKCREATE_TOTAL`) FROM `players`";
	$result=mysql_query($query);
	echo "<div class=info>Postawione: ".mysql_result($result,0,0);
	$query = "SELECT SUM(`BLOCKDESTROY_TOTAL`) FROM `players`";
	$result=mysql_query($query);
	echo "<br>Zniszczone: ".mysql_result($result,0,0)."</div></td>";
	
	echo "<td><h2 class=st2>Wydobyte minerały</h2>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 129";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<div class=info><img align='middle' src='items/Emerald.png'> Szmaragdy: ".$dd."<br>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 56";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/Diamond.png'> Diamenty: ".$dd."<br>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 14";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/Gold.png'> Złoto: ".$dd."<br>";
		
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 1";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/cobble.png'> Kamień: ".$dd."<br>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 16";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/Coal.png'> Węgiel: ".$dd."<br>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 15";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/Iron.png'> Żelazo: ".$dd."<br>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 74";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/Redstone.png'> Red Stone: ".$dd."<br>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 21";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/Lapis.png'> Lapis Lazuli: ".$dd."<br>";
		$query="SELECT SUM(`value`) FROM stats WHERE `type`='BLOCKDESTROY' AND `block` = 12";
		$result=mysql_query($query);
		if(mysql_result($result,0,0)) $dd = mysql_result($result,0,0); else $dd =0;
		echo "<img align='middle' src='items/piasek.png'> Piasek: ".$dd."
		</div></td></tr></table><br>";
		
//Pieniądze
		
	echo "<h2 class=st2>Pieniądze TOP 10</h2>";
	$query = "SELECT * FROM `iConomy` ORDER BY `balance` DESC LIMIT 10"; 
	$result=mysql_query($query);
	echo "<table id=menubez style='width:400px'><tr><td class=st>Lp.</td><td class=st colspan=2>Nick</td><td class=st>Kasa</td></tr>";
	$i = 1;
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr><td class=komorka>".$i."</td><td class='ramka komorka'><img src='https://minotar.net/avatar/".$result_row[1]."/32.png'></td><td class=komorka><a class='link2' href='gracze.php?player=".$result_row[1]."'>".$result_row[1]."</a></td><td class=komorka>".$result_row[2]."</td></tr>";
		$i++;
	}
	echo "</table>";

	echo "<h2 class=st2>Czas na serwerze</h2>";
	$query = "SELECT * FROM `players` ORDER BY `PLAYTIME` DESC LIMIT 10"; 
	$result=mysql_query($query);
	echo "<table id=menubez style='width:400px'><tr><td class=st>Lp.</td><td class=st colspan=2>Nick</td><td class=st>Czas</td></tr>";
	$i = 1;
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr><td class=komorka>".$i."</td><td class='ramka komorka'><img src='https://minotar.net/avatar/".$result_row[1]."/32.png'></td><td class=komorka><a class='link2' href='gracze.php?player=".$result_row[1]."'>".$result_row[1]."</a></td><td class=komorka>".totime($result_row[33])."</td></tr>";
		$i++;
	}
	echo "</table>";
	
    echo "<h2 class=st2>Budowniczy TOP 10</h2>";
	$query = "SELECT * FROM `players` ORDER BY `BLOCKCREATE_TOTAL` DESC LIMIT 10"; 
	$result=mysql_query($query);
	echo "<table id=menubez style='width:400px'><tr><td class=st>Lp.</td><td class=st colspan=2>Nick</td><td class=st>Postawione</td></tr>";
	$i = 1;
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr><td class=komorka>".$i."</td><td class='ramka komorka'><img src='https://minotar.net/avatar/".$result_row[1]."/32.png'></td><td class=komorka><a class='link2' href='gracze.php?player=".$result_row[1]."'>".$result_row[1]."</a></td><td class=komorka>".$result_row[10]."</td></tr>";
		$i++;
	}
	echo "</table>";
	
	echo "<h2 class=st2>Zabójstwa TOP 10</h2>";
	$query = "SELECT * FROM `players` ORDER BY `KILLS_TOTAL` DESC LIMIT 10"; 
	$result=mysql_query($query);
	echo "<table id=menubez style='width:400px'><tr><td class=st>Lp.</td><td class=st colspan=2>Nick</td><td class=st>Zabójstwa</td></tr>";
	$i = 1;
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr><td class=komorka>".$i."</td><td class='ramka komorka'><img src='https://minotar.net/avatar/".$result_row[1]."/32.png'></td><td class=komorka><a class='link2' href='gracze.php?player=".$result_row[1]."'>".$result_row[1]."</a></td><td class=komorka>".$result_row[6]."</td></tr>";
		$i++;
	}
	echo "</table>";

	echo "<h2 class=st2>Prace</h2>";
	$query = "SELECT job, COUNT( `username` ) FROM `jobs` GROUP BY `job`";
	$result=mysql_query($query);
	echo "<table id=menubez style='width:400px'><tr><td class=st>Praca</td><td class=st>Ilość graczy</td></tr>";
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr><td class=komorka>".$result_row[0]."</td><td class=komorka>".$result_row[1]."</td></tr>";
	}
	echo "</table><br>";
	

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