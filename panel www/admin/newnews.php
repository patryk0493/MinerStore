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
<form action=news.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto; font-size:95%">
<tr>
<td class="komorka">Wpisz nazwę</td>
<td><input type=text class=button  style="width:400px;" name=nazwa></td>
</tr>
<tr>
<td class="komorka">Treść</td>
<td><textarea class=button  style="width:400px; height:200px" name=tresc></textarea></td>
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
//data
$data2 = date("d-m-Y");
$data1=date("H:i");
$data = $data2 ." ". $data1;

$nazwa = $_POST['nazwa'];
$tresc = $_POST['tresc'];
$autor = $_SESSION['logged_nick'];
$komunikaty = '';
if(empty($nazwa)) {
$komunikaty .= "Musisz wpisać nazwę! <br>";
}
if(empty($tresc)) {
$komunikaty .= "Musisz wpisać treść! <br>";
}
if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
}
else {
$id = $_POST['id'];
$nazwa = addslashes($nazwa);
$tresc = addslashes($tresc);
$tresc = nl2br($tresc) ;
$autor = addslashes($autor);
$data = addslashes($data);
mysql_query("INSERT INTO news (nazwa, tresc, autor, data) VALUES ('$nazwa', '$tresc', '$autor', '$data')");
?>
Pomyślnie zapisano nowy news! </br><br>
<a class="link2 button" href="news.php">Przejdź do newsów</a>
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