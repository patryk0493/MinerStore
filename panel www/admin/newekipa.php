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
<form action=ekipa.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto; font-size:95%">
<tr>
<td class="komorka">Wpisz Nick</td>
<td><input type=text class=button  style="width:400px;" name=nick></td>
</tr>
<tr>
<td class="komorka">Wpisz rangę</td>
<td><input type=text class=button  style="width:400px;" name=ranga></td>
</tr>
<tr>
<td class="komorka">Wpisz Skype</td>
<td><input type=text class=button  style="width:400px;" name=skype></td>
</tr>
<tr>
<td class="komorka">Wpisz Gadu-Gadu</td>
<td><input type=text class=button  style="width:400px;" name=gg></td>
</tr>
<tr>
<td class="komorka">Wpisz E-mail</td>
<td><input type=text class=button  style="width:400px;" name=email></td>
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
$ranga = $_POST['ranga'];
$skype = $_POST['skype'];
$gg = $_POST['gg'];
$email = $_POST['email'];

$komunikaty = '';
if(empty($nick)) {
$komunikaty .= "Musisz wpisać nick! <br>";
}
if(empty($ranga)) {
$komunikaty .= "Musisz wpisać rangę! <br>";
}
if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
}
else {
$id = $_POST['id'];
$nick = addslashes($nick);
$ranga = addslashes($ranga);
$skype = addslashes($skype);
$gg = addslashes($gg);
$email = addslashes($email);
mysql_query("INSERT INTO ekipa (nick, ranga, skype, gg, email) VALUES ('$nick', '$ranga', '$skype', '$gg', '$email')");
?>
Pomyślnie zapisano nowego członka ekipy! </br><br>
<a class="link2 button" href="ekipa.php">Przejdź do listy członków</a>
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