<?php
session_start();
ob_start();
require("config/polacz.php");
?>
<html>
<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
</head>
<body>

<div id="login" style=" width: 500px; text-align: center; padding:10px">
<?php
if($_SESSION['logged_in'] != true){

$akcja = $_POST['akcja'];
if($akcja == tak) {
$ip = $_SERVER['REMOTE_ADDR'];
$nick = mysql_real_escape_string($_POST['nick']);
$pass = mysql_real_escape_string($_POST['pass']);
$pass_r = mysql_real_escape_string($_POST['pass_r']);
$nick = trim($nick);

// sprawdzanie, czy wpisane dane są poprawne
$check1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM authme WHERE name='$nick' LIMIT 1"));
$check3 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM authme WHERE ip='$ip' LIMIT 1"));
$check4 = strlen($nick);
$check5 = strlen($pass);
?>
<?php
$komunikaty = '';
?>
<?php
if(!$nick || !$pass || !$pass_r) {
$komunikaty .= "Wszystkie pola muszą byc uzupełnione!<br>";
}
if($check4 < 3) {
$komunikaty .= "Nick musi zawierać więcej niż 3 znaki.<br>";
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
if($check1[0] >= 1) {
$komunikaty .= "Ten login jest już zajęty.<br>";
}
if($pass != $pass_r) {
$komunikaty .= "Wpisane hasła nie zgadzają się.<br>";
}

if($komunikaty) {
echo "Rejestracja nie powiodła się. Popraw następujące błędy.<br><span style=\"color: orange\">".$komunikaty."</span><br><br> <a class='link3 button' href='register.php'>Odśwież</a><br> <br> ";
}
else { 
$login = str_replace(' ', '', $nick);
$pass = $_POST['pass'];
$pass2 = md5($pass);
$date = date("d m Y");
$no = 0;
mysql_query ("INSERT INTO authme (name, password, ip, lastlogin, admin, points) VALUES('$nick', '$pass2', '$ip', '$no', '$no', '$no')") or die("Jestem koniem. Nie mogłem Cię zarejestrować");
exit ("Konto zostało pomyślnie zarejestrowane. Możesz się teraz <a class='link3' href=\"index.php\">zalogować</a> i rozpocząć grę na serwerze. <br> <br><a class='link3 button' href='index.php'>Zaloguj się</a> ");
mysql_close($connection);
}
}
?>

<form method=post action="register.php">
Wprowadź dokładny nick:<br>(3-32 znaki)<br> <input type=text name="nick" class="button" lenght=32><br><br>
Wprowadź hasło:<br>(6-32 znaki)<br> <input type=password class="button" name="pass" lenght=32><br><br>
Powtórz hasło:<br> <input type=password name="pass_r" class="button" lenght=32><br><br>
<input type=hidden name="akcja" value="tak">
<input type=submit class="button" value="Rejestruj!"><br><br>
</form>
</div>
<?php
} else {
echo 'Jesteś zalogowany, po co masz się niby rejestrować?</br></br>';
echo '<a class="link2 button" href="index.php">Wróć</a>';
}
ob_flush();
?>
</body>
</html>