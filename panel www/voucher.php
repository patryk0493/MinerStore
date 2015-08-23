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

<body style="text-align: center">
<?php
include 'menu.php';
?>
</div>
<div id="buycontent" style="height: auto; text-shadow: none">
<?
require 'config/polacz.php';

function zrealizujZakup($id){
  $id = $id;
  require 'include/rcon_execute.php';
  require 'config/rcon_config.php';
  $r = new minecraftRcon($server, $rconPort, $rconPass);

	$zapytaj = mysql_query("SELECT * FROM services WHERE ID='$id'");
	$r3 = mysql_fetch_array($zapytaj);
	$nick3 = $_POST['nick'];
	$ilosckomend = $r3['komendy'];
	$komendaP1 = $r3['komenda'];
	$komendaP2 = $r3['komenda2'];
	$komendaP3 = $r3['komenda3'];
	$komendaP4 = $r3['komenda4'];
	$komendaP5 = $r3['komenda5'];
	$komendaP6 = $r3['komenda6'];
	$komendaP7 = $r3['komenda7'];
	$komendaP8 = $r3['komenda8'];

	$przed = array("gracz", "GRACZ");
	$po = array($nick3, $nick3);
	
	
	$komenda[1] = str_replace($przed, $po, $komendaP1);
	$komenda[2] = str_replace($przed, $po, $komendaP2);
	$komenda[3] = str_replace($przed, $po, $komendaP3);
	$komenda[4] = str_replace($przed, $po, $komendaP4);
	$komenda[5] = str_replace($przed, $po, $komendaP5);
	$komenda[6] = str_replace($przed, $po, $komendaP6);
	$komenda[7] = str_replace($przed, $po, $komendaP7);
	$komenda[8] = str_replace($przed, $po, $komendaP8);
if($ilosckomend > 0){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[1]);
   }
	 }
	 if($ilosckomend > 1){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[2]);
	 }
   }
	 if($ilosckomend > 2){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[3]);
	 }
   }
	 if($ilosckomend > 3){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[4]);
	 }
	}
	 if($ilosckomend > 4){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[5]);
	 }
	}
	 if($ilosckomend > 5){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[6]);
	 }
	}
	 if($ilosckomend > 6){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[7]);
	 }
	}
	 if($ilosckomend > 7){
   if (!$r->Auth()){
   $r->mcSendCommand($komenda[8]);
	 }
	}
}

?>
<?php
if($_SESSION['logged_in'] == 'true'){
if(!empty($_POST['go'])){
$code = $_POST['voucher'];
$code = mysql_real_escape_string($code);
$dane1 = mysql_query("SELECT * FROM voucher WHERE kod='$code'");

if(mysql_num_rows($dane1) < 1){
exit("<p class='calibri'>Voucher nie istnieje!</p></br>");
}
$r = mysql_fetch_array($dane1);
if($r['uzyto'] == 1){
exit("<p class='calibri'>Voucher zużyty!</p>");
}
$usluga = $r['usluga'];

if($usluga == 0){
$usluga = $r['punkty']." punktów";
$ukryj = 1;
$opis = 'Punkty VIP.';
	} 
else 
	{
$dane1 = mysql_query("SELECT * FROM services WHERE ID=$usluga");
$r = mysql_fetch_array($dane1);
$usluga = $r['nazwa'];
$opis = $r['opis'];
}

echo("<p class='calibri'>Twój voucher to: </p><span style='color:#F90'></br>".$code."</span></br></br>");
echo("<p class='calibri'>Upoważnia Cię on do odebrania usługi: </p></br><strong>".$usluga."</br></strong><p style='color:#F90'>Opis usługi: ".$opis."</p></br>");
echo("</br><p class='calibri'>Upewnij się, że jesteś <span id='online'>on-line</span> na serwerze oraz masz miejsce w ekwipunku, jeżeli kupujesz itemy!</p> </br>");
if($ukryj != 1){
echo("<p class='calibri'>Podaj nick w Minecraft gdzie zostanie uaktywniona usługa.</p>");
?>
<form action="" method="POST">
<input type="text" class="button" name="nick"></br><br>
<input class="button" type="submit" name="gogo" value="Dalej!"></br>
<input type="hidden" name="code" value="<?php echo($code); ?>">
</form>
<?php
} else {
?>
<form action="#" method="POST">
<input class="button" type="submit" name="gogo" value="Dalej!"></br><br>
<input type="hidden" name="code" value="<?php echo($code); ?>">
</form>
<?php
}
}
if(!empty($_POST['gogo'])){

$code = $_POST['code'];
$code = mysql_real_escape_string($code);
$dane1 = mysql_query("SELECT * FROM voucher WHERE kod='$code'");
$r = mysql_fetch_array($dane1);
$id = $r['usluga'];
$id = mysql_real_escape_string($id);
$punkty = $r['punkty'];
$user = $_SESSION['logged_nick'];
$dane2 = mysql_query("SELECT * FROM authme WHERE name='$user'");
$r2 = mysql_fetch_array($dane2);
$pkt = $r2['points'];
if($r['punkty']>0){
$newpoints = $r['punkty'] + $r2['points'];
mysql_query("UPDATE authme SET points=$newpoints WHERE name='$user'");
}
mysql_query("UPDATE voucher SET uzyto=1 WHERE kod='$code'");
$nick = $_POST['nick'];
$zapytaj = mysql_query("SELECT * FROM services WHERE ID='$id'");
$r3 = mysql_fetch_array($zapytaj);
$usluga = $r3['nazwa'];
$id = $r['usluga'];
if($id != 0){
zrealizujZakup($id);
}
$data = date('d-m-y - H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
mysql_query("INSERT INTO logs(nick, konto, usluga, koszt, stan, data, ip, rabat, voucher) VALUES('$nick', '$user', '$usluga', $punkty, $newpoints, '$data', '$ip', 'NONE', '$code')");
echo("<p>Zrealizowano poprawnie! </p><br><a class='button link3' href='index.php'>Powrót</a><br>");
exit;
}
}
else
{
	exit("<p class='calibri'>Musisz się najpierw <a class='link2' href='index.php'>zalogować!!</a></p><br>");
}
ob_flush();

?>
</div>
</body>