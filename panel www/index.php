<?php
session_start();
ob_start();
?>
<!DOCTYPE HTML SYSTEM>
<head>
<?php
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
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, generator" >
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
 </head>
<body>
<?php
include 'menu.php';
include 'config/polacz.php';
@include 'informacje.php';
?>
<?php
//NIE USUWAJ!
if($_SESSION['logged_in'] == true){
?>
</div>


<div id="buycontent" style="width:850px; height:700px; color: #EBEBEB; font-size: 100%;">
	<div id="nazwa">Home & News</div>
		<div style="float:left; width:500px; height:600px">
        <?
			include 'config/polacz.php';
			$news = mysql_query("SELECT * FROM news ORDER BY `news`.`ID` DESC ");
			while($r = mysql_fetch_assoc($news)) { 
        		echo "
					<div id='menubez' style='width:570px; border-bottom: 1px solid rgb(40, 40, 40); margin-left:10px; margin-bottom:20px'>
						<div style='border-bottom: 1px solid rgb(40, 40, 40);margin:10px;'><img style='border-color: rgb(220, 220, 220); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".stripslashes($r['autor'])."/30.png'>  <span class='link3' style=' font-size:21px'>  ".stripslashes($r['nazwa'])."</span></div>
						<div style='margin:15px;'><p class='calibri' style='font-size:13px'>".stripslashes($r['tresc'])."</p></div>
						<div style='float:right; margin-top:-20px; font-size:13px'>".stripslashes($r['autor']).", ".stripslashes($r['data'])."</div>
					</div>"; 

   			}	
		?>
       
		</div>
        
        <div id="menubez" style="float:right; width:230px; text-align:center; height:auto">
			<div id="form">
            <span style="font-family:Calibri; font-size:14px; color:#D5D5D5;">Sklep serwera</span><br>
            <span style="font-family:Calibri; font-size:22px; color:#F90;"><strong><? echo $nazwa ?></strong></span><hr class="hr"> 
			<form method="post" action="">
			<input type="hidden" name="check_code" value="1">
			<strong><p style="font-family:Minecraft; font-size:16px; color:#EBEBEB">Podaj kod z SMS:</p></strong></br>
			<input class="button" type="text" size="15" name="code"><input class="button" type=submit value="Sprawdź!"><br><br><hr class="hr"><br>
			</div>	</form>
<br style="clean:both"/>
		</div>
        <br style="clean:both"/>
		<? include "status.php"; ?>

		
</div>

    	
</br>
<?php
} else {
?>
</div>
 
 <div id="buycontent" style=" height:730px; margin-top:15px; width:850px; color: #EBEBEB; font-size: 100%;">
	<div id="nazwa">Home & News</div>
		<div style="float:left; width:500px; height:600px">
        <?
			include 'config/polacz.php';
			$news = mysql_query("SELECT * FROM news ORDER BY `news`.`ID` DESC ");
			while($r = mysql_fetch_assoc($news)) { 
        		echo "
					<div id='menubez' style='width:570px; border-bottom: 1px solid rgb(40, 40, 40); margin-left:10px; margin-bottom:20px'>
						<div style='border-bottom: 1px solid rgb(40, 40, 40);margin:5px;'><img style='border-color: rgb(220, 220, 220); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".stripslashes($r['autor'])."/30.png'>  <span class='link3' style=' font-size:21px'>  ".stripslashes($r['nazwa'])."</span></div>
						<div style='margin:15px;'><p class='calibri' style='font-size:13px'>".stripslashes($r['tresc'])."</p></div>
						<div style='float:right; margin-top:-22px; margin-right:3px; font-size:12px'>".stripslashes($r['autor']).", ".stripslashes($r['data'])."</div>
					</div>"; 

   			}	
		?>
       
		</div>
        
        <div id="menubez" style="float:right; width:230px; text-align:center; height: 370px;">
        	<p class="link" style="font-size:13px">Witaj w sklepie SMS oraz</br>panelu zarządzania kontem na serwerze <br><span style="font-family:Calibri; font-size:22px; color:#F90;"><strong><? echo $nazwa ?></strong></span></p><hr class="hr" style="width:90%">
			<div id="form" style=" margin-right:10px">
			<?php include 'include/loginfunction.php';
			if($whitelist==='1') echo "<a class='link3 button' href='register.php' >Dodaj się do WhiteList</a>";
			 ?>
            <hr class="hr" style="width:90%"><br>
            <a class="link3 button" href="tutorial.php"  onclick='return otworz(this.href)'>Poradnik do sklepu !</a>
			</div>
		</div>
        
        <? include "status.php"; ?>
   
 </div>

</br>
<?php
}
?>
</div>

<div class="contener2" style="margin-top:10px; width:850px">
<div id="sms" style="height: auto;">

Dostępne SMSy:</br>
<?php
if($system == 2){
foreach($config_homepay as $v)
echo "Wyślij SMS na ".$v['punkty']." pkt o treści<strong><span style=\"color: rgb(255, 153, 0);\"> ".$v['tekst']."</span></strong> pod numer <strong>".$v['numer']."</strong> za <strong>".$v['netto']."</strong>PLN + VAT <strong>( ".$v['brutto']."zl )</strong><br/>\n";
}
if($system == 1){
foreach($config_dotpay as $h)
echo "Wyślij SMS na ".$h['punkty']." pkt o treści<strong><span style=\"color: rgb(255, 153, 0);\"> ".$h['tekst']."</span></strong> pod numer <strong>".$h['numer']."</strong> za <strong>".$h['netto']."</strong>PLN + VAT <strong>( ".$h['brutto']."zl )</strong><br/>\n";
}
if($system == 3){
foreach($config_profitsms as $c)
echo "Wyślij SMS na ".$c['punkty']." pkt o treści<strong><span style=\"color: rgb(255, 153, 0);\"> ".$c['tekst']."</span></strong> pod numer <strong>".$c['numer']."</strong> za <strong>".$c['netto']."</strong>PLN + VAT <strong>( ".$c['brutto']."zl )</strong><br/>\n";
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

<? 
@include "stopka.php";
?>
<div id="version">
<?php 
include 'include/version.php';
include 'config/functions/versioncheck.php';
?>

</body>
</html>
<?php
} else {
header("Location: install.php");
ob_flush();
}