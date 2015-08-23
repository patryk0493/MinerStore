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
$query = mysql_query("SELECT * FROM news WHERE id='$id'");
$info = mysql_fetch_assoc($query);
$nazwa = stripslashes($info['nazwa']);
$autor = stripslashes($info['autor']);
$tresc = stripslashes($info['tresc']);
$tresc = strip_tags($tresc);
?>
<form action=editnews.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto">
<tr>
<td class="komorka">Wpisz nazwę newsa</td>
<td><input type='text' name='nazwa' class='button' style="width:300px;" value='<?php print($nazwa); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz treść</td>
<td><textarea name=tresc class=button  style="width:400px; height:200px" ><?php print($tresc); ?></textarea></td>
</tr>
<input type=hidden name=dodaj value="tak">
<input type=hidden name=id value="<?php print($id); ?>">
<td></td><td>
<input type=submit class=button  value="Dodaj" name="submit">
</td><br>
</table>
<center><br><br>
<a class="link2 button" href="news.php">Przejdź do newsów</a>
<br>

</form></br>
<div class="2aa" style="text-align: center">
<?php
}
if(!empty($_POST['submit'])){
$nazwa = $_POST['nazwa'];
$tresc = $_POST['tresc'];
$autor = $_SESSION['logged_nick'];

$komunikaty = '';
if(empty($nazwa)) {
$komunikaty .= "Musisz wpisać nazwę newsa! <br>";
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
$tresc = nl2br($tresc);
$autor = addslashes($autor);

mysql_query("UPDATE news SET nazwa='$nazwa', `tresc`='$tresc', `autor`='$autor' WHERE `id`=$id");
echo("<center>Pomyślnie zedytowano usługę o ID ".$id."!</br>");

?>
<a class="link2" href="news.php">Przejdź do newsów</a>
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