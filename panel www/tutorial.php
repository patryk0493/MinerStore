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
<script type="text/javascript">
// <![CDATA[
function otworz(adres) {
noweOkno = window.open(adres, 'Poradnik', 'menubar=yes, toolbar=yes, location=yes, scrollbars=no, resizable=no, status=yes, width=800, height=800');
return false;
}
// ]]>
</script>
</head>
<body style="text-align: center; font-family:Calibri">
<?
@include 'informacje.php';
?>

<div id="buycontent" style="height: auto; padding-top: 5px; padding-bottom:5px; width:800px; color: #EBEBEB; font-size: 110%; margin-top:20px">
<div id="nazwa">Poradnik</div>

<?php
include 'config/polacz.php';

require 'config/system.php';
if($system == 1){
require 'dotpayconfig.php';
}
if($system == 2){
require 'homepayconfig.php';
}
if($system == 3){
require 'profitsmsconfig.php';
}

	
echo "	
		<h2>Menu poradnika</h2>
		<a class='link2' href='#zalogowac'> Jak się zalogować?</a><br>
		<a class='link2' href='#doladowanie'> Jak doładować konto punktami?</a><br>
		<a class='link2' href='#kupus'>Jak zakupić przedmiot/usługę?</a><br>
		<a class='link2' href='#odb'>Jak odbanować gracza?</a><br>
		<hr>
		<div id='zalogowac'>
			<div id='menus'>
				<h3>Jak się zalogować?</h3>
				<p> Witaj w poradniku korzystania ze panelu gracza serwera ".$nazwa."<br>
				Zapoznamy Cię z podstawowymi funkcjami sklepu SMS oraz innymi funkcjami</p>
				<p> Do zalogowania użyj danych jakimi logowałeś się na serwerze gry. Loginem jest Twój nick Minecraft, zaś hasłem - hasło jakie podałeś podczas rejestracji komendą na serwerze np: <strong>/register 123 123</strong></p>
				<p> Wpisz je jak na obrazku poniżej:</p>
				<img src='tutorial/1.jpg'>
				<p> Jeśli dane się zgadzają, otworzy się strona główna sklepu.</p>
				<img src='tutorial/2.jpg'>
			</div>
		</div>
		
		<hr>
		<div id='doladowanie'>
			<div id='menus'>
				<h3>Jak doładować konto punktami?</h3>
				<p>Aby móc zakupić przedmioty i usługi, musisz posiadać punkty (wirtualna waluta sklepu), ich ilość podana jest w górnym prawym rogu sklepu tuż pod twoim nickiem. </p>
				<p>Konto doładujesz wysyłając SMS zgodnie z danymi z tabeli poniżej, wybierz ilość punktów, potem wpisz odpowiednią treść SMS i wyślij pod wybrany numer</p>";
			
			
echo '<div class="contener2"><div id="sms" style="height: auto">';

if($system == 2){
foreach($config_homepay as $v)
echo "Wyślij SMS na ".$v['punkty']." pkt. o treści<strong><span style=\"color: rgb(255, 153, 0)\"> ".$v['tekst']."</span></strong> pod numer <span style=\"color: rgb(255, 153, 0)\"><strong>".$v['numer']."</strong></span> za <strong>".$v['netto']."</strong>PLN + VAT <strong>( ".$v['brutto']."zl )</strong><br/>\n";
}
if($system == 1){
foreach($config_dotpay as $h)
echo "Wyślij SMS na ".$h['punkty']." .pkt. o treści<strong><span style=\"color: rgb(255, 153, 0)\"> ".$h['tekst']."</span></strong> pod numer <span style=\"color: rgb(255, 153, 0)\"><strong>".$h['numer']."</strong></span> za <strong>".$h['netto']."</strong>PLN + VAT <strong>( ".$h['brutto']."zl )</strong><br/>\n";
}
if($system == 3){
foreach($config_profitsms as $c)
echo "Wyślij SMS na ".$c['punkty']." pkt. o treści<strong><span style=\"color: rgb(255, 153, 0)\"> ".$c['tekst']."</span></strong> pod numer <span style=\"color: rgb(255, 153, 0)\"><strong>".$c['numer']."</strong></span> za <strong>".$c['netto']."</strong>PLN + VAT <strong>( ".$c['brutto']."zl )</strong><br/>\n";
}

echo '</div></div>';
			
				
echo "			<p>Otrzymasz zwrotnego SMS'a z kodem. Przepisz go, potem kliknij na 'Sprawdź'</p>
				<img src='tutorial/3.jpg'>
				<p> Jeśli wszystko wykonałeś poprawnie, Twoje konto zostanie doładowane o wybraną liczbę punktów</p>
			</div>
		</div>
		
		<hr>
		<div id='kupus'>
			<div id='menus'>
				<h3>Jak zakupić przedmiot/usługę?</h3>
				<p> Po zalogowaniudo sklepu, przejdź do zakładki 'Zakupy'.</p>
				<p> Wybierz z listy usługę jaką chcesz zakupić, kliknij na 'Zamawiam'</p>
				<img src='tutorial/4.jpg'>
				<p> Wpisz nick do kogo ma powędrować usługa (gracz musi być ONLINE), wpisz kod rabatowy jeśli go posiadasz. Jeśli jesteś pewny, kliknij 'Kupuję'. Cierpliwie poczekaj, po chwili otrzymasz zamówienie.</p>
				<img src='tutorial/5.jpg'>
			</div>
		</div>
		
		<hr>
		<div id='odb'>
			<div id='menus'>
				<h3>Jak odbanować gracza?</h3>
				<p> Naszym panelem szybko możesz odbanować dowolnego gracza - aby to zrobić przejdź do zakładki 'Banlist'.<br>
				<img src='tutorial/6.jpg'>
				Wyświetliła się lista zbanowanych graczy, wybierz i wyszukaj gracza, którego chcesz odbanować, teraz kliknij 'ODBANUJ'.</p>
				<img src='tutorial/7.jpg'>
				<p> Teraz sprawdź dane, czy aby na pewno to zbanowany gracz, jeśli jesteś pewien - kliknij 'Odbanuj'. Pamiętaj, że będziesz potrzebował do tego punktów.</p>
				<img src='tutorial/8.jpg'>
			</div>
		</div>
		
";

@include "stopka.php";
?>
</div>
</body>