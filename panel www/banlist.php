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
<div id="buycontent" style="height: auto; padding-top: 0px; width:840px; color: black; font-size: 100%;">
<div id="nazwa">Banlista</div>
<?

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

?>
<?php
include 'config/polacz.php';

$nick = $_SESSION['logged_nick'];
$player = $_SESSION['logged_nick'];

?>
    
<?php

	$ile = 30; //Ile osób na strone
	if(isset($_GET['page'])) {
		$page = addslashes($_GET['page']);
		} else $page=1;
	$start = ($page-1)*$ile;
	echo "<center><div class=szerokosc>";
	echo "<table style='float:right'><tr>
		<td class=st> <p class='link'>Strona: <strong>".$page."</strong></p> </td>
		</tr></table>";
	if(!isset($_GET['search'])){
		$query="SELECT * FROM banlist WHERE `type`>=0";
		$result=mysql_query($query);
		$all = mysql_num_rows($result);
		$query="SELECT * FROM banlist WHERE `type`>=0 LIMIT ".$start.", ".$ile;
		$result=mysql_query($query);
		echo "<form action='".$PHP_SELF."' method=GET><input class='button' type='text' name='search' id='search' value='Szukaj...'  onfocus='$(this).val(\"\");' onblur='if($(this).val() == \"\") $(this).val(\"Szukaj...\");'><input class='button' type='submit' value='Szukaj'>";
	} else {
		echo '<p class=st>Wyniki wyszukiwania dla: '.addslashes($_GET['search']).'</p>';
		$query="SELECT * FROM banlist WHERE `type`>=0 AND name LIKE  '%".addslashes($_GET['search'])."%'";
		$result=mysql_query($query);
		$all = mysql_num_rows($result);
		$query="SELECT * FROM banlist WHERE `type`>=0 AND name LIKE '%".addslashes($_GET['search'])."%' LIMIT ".$start.", ".$ile;
		$result=mysql_query($query); 
	}
	
	echo "<br><br><table id='menubez' style='width:820px; font-size: 120%'>
	<tr><td class=st>Nick</td><td class=st>Typ</td><td class=st>Powód</td><td class=st>Zbanowany przez</td><td class=st>Czas</td><td class=st>Upływa</td><td class=st> ODBANUJ GO!!!</td></tr>";
	
	while($result_row = mysql_fetch_row(($result))) {
		echo "<tr><td class=komorka>".$result_row[0]."</td><td class=komorka>";
		$odbanuj = $result_row[0];
		if($result_row[5]>0) echo "<span id='offline' style='background:none repeat scroll 0% 0% rgb(246, 158, 0);'>Temp</span>"; else echo "<span id='offline'>Perm</span>";
		echo "</td><td class=komorka>".$result_row[1]."</td><td class=komorka>".$result_row[2]." ";
		$query="SELECT * FROM players WHERE `name` = '".$result_row[2]."'";
		$result2=mysql_query($query);
		$result_row2 = mysql_fetch_row(($result2));
		if($result_row2[30] > $result_row2[31]) 
			echo "<span id='online'>Online</span>";  else echo "<span id='offline'>Offline</span>";
		echo "</td><td class=komorka>";
		echo date('d-m-Y H:i:s',$result_row[3])." </td><td class=komorka>";
		if(!empty($result_row[4])) echo date('d-m-Y H:i:s',$result_row[4])."</td>";  else echo "Nigdy</td>";
		echo "<td class=komorka>"; 
		//unban
	echo"
		
		<a id='neutral' href='unban.php?unban=".$odbanuj."'>Odbanuj</a>
		
		
		</td> </tr>";
	}
	//koniec unban
	echo "</table>";
		
		$all_pages = ceil($all/$ile);
		
		//Stronnicowanie
		if(!isset($_GET['search'])){
		echo "<br><div class='menubez' style='width:780px; height:30px'>";
			//Bez szukania
			while($i<=$all_pages) {
			if($i==$page) echo '<span id="online" class="link" style="font-size:16px; height:20px">'.$i.'</span> ';
				else echo '<a class="link2" href="?page='.$i.'">'.$i.' </a>';
				$i++;
			}
		echo "</div>";
		} else {
		echo "<div class='menubez' style='width:780px; height:30px'>";
			//Z szukaniem
			while($i<=$all_pages) {
			if($i==$page) echo '<span id="online" class="link" style="font-size:16px; height:20px">'.$i.'</span> ';
				else echo '<a class="link2" href="?page='.$i.'&search='.addslashes($_GET['search']).'">'.$i.'</a> ';
				$i++;
			}
		echo "</div>";
		}	
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