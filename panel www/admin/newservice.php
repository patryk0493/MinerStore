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
?>
<form action=services.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto; font-size:95%">
<tr>
<td class="komorka">Wpisz nazwę usługi</td>
<td><input type=text class=button style="width:400px" name=nazwa></td>
</tr>
<tr>
<td class="komorka">Wpisz opis usługi (do 200 znaków)</td>
<td><input type=text class=button style="width:400px" name=opis></td>
</tr>
<tr>
<td class="komorka">Wpisz koszt usługi w punktach</td>
<td><input type=text class=button style="width:400px" name=cost></td>
</tr>
<tr>
<td class="komorka">Wpisz ilość używanych komend w usłudze.</td>
<td><input type=text class=button style="width:400px" name=commands></td>
</tr>
<tr>
<td class="komorka">Wpisz komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command></td>
</tr>
<tr>
<td class="komorka">Wpisz drugą komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command2></td>
</tr>
<tr>
<td class="komorka">Wpisz trzecią komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command3></td>
</tr>
<tr>
<td class="komorka">Wpisz czwartą komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command4></td>
</tr>
<tr>
<td class="komorka">Wpisz piątą komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command5></td>
</tr>
<tr>
<td class="komorka">Wpisz szóstą komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command6></td>
</tr>
<tr>
<td class="komorka">Wpisz siódmą komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command7></td>
</tr>
<tr>
<td class="komorka">Wpisz ósmą komendę (bez "/")</td>
<td><input type=text class=button style="width:400px" name=command8></td>
</tr>
<tr>
<td class="komorka">Wpisz ilość zniżki (domyślnie 0)</td>
<td><input type=text class=button style="width:400px" name=znizka></td>
</tr>
<tr>
<td class="komorka">Dodaj link do obrazka usługi.</td>
<td><input type=text class=button style="width:400px" name=img></td>
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
$nazwa = $_POST['nazwa'];
$opis = $_POST['opis'];
$cost = $_POST['cost'];
$forplayer = $_POST['dlagracza'];
$commands = $_POST['commands'];
$command = $_POST['command'];
$znizka = $_POST['znizka'];
if($commands > 1){
$command2 = $_POST['command2'];
}
if($commands > 2){
$command3 = $_POST['command3'];
}
if($commands > 3){
$command4 = $_POST['command4'];
}
if($commands > 4){
$command5 = $_POST['command5'];
}
if($commands > 5){
$command6 = $_POST['command6'];
}
if($commands > 6){
$command7 = $_POST['command7'];
}
if($commands > 7){
$command8 = $_POST['command8'];
}
if($commands > 8){
exit("Maksymalnie 8 komend!");
}
$komunikaty = '';
if(empty($nazwa)) {
$komunikaty .= "Musisz wpisać nazwę usługi! <br>";
}
if(empty($opis)) {
$komunikaty .= "Musisz wpisać opis usługi! <br>";
}
if(empty($cost)) {
$komunikaty .= "Musisz wpisać koszt usługi (w punktach)! <br>";
}
if(empty($command)) {
$komunikaty .= "Musisz wpisać komendę jaką ma wywołać serwer! <br>";
}
if(empty($commands)) {
$komunikaty .= "Musisz wpisać ile komend ma wywołać serwer! <br>";
}
if(!is_numeric($cost)) {
$komunikaty .= "Wartość punktów musi być liczbą! <br>";
}
if($cost < 0) {
$komunikaty .= "Wartość punktów musi być większa od zera! <br>";
}
if(strlen($opis) > 200) {
$komunikaty .= "Opis nie może być dłuższy niż 200 znaków! <br>";
}

if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
}
else {
$nazwa = addslashes($nazwa);
$opis = addslashes($opis);
$cost = addslashes($cost);
$commands = addslashes($commands);
$forplayer = addslashes($forplayer);
$command = addslashes($command);
$command2 = addslashes($command2);
$command3 = addslashes($command3);
$command4 = addslashes($command4);
$command5 = addslashes($command5);
$command6 = addslashes($command6);
$command7 = addslashes($command7);
$command8 = addslashes($command8);
$znizka = addslashes($znizka);
$img = $_POST['img'];
mysql_query("INSERT INTO services (nazwa, opis, koszt, komendy, dlagracza, komenda, komenda2, komenda3, komenda4, komenda5, komenda6, komenda7, komenda8, znizka, img) VALUES ('$nazwa', '$opis', '$cost', '$commands', '$forplayer', '$command', '$command2', '$command3', '$command4', '$command5', '$command6', '$command7', '$command8', '$znizka', '$img')");
?>
Pomyślnie zapisano nową usługę! </br><br>
<a class="link2 button" href="services.php">Przejdź do usług</a>
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