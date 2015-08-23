<?php
session_start();
ob_start();
?>
<html>
<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body style="text-align: center; font-family:Calibri">
<?
include 'menu.php';
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 0px; width:800px; color: black;">
<div id="nazwa">Kontakt</div>
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

?>
<?php
include 'config/polacz.php';
@include 'informacje.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];

?>
    
<?php
// sprawdzamy, czy zmienna $submit jest pusta
if (empty($_POST['submit'])) {
    // wyświetlamy formularz
    echo "<table align=\"center\" border=\"0\"><form method=\"post\">
<td>Temat</td>
<td><input class=\"button\" type=\"text\" name=\"subject\" style=\"width: 500px\"></td>
</tr>
<tr>
<td>Treść wiadomości</td>
<td><textarea name=\"tresc\" class=\"button\" style=\"width: 500px; height: 200px\"></textarea></td>
</tr>
<tr>
<td>Adres e-mail</td>
<td><input class=\"button\" type=\"text\" name=\"mail\" style=\"width: 500px\"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input class=\"button\" type=\"submit\" name=\"submit\" value=\"Wyślij\">&nbsp;
<input class=\"button\" type=\"reset\" value=\"Resetuj\"></td></form>
</tr>
</table>";
}
// sprawdzamy, czy zmienne przesłane z formularza nie są puste
elseif (!empty($_POST['tresc']) && !empty($_POST['mail'])) {
	
$to      = 'patryk0493@gmail.com';
$subject = $_POST['subject'];
$message = $_POST['tresc'];
$headers = 'From: ' . $_POST['mail'] . "\r\n" .
	'Content-type: text/html; charset=utf-8';

mail($to, $subject, $message, $headers) or die('Nie wysłano emaila');
    // wyświetlenie komunikatu w przypadku powodzenia
    echo "<div class='link3' align=\"center\" style=\"margin:10px\">Wiadomość została wysłana poprawnie!</div><br><br> Postaramy się odpowiedzieć jak najprędzej!";
}
// lub w przypadku nie wypełnienia formularza do końca
else echo "<span class='link3' align=\"center\" style=\"margin:10px\">Wypełnij wszystkie pola formularza!<br><br> <a class='link3 button' href='kontakt.php'>Popraw wiadomość</a></span><br><br>";
	
@include "stopka.php";
	mysql_close($connection);

}
else
{
	exit("<p class='calibri'>Musisz się najpierw <a class='link2' href='index.php'>zalogować!!</a></p><br>");
}
ob_flush();
?>
</div>
</body>