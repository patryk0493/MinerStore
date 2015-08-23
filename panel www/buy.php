<?php
session_start();
ob_start();
?>
<html>
<head>
<?
include 'config/polacz.php';
@include 'config/lock.php';
if($lock == 1){


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
?>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
</head>
<body style="font-family:Calibri">
<?php

include 'menu.php';


function zrealizujZakup(){
  require 'include/rcon_execute.php';
  require 'config/rcon_config.php';
  $r = new minecraftRcon($server, $rconPort, $rconPass);

	$zapytaj = mysql_query("SELECT * FROM services WHERE ID='$id'");
	$r3 = mysql_fetch_array($zapytaj);
	$nick3 = $_POST['nick3'];

	$ilosckomend = $r3['komendy'];
	$komendaP1 = $r3['komenda'];
	$komendaP2 = $r3['komenda2'];
	$komendaP3 = $r3['komenda3'];
	$komendaP4 = $r3['komenda4'];
	$komendaP5 = $r3['komenda5'];
	$komendaP6 = $r3['komenda6'];
	$komendaP7 = $r3['komenda7'];
	$komendaP8 = $r3['komenda8'];
	$znizka = $r3['znizka'];  //pobranie ilości zniżki
	$przed = array("gracz", "GRACZ");
	$po   = array($nick3, $nick3);
	
	
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
</div>
<div id="buycontent" style="height: auto; width:880px; color: black; font-size: 100%;">
<div id="nazwa">Zakupy</div>
<? if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){ ?>
<div id="voucher" style="margin-left: 120px; margin-top:20px">
	<p style="margin-left: 50px; color:#F90"><strong>Zrealizuj Voucher</strong>:</p>
	<form action="voucher.php" method="POST"><input class="button" type="text" style="text-align: center; width: 210px; margin-top: -10px; margin-left: 35px" name="voucher">
    <input class="button" type="submit" name="go" value="Realizuj">

	</form>
</div>


<?php
include 'config/polacz.php';
$dane5 = mysql_query("SELECT * FROM services");
if (mysql_num_rows($dane5) > 0) {
?>

<?
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){


    while($r = mysql_fetch_assoc($dane5)) { 
		$znizka = $r['znizka'];  //pobranie ilości zniżki
		$koszt = $r['koszt'];
		$nowa = $koszt - $znizka;
        echo "<div id='menubez' style='border:1px solid #424242; width:197px; height:300px; display:inline-block;'>"; 
			echo '<form action="buyservice.php" method=POST>';
			if($znizka > 0){
				echo '<div style="height: 25px; width:70px; background-color:#84b322; text-align:center; position:absolute; margin-top:-40px; margin-left:-10px; padding:3px; color:#ffffff">-'.$znizka.' pkt. </div>';
			}
			echo '<div style="height: 64px; border-bottom: 1px solid rgb(40, 40, 40); text-align:right; margin-top:60px;"><img src="'.$r['img'].'" /></div>';
        	echo "<a class='dane link' href='#'>
					<div style='border-bottom: 1px solid rgb(40, 40, 40); font-family:Calibri; font-size:20px; color:#F90;'>".stripslashes($r['nazwa'])."</div>
					<span style='box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.9);'>
						
							<table style='font-size:14px'><tr><td style='border-right: 1px solid rgb(40, 40, 40); width:50px'>Opis<br>usługi</td>
							<td>".stripslashes(substr($r['opis'], 0, 255))."</td>
							</tr></table>
						
					</span></a>
					";
					
			echo "<div style='vertical-align: middle; text-align:center; height:70px; padding-top:20px'>";
			if($znizka <= 0) { echo stripslashes($r['koszt'])." pkt."; 
			} else {
			echo "<span style='font-size:12px'><s style='color:#636363'>".$koszt." pkt.</s></span><span style='color:#7cd415; font-size:18px'>    ".$nowa." pkt.</span> " ;}
			echo "</div>";
		
			echo '<div style=" vertical-align: middle; text-align: center">
			<form action="buyservice.php" method=POST>
			<input type="hidden" name="ID" value='.stripslashes($r['ID']).'>
			<input class="button" style="font-size:16px" type="submit" value="Zamawiam »"/></form></div>';
		echo "</div>";
    }




} else {
    while($r = mysql_fetch_assoc($dane5)) { 
        echo "<tr>"; 
		echo '<td style="height: 64px"><img src="'.$r['img'].'" /></td>';
        echo "<td>".stripslashes($r['nazwa'])."</td>"; 
        echo "<td>".stripslashes(substr($r['opis'], 0, 255))."</td>"; 
		echo "<td>".stripslashes($r['koszt'])." pkt.</td>";
		echo '<td>Zaloguj się!</td>';
		echo "</tr>";
    }
echo "</table>";
}
}
?>


<div class="contener2">
<?php
echo '<div id="sms" style="height: auto">';

?>
Dostępne SMSy:</br>
<?php
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
?>
</br>
<?php
if($system == 1){
echo "System płatności obsługuje firma <a class=\"link2\" href=\"http://www.dotpay.pl\">DotPay</a>.";
}
if($system == 2){
echo "System płatności obsługuje firma <a class=\"link2\" href=\"http://www.homepay.pl\">HomePay</a>.";
}
if($system == 3){
echo "System płatności obsługuje firma <a class=\"link2\" href=\"http://www.profitsms.pl\">ProfitSMS</a>.</br>
Usługa działa w sieciach operatorów: Plus GSM, T-Mobile, Orange, Play.";
}
?>
</br></br>
</div>
</div>


<?
@include "stopka.php";
}
else
{
	exit("<p class='calibri'>Musisz się najpierw <a class='link2' href='index.php'>zalogować!!</a></p><br>");
}	
?>
</body>
<?php
}
mysql_close($connection);
ob_flush();
?>