<?php
$config_profitsms=array();
include 'config/functions/numery_koszta.php';
@include 'informacje.php';
include 'config/config.php';
@include 'config/polacz.php';
$zapytanie = mysql_query("SELECT * FROM codes");
while($rekord = mysql_fetch_array($zapytanie))
{
$config_profitsms[]=array("acc_id"=>$rekord['numer'],"nazwa"=>$rekord['nazwa'],"punkty"=>$rekord['punkty'],"netto"=>$rekord['netto'],"brutto"=>$rekord['brutto'],"numer"=>$rekord['numer'],"tekst"=>$rekord['tresc']);
}

$code = $_POST['code'];

$config_profitsms_multi=array("acc_ids"=>array());
$config_profitsms_accs=array();

foreach($config_profitsms as $k=>$v)
    {
    $config_profitsms_accs[$v['acc_id']]=$k;
    $config_profitsms_multi['acc_ids'][]=$v['acc_id'];
    }
$config_profitsms_multi['acc_ids']=urlencode(implode(",",$config_profitsms_multi['acc_ids']));
if($_POST&&$_POST['check_code'])
    {
    $code=$_POST['code'];
    if(!preg_match("/^[A-Za-z0-9]{8}$/",$code)) echo '<div id="menubez" style="position:absolute; margin-top:25px; margin-left: 200px; padding:10px; z-index:999; margin-left: 35%; margin-right: 50%; width: 400px; text-align:center"><p><img style="vertical-align:middle" src="images/error.png"> Zły format kodu - musi być 8 znaków.</p><a class="link3 button" href="index.php">Odśwież</a></div>';
	else {
    if($_SESSION['logged_nick']=="")
	{
	    echo '<div class="gz">Zaloguj się!</div>';
	} 
	else
	{
	include 'config/licencja.php';
	$zapytanie = mysql_query("SELECT * FROM codes");
	$dane2 = mysql_query("SELECT points FROM authme WHERE name='$nick'");
	$r = mysql_fetch_array($dane2);
	$punktystare = $r['points'];
	while($rekord = mysql_fetch_array($zapytanie))
	{
	$handle=fopen("http://".$adres."/profitsms.php?apiKey=".$id."&code=".$code."&smsNr=".$rekord['numer']."&lic=".$licencja, 'r');
	$check=fgetcsv($handle,1024);
	fclose($handle);
	$x++;
	
	
	$dane2 = mysql_query("SELECT * FROM users WHERE nick='$nick'");
	if($check[0]=="1" && $_SESSION['logged_nick']!="")
	    {
	    echo '<div id="menubez" style="position:absolute; margin-top:25px; margin-left: 200px; padding:10px; z-index:999; margin-left: 35%; margin-right: 50%; width: 400px; text-align:center"><p><img style="vertical-align:middle" src="images/ok.png"> Gratulacje, <span style="color: orange"><strong>'. $_SESSION['logged_nick']. '</strong></span> - kod jest poprawny! Zakupiłeś '.$rekord['nazwa'].'</p><a class="link3 button" href="index.php">Odśwież</a></div>';
		$nick = $_SESSION['logged_nick'];
		$dane5 = mysql_query("SELECT points FROM authme WHERE name='$nick'");
		$r2 = mysql_fetch_array($dane5);
		$punktyP = $r2['points'];
		$nowepkt = $punktyP + $rekord['punkty'];
		mysql_query("UPDATE authme SET points = '$nowepkt' WHERE name = '$nick'");
	    }
	elseif($check[0]==""){
	    }
	elseif($check[0]=="P"){
		exit("Niepoprawna licencja!");
    }
	}
	$dane3 = mysql_query("SELECT * FROM authme WHERE name='$nick'");
	$r2 = mysql_fetch_array($dane3);
	$punktynowe = $r2['points'];
	if($punktystare == $punktynowe){
		echo '<div id="menubez" style="position:absolute; margin-top:25px; margin-left: 200px; padding:10px; z-index:999; margin-left: 35%; margin-right: 50%; width: 400px; text-align:center"><p><img style="vertical-align:middle" src="images/error.png"> Wprowdzono niepoprawny kod. Skontaktuj się z administratorem jeżeli myślisz, iż to bład.</p><a class="link3 button" href="index.php">Odśwież</a></div>';
	}
}
}
}
?>