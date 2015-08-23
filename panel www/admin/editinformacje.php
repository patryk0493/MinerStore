<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
include("../config/polacz.php");
@include("../informacje.php");
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

?>
<form action=editinformacje.php method=POST>
<table id="menubez" style="text-align: left; margin-left: auto; margin-right: auto">
<tr>
<td class="komorka">Wpisz nazwę</td>
<td><input type='text' name='nazwa' class='button' style="width:300px;" value='<?php print($nazwa); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz adres URL dużego loga</td>
<td><input type='text' name='logoduze' class='button' style="width:300px;" value='<?php print($logoduze); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz adres URL małego loga</td>
<td><input type='text' name='logomale' class='button' style="width:300px;" value='<?php print($logomale); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz adres panelu (bez "http://" oraz "/" na końcu)</td>
<td><input type='text' name='adres' class='button' style="width:300px;" value='<?php print($adres); ?>'</td>
</tr>
<tr>
<td class="komorka">Wpisz adres Dynmap lub zostaw puste (bez "http://" oraz "/" na końcu)</td>
<td><input type='text' name='adresdynmap' class='button' style="width:300px;" value='<?php print($adresdynmap); ?>'</td>
</tr>
<tr>
<td class="komorka">Adres podstawowy (np: do forum)</td>
<td><input type='text' name='adrespodstawowy' class='button' style="width:300px;" value='<?php print($adrespodstawowy); ?>'</td>
</tr>
<tr>
<td class="komorka">E-mail potwierdzający zakup licencji</td>
<td><input type='text' name='email' class='button' style="width:300px;" value='<?php print($email); ?>'</td>
</tr>
<tr>
<td class="komorka">Rejestracja gracza na WhiteList </td>
<td><input type="radio" value="1" name="whitelist" <?php if($whitelist == '1') echo 'checked="checked"'; ?> />Tak<br><input type="radio" value="0" name="whitelist" <?php if($whitelist == '0') echo 'checked="checked"'; ?> />Nie</td>
</tr>
<input type=hidden name=dodaj value="tak">
<td></td><td>
<input type=submit class=button  value="Zapisz dane" name="submit">
</td><br>
</table>
<center><br><br>
<a class="link2 button" href="index.php">Przejdź do menu</a>
<br>

</form></br>
<div class="2aa" style="text-align: center">
<?php
}
if(!empty($_POST['submit'])){



if($komunikaty) {
echo "<strong>Popraw następujące błędy:</br></br></strong> ".$komunikaty;
}
else {
	//operacje
	if(!$_POST['email'] == ''){
	$fp = fopen('../informacje.php', 'w');
	fwrite($fp, "<?php\n");
	fwrite($fp, "session_start();\n");
	fwrite($fp, "ob_start();\n");
	fwrite($fp, "\$nazwa = '". $_POST['nazwa'] ."';\n");
	fwrite($fp, "\$logoduze = '". $_POST['logoduze'] ."';\n");
	fwrite($fp, "\$logomale = '". $_POST['logomale'] ."';\n");
	fwrite($fp, "\$adres = '". $_POST['adres'] ."';\n");
	fwrite($fp, "\$adresdynmap = '". $_POST['adresdynmap'] ."';\n");
	fwrite($fp, "\$adrespodstawowy = '". $_POST['adrespodstawowy'] ."';\n");
	fwrite($fp, "\$email = '". $_POST['email'] ."';\n");
	fwrite($fp, "\$whitelist = '". $_POST['whitelist'] ."';\n?>");
	fclose($fp);
	} else { exit ("Brak email");
	}

echo("<center>Pomyślnie zedytowano informacje !</br>");

?>
<a class="link2" href="index.php">Przejdź do menu admina</a>
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