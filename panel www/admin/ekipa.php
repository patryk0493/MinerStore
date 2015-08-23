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
<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>

</head>
</div>
<div style="opacity: 1; width: auto; height: auto">
<?php 
$dane = mysql_query("SELECT * FROM ekipa");
if (mysql_num_rows($dane) > 0) {
?>
<body style="text-align: center">
<br><br><br><br>
<table id="menubez" style="text-align: center; margin-left: auto; margin-right: auto; font-size:95%">
<tr style="text-align: center">
<td class="st" style="text-align: center; width: 70px; height=15px"><strong>ID</strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Nick</strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Ranga</strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Skype</strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Gadu-Gadu</strong></td>
<td class="st" style="text-align: center; width: 200px"><strong>E-mail</strong></td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) { 
        echo "<tr>"; 
        echo "<td>".stripslashes($r['ID'])."</td>";
        echo "<td>".stripslashes($r['nick'])."</td>";
		echo "<td>".stripslashes($r['ranga'])."</td>"; 
		echo "<td>".stripslashes($r['skype'])."</td>";
		echo "<td>".stripslashes($r['gg'])."</td>";
		echo "<td>".stripslashes($r['email'])."</td>"; 
		echo "<td><form action=editekipa.php method=POST><input type=hidden name=id value=".stripslashes($r['ID'])."><input type=submit class=button  name=go value=Edytuj!></form></td>";
		echo "<td><form action=deleteekipa.php method=POST><input type=hidden name=id value=".stripslashes($r['ID'])."><input type=submit class=button  name=go value=Usuń!></form></td>";
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
<h1>Dodawanie ekipy</h1>
<?

include 'newekipa.php';

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