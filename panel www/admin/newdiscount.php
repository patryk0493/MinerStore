<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){

include("../config/polacz.php");
function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
	}
    return $str;
}
?>
<html>
<head>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>
</head>
<?php
if ($_POST['wykonaj'] != "taaaaaaaaak!") {
?>
<form action=newdiscount.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto">
<tr>
<td class="komorka">Wpisz nazwę rabatu:</td>
<td><input type=text class=button name="name"></td>
</tr>
<tr>
<td class="komorka">Wpisz procent rabatu:</td>
<td><input type=text class=button style="width: 30px" name="procent"> %</td>
</tr>
<tr>
<td class="komorka">Wpisz ile razy można użyć rabatu:</td>
<td><input type=text class=button style="width: 30px" name="uzycia"></td>
</tr>
<tr>
<td></td>
<td><input type=submit class=button value="Dodaj"></td>
</tr>
</table>
<br>
<input type=hidden name="wykonaj" value="taaaaaaaaak!"></form>
<?php
}
else {
//okreslenie zmiennych
$name = $_POST['name'];
$procent = $_POST['procent'];
$uzycia = $_POST['uzycia'];

//sprawdzenie czy wpisane dane są poprawne
$komunikaty = '';
if(empty($name)) {
$komunikaty .= "Musisz wpisać nazwę rabatu! <br>";
}
if(empty($procent)) {
$komunikaty .= "Musisz wpisać procentową zniżkę! <br>";
}
if(is_numeric($procent)) {
}
else {
$komunikaty .= "Procent zniżki musi być liczbą! <br>";
}
if(is_numeric($uzycia)) {
}
else {
$komunikaty .= "Liczba użyć musi być liczbą! <br>";
}
if($uzycia < 0) {
$komunikaty .= "Liczba użyć musi być większa od 0. <br>";
}

//jeżeli coś jest źle wyświetla komunikaty
if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
} 
else {
//jak wszystko ok wpisuje do mysqla
$name = addslashes($name);
$procent = addslashes($procent);
$uzycia = addslashes($uzycia);
$code = (randString(4).'-'.randString(4).'-'.randString(4));
$code = addslashes($code);
mysql_query("INSERT INTO rabat (nazwa, kod, procent, uzycia) VALUES ('$name', '$code', $procent, $uzycia)");
echo "<center>Pomyślnie dodano rabat.";
echo "</br>Kod rabatowy: ".$code."";
?>
</br></br>
<a class="link3 button" href="discount.php">Odśwież</a>
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

</html>