<?php
echo 'Current PHP version: ' . phpversion();
echo $_SERVER["SERVER_NAME"];


$url = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=D5DA168821E97F1C7398B94D3782497C&steamids=76561198431853961"); 
	$content = json_decode($url, true);
echo $content['response']['players'][0]['personaname'];