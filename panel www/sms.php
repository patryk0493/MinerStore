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
<body style="text-align: center; font-family:Calibri">
<?
@include 'informacje.php';
?>


<?php
include 'config/polacz.php';

require 'config/system.php';
if($system == 1){
require 'dotpayconfig.php';
}
if($system == 2){
require 'homepayconfig.php';
}
if($system == 3){
require 'profitsmsconfig.php';
}
	
echo '<br><div class="contener2"><div id="sms" style="height: auto">Dostępne SMSy:</br></br>';

if($system == 2){
foreach($config_homepay as $v)
echo "Wyślij SMS na ".$v['punkty']." pkt. o treści<strong><span style=\"color: rgb(255, 153, 0)\"> ".$v['tekst']."</span></strong> pod numer <span style=\"color: rgb(255, 153, 0)\"><strong>".$v['numer']."</strong></span> za <strong>".$v['netto']."</strong>PLN + VAT <strong>( ".$v['brutto']."zl )</strong><br/>\n";
}
if($system == 1){
foreach($config_dotpay as $h)
echo "Wyślij SMS na ".$h['punkty']." .pkt. o treści<strong><span style=\"color: rgb(255, 153, 0)\"> ".$h['tekst']."</span></strong> pod numer <span style=\"color: rgb(255, 153, 0)\"><strong>".$h['numer']."</strong></span> za <strong>".$h['netto']."</strong>PLN + VAT <strong>( ".$h['brutto']."zl )</strong><br/>\n";
}
if($system == 3){
foreach($config_profitsms as $c)
echo "Wyślij SMS na ".$c['punkty']." pkt. o treści<strong><span style=\"color: rgb(255, 153, 0)\"> ".$c['tekst']."</span></strong> pod numer <span style=\"color: rgb(255, 153, 0)\"><strong>".$c['numer']."</strong></span> za <strong>".$c['netto']."</strong>PLN + VAT <strong>( ".$c['brutto']."zl )</strong><br/>\n";
}

echo '</br>';

echo "<div id='menubez' style='width:230px; text-align:center; height:150px; margin-right: 50%; margin-left: 30%; '>
			<div id='form'>
			<form method='post' action=''>
			<input type='hidden' name='check_code' value='1'>
			<strong><p style='font-family:Minecraft; font-size:16px; color:#EBEBEB'>Podaj kod z SMS:</p></strong></br>
			<input class='button' type='text' size='15' name='code'><input class='button' type=submit value='Sprawdź!'>
			</div>	</form>

		</div></div></div>
";


?>
</div>
</body>