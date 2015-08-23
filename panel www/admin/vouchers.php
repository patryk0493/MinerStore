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
$dane = mysql_query("SELECT * FROM voucher");
if (mysql_num_rows($dane) > 0) {
?>
<body>
<br><br>
<table id="menubez" style="text-align: center; margin-left: auto; margin-right: auto">
<tr style=" text-align: center">
<td class="st" width="190px">Nazwa</td>
<td class="st" width="250px">Kod</td>
<td class="st" width="200px">Usługa</td>
<td class="st" width="90px">Punkty</td>
<td class="st" width="80px">Zużyty?</td>
<td class="st" width="50px"></td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) { 
		echo "<tr style=\"text-align: center\">"; 
		echo "<td width=\"150px\">".stripslashes($r['nazwa'])."</td>";
		echo "<td width=\"150px\">".stripslashes($r['kod'])."</td>";
			if(stripslashes($r['usluga']) == 0){
				$usluga = 'BRAK';
			}
			else {
				$usluga = stripslashes($r['usluga']);
				$dane2 = "SELECT * FROM services WHERE ID=$usluga";
				$dane3 = mysql_query($dane2);
				$r2 = mysql_fetch_array($dane3);
				$usluga = stripslashes($r2['nazwa']);
			}
			if(stripslashes($r['punkty']) == 0){
				$punkty = 'BRAK';
			}
			else {
				$punkty = stripslashes($r['punkty']);
			}

		echo "<td width=\"50px\">".$usluga."</td>"; 
		echo "<td width=\"50px\">".$punkty."</td>";
		$uzyto = stripslashes($r['uzyto']);
		if($uzyto == 1){
		$uzyto = "TAK";
		} else {
		$uzyto = "NIE";
		}
		echo "<td width=\"60px\">".$uzyto."</td>";
		echo "<form action='deletevoucher.php' method='POST'><td width=\"50px\"><input type='hidden' name='id' class='button' value='".stripslashes($r['id'])."'><input type=submit class=button name=go value=Usuń!></td></form>";
		echo "</tr>";
    }
echo "</table>";
?>
</br>
<?
}
mysql_close($connection);
include 'newvoucher.php';
}
else
{
exit("Nie masz tu dostepu!");
}
?>
</body>