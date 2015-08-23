<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){

include("../config/polacz.php");
?>
<html>
<head>
<link rel=stylesheet href="../stylefree.css" TYPE="text/css" media="screen"/>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft</title>
 </head>
<body style="text-align:center">
<?php
$id = $_POST['id'];
if(empty($_GET['tak'])) {
if(empty($id)){
echo "Nie wybrałeś zniżki do usunięcia! <a class=\"link2 button\" href=\"vouchers.php\">Powrót</a>";
}
else {
$dane = mysql_query("SELECT * FROM voucher WHERE id='$id'");
$r = mysql_fetch_assoc($dane);
echo "Czy na pewno chcesz usunąć voucher o nazwie \"".$r['nazwa']."\" o id \"".$id."\"?<br>";
echo "<a class=\"link2 button\" href=\"deletevoucher.php?tak=1&id=".$id."\">Tak</a> <a class=\"link2 button\" href=\"deletevoucher.php?tak=0\">Nie</a>";
}
}
else {
if($_GET['tak'] = 1){
	$id = $_GET['id'];
	mysql_query("DELETE FROM voucher WHERE id=".$id."");
	echo "Pomyślnie usunięto voucher! <a class=\"link2 button\" href=\"vouchers.php\">Powrót</a>";
}
elseif ($_GET['tak'] = 0) {
	echo "Nie to nie. Nie usuwamy. <a class=\"link2 button\" href=\"vouchers.php\">Powrót</a>";
	}
else {
echo "Ah ty zły człowieku, chciałeś mnie oszukać?";
}
}
mysql_close($connection);
}
else
{
exit("Nie masz tu dostepu!");
}
?>