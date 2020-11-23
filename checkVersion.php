<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: checkVersion.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function checkVersion(){
	global $config, $p, $core;
	
	$cfg = $config['1']['functions']['checkVersion'];
	$token = $cfg['telegram_api'];
	$chatid = $cfg['chat_id'];
	
	
	$api = exec("wget https://teamspeak.com/versions/server.json -qO - | jq '.linux.x86_64.version'");
	
	if($api == '"3.13.0"'){
		$core->sendTelegram($chatid, "Dostępna jest nowa wersja TeamSpeaka: 3.13.0", $token);
	}
}