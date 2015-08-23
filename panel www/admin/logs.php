<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){

include 'menu.php';
include '../config/polacz.php';
$start = $_GET['start'];
if(empty($start)){
$start = 0;
}
$end = $start+20;
?>
<html>
<head>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>
</head>
</div>
<?php
$dane = mysql_query("SELECT * FROM logs ORDER BY id DESC");
if (mysql_num_rows($dane) > 0) {
?>
<body><br><br>
<form method="POST">
<table id="menubez" style=" text-align: justify; margin-left: auto; margin-right: auto; font-size: 75%">
<tr class="st" style=" text-align: center">
<td style="width:1400px; height:10px" ></td>
</tr>
<?php
    while($r = mysql_fetch_assoc($dane)) {
	if($r['rabat'] == 'NONE' && $r['voucher'] == 'NONE'){
		echo "<tr style=\"text-align: left\">";
		echo "<td style=\"width:1400px; height:20px\">".stripslashes($r['data'])." - Gracz o IP <strong>".stripslashes($r['ip'])."</strong> i nicku w Minecraft <span style='color: red'><strong>".stripslashes($r['nick'])."</strong></span> zakupił usługę <strong>".stripslashes($r['usluga'])."</strong> za <strong>".stripslashes($r['koszt'])."</strong> punktów używając do tego konta o nicku <strong><span style='color: green'>".stripslashes($r['konto'])."</span></strong> na którym znajdowało się <strong>".stripslashes($r['stan'])."</strong> punktów. Nie użyto żadnego kodu rabatowego.</td>";
		echo "</tr>";
	} elseif($r['rabat'] != 'NONE'){
		echo "<tr style=\"text-align: left\">";
		echo "<td style=\"width:1400px; height:20px\">".stripslashes($r['data'])." - Gracz o IP <strong>".stripslashes($r['ip'])."</strong> i nicku w Minecraft <span style='color: red'><strong>".stripslashes($r['nick'])."</strong></span> zakupił usługę <strong>".stripslashes($r['usluga'])."</strong> za <strong>".stripslashes($r['koszt'])."</strong> punktów używając do tego konta o nicku <strong><span style='color: green'>".stripslashes($r['konto'])."</span></strong> na którym znajdowało się <strong>".stripslashes($r['stan'])."</strong> punktów. Został użyty rabat o kodzie <strong><span style='color: yellow'>".stripslashes($r['rabat'])."</span></strong></td>";
		echo "</tr>";
    } elseif(!empty($r['voucher']) && !empty($r['nick'])){
		echo "<tr style=\"text-align: left\">";
		echo "<td style=\"width:1400px; height:20px\">".stripslashes($r['data'])." - Gracz o IP <strong>".stripslashes($r['ip'])."</strong> i nicku w Minecraft <span style='color: red'><strong>".stripslashes($r['nick'])."</strong></span> zrealizował voucher <strong><span style='color: yellow'>".stripslashes($r['voucher'])."</span></strong> dający <strong>".stripslashes($r['koszt'])."</strong> punktów oraz przyznawający usługę o nazwie <strong>".stripslashes($r['usluga'])."</strong> używając do tego konta <strong><span style='color: green'>".stripslashes($r['konto'])."</span></strong>.";
		echo "</tr>";
	} elseif(!empty($r['voucher']) && empty($r['nick'])){
		echo "<tr style=\"text-align: left\">";
		echo "<td style=\"width:1400px; height:20px\">".stripslashes($r['data'])." - Gracz o IP <strong>".stripslashes($r['ip'])."</strong> zrealizował voucher <strong><span style='color: yellow'>".stripslashes($r['voucher'])."</span></strong> dający <strong>".stripslashes($r['koszt'])."</strong> punktów używając do tego konta <strong><span style='color: green'>".stripslashes($r['konto'])."</span></strong>.";
		echo "</tr>";
	}
	}
echo "</table>";
?>
</form>
</br>
<?
}
mysql_close($connection);
}
else
{
exit("Nie masz tu dostepu!");
}
?>
</body>