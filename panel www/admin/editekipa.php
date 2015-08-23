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
$id = $_POST['id'];
if (empty($_POST['submit'])){
$query = mysql_query("SELECT * FROM ekipa WHERE id='$id'");
$info = mysql_fetch_assoc($query);
$nick = stripslashes($info['nick']);
$ranga = stripslashes($info['ranga']);
$skype = stripslashes($info['skype']);
$gg = stripslashes($info['gg']);
$email = stripslashes($info['email']);

?>
<form action=editekipa.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto">
<tr>
<td class="komorka">Wpisz Nick</td>
<td><input type='text' name='nick' class='button' style="width:300px;" value='<?php print($nick); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz rangę</td>
<td><input type='text' name='ranga' class='button' style="width:300px;" value='<?php print($ranga); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz Skype</td>
<td><input type='text' name='skype' class='button' style="width:300px;" value='<?php print($skype); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz Gadu-Gadu</td>
<td><input type='text' name='gg' class='button' style="width:300px;" value='<?php print($gg); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz E-mail</td>
<td><input type='text' name='email' class='button' style="width:300px;" value='<?php print($email); ?>'</td>
</tr>
<input type=hidden name=dodaj value="tak">
<input type=hidden name=id value="<?php print($id); ?>">
<td></td><td>
<input type=submit class=button  value="Dodaj" name="submit">
</td><br>
</table>
<center><br><br>
<a class="link2 button" href="ekipa.php">Przejdź do ekipy</a>
<br>

</form></br>
<div class="2aa" style="text-align: center">
<?php
}
if(!empty($_POST['submit'])){
$nick = $_POST['nick'];
$ranga = $_POST['ranga'];
$skype = $_POST['skype'];
$gg = $_POST['gg'];
$email = $_POST['email'];

$komunikaty = '';
if(empty($nick)) {
$komunikaty .= "Musisz wpisać Nick! <br>";
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

mysql_query("UPDATE ekipa SET nick='$nick', `ranga`='$ranga', `skype`='$skype', `gg`='$gg', `email`='$email' WHERE `id`=$id");
echo("<center>Pomyślnie zedytowano członka ekipy o ID ".$id."!</br>");

?>
<a class="link2" href="ekipa.php">Przejdź do członków ekipy</a>
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