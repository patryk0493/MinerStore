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
if (empty($_POST['wykonaj'])) {
?>
<form action=newvoucher.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto">
<tr>
<td class="komorka">Wpisz nazwę voucher'a:</td>
<td><input type=text class=button name="name"></td>
</tr>
<tr>
<td class="komorka">Wpisz ID usługi (zostaw puste jeżeli voucher nie daje usług!):</td>
<td><input type=text class=button style="width: 60px" name="service"></td>
</tr>
<tr>
<td class="komorka">Wpisz ile punktów dodaje voucher (zostaw puste jeżeli voucher nie daje punktów!)</td>
<td><input type=text class=button style="width: 60px" name="points"></td>
</tr>
<tr>
<td class="komorka">Wpisz ilość voucherów którą chcesz wygenerować:</td>
<td><input type=text class=button style="width: 60px" name="ilosc"></td>
</tr>
<tr>
<td></td>
<td><input type=submit class=button name="wykonaj" value="Dodaj"></td>
</tr>
</table>
<br>
</form>
<?php
}
else {
//okreslenie zmiennych
$name = $_POST['name'];
$service = $_POST['service'];
$points = $_POST['points'];

//sprawdzenie czy wpisane dane są poprawne
$komunikaty = '';
if(empty($name)) {
$komunikaty .= "Musisz wpisać nazwę rabatu! <br>";
}
//jeżeli coś jest źle wyświetla komunikaty
if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
} 
else {
//jak wszystko ok wpisuje do mysqla
if(empty($points)){
$points = 0;
}
if(empty($service)){
$service = 0;
}
$kody = $_POST['ilosc'];
$x = 1;
while($x<=$kody){
$name = addslashes($name);
$points = addslashes($points);
$service = addslashes($service);
$code = (randString(3).'-'.randString(3).'-'.randString(3).'-'.randString(3));
$code = addslashes($code);
mysql_query("INSERT INTO voucher (nazwa, kod, usluga, punkty) VALUES ('$name', '$code', $service, $points)");
echo "<center>Pomyślnie dodano voucher.";
echo "</br>Voucher: ".$code."</br>";
$x++;
}
?>
</br>
<a class="link2 button" href="vouchers.php">Odśwież</a>
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