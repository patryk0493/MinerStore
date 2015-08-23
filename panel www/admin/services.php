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
$dane = mysql_query("SELECT * FROM services");
if (mysql_num_rows($dane) > 0) {
?>
<body style="text-align: center">
<br><br>
<table id="menubez" style="text-align: center; margin-left: auto; margin-right: auto; font-size:95%">
<tr style="text-align: center">
<td class="st" style="text-align: center; width: 70px; height=15px"><strong>ID</strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Nazwa</strong></td>
<td class="st" style="text-align: center; width: 200px"><strong>Opis</strong></td>
<td class="st" style="text-align: center; width: 70px"><strong>Koszt</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 1</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 2</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 3</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 4</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 5</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 6</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 7</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Komenda 8</strong></td>
<td class="st" style="text-align: center; width: 170px"><strong>Zniżka</strong></td>
<td class="st" style="text-align: center; width: 70px"><strong></strong></td>
<td class="st" style="text-align: center; width: 70px"><strong></strong></td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) { 
        echo "<tr>"; 
        echo "<td class='komorka'>".stripslashes($r['ID'])."</td>";
        echo "<td class='komorka'>".stripslashes($r['nazwa'])."</td>"; 
        echo "<td class='komorka'>".stripslashes($r['opis'])."</td>"; 
		echo "<td class='komorka'>".stripslashes($r['koszt'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda2'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda3'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda4'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda5'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda6'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda7'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['komenda8'])."</td>";
		echo "<td class='komorka'>".stripslashes($r['znizka'])."</td>";
		echo "<td><form action=editservice.php method=POST><input type=hidden name=id value=".stripslashes($r['ID'])."><input type=submit class=button name=go value=Edytuj!></form></td>";
		echo "<td><form action=deleteservice.php method=POST><input type=hidden name=id value=".stripslashes($r['ID'])."><input type=submit class=button name=go value=Usuń!></form></td>";
		echo "</tr>";
    }
echo "</table>";
?>
</br></br>
<?
}
mysql_close($connection);
?>
<div id="menubez" style="text-align: center">
<h1>UWAGA</h1>
Nie wpisuj NICKu do komend - zamiast "give ASSHunter diamond 64" wpisz "give <strong>GRACZ</strong> diamond 64" - gracz sam zostanie dodany przez skrypt.</br>
</br>
Tak - GRACZ - ponieważ podczas jest on podmieniany za wpisanego gracza podczas kupowania.</br></br>
<?

include 'newservice.php';

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