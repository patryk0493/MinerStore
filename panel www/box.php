<?php
@include 'informacje.php'; //informacje

if(!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0){
	
//ponizej logowanie
?>

<div id="form">
			<br><p class="link" style="font-size:16px">Witaj w sklepie SMS oraz</br>panelu zarządzania kontem na serwerze DOSCRAFT.eu</p></br></br></strong>
				<div style="color: #666; font-size: 100%; font-family: Tahoma">
				<?php include 'include/loginfunction.php'; ?><br><br>
                <a class="link3 button" href="tutorial.php"  onclick='return otworz(this.href)'>Dowiedz się jak korzystać ze sklepu!</a>
</div>

<?
}
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['logged_nick'])){

?>

<div class="contener2" style=" right: 80px; top: 50px; height:auto; width:220px; text-align:center;">
<img src="https://minotar.net/avatar/<? print($_SESSION['logged_nick']); ?>/150.png"<br>
<p class="Calibri" style="color:#EEE; font-size:18px;"> <strong><? print($_SESSION['logged_nick']); ?></strong><hr /> Stan konta:<br /><? punkty(); ?> pkt. </p><br /><br />


		<form method="post" action="">
		<input type="hidden" name="check_code" value="1">
		</br><strong><p style="font-family:Minecraft; font-size:14px; color:#EBEBEB">Podaj kod z SMS </p></strong></br>
		<input class="button" type="text" size="15" name="code"><input class="button" type=submit value="Sprawdź!">

            <br><br>
    
</form>

<a class="link3 button" href="tutorial.php"  onclick='return otworz(this.href)'>Poradnik</a><br /><br />
<a class="link3 button" href="sms.php"  onclick='return otworz(this.href)'>Dostępne SMS'y</a><br /><br />
<a class="link3 button" href="klienci.php">Ostatni klienci</a>
<?
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
?>
<hr /><br />
<a class="link3 button" style="color:#EEE;" href="admin/index.php">Config Panel</a><br /><br />
<a class="link3 button" style="color:#EEE;" href="admin/debugconsole.php">Konsola</a> 

<?
}
?>
<a class="Calibri" style="color:#EEE; font-size:18px" href="wyloguj.php"><hr /><strong>Wyloguj</strong></a> </p></br>

<?
}
?>