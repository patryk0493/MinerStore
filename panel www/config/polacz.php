<?php
require 'dbconnect_info.php';
$connection = mysql_connect($db_h, $db_nick, $db_pass) or die ('</br>Nie mozna polaczyc sie z serwerem MySQL.</br> Wszystko dobrze wpisane?</br>'.mysql_error());
mysql_select_db($db_n) or die ('Blad wyboru bazy danych.');
?>