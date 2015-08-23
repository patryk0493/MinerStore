<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<link rel="Shortcut icon" href="favicon.ico" />
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Description" content="Panel zarządzania kontem gracza na serwerze Minecraft by ASSHunter gg:8186874 , skype:eliaszpatryk , email: patryk0493@gmail.com" />
	<meta name="Keywords" content="server, panel, minecraft, gry, zarządzanie, kasa, banlista, stats, statystyki, bank, postać, sygnatura, henerator" />
	<title>Panel gracza | Sklep SMS | Minecraft by ASSHunter</title>
<script type="text/javascript"> window.document.onkeydown = function (e)
{
    if (!e){
        e = event;
    }
    if (e.keyCode == 27){
        lightbox_close();
    }
}
</script>
<script type="text/javascript"> window.document.onkeydown = function (f)
{
    if (!f){
        f = event;
    }
    if (f.keyCode == 70){
        por_close();
    }
}
</script>
<script type="text/javascript">function lightbox_open(){
    window.scrollTo(0,0);
    document.getElementById('light').style.display='block';
    document.getElementById('fade').style.display='block'; 
}
</script>
<script type="text/javascript">function por_open(){
    window.scrollTo(0,0);
    document.getElementById('por').style.display='block';
    document.getElementById('fade').style.display='block'; 
}
</script>
<script type="text/javascript">
function lightbox_close(){
    document.getElementById('light').style.display='none';
    document.getElementById('fade').style.display='none';
}
</script>
<script type="text/javascript">
function por_close(){
    document.getElementById('por').style.display='none';
    document.getElementById('fade').style.display='none';
}
</script>
 </head>
<body>
<?php
@include 'informacje.php'; //informacje
function punkty(){
require 'config/polacz.php';
$nick = $_SESSION['logged_nick'];
$a = "SELECT points FROM authme WHERE name='$nick'";
$b = mysql_query($a) or die(mysql_error()); 
$checkpoints = mysql_fetch_array($b);
if($checkpoints['points'] == 0){
echo("0");
}
else 
{
print($checkpoints['points']);
}
mysql_close($connection);
}
?>
<div id="koza" style="text-align:center">

<?
if(!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0){
?>

 <div style="text-align:center"><a href="http://<? echo $adrespodstawowy;?>"><img align="middle" src="<? echo $logoduze;?>"></a></div>
<?
}
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['logged_nick'])){

?>

<div class="contener2" style="float: right; position:fixed; right: 40px; top: 10px; height:35px; width:400px; padding-top:20px; margin-top:-20px;text-align:left; z-index:9999">

	<img style="border:1px solid #424242; vertical-align:middle" src="https://minotar.net/avatar/<? print($_SESSION['logged_nick']); ?>/30.png"
	<p class="Calibri" style="color:#EEE; font-size:16px;"> <strong><? print($_SESSION['logged_nick']); ?></strong>  | Stan konta: <? punkty(); ?> pkt. </p>

    <div class="dropdown">
      <a href="#">Menu</a>
      <div>
        <ul>
          <li><a href="#" onClick="lightbox_open();"><img style="vertical-align:middle" src="images/doladuj.png" /> Doładuj punkty</a>
			<div id="light"><iframe id="menubez" width="100%" height="580px" src="sms.php"></iframe></div>
			<div id="fade" onClick="lightbox_close();"></div> </li>
          <li><a href="klienci.php"><img style="vertical-align:middle" src="images/klienci.png" /> Ostatni klienci</a></li>
          <li><a href="ekipa.php"><img style="vertical-align:middle" src="images/ekipa.png" /> Ekipa serwera</a></li>
          <? if ($adresdynmap !='') { echo "
          <li><a href='dynmap.php'><img style='vertical-align:middle' src='images/mapa.png' /> Mapa serwera</a></li>";}?>

			<li><a href='haslo.php'><img style='vertical-align:middle' src='images/haslo.png' /> Zmiana hasła</a></li>
			<? if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){ echo "
			<li><a style='color:#EEE;' href='admin/index.php'><img style='vertical-align:middle' src='images/admini.png' /> Panel admina</a></li>";}?>
          <li><a href="wyloguj.php"><img style="vertical-align:middle" src="images/logout.png" /> <strong>Wyloguj</strong></a></li>
        </ul>
      </div>
    </div>
    
</div>


<div id="kok" style="text-align:center; position:absolute; right: 25%; top: 90px; font-size:22px;">

	<div id="zakupy" style="float:left; margin-top: -90px;"> <a href="http://<? echo $adrespodstawowy;?>"><img src="<? echo $logomale;?>"></a> </div>

	<div id='cssmenu' style="float:right">
	<ul>
   <li class='active'><a href='index.php'><span>Home</span></a></li>
   <li class='active'><a href='buy.php'><span>Zakupy</span></a></li>
   <li class='active'><a href='banlist.php'><span>Banlista</span></a></li>
   <li class='has-sub'><a href='#'><span>Panel</span></a>
      <ul>
         <li><a href='gracz.php'><span>Twoja postać</span></a></li>
         <li><a href='gracze.php'><span>Twoje konto</span></a></li>
         <li><a href='zakupy.php'><span>Twoje zakupy</span></a></li>
         <li class='last'><a href='sygnatura.php'><span>Sygnatury</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Staty</span></a>
      <ul>
         <li><a href='gracze.php'><span>Staty graczy</span></a></li>
         <li><a href='stats.php'><span>Staty serwera</span></a></li>
         <li class='last'><a href='mcmmo.php'><span>McMMO</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='kontakt.php'><span>Kontakt</span></a></li>
	</ul>
	</div>

</div>

<?
}
?>