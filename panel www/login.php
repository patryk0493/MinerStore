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
</head>
<body>

<div id="login" style="color:#D6D6D6;font-size: 100%; font-family: Tahoma; width: 400px; height:400px; left:50%;right:50%; text-align: center">
<?php
$topola = 0;
require("config/polacz.php");
if ( $_GET['login'] OR $_GET['pass']) {
exit();
}
$wykonano = $_POST['wykonano'];
if (!$wykonano OR empty($wykonano)) {
echo "<form action=\"login.php\" method=post> Logowanie do panelu<br><br> Login: <input type=text class=\"button\" name=\"nick\" maxlenght=32><br><br>Hasło: <input type=password class=\"button\" name=\"pass\"><br><input type=hidden name=\"wykonano\" value=\"tak\"><br><br><input class=\"button\" type=submit value=\"Zaloguj\"></form>";
}

else 
{
$nick = $_POST['nick'];
$pass2 = $_POST['pass'];
$pass3 = mysql_real_escape_string($pass2);
$nick = mysql_real_escape_string($nick); 
$pass = md5($pass3);

if(!$nick or empty($nick)){
echo "<p class='link'>Musisz wprowadzic login.</p>";}
if(!$pass or empty($pass)) {
echo "<p class='link'>Musisz wprowadzic hasło.</p>";}
$zap = "SELECT password FROM authme WHERE name='$nick'";
$zap1 = mysql_query($zap) or die(mysql_error()); 
$checkpass = mysql_fetch_array($zap1);
if($checkpass['password'] != $pass){
exit("<p class='link'>Logowanie nieudane</p><br><a class='link3 button' href='index.php'>Powrót</a>");
} else {
session_register("logged_in");
$_SESSION['logged_in'] = true;
session_register("logged_nick");
$_SESSION['logged_nick'] = $nick;
$date = date("d m Y");
$zap2 = "SELECT * FROM authme WHERE name='$nick'";
$zap3 = mysql_query($zap2);
$checkadmin = mysql_fetch_array($zap3);
echo "123";
if($checkadmin[admin] == 1){
session_register("admin");
$_SESSION['admin'] = true;
}
header("Location: index.php");
ob_flush();
}
}
;
mysql_close($connection);
?>
</div>
</body>
</html>