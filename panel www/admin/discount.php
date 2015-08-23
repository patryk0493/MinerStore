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
<?php 
$dane = mysql_query("SELECT * FROM rabat ORDER BY procent");
if (mysql_num_rows($dane) > 0) {
?>
<body>
<br><br>
<table id="menubez" style="background: black; text-align: center; margin-left: auto; margin-right: auto">
<tr class="st" style="text-align: center">
<td class="st" style="text-align: center; width: 70px">ID</td>
<td class="st" width="190px">Nazwa</td>
<td class="st" width="250px">Kod</td>
<td class="st" width="60px">Procent</td>
<td class="st" width="90px">Liczba użyć:</td>
<td class="st" width="80px">Użyto już:</td>
<td class="st" width="50px">Usunąć?</td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) { 
		echo "<tr style=\"text-align: center\">"; 
		echo "<td width=\"80px\">".stripslashes($r['ID'])."</td>";
		echo "<td width=\"150px\">".stripslashes($r['nazwa'])."</td>";
		echo "<td width=\"150px\">".stripslashes($r['kod'])."</td>";
		echo "<td width=\"50px\">".stripslashes($r['procent'])."</td>"; 
		echo "<td width=\"100px\">".stripslashes($r['uzycia'])."</td>"; 
		echo "<td width=\"60px\">".stripslashes($r['uzyto'])."</td>";
		echo "<form action='deletediscount.php' method='POST'><td width=\"50px\"><input type='hidden' name='id' value='".stripslashes($r['ID'])."'><input type=submit name=go class=button value=Usuń!></td></form>";
		echo "</tr>";
    }
echo "</table>";
?>
</br>
<?
}
mysql_close($connection);
include 'newdiscount.php';
}
else
{
exit("Nie masz tu dostepu!");
}
?>
</body>