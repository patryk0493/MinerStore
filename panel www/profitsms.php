<?
//require 'polacz.php'; //plik łączący z bazą danych

$license = $_GET['lic'];
$ipT = $_SERVER['REMOTE_ADDR'];

	function posol($thing){
//wycięto
	}

$check = md5(posol($ipT));

if($license == "666_Dramo" || $license == "6aabe84bde369bf1ac06593d525686a3" || $license == "c410aa06d1910aedc4523dbb6c75bd80" || $license == "bb61c0d816cb47492fa5817d381644cd" || $license == "88936821a9194c332fe4dceb07264f3c" || $license == "4ed8393d82f3816efb88c9cc95b557a6" ){ //obsługa specjalnych licencji
$check = "true";
}
elseif($license =! "zzz"){
//$dane = mysql_query("SELECT * FROM licencje WHERE licencja='$license'");
//$r = mysql_fetch_array($dane);
$check = 'true';
}
//lekko zmodyfikowałem skrypt żeby zawsze zwracał true i nie wymagał licencji.

if($check == 'true'){
$handle=fopen("http://profitsms.pl/check.php?apiKey=".$_GET['apiKey']."&code=".$_GET['code']."&smsNr=".$_GET['smsNr']."", 'r');
$check=fgetcsv($handle,8);
fclose($handle);
print($check[0]);
echo(",");
print($check[1]);
} 
else
{
$omg = P;
print("P");
}
?>