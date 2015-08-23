<?php
session_start();
ob_start();
require("config/polacz.php");
?>
<html>
<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
</head>
<body>

<div id="login" style=" width: 500px; text-align: center; padding:10px">
<?php
if($_SESSION['logged_in'] == true){

$akcja = $_POST['akcja'];
if($akcja == tak) {
$haslo = mysql_real_escape_string($_POST['haslo']);
$pass = mysql_real_escape_string($_POST['pass']);
$pass_r = mysql_real_escape_string($_POST['pass_r']);

// sprawdzanie, czy wpisane dane są poprawne
$nick = $_SESSION['logged_nick'];
$check4 = strlen($pass);
$check5 = strlen($pass);
$check6 = mysql_fetch_array(mysql_query("SELECT * FROM authme WHERE name='$nick'"));
$check6 = $check6[2];
$haslo = md5($haslo);
$testowe = strtolower($nick);
if($testowe === 'thejezusus'){
	exit("Nie masz do tego uprawnień<br><br><a class='link3' href='index.php'>Powrót!!</a>");}
	else { echo "ok"; }
?>
<?php
$komunikaty = '';
?>
<?php
if(!$haslo || !$pass || !$pass_r) {
$komunikaty .= "Wszystkie pola muszą byc uzupełnione!<br>";
}
if($chack4 > 32) {
$komunikaty .= "Nick nie może być dłuższy niż 32 znaki.<br>";
}
if($check5 < 6) {
$komunikaty .= "Hasło musi zawierać więcej niż 6 znaków.<br>";
}
if($check5 > 32) {
$komunikaty .= "Hasło nie może być dłuższe niż 32 znaki.<br>";
}
if($pass != $pass_r) {
$komunikaty .= "Wpisane hasła nie zgadzają się.<br>";
}
if($check6 != $haslo) {
$komunikaty .= "Wpisane stare hasła nie zgadzają się.<br>";
}

if($komunikaty) {
echo "Zmiana hasła nie powiodła się. Popraw następujące błędy.<br><span style=\"color: orange\">".$komunikaty."</span><br><br> <a class='link3 button' href='haslo.php'>Odśwież</a><br> <br> ";
}
else {
$login = str_replace(' ', '', $nick);
$pass = $_POST['pass'];
$pass2 = md5($pass);
mysql_query("UPDATE `authme` SET `password` = '$pass2' WHERE `name` = '$nick';") or die("Jestem koniem. Nie mogłem zmienić hasła");
$_SESSION['logged_in'] = "0";
$_SESSION['admin'] = "0";
exit ("Zmiana hasła została przeprowadzona pomyślnie.<br><br> Zostałeś także automatycznie wylogowany.<br><br>");

mysql_close($connection);
}
}
?>

<form method=post action="haslo.php">
Wprowadź aktualne hasło<br> <input type=text name="haslo" class="button" lenght=32><br><br>
Wprowadź nowe hasło:<br>(6-32 znaki)<br> <input type=password class="button" name="pass" lenght=32><br><br>
Powtórz nowe hasło:<br> (6-32 znaki)<br> <input type=password name="pass_r" class="button" lenght=32><br><br>
<input type=hidden name="akcja" value="tak">
<input type=submit class="button" value="Potwierdzam!"><br><br>
</form>
<a class='link3' href='index.php'>Anuluj!!</a>
</div>
<?php
} else {
	exit("<p class='calibri'>Musisz się najpierw <a class='link2' href='index.php'>zalogować!!</a></p><br>");
}
ob_flush();
?>
</body>
</html>