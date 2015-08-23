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
<div id="buycontent" style="height: auto; padding-top: 5px; padding-bottom:5px; width:800px; color: black; font-size: 110%;">
<div id="nazwa">Ostatnie zakupy</div>
<?

?>
<?php
include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];

?>
    
<?php
	//kod
	
	echo "<div class='contener2' style='width:780px; text-align:center;'> <p style='font-family:Calibri; font-size:16px; color:#bbbbbb'>Ostatnie zakupy:</p>";
	
	$query="SELECT * FROM logs ORDER BY `logs`.`id` DESC LIMIT 0 , 148";
		$result=mysql_query($query);
		$all = mysql_num_rows($result);
		
	while($result_row = mysql_fetch_row(($result))) {
		echo "<a class='dane link' href='#'><img style='margin-top:4px; margin-left:4px; border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".$result_row[2]."/50.png'>";
		echo "<span><div id='inf'>
      ".$result_row[2]."
           </div><table><tbody><tr><td><img style='border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".$result_row[2]."/100.png'></img></td><td>
      
		<p style='font-family:Calibri; font-size:16px; color:#EBEBEB'>Usługa:<br>".$result_row[3]."</p>
		<p style='font-family:Calibri; font-size:16px; color:#EBEBEB'>Zakupiono:<br>".$result_row[6]."</p>

    </td></tr></tbody></table></span></a>";
	}
	
	echo "<p style='font-family:Calibri; font-size:16px; color:#EBEBEB'>Administracja serwera <a class='link2' href='http://".$adrespodstawowy."'>".$nazwa."</a> serdecznie dziękuje za wsparcie serwera!</p></div>";

//koniec kodu

@include "stopka.php";
	mysql_close($connection);

ob_flush();
?>
</div>
</body>