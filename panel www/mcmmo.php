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
include 'menu.php';
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 0px; width:860px; color: black; font-size: 110%;">
<div id="nazwa">McMMO</div>
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

?>
<?php
include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];

?>
    
<?php

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
	

	echo "<div style='width:850px'>";
	
	//dodanie ID
	$query = "SELECT * FROM `mcmmo_users` WHERE `user`='".$nick."'"; 
	$result=mysql_query($query);
	$result_row = mysql_fetch_row(($result));
	$id=$result_row[0];

    //umiejętności
	$query = "SELECT * FROM `mcmmo_skills` WHERE `user_id`='".$id."'"; 
	$result=mysql_query($query);
	$result_row = mysql_fetch_row(($result));
	
	echo "<br><h2 class=st2>Umiejętności</h2><table id='menubez'><tr>
		<td class='st'>Tresura</td>
		<td class='st'>Górnictwo</td>
		<td class='st'>Ścinanie drzew</td>
		<td class='st'>Naprawa</td>
		<td class='st'>Bezbronność</td>
		<td class='st'>Zielarstwo</td>
		<td class='st'>Kopanie</td>
		<td class='st'>Łucznictwo</td>
		<td class='st'>Broń biała</td>
		<td class='st'>Topór</td>
		<td class='st'>Akrobatyka</td>
		<td class='st'>Wędkarstwo</td></tr>
		<tr>
			<td class='komorka'>".$result_row[1]."</td>
			<td class='komorka'>".$result_row[2]."</td>
			<td class='komorka'>".$result_row[3]."</td>
			<td class='komorka'>".$result_row[4]."</td>
			<td class='komorka'>".$result_row[5]."</td>
			<td class='komorka'>".$result_row[6]."</td>
			<td class='komorka'>".$result_row[7]."</td>
			<td class='komorka'>".$result_row[8]."</td>
			<td class='komorka'>".$result_row[9]."</td>
			<td class='komorka'>".$result_row[10]."</td>
			<td class='komorka'>".$result_row[11]."</td>
			<td class='komorka'>".$result_row[12]."</td>
		</tr>
		</table><br><br>";
		
	    //doświadczenie
	$query = "SELECT * FROM `mcmmo_experience` WHERE `user_id`='".$id."'"; 
	$result=mysql_query($query);
	$result_row = mysql_fetch_row(($result));
	
	echo "<h2 class=st2>Doświadczenie</h2><table id='menubez'><tr>
		<td class='st'>Tresura</td>
		<td class='st'>Górnictwo</td>
		<td class='st'>Ścinanie drzew</td>
		<td class='st'>Naprawa</td>
		<td class='st'>Bezbronność</td>
		<td class='st'>Zielarstwo</td>
		<td class='st'>Kopanie</td>
		<td class='st'>Łucznictwo</td>
		<td class='st'>Broń biała</td>
		<td class='st'>Topór</td>
		<td class='st'>Akrobatyka</td>
		<td class='st'>Wędkarstwo</td></tr>
		<tr>
			<td class='komorka'>".$result_row[1]."</td>
			<td class='komorka'>".$result_row[2]."</td>
			<td class='komorka'>".$result_row[3]."</td>
			<td class='komorka'>".$result_row[4]."</td>
			<td class='komorka'>".$result_row[5]."</td>
			<td class='komorka'>".$result_row[6]."</td>
			<td class='komorka'>".$result_row[7]."</td>
			<td class='komorka'>".$result_row[8]."</td>
			<td class='komorka'>".$result_row[9]."</td>
			<td class='komorka'>".$result_row[10]."</td>
			<td class='komorka'>".$result_row[11]."</td>
			<td class='komorka'>".$result_row[12]."</td>
		</tr>
		</table><br><br>";
	
	
		    //zdobyte
	$query = "SELECT * FROM `mcmmo_cooldowns` WHERE `user_id`='".$id."'"; 
	$result=mysql_query($query);
	$result_row = mysql_fetch_row(($result));
	
	echo "<h2 class=st2>Osiągnięto</h2><table id='menubez'><tr>
		<td class='st'>Tresura</td>
		<td class='st'>Górnictwo</td>
		<td class='st'>Ścinanie drzew</td>
		<td class='st'>Naprawa</td>
		<td class='st'>Bezbronność</td>
		<td class='st'>Zielarstwo</td>
		<td class='st'>Kopanie</td>
		<td class='st'>Łucznictwo</td>
		<td class='st'>Broń biała</td>
		<td class='st'>Topór</td>
		<td class='st'>Akrobatyka</td>
		<td class='st'>Wędkarstwo</td></tr>
		<tr>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[1]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[1]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[2]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[2]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[3]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[3]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[4]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[4]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[5]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[5]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[6]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[6]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[7]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[7]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[8]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[8]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[9]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[9]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[10]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[10]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[11]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[11]);echo "</td>
			<td class='komorka' style='font-size: 60%;'>";if(($result_row[12]) == 0) echo "Nigdy"; else echo date('d-m-Y H:i:s',$result_row[12]);echo "</td>
		</tr>
		</table><br><br>";
	echo "</div><br>";


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