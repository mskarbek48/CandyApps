<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: info.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function info(){
	global $config, $ts, $telegram, $p, $core, $telegram, $server_info;
	$server_info = $info;
	$cfg = $config['1']['functions']['info'];
	$token = $cfg['telegram_api'];
	$chatid = $cfg['chat_id'];
	$date = date('H:i');
	if($cfg['enabled']){
			$core->sendTelegram($chatid, "<i>Podsumowanie serwera</i>", $token);
			$core->sendTelegram($chatid, "<b>Serwer działa! (".$info['virtualserver_total_ping']." ms)</b> - ".date('H:i')."", $token);
			$core->sendTelegram($chatid, "Nazwa serwera: ".$info['virtualserver_name'], $token);
			$core->sendTelegram($chatid, "Klienci Query: ".$info['virtualserver_queryclientsonline'], $token);
			$core->sendTelegram($chatid, "Klienci: ".$info['virtualserver_clientsonline'], $token);
			$core->sendTelegram($chatid, "Backup serwera:", $token);
	}
}
?>