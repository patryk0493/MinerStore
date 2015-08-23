<?php
session_start();
ob_start();
?>
<html>
<head>
<?
include 'config/polacz.php';
?>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
</head>
<body>
<?php
include 'menu.php';
?>
</div>
<div style="height: auto; width:600px; height:350px; text-align:center" id="buycontent">
<div id="nazwa">Odbanuj gracza</div>

<?
//pobranie danych
$odbanuj = $_GET['unban'];
$nick = $_SESSION['logged_nick'];
$rozpocznij = $_POST['rozpocznij'];

	//stan konta odbanowywujacego
	$kwota = 10;  //tutaj wprować wartość odbanowania
		include 'config/polacz.php';
		$query="SELECT * FROM authme WHERE `name` = '$nick' ";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $kasa=0; else {
		$kasa=mysql_result($result,0,"points");}
		$teraz=$kasa-$kwota;
		$data = date('d-m-y - H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

	echo "<br><div class='info' style='margin-left: auto; margin-right: auto;'><p class='link3' style='font: 16px'>Unban gracza ".$odbanuj."</p><p>Koszt usługi to: ".$kwota." pkt. Po zakupie na twoim koncie zostanie ".$teraz." pkt.</p>";
	echo	"<form action = '' method = 'post'>
		<input class='button' type = 'submit' name = 'ok' value = 'Odbanuj'>
		</form>";
		
	
	
	if($_POST['ok']!= "" && $odbanuj!= ""){	
		//unban za 10 pkt	
			if($kwota<=$kasa){
				mysql_query("UPDATE `authme` SET points = points - $kwota WHERE name='$nick'");
				mysql_query("DELETE FROM banlist WHERE name='$odbanuj'");
				$zmiana = "unban $odbanuj";
				require 'include/rcon_execute.php';
				require 'config/rcon_config.php';
				$r = new minecraftRcon($server, $rconPort, $rconPass);
					if (!$r->Auth()){
   						$r->mcSendCommand($zmiana);
   					}
				mysql_query("INSERT INTO logs(nick, konto, usluga, koszt, stan, data, ip, rabat, voucher) VALUES('$odbanuj', '$nick', 'Unban gracza z Banlisty', $kwota, $teraz, '$data', '$ip', 'NONE', 'NONE')");
				echo "<p>Gratulacje! Odbanowano gracza: ".$odbanuj.". ";
				echo "<br><br><a href='banlist.php' class='button link3'>Powróć do Banlist</a>";
			} else { 
			echo "<p>Brak wystarczającej ilości punktów</p> <br><br><a href='index.php' class='button'>Doładuj punkty</a>";}
	}
		
		
?>
</br></br>
</div>
</div>

</body>
<?php
mysql_close($connection);
ob_flush();
?>