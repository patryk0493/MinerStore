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
@include 'informacje.php';
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 5px; padding-bottom:5px; width:800px; color:#BEBEBE; text-align:center; font-size: 110%;">
<div id="nazwa">Moje zakupy</div>
<?

?>
<?php
include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];

?>
    
<?php
	//kod
	

	
	$query="SELECT * FROM logs WHERE konto = '$player' ORDER BY `logs`.`data` DESC";
		$result=mysql_query($query);
		$all = mysql_num_rows($result);
	if($all>0){
	echo "<table id='menubez' style='width:790px'><tr>
	<td class=st style='width:15%'>Komu</td>
	<td class=st style='width:20%'>Co</td>
	<td class=st style='width:10%'>Za</td>
	<td class=st style='width:20%'>Kiedy</td>
	<td class=st style='width:10%'>Stan konta</td>
	</tr>";
	
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr>
			<td class=komorka>".$result_row[1]."</td>
			<td class=komorka>".$result_row[3]."</td>
			<td class=komorka>".$result_row[4]."</td>
			<td class=komorka>".$result_row[6]."</td>
			<td class=komorka>".$result_row[5]."</td>
			</tr>
		";
	}
	} else {
		echo "Nic jeszcze nie zakupiłeś!!!";
	}
	echo "</table><br><br>";
	

//koniec kodu

@include "stopka.php";
	mysql_close($connection);

ob_flush();
?>
</div>
</body>