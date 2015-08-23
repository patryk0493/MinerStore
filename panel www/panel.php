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
<?
include 'menu.php';
?>
</div>
<div id="buycontent" style="height: auto; width:750px; color: BEBEBE; font-size: 90%;">
<div id="nazwa">Panel</div>
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

?>
<?php
include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$ip = $_SERVER['REMOTE_ADDR'];
$data = date('d-m-y - H:i:s');
?>

<p class="link3"> Transfer wirtualnych pieniędzy na serwerze
<form action = 'panel.php?action=panel' method = 'post'>
<span class="link3">Kwota do wysyłki:</span>
<input class='button' type = 'text' name = 'ilosc' maxlength='20' size = '10'>
<span class="link3">           Odbiorca:</span>
<input class='button' type = 'text' name = 'dla' maxlength='29' size = '10'>
<input class='button' type = 'submit' name = 'start' value = 'Prześlij'>
</form>
	<?
		$ilosc = $_POST['ilosc'];
		$dla = $_POST['dla'];
		$query="SELECT * FROM iConomy WHERE `username` = '$nick' ";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$kasa=mysql_result($result,0,"balance");}
		
		if($ilosc>$kasa)
			exit("<p class='link3'>Zła wartość, wpisz poprawną liczbę.");
		if($ilosc<0)
			exit("<p class='link3'>Kwowa nie może być mniejsza od 0.");
	    if($_POST['ilosc']!="" && $_POST['dla']!= "" && $_POST['start']!= ""){		
			$teraz=$kasa-$ilosc;
			mysql_query("UPDATE `iConomy` SET balance = balance - '$ilosc' WHERE username='$nick'");
			mysql_query("UPDATE `iConomy` SET balance = balance + '$ilosc' WHERE username='$dla'");
			echo "<p class='Calibri'>Obecna kasa: ".$teraz." ";
			echo "Wysłano: ".$ilosc."zł, a masz: ".$teraz." </p>";	
		}
 
//transfer punktów
	echo "<br><hr class='hr'><p class='link3'> Transfer punktów między kontami
	<form action = '' method = 'post'>
	<p class='link3'>Kwota punktów do wysyłki:
	<input class='button' type = 'text' name = 'ile' maxlength='20' size = '10'>
	<p class='link3'>Odbiorca:
	<input class='button' type = 'text' name = 'dla1' maxlength='29' size = '15'></p>
	<input class='button' type = 'submit' name = 'star' value = 'Prześlij'>
	</form>";
	
		$ilosc1 = $_POST['ile'];
		$dla1 = $_POST['dla1'];

		$query="SELECT * FROM authme WHERE `name` = '$nick' ";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $kasa1=0; else {
		$kasa1=mysql_result($result,0,"points");}

		if($ilosc1>$kasa1)
		exit("<p class='link3'>Zła wartość, wpisz poprawną liczbę.<br><br><a href='panel.php' class='button link3'>Powróć do Panelu</a>");
		if($ilosc1<0)
		exit("<p class='link3'>Kwota nie może być mniejsza od 0.<br><br><a href='panel.php' class='button link3'>Powróć do Panelu</a>");
		
	    if($ilosc1!="" && $dla1!= "" && $_POST['star']!= ""){	
			$teraz=$kasa1-$ilosc1;
			mysql_query("UPDATE `authme` SET points = points - '$ilosc1' WHERE name='$nick'");
			mysql_query("UPDATE `authme` SET points = points + '$ilosc1' WHERE name='$dla1'");
			echo "<p class='Calibri'>Gratulacje !!! Przesłałeś ".$ilosc1." pkt. dla konta: ".$dla1."</p>";
			echo "<a href='panel.php' class='button link3'>Powróć do Panelu</a>";
	
		} 

	//zmiana zawodu
		echo "<br><hr class='hr'><p class='link3'>Zmiana zawodu</p><p class='link3'>Koszt zmiany klasy to: 400zł.</p>";
		echo  "<form action = 'panel.php?action=panel' method = 'post'>
		<select name='klasa'>
		<option value='Drwal'>Drwal</option>
		<option value='Wojownik'>Wojownik</option>
		<option value='Gornik'>Górnik</option>
		<option value='Farmer'>Farmer</option>
		</select>
		<input class='button' type = 'submit' name = 'ok' value = 'Zmień klasę'>
		</form>	";	
		
		if($_POST['klasa']!="" && $_POST['ok']!= ""){		
			if(400<$kasa){
				$teraz=$kasa-400;
				$nowa = $_POST['klasa'];
				mysql_query("UPDATE `iConomy` SET balance = balance - 400 WHERE username='$nick'");
				mysql_query("UPDATE `jobs` SET job = '$nowa' WHERE username='$nick'");
				$zmiana = "say Cokolwiek";
				require 'include/rcon_execute.php';
				require 'config/rcon_config.php';
				$r = new minecraftRcon($server, $rconPort, $rconPass);
					if (!$r->Auth()){
   						$r->mcSendCommand($zmiana);
   					}
				echo "<p class='Calibri'>Obecna kasa: ".$teraz." ";	
				echo "<p class='Calibri'>Obecna klasa: ".$nowa.". ";
			} else { echo "<p class='Calibri'>Brak środków";}
		}
		
	// zabójstwo
	$kwota = 5; //ilość pkt za zabójstwo
	echo "<br><hr class='hr'><p class='link3'>Zabójstwo gracza</p><p class='link3'>Koszt to ".$kwota." punków, gracz musi być <span id='online'>ONLINE</span></p>";
	echo	"<form action = '' method = 'post'>
		<p class='link3'>Nick gracza:
		<input class='button' type = 'text' name = 'on' maxlength='20' size = '20'>
		<input class='button' type = 'submit' name = 'teraz' value = 'Wykonaj'>
		</form>";
	
	if($_POST['on']!="" && $_POST['teraz']!= ""){		
			if($kwota<$kasa1){
				$teraz=$kasa1-$kwota;
				$on = $_POST['on'];
				mysql_query("UPDATE `authme` SET points = points - $kwota WHERE name='$nick'");
				$komenda = "kill $on";
				require 'include/rcon_execute.php';
				require 'config/rcon_config.php';
				$r = new minecraftRcon($server, $rconPort, $rconPass);
					if (!$r->Auth()){
   						$r->mcSendCommand($komenda);
   					}
				mysql_query("INSERT INTO logs(nick, konto, usluga, koszt, stan, data, ip, rabat, voucher) VALUES('$on', '$nick', 'Zabójstwo na życzenie', '$kwota', '$teraz', '$data', '$ip', 'NONE', 'NONE')");
				echo "<p class='Calibri'>Zgładzono gracza: ".$on.". ";
			} else { echo "<p class='Calibri'>Brak środków";}
		}
	
	
	
@include "stopka.php";
		mysql_close($connection);
}
else
{
	exit("<p class='calibri'>Musisz się najpierw <a class='link2' href='index.php'>zalogować!!</a></p><br>");
}
ob_flush();
?>
</div>
</body>