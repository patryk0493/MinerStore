<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
include("../config/polacz.php");
$id = $_POST['id'];
?>
<html>
<head>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>

</head>
<body>
<?php
if (empty($_POST['submit'])){
$query = mysql_query("SELECT * FROM services WHERE id='$id'");
$info = mysql_fetch_assoc($query);
$nazwa = stripslashes($info['nazwa']);
$opis = stripslashes($info['opis']);
$cost = stripslashes($info['koszt']);
$commands = stripslashes($info['komendy']);
$command1 = stripslashes($info['komenda']);
$command2 = stripslashes($info['komenda2']);
$command3 = stripslashes($info['komenda3']);
$command4 = stripslashes($info['komenda4']);
$command5 = stripslashes($info['komenda5']);
$command6 = stripslashes($info['komenda6']);
$command7 = stripslashes($info['komenda7']);
$command8 = stripslashes($info['komenda8']);
$znizka = stripslashes($info['znizka']);
$img = stripslashes($info['img']);
?>
<form action=editservice.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto">
<tr>
<td class="komorka">Wpisz nazwę usługi</td>
<td><input type='text' name='nazwa' class=button style='width:400px' value='<?php print($nazwa); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz opis usługi (do 200 znaków)</td>
<td><input type=text name=opis class=button style='width:400px' value='<?php print($opis); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz koszt usługi w punktach</td>
<td><input type=text name=cost class=button style='width:400px' value='<?php print($cost); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz ilość używanych komend w usłudze.</td>
<td><input type=text name=commands class=button style='width:400px' value='<?php print($commands); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz komendę (bez "/")</td>
<td><input type=text name=command class=button style='width:400px' value='<?php print($command1); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz drugą komendę (bez "/")</td>
<td><input type=text name=command2 class=button  style='width:400px' value='<?php print($command2); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz trzecią komendę (bez "/")</td>
<td><input type=text name=command3 class=button style='width:400px' value='<?php print($command3); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz czwartą komendę (bez "/")</td>
<td><input type=text name=command4 class=button style='width:400px' value='<?php print($command4); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz piątą komendę (bez "/")</td>
<td><input type=text name=command5 class=button style='width:400px' value='<?php print($command5); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz szóstą komendę (bez "/")</td>
<td><input type=text name=command6 class=button style='width:400px' value='<?php print($command6); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz siódmą komendę (bez "/")</td>
<td><input type=text name=command7 class=button style='width:400px' value='<?php print($command7); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz ósmą komendę (bez "/")</td>
<td><input type=text name=command8 class=button style='width:400px' value='<?php print($command8); ?>'></td>
</tr>
<tr>
<td class="komorka">Wpisz ilość zniżki (lub wpisz 0)</td>
<td><input type=text name=znizka class=button style='width:400px' value='<?php print($znizka); ?>'></td>
</tr>
<tr>
<td class="komorka">Dodaj link do obrazka usługi.</td>
<td><input type=text name=img class=button style='width:400px' value='<?php print($img); ?>'></td>
</tr>
<input type=hidden name=dodaj value="tak">
<input type=hidden name=id value="<?php print($id); ?>">
<td></td><td>
<input type=submit class=button value="Dodaj" name="submit">
</td>
</table>
<br>
<br><br>
<center>
<a class="link2 button" href="news.php">Przejdź do usług</a>
</form></br>
<div class="2aa" style="text-align: center">
<?php
}
if(!empty($_POST['submit'])){
$nazwa = $_POST['nazwa'];
$opis = $_POST['opis'];
$cost = $_POST['cost'];
$forplayer = $_POST['dlagracza'];
$commands = $_POST['commands'];
$znizka = $_POST['znizka'];
$command = $_POST['command'];
if($commands > 1){
$command2 = $_POST['command2'];
}
if($commands > 2){
$command3 = $_POST['command3'];
}
if($commands > 3){
$command4 = $_POST['command4'];
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
$id = $_POST['id'];
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
mysql_query("UPDATE services SET nazwa='$nazwa', `opis`='$opis', `koszt`='$cost', `komendy`='$commands', `dlagracza`='$forplayer', `komenda`='$command', `komenda2`='$command2', `komenda3`='$command3', `komenda4`='$command4', `komenda5`='$command5', `komenda6`='$command6', `komenda7`='$command7', `komenda8`='$command8', `znizka`='$znizka', `img`='$img' WHERE `id`=$id");
echo("Pomyślnie zedytowano usługę!</br>");
print($id);
?>
<center>
<a class="link2" href="services.php">Przejdź do usług</a>
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