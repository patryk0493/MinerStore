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
$dane = mysql_query("SELECT * FROM codes");
if (mysql_num_rows($dane) > 0) {
?>
<body>
<br>
<table id="menubez"  style=" font-size:16px; text-align: center; margin-left: auto; margin-right: auto">
<tr class="st" style="text-align: center">
<td class="st" style="text-align: center; width: 70px">ID</td>
<td class="st" width="50px" height="15px">ID Konta</td>
<td class="st" width="190px">Nazwa</td>
<td class="st" width="60px">Punkty</td>
<td class="st" width="90px">Numer</td>
<td class="st"  width="80px">Netto</td>
<td class="st" width="90px">Brutto</td>
<td class="st" width="150px">Treść</td>
<td class="st" width="30px"></td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) { 
		$numer = stripslashes($r['numer']);
		if($numer>9000){
		$netto = substr($numer, 1, 2); 
		$brutto = $netto*1.23;
		}
		elseif($numer<8000){
		$netto = substr($numer, 1, 1); 
		$brutto = $netto*1.23;
		} else {
		$netto = substr($numer, 1, 1); 
		$brutto = $netto*1.23;
		}
		echo "<tr style=\"text-align: center\">"; 
		echo "<td width=\"80px\">".stripslashes($r['ID'])."</td>";
		echo "<td width=\"130px\">".stripslashes($r['idkonta'])."</td>";
		echo "<td width=\"150px\">".stripslashes($r['nazwa'])."</td>";
		echo "<td width=\"50px\">".stripslashes($r['punkty'])."</td>"; 
		echo "<td width=\"100px\">".stripslashes($r['numer'])."</td>"; 
		echo "<td width=\"60px\">".stripslashes($r['netto'])."</td>";
		echo "<td width=\"60px\">".stripslashes($r['brutto'])."</td>"; 
		echo "<td width=\"200px\">".stripslashes($r['tresc'])."</td>";
		echo "<td><form action='deletecode.php' method='POST'><input type='hidden' name='id' value='".stripslashes($r['ID'])."'><input type=submit name=go class=button value=Usuń!></form></td>";
		echo "</tr>";
    }
echo "</table>";
?>
</br>
<?
}
mysql_close($connection);
include 'newcode.php';
}
else
{
exit("Nie masz tu dostepu!");
}
?>
</body>