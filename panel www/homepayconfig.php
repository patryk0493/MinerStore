<?php

include 'config/functions/numery_koszta.php';

$config_homepay_usr_id=$id; //TEGO NIE RUSZAJ
$config_homepay=array(); //TEGO NIE RUSZAJ

include 'config/polacz.php';
require 'config/licencja.php';
@include 'config/orderby.php';
@include 'informacje.php';

switch ($orderby) {
case "ASC":
  $zapytanie = mysql_query("SELECT * FROM codes ORDER BY numer ASC");
  break;
case "DESC":
  $zapytanie = mysql_query("SELECT * FROM codes ORDER BY numer DESC");
  break;
default:
  $zapytanie = mysql_query("SELECT * FROM codes ORDER BY numer ASC");
  break;
}


while($rekord = mysql_fetch_array($zapytanie))
{
$config_homepay[]=array("acc_id"=>$rekord['idkonta'],"punkty"=>$rekord['punkty'],"nazwa"=>$rekord['nazwa'],"netto"=>$rekord['netto'],"brutto"=>$rekord['brutto'],"numer"=>$rekord['numer'],"tekst"=>$rekord['tresc']);
}

$config_homepay_multi=array("acc_ids"=>array());
$config_homepay_accs=array();



foreach($config_homepay as $k=>$v)
    {
    $config_homepay_accs[$v['acc_id']]=$k;
    $config_homepay_multi['acc_ids'][]=$v['acc_id'];
    }
$config_homepay_multi['acc_ids']=urlencode(implode(",",$config_homepay_multi['acc_ids']));

if($_POST&&$_POST['check_code'])
    {
    $code=$_POST['code'];
    if(!preg_match("/^[A-Za-z0-9]{8}$/",$code)) echo '<div id="menubez" style="position:absolute; margin-top:25px; margin-left: 200px; padding:10px; z-index:999; margin-left: 35%; margin-right: 50%; width: 400px; text-align:center"><p><img style="vertical-align:middle" src="images/error.png"> Zły format kodu - musi być 8 znaków.</p><a class="link3 button" href="index.php">Odśwież</a></div>';
    if($_SESSION['logged_nick']=="" or $_SESSION['logged_nick']=="0")
	{
	    echo '<div class="gz">Zaloguj sie!</div>';
	}
	else
	{
	$configacc = $config_homepay_multi['acc_ids'];
	$handle=fopen("http://".$adres."/homepay.php?usr_id=".$config_homepay_usr_id."&config_acc=".$configacc."&code=".$code."&lic=".$licencja,'r');
	$check=fgetcsv($handle,1024);
	fclose($handle);
	if($check[0]=="1")
	    {
	    echo '<div id="menubez" style="position:absolute; margin-top:25px; margin-left: 200px; padding:10px; z-index:999; margin-left: 35%; margin-right: 50%; width: 400px; text-align:center"><p><img style="vertical-align:middle" src="images/ok.png"> Gratulacje, <span style="color: orange"><strong>'. $_SESSION['logged_nick']. '</strong></span> - kod jest poprawny! Zakupiłeś '.$config_homepay[$config_homepay_accs[$check[1]]]['nazwa'].'</p><a class="link3 button" href="index.php">Odśwież</a></div>';
		$nick = $_SESSION['logged_nick'];

		$dane2 = mysql_query("SELECT points FROM authme WHERE name='$nick'");
		$r = mysql_fetch_array($dane2);
			
		$punktyP = $r['points'];
		
		if ($punktyP == NULL){
		$punkty = 0;
		$nowepkt = $punkty + $config_homepay[$config_homepay_accs[$check[1]]]['punkty'];
		mysql_query("UPDATE authme SET points = '$nowepkt' WHERE name = '$nick'");
		}
		else
		{
		$nowepkt = $punktyP + $config_homepay[$config_homepay_accs[$check[1]]]['punkty'];
		mysql_query("UPDATE authme SET points = '$nowepkt' WHERE name = '$nick'");
	    }
	}
	if($check[0]=="0"){
	    echo ('<div id="menubez" style="position:absolute; margin-top:25px; margin-left: 200px; padding:10px; z-index:999; margin-left: 35%; margin-right: 50%; width: 400px; text-align:center"><p><img style="vertical-align:middle" src="images/error.png"> Wprowdzono niepoprawny kod. Skontaktuj się z administratorem jeżeli myślisz, iż to bład.</p><a class="link3 button" href="index.php">Odśwież</a></div>');
	    }
	elseif($check[0]=="E"){
	    echo ('<div id="menubez" style="position:absolute; margin-top:25px; margin-left: 200px; padding:10px; z-index:999; margin-left: 35%; margin-right: 50%; width: 400px; text-align:center"><p><img style="vertical-align:middle" src="images/error.png"> Wystąpił błąd</p><a class="link3 button" href="index.php">Odśwież</a></div>');
	    }
	elseif($check[0]=="P"){
	print("Nieaktywna licencja!");
	}
}
}
mysql_close($connection);
?>