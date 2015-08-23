<?php
include 'config/polacz.php';
if ( $_GET['login'] OR $_GET['pass']) {
exit();
}
$wykonano = $_POST['wykonano'];
if (!$wykonano OR empty($wykonano)) {
echo "<form action=\"login.php\" method=post> Nick: <input class=\"button\" type=text name=\"nick\" maxlenght=32><br>Hasło: <input class=\"button\"  type=password name=\"pass\"></br><input type=hidden name=\"wykonano\" value=\"tak\"><br><input class=\"button\" style=\"width: 120px; height: 35px\" type=submit value=\"Zaloguj\"></form>";
}
else {
$nick = $_POST['nick'];
$pass2 = $_POST['pass'];
$nick = addslashes($nick);
$nick = htmlspecialchars($nick);
$pass = md5($pass2);

if(!$nick or empty($nick)){
echo "Musisz wprowadzic login.";}
if(!$pass or empty($pass)) {
echo "Musisz wprowadzic haslo.";}

$checkpass = mysql_fetch_array(mysql_query("SELECT password FROM authme WHERE nick='$nick'"));
if($checkpass['pass'] != $pass){
exit("Logowanie nieudane");
} else {
session_register("logged_in");
$_SESSION['logged_in'] = true;
session_register("logged_nick");
$_SESSION['logged_nick'] = $nick;
$date = date("d m Y");
$checkadmin = mysql_fetch_array(mysql_query("SELECT x FROM authme WHERE nick='$nick'"));
if($checkadmin[x] == 1){
session_register("admin");
$_SESSION['admin'] = true;
}
header("Location: index.php");
}
}
;
mysql_close($connection);
?>