<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){

include 'menu.php';
include '../config/polacz.php';
?>
<html>
<head>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>

</head>
</div>
<div style="opacity: 1; width: auto; height: auto">
<?php 
$dane = mysql_query("SELECT * FROM authme WHERE admin = 1 AND name != 'ADMIN'");
if (mysql_num_rows($dane) > 0) {
?>
<body style="text-align: center">
<br><br><br><br>
<table id="menubez" style="text-align: center; margin-left: auto; margin-right: auto; font-size:95%">
<tr style="text-align: center">
<td class="st" style="text-align: center; width: 130px"><strong></strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Nick</strong></td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) { 
        echo "<tr>"; 
        echo "<td><img style='margin-top:4px; margin-left:4px; border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".stripslashes($r['name'])."/50.png'></td>";
		echo "<td>".stripslashes($r['name'])."</td>"; 
		echo "<td><form action=deleteadmin.php method=POST><input type=hidden name=id value=".stripslashes($r['id'])."><input type=submit class=button  name=go value=Usuń!></form></td>";
		echo "</tr>";
    }
echo "</table>";
?>
</br>
<?
}
mysql_close($connection);
?>
<div id="menubez" style="text-align: center; width:800px; margin-left: auto; margin-right: auto;">
<h1>Dodawanie admina panelu</h1>
<h3>Podaj dokładny nick</h3>
<?

include 'newadmin.php';

?>
</div>
<?
}
else
{
exit("Nie masz tu dostepu!");
}
?>
</div>
</body>