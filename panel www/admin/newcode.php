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
	<title>Panel gracza | Sklep SMS | Minecraft</title>
</head>
<?php
if ($_POST['wykonaj'] != "taaaaaaaaak!") {
?>
<form action=codes.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto">
<tr>
<td class="komorka">Wpisz nazwę:</td>
<td><input type=text class=button name="name"></td>
</tr>
<tr>
<td class="komorka">Wpisz ID swojego konta SMS:</td>
<td><input type=text class=button name="idkonta"></td>
</tr>
<tr>
<td class="komorka">Wpisz treść SMSa:</td>
<td><input type=text class=button name="tresc"></td>
</tr>
<tr>
<td class="komorka">Wpisz numer SMSa:</td><td><input type=text class=button name="number"></td>
</tr>
<tr>
<td class="komorka">Wpisz ilość punktów:</td>
<td><input type=text class=button name=points></td>
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
$idkonta = $_POST['idkonta'];
$tresc = $_POST['tresc'];
$number = $_POST['number'];
$points = $_POST['points'];

//sprawdzenie czy wpisane dane są poprawne
$komunikaty = '';
if(empty($name)) {
$komunikaty .= "Musisz wpisać nazwę usługi! <br>";
}
if(empty($tresc)) {
$komunikaty .= "Musisz wpisać treść SMSa! <br>";
}
if(empty($number)) {
$komunikaty .= "Musisz wpisać numer pod który ma być wysłany SMS! <br>";
}
if(empty($points)) {
$komunikaty .= "Musisz wpisać ilość punktów przyznawaną za wysłanie SMSa! <br>";
}
if(is_numeric($number)) {
}
else {
$komunikaty .= "Numer pod który ma być wysłany SMS musi być numerem. <br>";
}
if(is_numeric($points)) {
}
else {
$komunikaty .= "Liczba punktów przyznawanych musi być liczbą! <br>";
}
if($points < 0) {
$komunikaty .= "Liczba punktów musi być większa od 0. <br>";
}

//jeżeli coś jest źle wyświetla komunikaty
if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
} 
else {
//jak wszystko ok wpisuje do mysqla

if($number>9000){
$netto = substr($number, 1, 2); 
$brutto = $netto*1.23;
}
elseif($number<8000){
$netto = substr($number, 1, 1); 
$brutto = $netto*1.23;
} else {
$netto = substr($number, 1, 1); 
$brutto = $netto*1.23;
}
$name = addslashes($name);
$tresc = addslashes($tresc);
$number = addslashes($number);
$points = addslashes($points);
mysql_query("INSERT INTO codes (nazwa, tresc, numer, punkty, netto, brutto, idkonta) VALUES ('$name', '$tresc', '$number', '$points', '$netto', '$brutto', '$idkonta')");
echo "<br><center>Pomyślnie dodano usługę.";
?>
</br><br>
<a class="link3 button" href="codes.php">Odśwież</a>
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