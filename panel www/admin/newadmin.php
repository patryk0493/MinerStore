<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){

include("../config/polacz.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>
</head>
<body>
<?php
if ($_POST['wykonaj'] != "tak"){
?><center>
<form action=admin.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto; font-size:95%">
<tr>
<td class="komorka">Wpisz Nick</td>
<td><input type=text class=button  style="width:200px;" name=nick></td>
</tr>
<input type=hidden name=wykonaj value="tak">
<td></td><td>
<input type=submit class=button  value="Dodaj">
</td>
</table>
<br>
</form></br>
<div id="menubez" style="text-align: center">
<?php
}
else {
$nick = $_POST['nick'];

$komunikaty = '';
if(empty($nick)) {
$komunikaty .= "Musisz wpisać nick! <br>";
}
else {
$nick = $_POST['nick'];
mysql_query("UPDATE `authme` SET `admin` = 1 WHERE  name = '$nick' ");
?>
Pomyślnie zapisano nowego admina panelu! </br><br>
<a class="link2 button" href="admin.php">Odśwież listę adminów panelu</a>
</br><br>
</div>
<?
}
}
mysql_close($connection);
}
else
{
exit("Nie masz tu dostepu!");
}
?>
</body>
</html>