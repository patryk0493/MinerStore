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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body style="text-align: center">
<?
@include 'informacje.php'; //informacje
?>
<div id="buycontent" style="height: auto; padding-top: 0px; width:800px; color: black; font-size: 110%; text-shadow: 0px 0px 0px #696969; ">

<?php
include 'config/polacz.php';

$player = $_GET['nick'];

	function totime($timee) {
		$sek = $timee % 60;
		$timee -= $sek;
		$timee /= 60;
		if($timee == 0 ) return $sek."s";
		$min = $timee % 60;
		$timee -= $min;
		$timee /= 60;
		if($timee == 0 ) return $min."m ".$sek."s";
		return $timee."h ".$min."m ".$sek."s";
	}
?>
 <?   

// Nick oraz id, level, czas, zabójstwa, zgony
$query="SELECT * FROM `players` WHERE `name`='".$player."'"; 
$result=mysql_query($query) or die('Nie działa');
while($result_row = mysql_fetch_row(($result))) {
$id = $result_row[0];
$nick = $result_row[1];
$lvl = $result_row[16];
$zab = $result_row[6];
$zgo = $result_row[7];
$czas = totime($result_row[33]);}



// Pieniądze
$query="SELECT * FROM `iConomy` WHERE `username`='".$player."'"; 
$result=mysql_query($query);
if(mysql_num_rows($result) == 0) $kasa='biedak'; 
else{
	while($result_row = mysql_fetch_row(($result))) {
	$kasa = $result_row[2];
	}
}


//zawód
$query="SELECT * FROM `jobs` WHERE `username`='".$player."'"; 
$result=mysql_query($query);
if(mysql_num_rows($result) == 0) $robota='niezatrudniony'; 
else{
	while($result_row = mysql_fetch_row(($result))) {
	$robota = $result_row[3];
	$exp = $result_row[2];
	}
}


ob_get_clean();
header('Content-type: image/png');
    $rImg = ImageCreateFromPNG('1.png');

    $czarny  = imagecolorallocate($rImg, 0, 0, 0);
    $bialy = imagecolorallocate($rImg, 250, 250, 250);
    $zolty = imagecolorallocate($rImg, 235, 227, 0);
	
	$czcionka ="OpenSans.ttf";
	$czcionka2 ="LifeCraft.ttf";
	$czcionka3 ="UnZialish.ttf";
	$czcionka4 ="Ingleby_regular.ttf";
	$czcionka5 ="minecraft.ttf";
			
	$pieniadze = "Pieniadze: $kasa $";
	$praca = "Praca: $robota $exp lvl";
	$level = "LvL: $lvl";
	$cza = "Czas: $czas";
	$zabojstwa = "K: $zab";
	$zgony = "D: $zgo";
	$kd = $zab/$zgo;
	$ratio = "K/D: $kd";
	
	$avatar = "https://minotar.net/avatar/$player/55.png";
	
    $watermark = imagecreatefromPNG($avatar);
	
    $width = imagesx($rImg);
    $height = imagesy($rImg);
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);
	imagecopymerge($rImg, $watermark, 5, 5, 0, 0, $watermark_width, $watermark_height, 100);


    imagettftext($rImg, 20, 0, 71, 28, $czarny, $czcionka3,'TEST');//cien
    imagettftext($rImg, 20, 0, 70, 27, $bialy, $czcionka3,$nick);
	imagettftext($rImg, 12, 0, 5, 80, $bialy, $czcionka,$praca);
	imagettftext($rImg, 12, 0, 5, 95, $bialy, $czcionka,$pieniadze);
	imagettftext($rImg, 11, 0, 330, 25, $bialy, $czcionka5,$level);
	imagettftext($rImg, 10, 0, 315, 95, $zolty, $czcionka2,$adrespodstawowy);
	imagettftext($rImg, 11, 0, 330, 42, $bialy, $czcionka5,$zabojstwa);
	imagettftext($rImg, 11, 0, 330, 60, $bialy, $czcionka5,$zgony);
	imagettftext($rImg, 11, 0, 330, 78, $bialy, $czcionka5,$ratio);
    
    imagepng($rImg);
	imagepng($rImg, "stats/".$player.".png"); 
    imagedestroy($rImg);
	imagedestroy($watermark);


mysql_close($connection);

ob_flush();
?>
</div>
</body>