<?php
session_start();
ob_start();
?>
<html>
<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body style="text-align: center; font-family:Calibri">
<?
include 'menu.php';
?>
</div>
<div id="buycontent" style="height: auto; padding-top: 0px; width:800px; color: black; font-size: 110%;">
<div id="nazwa">Lista graczy</div>
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
	

	//Wszystkie
	if(!isset($_GET['player'])){
		$ile = 30; //Ile osób na strone
		if(isset($_GET['page'])) {
							$page = addslashes($_GET['page']);
						} else $page=1;
		$start = ($page-1)*$ile;
		echo "<center><div class=szerokosc><br><br>";
		echo "<table style='float:right'><tr>
			<td class=st2> <p class='link'>Strona: <strong>".$page."</strong></p> </td>
		</tr></table>";
		if(!isset($_GET['search'])){
			//Bez szukania
			$query="SELECT * FROM players";
			$result=mysql_query($query);
			$all = mysql_num_rows($result);
			$query="SELECT * FROM players LIMIT ".$start.", ".$ile;
			$result=mysql_query($query);
			echo "<form action='".$PHP_SELF."' method=GET><input class='button' type='text' name='search' id='search' value='Szukaj...' onfocus='$(this).val(\"\");' onblur='if($(this).val() == \"\") $(this).val(\"Szukaj...\");'><input class='button' type='submit' value='Szukaj'>";
		} else {
			//Z szukaniem
			echo '<p class=st> Wyniki wyszukiwania dla: '.addslashes($_GET['search']).'</p>';
			$query="SELECT * FROM players WHERE name LIKE '%".addslashes($_GET['search'])."%'";
			$result=mysql_query($query);
			$all = mysql_num_rows($result);
			$query="SELECT * FROM players WHERE name LIKE '%".addslashes($_GET['search'])."%' LIMIT ".$start.", ".$ile;
			$result=mysql_query($query); 
		}
		echo "<br><br><table id=menubez style='width:790px'><tr><td class=st>ID</td><td class=st colspan=2>GRACZ</td><td class=st>Status</td><td class=st>Ostatnio widziany</td><td class=st>Czas w grze</td><td class=st>Logowań</td><td class=st>Średnio</td></tr>";
		while($result_row = mysql_fetch_row(($result))) {
			echo "<tr><td class=komorka>".$result_row[0]."</td>
			<td class='komorka'><img style='border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".$result_row[1]."/32.png'></td>
			<td class=komorka><a class='link2' href='?player=".$result_row[1]."'>
			".$result_row[1]."</a></td><td class=komorka>";
			if($result_row[30] > $result_row[31]) echo "<span id='online'>ONLINE</span>"; else echo "<span id='offline'>OFFLINE</span>";
			echo "</td><td class=komorka>".date('d-m-Y H:i:s',$result_row[30])."</td><td class=komorka>".totime($result_row[33])."</td><td class=komorka>".$result_row[32]."</td><td class=komorka>".totime(round($result_row[33] / $result_row[32]))."</td></tr>";
		}
		echo "</table>";
		$all_pages = ceil($all/$ile);
		
		//Stronnicowanie
		if(!isset($_GET['search'])){
		echo "<br><div class='menubez' style='width:780px; height:30px'>";
			//Bez szukania
			while($i<=$all_pages) {
			if($i==$page) echo '<span id="online" class="link" style="font-size:16px; height:20px">'.$i.'</span>  ';
				else echo '<a class="link2" href="?page='.$i.'">'.$i.' </a>';
				$i++;
			}
		echo "</div>";
		} else {
		echo "<br><div class='menubez' style='width:780px; height:30px'>";
			//Z szukaniem
			while($i<=$all_pages) {
			if($i==$page) echo '<span id="online" class="link" style="font-size:16px; height:20px">'.$i.'</span>  ';
				else echo '<a class="link2" href="?page='.$i.'&search='.addslashes($_GET['search']).'">'.$i.' </a>';
				$i++;
			}
		echo "</div>";

		}	

	//Pojedyńcza osoba
	} else {
		$query="SELECT * FROM players WHERE `name` = '".addslashes($_GET['player'])."'";
		$result=mysql_query($query);
		while($result_row = mysql_fetch_row(($result))) {
			echo "<center><div style='width:790px'><h1 class=menu style='font-family:Minecraft; color:#20e1fa'><img style='border-color: rgb(161, 161, 161); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2)' src='https://minotar.net/avatar/".$result_row[1]."/40.png'> ".$result_row[1]."</h1>
			<table><tr><td><iframe class=info2 src='./skin/index.php?user=".$result_row[1]."' title='".$result_row[1]."' width='350px' height='360px'></iframe></td>
			<td>       </td>
			<td><h2 class=st2>Info</h2>
			<div class=info>Status: ";
			if($result_row[30] > $result_row[31]) echo "<span id='online'>ONLINE</span>"; else echo "<span id='offline'>OFFLINE</span>";
			echo "<br>
			Ostatnio widziany: ".date('d-m-Y H:i:s',$result_row[30])."<br>Czas w grze: ".totime($result_row[33])."<br>Logowań: ".$result_row[32]."<br>Średnio: ".totime(round($result_row[33] / $result_row[32]))."
			<br>Zabójstwa: ".$result_row[6]."
			<br>Śmierci: ".$result_row[7]."
			<br>Level: ".$result_row[16]."
			<br>Enchantowane przedmioty: ".$result_row[12]."
			<br>Użyte komendy: ".$result_row[26]."</div>
			<h2 class=st2>Bloki</h2>
			<div class=info>Postawione: ".$result_row[10]."<br>Zniszczone: ".$result_row[9]."</div></td></tr></table>
			<table><tr><td><h2 class=st2>Odległości</h2>
			<div class=info>Przebyta ogółem: ".$result_row[17]."<br>
			Sprint: ".$result_row[41]."<br>
			Skradanie: ".$result_row[40]."<br>
			Wys. upadków: ".$result_row[42]."<br>
			Łodzią: ".$result_row[5]."<br>
			Minecart: ".$result_row[3]."<br>
			Świnią: ".$result_row[35]."<br></div>";
			$name = $result_row[1];
			$id = $result_row[0];
		}
		
	//zgony	
		echo "<h2 class=st2 width:300px;'> Śmierci</h2><div class=info>";
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='ENV_DEATHS' AND `data` = '3'";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "Upadek: ".$dd."<br>";	
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='ENV_DEATHS' AND `data` = 2";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "Utonięcie: ".$dd."<br>";	
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='ENV_DEATHS' AND `data` = 6";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "Lava: ".$dd."<br>";	
			
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='ENV_DEATHS' AND `data` = 1";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "Pokłucie kaktusem: ".$dd."<br>";	
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='ENV_DEATHS' AND `data` = 4";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "Spłonięcie: ".$dd."<br>";	
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='DEATHS' AND `block` = 0";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "Mob: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='DEATHS' AND `block` > 0";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "PvP: ".$dd."<br>";	
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='DEATHS' AND `block` = 10";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "???: ".$dd."<br>";	
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='DEATHS' AND `block` = 11";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "???: ".$dd."<br>";	
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='DEATHS' AND `data` = 13";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "???: ".$dd."<br></div>";	

		$query="SELECT * FROM iConomy WHERE `username` = '".strtolower($name)."'";
		$result=mysql_query($query);
		while($result_row = mysql_fetch_row(($result))) {
			echo "<h2 class=st2 width:300px;'> Pieniądze</h2><div class=info style=font-size:16px>".$result_row[2]." zł</div></td>";
		}
	
		echo "<td><h2 class=st2 width:300px;'>Wydobyte minerały</h2>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='BLOCKDESTROY' AND `block` = 129";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<div class=info><img align='middle' src='items/Emerald.png'> Szmaragdy: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='BLOCKDESTROY' AND `block` = 56";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<img align='middle' src='items/Diamond.png'> Diamenty: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='BLOCKDESTROY' AND `block` = 14";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<img align='middle' src='items/Gold.png'> Złoto: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='BLOCKDESTROY' AND `block` = 1";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<img align='middle' src='items/cobble.png'> Kamień: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = '".$id."' AND `type`='BLOCKDESTROY' AND `block` = 16";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<img align='middle' src='items/Coal.png'> Węgiel: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='BLOCKDESTROY' AND `block` = 15";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<img align='middle' src='items/Iron.png'> Żelazo: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='BLOCKDESTROY' AND `block` = 74";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<img align='middle' src='items/Redstone.png'> Red Stone: ".$dd."<br>";
		
		$query="SELECT * FROM stats WHERE `player_id` = ".$id." AND `type`='BLOCKDESTROY' AND `block` = 21";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) $dd=0; else {
		$dd=mysql_result($result,0,"value");}
		echo "<img align='middle' src='items/Lapis.png'> Lapis Lazuli: ".$dd."<br></div>";

	//zawód	
	
		echo "<h2 class=st2 width:300px;'> IP</h2><div class=info>";
		$query="SELECT * FROM authme WHERE `name` = '".$name."'";
		$result=mysql_query($query);
		if(mysql_num_rows($result) == 0) echo "Brak IP"; else {
		echo $dd= mysql_result($result,0,"ip");}
		echo "<br></div>";	
			
		echo "<h2 class=st2 width:300px;'>Zawód</h2>";
		$query="SELECT * FROM jobs WHERE `username` = '".$name."'";
		$result=mysql_query($query);
		echo  "<div class=info>";
		if(mysql_num_rows($result) == 0) echo "Brak zawodu"; else {
			echo mysql_result($result,0,"job")." - ".mysql_result($result,0,"level")." lvl - " .mysql_result($result,0,"experience")." exp" ;
		}
		echo "</div></td></tr></table><br>";

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