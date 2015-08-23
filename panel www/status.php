<?php

	include_once 'status/status.class.php';
	include_once 'config/rcon_config.php';
	$status = new MinecraftServerStatus();
	$response = $status->getStatus($server);
if(!$queryPort == ''){
	if(!$response) {
		echo"Serwer jest <span id='offline' style='height:20px; font-size:14px'>OFFLINE</span>";
	} else {
		$min1 = $response['players'];
		$max1 = $response['maxplayers'];
		$procenty = $min1/$max1*100;
		echo"
		<div id='menubez' style='float:right; width:230px; height:auto'>
			
			<div class='st' style='width:100px; float:left'>
				<p class='link3'>Wersja: ".$response['version']." </p>
			</div>
			<div class='st' style='width:100px; float:right'>
				<p class='link3'>Ping: ".$response['ping']." </p>
			</div>
			<div class='st' style='width:220px; margin-top: 70px'>
				<p class='link3'><span id='online' style='height:20px; font-size:14px'>ONLINE</span>    Gracze: ".$response['players']."/".$response['maxplayers']." </p>
				
				<div class='meter'>
					<span style='width: ".$procenty."%'></span>
				</div>
			</div>
		</div>

			";
	}
}
?>