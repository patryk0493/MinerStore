<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<link rel="Shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
</head>
<body><center>
<div id="menubez" style="height: auto; width:700px; text-align:center; font-size:90%"><br>
<?php
@include 'config/lock.php';
if($lock == 1){
exit("Już zainstalowałeś skrypt!</br> Jeżeli chcesz go ponownie zainstalować usuń plik \"lock.php\" znajdujący się w folderze config.");
}
if($_GET['p'] == ""){
?>
Witaj w panelu instalacyjnym Panelu zarządzania serwerem!</br>
Aby kontynuować instalację, wciśnij przycisk "Dalej"</br><br>
<form method="post" action="install.php?p=1">
<input type="submit" class="button" value="Dalej">
</form>
</br></br>
<?php
}
if($_GET['p'] == 1){
?>

Uzupełnij wszystkie rubryczki prawidłowo!</br>
Zapamiętaj dane do bazy danych, będą potrzebne podczas konfiguracji pluginów!</br></br>

<form method="post" action="install.php?p=2">
Adres do połączenia się z bazą danych:</br> <input class="button" type="text" name="database_host"></br></br>
Nazwa bazy danych:  </br>                   <input class="button" type="text" name="database_name"></br></br>
Login administratora bazy danych:  </br>     <input class="button" type="text" name="nick"></br></br>
Hasło administratora bazy danych:   </br>   <input class="button" type="text" name="pass"></br><br>
<input type="submit" class="button" value="Dalej" name="submit2">
</form>
</br></br>
<?php
}
?>
<?php
if($_GET['p'] == 2){
if($_POST['submit2']){

$fp = fopen('config/dbconnect_info.php', 'w');
fwrite($fp, "<?php\n");
fwrite($fp, "\$db_h = '". $_POST['database_host'] ."';\n");
fwrite($fp, "\$db_n = '". $_POST['database_name'] ."';\n");
fwrite($fp, "\$db_nick = '". $_POST['nick'] ."';\n");
fwrite($fp, "\$db_pass = '". $_POST['pass'] ."';\n?>");
fclose($fp);
}
?>
Okej, na razie wszystko gra!</br>
Spróbujemy się połączyć z bazą danych?
<form method="post" action="install.php?p=3"></br>
<input type="submit" class="button" value="Dalej">
</form></br></br>
<?php
}
if($_GET['p'] == 3){
?>
Jeżeli nie widzisz tutaj nigdzie żadnych błędów, wszystko działa!</br>
Jeśli widzisz błędy - sprawdź dane do bazy danych oraz możliwość połączenia!</br>
<?php
require 'config/polacz.php';
mysql_close($connection);
?>
<form method="post" action="install.php?p=4"></br>
<input type="submit" class="button" value="Dalej" name="submit">
</form></br></br>
<?php
}
	//informacje
if($_GET['p'] == 4){
?>
Teraz pora na konfigurację panelu, dane są w pliku "informacje.php"</br></br>
<form method="post" action="install.php?p=5">
Nazwa twojego serwera serwera (max 25 znaków):</br>										<input class="button" style="width:400px" type="text" name="nazwa"></br></br>
Pełny link do dużego logo:  </br>           							   				<input class="button" style="width:400px" type="text" name="logoduze"></br></br>
Pełny link do małego logo:  </br>  															<input class="button" style="width:400px" type="text" name="logomale"></br></br>
Adres panelu (bez "http://" oraz "/" na końcu) - przykład:  <span style="color:#FF8000">mojadres.pl/panel </span>  </br> 	 <input class="button" style="width:400px" type="text" name="adres"></br></br>
Adres dynmap (jeśli nie korzystasz - zostaw puste) (bez "http://" oraz "/" na końcu) - przykład:  <span style="color:#FF8000"> dyn.map.pl:8123  </span> </br>  	<input class="button" style="width:400px" type="text" name="adresdynmap"></br></br>
Adres podstawowy do twojego portalu lub forum (bez "http://" oraz "/" na końcu) - przykład: <span style="color:#FF8000"> mojeforum.pl  </span>  </br>   <input class="button" style="width:400px" type="text" name="adrespodstawowy"></br></br>
Twój email, którym możesz potwierdzić zakup:   </br>  										 <input class="button" style="width:400px" type="text" name="email"></br></br>
Serwer korzysta stale z Whitelist?  (dla rejestracji gracza)</br>							<input type="radio" value="1" name="whitelist">Tak</br>
																							<input type="radio" value="0" name="whitelist">Nie</br></br>
<input type="submit" value="Dalej" class="button" name="submit4">
</form>
</br></br>
<?php
}
if($_POST['submit4']){
	if(!$_POST['email'] == ''){
	$fp = fopen('informacje.php', 'w');
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
	
	}

if($_GET['p'] == 5){
?>
<form method="POST" action="install.php?p=6">
Podaj ID/Authcode swojego konta (wykorzystywanego u partnera płatnościowego!)</br>
<input class="button" style="width:200px" type="text" name="idkonta"></br></br>
Jaki system płatności chcesz wykorzystywać na swojej stronie?</br>
<input type="radio" value="2" name="system"> HomePay</br>
<input type="radio" value="3" name="system"> ProfitSMS</br></br>
Podaj swój nick w Minecraft: (NIE WPISUJ 'ADMIN'!)</br>
<input class="button" type="text" name="nick"></br></br>
Podaj hasło z jakiego będziesz korzystał:</br>
<input class="button" type="password" name="pass"></br></br>
Powtórz hasło do swojego konta administracyjnego:</br>
<input class="button" type="password" name="pass_r"></br></br>
Wpisz IP swojego serwera Minecraft:</br>
<input class="button" type="text" name="serverip"></br></br>
Wpisz port QUERY swojego serwera Minecraft (jeśli nie masz lub nie chcesz korzystać z dynamicznego statusu serwera - zostaw puste):</br>
<input class="button" type="text" name="query"></br></br>
<input type="submit" class="button" value="Dalej" name="submit3">
</form></br></br>
<?php
}
if($_GET['p'] == 6){
if($_POST['submit3']){
if($_POST['pass'] === $_POST['pass_r']){
require 'config/polacz.php';

$achievements = "CREATE TABLE IF NOT EXISTS `achievements` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(64) NOT NULL,
  `type` enum('BLOCKDESTROY','BLOCKCREATE','ITEMUSE','ITEMDROP','ITEMPICKUP','CRAFTING','SMELTING','BREWING','DAMAGETAKEN','DAMAGEDEALT','KILLS','DEATHS','MINECART_ENTER','MINECART','BOAT_ENTER','BOAT','KILLS_TOTAL','DEATHS_TOTAL','ITEMUSE_TOTAL','BLOCKDESTROY_TOTAL','BLOCKCREATE_TOTAL','CRAFTING_TOTAL','ENCHANTING_TOTAL','ENCHANTING_LVLS','EXP_TOTAL','EXP_CURRENT','LEVEL','MOVE','ARMSWING','OPENCHEST','LIGHTER','EGGTHROW','SNOWBALLTHROW','FISHCAUGHT','CHAT','CHATLETTERS','COMMAND','TELEPORT','RESPAWN','KICK','LASTLOGIN','LASTLOGOUT','LOGIN','PLAYTIME','PIG_RIDDEN','PIG_DIST','EGGHATCHED','BEDUSED','SHEEPSHEARED','SNEAK','SPRINT','FALL_DIST','SMELTING_TOTAL') NOT NULL,
  `block` int(11) NOT NULL,
  `data` tinyint(4) NOT NULL,
  `value` bigint(20) NOT NULL,
  `command` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$authme = "CREATE TABLE IF NOT EXISTS `authme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(40) CHARACTER SET latin1 NOT NULL,
  `lastlogin` bigint(20) DEFAULT NULL,
  `admin` smallint(6) DEFAULT '0',
  `points` int(8) NOT NULL DEFAULT '0',
  `z` smallint(6) DEFAULT '0',
  `y` int(11) DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;";

$banlist = "CREATE TABLE IF NOT EXISTS `banlist` (
  `name` varchar(32) NOT NULL,
  `reason` text NOT NULL,
  `admin` varchar(32) NOT NULL,
  `time` bigint(20) NOT NULL,
  `temptime` bigint(20) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;";

$players = "CREATE TABLE IF NOT EXISTS `players` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `MINECART_ENTER` int(10) unsigned NOT NULL DEFAULT '0',
  `MINECART` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `BOAT_ENTER` int(10) unsigned NOT NULL DEFAULT '0',
  `BOAT` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `KILLS_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `DEATHS_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `ITEMUSE_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `BLOCKDESTROY_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `BLOCKCREATE_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `CRAFTING_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `ENCHANTING_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `ENCHANTING_LVLS` int(10) unsigned NOT NULL DEFAULT '0',
  `EXP_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `EXP_CURRENT` int(10) unsigned NOT NULL DEFAULT '0',
  `LEVEL` int(10) unsigned NOT NULL DEFAULT '0',
  `MOVE` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `ARMSWING` int(10) unsigned NOT NULL DEFAULT '0',
  `OPENCHEST` int(10) unsigned NOT NULL DEFAULT '0',
  `LIGHTER` int(10) unsigned NOT NULL DEFAULT '0',
  `EGGTHROW` int(10) unsigned NOT NULL DEFAULT '0',
  `SNOWBALLTHROW` int(10) unsigned NOT NULL DEFAULT '0',
  `FISHCAUGHT` int(10) unsigned NOT NULL DEFAULT '0',
  `CHAT` int(10) unsigned NOT NULL DEFAULT '0',
  `CHATLETTERS` int(10) unsigned NOT NULL DEFAULT '0',
  `COMMAND` int(10) unsigned NOT NULL DEFAULT '0',
  `TELEPORT` int(10) unsigned NOT NULL DEFAULT '0',
  `RESPAWN` int(10) unsigned NOT NULL DEFAULT '0',
  `KICK` int(10) unsigned NOT NULL DEFAULT '0',
  `LASTLOGIN` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'UNIX Timestamp',
  `LASTLOGOUT` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'UNIX Timestamp',
  `LOGIN` int(10) unsigned NOT NULL DEFAULT '0',
  `PLAYTIME` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Online time in seconds',
  `PIG_RIDDEN` int(10) unsigned NOT NULL DEFAULT '0',
  `PIG_DIST` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `EGGHATCHED` int(10) unsigned NOT NULL DEFAULT '0',
  `COWSMILKED` int(10) unsigned NOT NULL DEFAULT '0',
  `BEDUSED` int(10) unsigned NOT NULL DEFAULT '0',
  `SHEEPSHEARED` int(10) unsigned NOT NULL DEFAULT '0',
  `SNEAK` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `SPRINT` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `FALL_DIST` float(11,2) unsigned NOT NULL DEFAULT '0.00',
  `SMELTING_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  `BREWING_TOTAL` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$player_achievements = "CREATE TABLE IF NOT EXISTS `player_achievements` (
  `player_id` mediumint(9) NOT NULL,
  `achievement_id` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$stats = "CREATE TABLE IF NOT EXISTS `stats` (
  `player_id` mediumint(8) unsigned NOT NULL,
  `type` enum('BLOCKDESTROY','BLOCKCREATE','ITEMUSE','ITEMDROP','ITEMPICKUP','CRAFTING','SMELTING','BREWING','DAMAGETAKEN','DAMAGEDEALT','KILLS','DEATHS','ENV_DEATHS') NOT NULL,
  `block` int(10) unsigned NOT NULL,
  `data` mediumint(5) unsigned NOT NULL,
  `value` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `main` (`player_id`,`type`,`block`,`data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";


$iConomy = "CREATE TABLE IF NOT EXISTS `iConomy` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `balance` double(64,2) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$jobs = "CREATE TABLE IF NOT EXISTS `jobs` (
  `username` varchar(20) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `job` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$mcmmo1 = "CREATE TABLE IF NOT EXISTS `mcmmo_cooldowns` (
  `user_id` int(10) unsigned NOT NULL,
  `taming` int(32) unsigned NOT NULL DEFAULT '0',
  `mining` int(32) unsigned NOT NULL DEFAULT '0',
  `woodcutting` int(32) unsigned NOT NULL DEFAULT '0',
  `repair` int(32) unsigned NOT NULL DEFAULT '0',
  `unarmed` int(32) unsigned NOT NULL DEFAULT '0',
  `herbalism` int(32) unsigned NOT NULL DEFAULT '0',
  `excavation` int(32) unsigned NOT NULL DEFAULT '0',
  `archery` int(32) unsigned NOT NULL DEFAULT '0',
  `swords` int(32) unsigned NOT NULL DEFAULT '0',
  `axes` int(32) unsigned NOT NULL DEFAULT '0',
  `acrobatics` int(32) unsigned NOT NULL DEFAULT '0',
  `blast_mining` int(32) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$mcmmo2 = "CREATE TABLE IF NOT EXISTS `mcmmo_experience` (
  `user_id` int(10) unsigned NOT NULL,
  `taming` int(10) unsigned NOT NULL DEFAULT '0',
  `mining` int(10) unsigned NOT NULL DEFAULT '0',
  `woodcutting` int(10) unsigned NOT NULL DEFAULT '0',
  `repair` int(10) unsigned NOT NULL DEFAULT '0',
  `unarmed` int(10) unsigned NOT NULL DEFAULT '0',
  `herbalism` int(10) unsigned NOT NULL DEFAULT '0',
  `excavation` int(10) unsigned NOT NULL DEFAULT '0',
  `archery` int(10) unsigned NOT NULL DEFAULT '0',
  `swords` int(10) unsigned NOT NULL DEFAULT '0',
  `axes` int(10) unsigned NOT NULL DEFAULT '0',
  `acrobatics` int(10) unsigned NOT NULL DEFAULT '0',
  `fishing` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$mcmmo3 = "CREATE TABLE IF NOT EXISTS `mcmmo_huds` (
  `user_id` int(10) unsigned NOT NULL,
  `hudtype` varchar(50) NOT NULL DEFAULT 'STANDARD',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$mcmmo4 = "CREATE TABLE IF NOT EXISTS `mcmmo_skills` (
  `user_id` int(10) unsigned NOT NULL,
  `taming` int(10) unsigned NOT NULL DEFAULT '0',
  `mining` int(10) unsigned NOT NULL DEFAULT '0',
  `woodcutting` int(10) unsigned NOT NULL DEFAULT '0',
  `repair` int(10) unsigned NOT NULL DEFAULT '0',
  `unarmed` int(10) unsigned NOT NULL DEFAULT '0',
  `herbalism` int(10) unsigned NOT NULL DEFAULT '0',
  `excavation` int(10) unsigned NOT NULL DEFAULT '0',
  `archery` int(10) unsigned NOT NULL DEFAULT '0',
  `swords` int(10) unsigned NOT NULL DEFAULT '0',
  `axes` int(10) unsigned NOT NULL DEFAULT '0',
  `acrobatics` int(10) unsigned NOT NULL DEFAULT '0',
  `fishing` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `idx_taming` (`taming`) USING BTREE,
  KEY `idx_mining` (`mining`) USING BTREE,
  KEY `idx_woodcutting` (`woodcutting`) USING BTREE,
  KEY `idx_repair` (`repair`) USING BTREE,
  KEY `idx_unarmed` (`unarmed`) USING BTREE,
  KEY `idx_herbalism` (`herbalism`) USING BTREE,
  KEY `idx_excavation` (`excavation`) USING BTREE,
  KEY `idx_archery` (`archery`) USING BTREE,
  KEY `idx_swords` (`swords`) USING BTREE,
  KEY `idx_axes` (`axes`) USING BTREE,
  KEY `idx_acrobatics` (`acrobatics`) USING BTREE,
  KEY `idx_fishing` (`fishing`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$mcmmo5 = "CREATE TABLE IF NOT EXISTS `mcmmo_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(40) NOT NULL,
  `lastlogin` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$news = "CREATE TABLE IF NOT EXISTS `news` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `autor` varchar(40) NOT NULL,
  `tresc` longtext CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$table = "CREATE TABLE IF NOT EXISTS codes
(
ID int NOT NULL AUTO_INCREMENT,
nazwa varchar(32),
tresc varchar(32),
numer int,
punkty int,
netto varchar(40),
brutto varchar(40),
idkonta int,
PRIMARY KEY(ID)
)DEFAULT CHARSET=utf8 DEFAULT COLLATE = 'utf8_unicode_ci' AUTO_INCREMENT=1;";

$table2 = "CREATE TABLE IF NOT EXISTS `services` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opis` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `koszt` int(11) DEFAULT NULL,
  `komendy` int(11) DEFAULT NULL,
  `dlagracza` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `komenda` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `komenda2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `komenda3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `komenda4` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `komenda5` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `komenda6` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `komenda7` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `komenda8` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `znizka` int(100) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";

//Brak

$table4 = "CREATE TABLE IF NOT EXISTS rabat
(
ID int NOT NULL AUTO_INCREMENT,
nazwa varchar(32),
kod varchar(80),
procent int(80),
uzycia int(32),
uzyto int(32) NOT NULL,
PRIMARY KEY(ID)
)DEFAULT CHARSET=utf8 DEFAULT COLLATE = 'utf8_unicode_ci' AUTO_INCREMENT=1";

$table5 = "CREATE TABLE IF NOT EXISTS logs
(
id int NOT NULL AUTO_INCREMENT,
nick varchar(55),
konto varchar(55),
usluga varchar(55),
koszt int(50),
stan int(50),
data varchar(55),
ip varchar(55),
rabat varchar(55),
voucher varchar(55),
PRIMARY KEY(id)
)DEFAULT CHARSET=utf8 DEFAULT COLLATE = 'utf8_unicode_ci' AUTO_INCREMENT=1";

$table6 = "CREATE TABLE IF NOT EXISTS voucher
(
id int NOT NULL AUTO_INCREMENT,
nazwa varchar(32),
kod varchar(80),
usluga int(30),
punkty int(30),
uzyto int(1) NOT NULL,
PRIMARY KEY(ID)
)DEFAULT CHARSET=utf8 DEFAULT COLLATE = 'utf8_unicode_ci' AUTO_INCREMENT=1";

$news2 = "INSERT INTO `news` (`ID`, `nazwa`, `autor`, `tresc`, `data`) VALUES
(1, 'Nazwa newsa', 'ASSHunterz', 'Treść newsa', '26-07-2013 10:22'),
(2, 'Nazwa newsa', 'ASSHunterz', 'Treść newsa', '26-07-2013 10:22'),
(3, 'Nazwa newsa', 'ASSHunterz', 'Treść newsa', '26-07-2013 10:24');";

$ekipa = "CREATE TABLE IF NOT EXISTS `ekipa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) NOT NULL,
  `ranga` varchar(100) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `gg` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";



function randString($length, $charset='abcdefghijklmnopqrstuvwxyz0123456789')
{
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
	}
    return $str;
}

$nick = $_POST['nick'];
$pass = md5($_POST['pass']);
$points = "1337";
$isadmin = "1";
$port = mt_rand(1337,9999);
$rconPass = randString(7);
$pnick = 'ADMIN';
$ppass = '5620c40e9470ed90a92d4d84844679c1';
$konto = "INSERT INTO authme(name, password, points, admin) VALUES('$pnick', '$ppass', '$points', '$isadmin')";
$konto2 = "INSERT INTO authme(name, password, points, admin) VALUES('$nick', '$pass', '$points', '$isadmin')";
mysql_query($table) or die(mysql_error());
mysql_query($table2) or die(mysql_error());
mysql_query($table4) or die(mysql_error());
mysql_query($table5) or die(mysql_error());
mysql_query($table6) or die(mysql_error());

mysql_query($achievements) or die(mysql_error());
mysql_query($authme) or die(mysql_error());
mysql_query($banlist) or die(mysql_error());
mysql_query($players) or die(mysql_error());
mysql_query($player_achievements) or die(mysql_error());
mysql_query($stats) or die(mysql_error());
mysql_query($iConomy) or die(mysql_error());
mysql_query($jobs) or die(mysql_error());
mysql_query($mcmmo1) or die(mysql_error());
mysql_query($mcmmo2) or die(mysql_error());
mysql_query($mcmmo3) or die(mysql_error());
mysql_query($mcmmo4) or die(mysql_error());
mysql_query($mcmmo5) or die(mysql_error());
mysql_query($news) or die(mysql_error());
mysql_query($news2) or die(mysql_error());
mysql_query($ekipa) or die(mysql_error());

mysql_query($konto) or die(mysql_error());
mysql_query($konto2) or die(mysql_error());
$fpp = fopen('config/system.php', 'w');
fwrite($fpp, "<?php\n\$system = ".$_POST['system'].";\n\$liczbauslug = 'NOT_USED';\n\$id = '".$_POST['idkonta']."';\n?>");
fclose($fpp);
$fpd = fopen('config/rcon_config.php', 'w');
fwrite($fpd, "<?php\n\$server = '".$_POST['serverip']."';\n\$rconPort = '".$port."';\n\$rconPass = '".$rconPass."';\n\$queryPort = '".$_POST['query']."';\n?>");
fclose($fpd);
mysql_close($connection);
}
else {
exit("Hasła różnią sie od siebie!");
}
}


?>
<div id="quote" style="background:#2D2D2D; border: 1px solid #747474; color: #EAEAEA; width:80%; margin-left: auto; margin-right: auto"></br>enable-rcon=false</br><? if($_POST['query'] != '') echo "enable-query=false"?></br></br></div></br>
Znajdź w pliku server.propeties </br>(znajduje się on na Twoim serwerze Minecraft)</br> powyższą linijkę i zamień ją na:</br></br>
<div id="quote" style="background:#2D2D2D; border: 1px solid #747474; color: #EAEAEA; width:80%; margin-left: auto; margin-right: auto">
enable-rcon=true</br>
enable-query=true</br>
<? if($_POST['query'] != '') echo "query.port=".$_POST['query']?></br>
rcon.port=<?php print($port); ?></br>
rcon.password=<?php print($rconPass); ?></br>
</div>
</br></br>
Wszystko zainstalowano poprawnie! </br>Przejdź do pliku <a class="link3" href="index.php">logowania</a>!</br></br>Teraz pozostaje ci tylko skonfigurować pluginy!
<?php
$fpc = fopen('config/lock.php', 'w');
fwrite($fpc, "<? \$lock = 1;\n?>");
fclose($fpc);
}
?>
</div>
<? @include 'stopka.php';?>
</body>