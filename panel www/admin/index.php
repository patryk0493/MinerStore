<?
session_start();
ob_start();
?>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>
<body style="text-align:center">
<?php

include 'menu.php';
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
?>
</div></br>
<? 	
$plik = fopen('http://www.patrykeliasz.pl/info.html','r');
$zawartosc = fread($plik, 3000);
echo $zawartosc; 
?>
    
<div style="background:url('../images/obsidian.png'); width: 450px; height: auto; margin-top: 10px; margin-left: auto; margin-right: auto; text-align: center">
</div>
<div class="contener2" style="opacity: 1; width: 260px; height: 360px; margin-top: 50px; margin-left: auto; margin-right: auto">
<table style="border: 0">
<tr>
<form method="POST" action="services.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Dodaj usługę!">
</form>
<form style="float: right" method="POST" action="codes.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Dodaj nowy kod!">
</form>
</tr>
<tr>
<form style="float: right" method="POST" action="discount.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Dodaj zniżkę!">
</form>
<form style="float: right" method="POST" action="logs.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Sprawdź logi!">
</form>
</tr>
<tr>
<form style="float: right" method="POST" action="vouchers.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Dodaj voucher!">
</form>
<form style="float: right" method="POST" action="news.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Dodaj news!">
</form>
</tr>
<tr>
<form style="float: right" method="POST" action="ekipa.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Dodaj ekipę!">
</form>
<form style="float: right" method="POST" action="editinformacje.php">
<input class="button" style="width: 120px; height: 50px; margin:5px" type="submit" value="Edytuj informacje!">
</form>
</tr>
<tr>
<form style="float: right" method="POST" action="admin.php">
<input class="button" style="width: 120px; height: 50px; margin:5px;" type="submit" value="Admini panelu!">
</form>
</tr>
</table>
<p style="text-align: center; font-size: 140%; font-family: Tahoma"><a style="color: black" class="link2" href="../index.php"><input class="button link3" style="width: 60px; height: 30px" type="submit" value="Powrót"/></a></p>
</div>
<?
}
else{
exit("Nie masz tu dostepu!");
}
ob_flush();
?>
</div>
</body>
</html>