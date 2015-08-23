<head>
<link rel=stylesheet href="stylefree.css" TYPE="text/css" media="screen"/>
<link rel="Shortcut icon" href="favicon.ico" />
</head>

<?

function punkty(){
require '../config/polacz.php';
$nick = $_SESSION['logged_nick'];
$checkpoints = mysql_fetch_array(mysql_query("SELECT points FROM authme WHERE name='$nick'"));
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

<div class=contener2" style="opacity: 1.0; font-size: 120%;">

<?
if(!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0){
?>

<a class="link2" href="../login.php">Zaloguj się.</a>
</div>
<?
}
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['logged_nick'])){

?>
<div class="contener2" style="font-size: 80%; width:650px">

Witaj <? print($_SESSION['logged_nick']); ?> w panelu administracyjnym !</br> <a class="link2" href="../index.php">Home</a> | <a class="link2" href="../buy.php">Zakupy</a> | <a class="link2" href="../admin/services.php">Usługi</a> | <a class="link2" href="../admin/codes.php">Kody SMS</a> | <a class="link2" href="../admin/logs.php">Logi</a> 

<?
}
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){

?>
 | <a class="link2" href="../admin/index.php">Panel Administracyjny</a> | <a class="link2" href="../admin/debugconsole.php">Konsola</a> | <a class="link2" href="../wyloguj.php">Wyloguj</a>
<?
}
?>
</div>