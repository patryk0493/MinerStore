<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){

include("../config/polacz.php");
?>
<html>
<head>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title></head>
<body>
<?php
if ($_POST['wykonaj'] != "tak"){
?><center>
<form action=loteria.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto; font-size:95%">
<tr>
<td class="komorka">Wpisz minimalną ilość losowanych punktów</td>
<td><input type=text class=button  style="width:100px;" name=min></td>
</tr>
<tr>
<td class="komorka">Wpisz maksymalną ilość losowanych punktów</td>
<td><input type=text class=button  style="width:100px;" name=max></td>
</tr>
<input type=hidden name=wykonaj value="tak">
<td></td><td>
<input type=submit class=button  value="Losuj">
</td>
</table>
<br>
</br><br>
<a class="link2 button" href="index.php">Przejdź do menu głównego</a>
</form></br>

<?php
}
else {
$min = $_POST['min'];
$max = $_POST['max'];
$komunikaty = '';
if(empty($min)) {
$komunikaty .= "Musisz wpisać minimalną ilośc losowanych punktów! <br>";
}
if(empty($max)) {
$komunikaty .= "Musisz maksymalną ilośc losowanych punktów! <br>";
}
if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
}
else {

$min = addslashes($min);
$max = addslashes($max);
$pkt = mt_rand($min,$max);


$kto = mysql_query("UPDATE `authme` SET points = points + $pkt WHERE `points`>0 ORDER BY rand() LIMIT 1");
$kto = $kto[1];
?><center>
Wylosowano <? echo $pkt ?> pkt. oraz przekazano losowemu klientowi (<? echo $kto ?>)</br><br>
<a class="link2 button" href="loteria.php">Przejdź do loterii</a>
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