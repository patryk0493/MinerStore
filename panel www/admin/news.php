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
$dane = mysql_query("SELECT * FROM news");
if (mysql_num_rows($dane) > 0) {
?>
<body style="text-align: center">
<br><br><br><br>
<table id="menubez" style="text-align: center; margin-left: auto; margin-right: auto; font-size:95%">
<tr style="text-align: center">
<td class="st" style="text-align: center; width: 70px; height=15px"><strong>ID</strong></td>
<td class="st" style="text-align: center; width: 300px"><strong>Nazwa</strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Autor</strong></td>
<td class="st" style="text-align: center; width: 130px"><strong>Data i czas</strong></td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) { 
        echo "<tr>"; 
        echo "<td>".stripslashes($r['ID'])."</td>";
        echo "<td>".stripslashes($r['nazwa'])."</td>"; 
		echo "<td>".stripslashes($r['autor'])."</td>";
		echo "<td>".stripslashes($r['data'])."</td>";
		echo "<td><form action=editnews.php method=POST><input type=hidden name=id value=".stripslashes($r['ID'])."><input type=submit class=button  name=go value=Edytuj!></form></td>";
		echo "<td><form action=deletenews.php method=POST><input type=hidden name=id value=".stripslashes($r['ID'])."><input type=submit class=button  name=go value=Usuń!></form></td>";
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
<h1>Tworzenie newsa</h1>
Na stronie głównej mieszczą się 2 długie newsy lub/i do 5 krótkich, pamiętaj, aby usuwać stare newsy!! Nie pisz ich za długich lub za dużo, mogą "wyjeżdzać" poza ich miejsce.
</br></br>
<?

include 'newnews.php';

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