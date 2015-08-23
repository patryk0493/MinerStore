<?php
session_start();
ob_start();
?>
<html>
<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
// <![CDATA[
function otworz(adres) {
noweOkno = window.open(adres, 'Poradnik', ', scrollbars=yes, resizable=no, status=yes, width=900');
return false;
}
// ]]>
</script>
</head>
<body style="text-align: center">
<?
include 'menu.php';
?>
</div>
<div id="buycontent" style="height: 470px; width:820px; font-size: 100%;">
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

?>
<?php
include 'config/polacz.php';

$id = $_POST['ID'];
if(empty($id)) {
echo "Nie wybrałeś usługi do kupienia! <a class='button link3' href=\"buy.php\">Powrót</a>";
exit;
}

$nick = $_SESSION['logged_nick'];
$dane = mysql_query("SELECT koszt,opis,znizka FROM services WHERE ID='$id'");
$dane2 = mysql_query("SELECT points FROM authme WHERE name='$nick'");
$r = mysql_fetch_array($dane);
$r2 = mysql_fetch_array($dane2);

if($r2['points']<$r['koszt']){
echo("Nie stać Cię! Musisz doładować punkty <br><br> <a class='button link3' href='tutorial.php#doladowanie' onclick='return otworz(this.href)'> Jak doładować konto?</a> 
<br><br><a class='button link3' href=\"buy.php\">Powrót</a>");
exit;
}
$nick2 = $_POST['nick'];
$nick2 = mysql_real_escape_string($nick2);
$punkty = $r2['points'];
$koszt = $r['koszt'];
$opis = $r['opis'];
$znizka = $r['znizka'];  //pobranie ilości zniżki
$koszt = $r['koszt'];
$nowa = $koszt - $znizka;
$nowepkt = $punkty - $koszt + $znizka;
?>

	<div id="menubez" class="calibri" style="float:left; width:370px; height:450px">
			<p>Podaj nick gracza w Minecraft, który ma otrzymać usługę:</br></p>
				<form action="#" method="POST">
				<input class="button" type="text" name="nick3"><br /><br />
                <hr class="hr">
			<p>	Podaj kod rabatowy (jeżeli nie posiadasz - zostaw puste):</br></p>
				<input class="button" type="text" name="rabat"></br></br>
                <hr class="hr">
				<input type="hidden" name="ID" value="<? print_r($id) ?>"></br>
				<input class="button" style="width:100px; height:50px; font-size:16px" type="submit" value="Kupuję" name="buy"/></br>
                <p>Po kliknięciu "Kupuję" cierpliwie poczekaj, aż pojawi się informacja o pomyśnym zakupie usługi.</p>
				</form>
	</div>
	<div id="menubez" class="calibri" style="float:right; width:403px; height:450px">
    		<div id="123">
				<p style="font-size: 100%">Po zakupie zostanie Ci: <strong<span style="color: rgb(236, 236, 236)"><? print_r($nowepkt); ?> </span></strong> pkt.</br></p>
				<p style="font-size: 100%"><hr class="hr"><br>
				Jeżeli kupujesz przedmioty musisz być <span id="online">ONLINE</span> na serwerze oraz <strong></br>posiadać miejsce w ekwipunku</strong>!<br><br><hr class="hr"><br></p>
				<p style="font-size: 100%">Opis usługi: <?php print(stripslashes($opis)); ?><br></p>
				<p style="font-size: 100%">Koszt usługi: 
                <?
					if($znizka <= 0) { echo stripslashes($r['koszt'])." pkt."; 
					} else {
					echo "<span style='color:#F90;'>".$nowa." pkt. </span> w promocji (".$znizka." taniej) " ;}
				?>
                <br></p>

			</div>
    </div>

<?

function zrealizujZakup($id){
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

if(!empty($_POST['rabat']) && !empty($_POST['buy']) && !empty($_POST['nick3'])){
	$id = $_POST['ID'];
	$code = $_POST['rabat'];
	$code = mysql_real_escape_string($code);
	$pytaj = mysql_query("SELECT * FROM rabat WHERE kod='$code'");
	$kolumny = mysql_num_rows($pytaj);
	if($kolumny < 1){
	exit("<div id='menubez' style='position:absolute; margin-top:15px; margin-left: 200px; width:400px; padding:10px; z-index:999'><p><img style='vertical-align:middle' src='images/error.png'> Taki kod nie istnieje!!! </p><a class='link3 button' href=\"buy.php\">Powrót do sklepu</a></div></br></br></br>");
	}
	$rabat = mysql_fetch_array($pytaj);
	$uzycia = $rabat['uzycia']-$rabat['uzyto'];
	if($uzycia < 1){
	exit("<div id='menubez' style='position:absolute; margin-top:15px; margin-left: 150px; width:500px; padding:10px; z-index:999'><p><img style='vertical-align:middle' src='images/error.png'> Kod rabatowy został już zużyty przez innych użytkowników </p><a class='link3 button' href=\"buy.php\">Powrót do sklepu</a></div></br></br></br>");
	}
	$rabatprocent = 100-$rabat['procent'];
	$rabatprocent = $rabatprocent/100;
	$koszt = $koszt * $rabatprocent;
	$nowepkt = $punkty - $koszt;
	$uzycia = $rabat['uzyto'];
	$uzycia++;
	mysql_query("UPDATE `rabat` SET uzyto = $uzycia WHERE kod='$code'");
    mysql_query("UPDATE `authme` SET points = $nowepkt WHERE name = '$nick'");
	$nick = $_POST['nick3'];
	$nick = mysql_real_escape_string($nick);
  $nick = htmlspecialchars($nick);
	$konto = $_SESSION['logged_nick'];
	$zapytaj = mysql_query("SELECT * FROM services WHERE ID='$id'");
	$r3 = mysql_fetch_array($zapytaj);
	$usluga = $r3['nazwa'];
	$data = date('d-m-y - H:i:s');
	$id = $_POST['ID'];
	zrealizujZakup($id);
	$ip = $_SERVER['REMOTE_ADDR'];
	mysql_query("INSERT INTO logs(nick, konto, usluga, koszt, stan, data, ip, rabat, voucher) VALUES('$nick', '$konto', '$usluga', $koszt, $nowepkt, '$data', '$ip', '$code', 'NONE')");
    echo "<div id='menubez' style='position:absolute; margin-top:15px; margin-left: 200px; width:400px; padding:10px; z-index:999'><p><img style='vertical-align:middle' src='images/ok.png'> Kupiono usługę! </p><a class='link3 button' href=\"buy.php\">Powrót do sklepu</a>
			<p class='link'>Użyty rabat dał Ci zniżkę, przez co zostało Ci ".$nowepkt." punktów.</p></div></br></br></br>";
}
elseif(empty($_POST['rabat']) && !empty($_POST['buy']) && !empty($_POST['nick3'])){
	$id = $_POST['ID'];
	$nick2 = $_POST['nick3'];
	$nick2 = mysql_real_escape_string($nick2);
  $nick2 = htmlspecialchars($nick2);
	$konto = $_SESSION['logged_nick'];
	$zapytaj = mysql_query("SELECT * FROM services WHERE ID='$id'");
	$r3 = mysql_fetch_array($zapytaj);
	$usluga = $r3['nazwa'];
	$data = date('d-m-y - H:i:s');
	$id = $_POST['ID'];
	zrealizujZakup($id);
	$ip = $_SERVER['REMOTE_ADDR'];
	mysql_query("UPDATE authme SET points = $nowepkt WHERE name = '$konto'");
	
	mysql_query("INSERT INTO logs(nick, konto, usluga, koszt, stan, data, ip, rabat, voucher) VALUES('$nick2', '$konto', '$usluga', $koszt, $nowepkt, '$data', '$ip', 'NONE', 'NONE')");
    echo "</br><div id='menubez' style='position:absolute; margin-top:15px; margin-left: 200px; width:400px; padding:10px; z-index:999'><p><img style='vertical-align:middle' src='images/ok.png'> Kupiono usługę! </p><a class='link3 button' href=\"buy.php\">Powrót do sklepu</a></div></br></br></br>" ;
}
elseif(!empty($_POST['buy']) && empty($_POST['nick3'])){
echo("<div id='menubez' style='position:absolute; margin-top:15px; margin-left: 200px; width:400px; padding:10px; z-index:999'><p><img style='vertical-align:middle' src='images/error.png'> Uzupełnij wszystkie pola </p><a class='link3 button' href=\"buy.php\">Powrót do sklepu</a></div></br></br></br>");
}
mysql_close($connection);

@include "stopka.php";
}
else
{
	exit("<p class='calibri'>Musisz się najpierw <a class='link2' href='index.php'>zalogować!!</a></p><br>");
}
ob_flush();
?>
</div>
</body>