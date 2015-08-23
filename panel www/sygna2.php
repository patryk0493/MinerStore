<?php
session_start();
ob_start();

@include 'informacje.php'; //informacje
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
    $rImg = ImageCreateFromPNG('2.png');

    $czarny  = imagecolorallocate($rImg, 0, 0, 0);
    $bialy = imagecolorallocate($rImg, 250, 250, 250);
    $zolty = imagecolorallocate($rImg, 235, 227, 0);
	
	$czcionka ="OpenSans.ttf";
	$czcionka2 ="LifeCraft.ttf";
	$czcionka3 ="UnZialish.ttf";
	$czcionka4 ="Ingleby_regular.ttf";
	$czcionka5 ="minecraft.ttf";
			
	$pieniadze = "Pieniadze: $kasa Zildjan";
	$praca = "Praca: $robota $exp lvl";
	$level = "LvL: $lvl";
	$cza = "Czas: $czas";
	$zabojstwa = "Kills: $zab";
	$zgony = "Deaths: $zgo";
	$kd = $zab/$zgo;
	$ratio = "K/D: $kd";
	
	$avatar = "https://minotar.net/avatar/$player/32.png";
	
    $watermark = imagecreatefromPNG($avatar);
	
    $width = imagesx($rImg);
    $height = imagesy($rImg);
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);
	imagecopymerge($rImg, $watermark, 4, 4, 0, 0, $watermark_width, $watermark_height, 100);

    imagettftext($rImg, 16, 0, 51, 28, $czarny, $czcionka3,$nick);
    imagettftext($rImg, 16, 0, 50, 27, $bialy, $czcionka3,$nick);
	imagettftext($rImg, 16, 0, 335, 20, $bialy, $czcionka4,$level);
	imagettftext($rImg, 10, 0, 320, 35, $zolty, $czcionka2,$adrespodstawowy);
	imagettftext($rImg, 11, 0, 260, 15, $bialy, $czcionka4,$zabojstwa);
	imagettftext($rImg, 12, 0, 260, 33, $bialy, $czcionka4,$zgony);
    
    imagepng($rImg);
	imagepng($rImg, "stats/".$player."2.png"); 
    imagedestroy($rImg);
	imagedestroy($watermark);


mysql_close($connection);

ob_flush();
?>