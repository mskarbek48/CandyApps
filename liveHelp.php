<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: liveHelp.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function liveHelp(){
	
	global $ts, $config, $core, $telegram, $clients;
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times"));
	
	$cfg = $config[2]['functions']['liveHelp'];
	$livehelp = $core->getClid($ts, $cfg['bot_dbid']);
	
	foreach($clients as $client){
		if($client['cid'] == $cfg['channel_id'] && $client['client_database_id'] != $cfg['bot_dbid']){
			$admins = $core->getClientsCountGroup($ts, $cfg['supporter_group']);
			if($admins == 0){
				$ts->sendMessage(1, $livehelp, "!vol 100");
				$ts->sendMessage(1, $livehelp, "!bot name LiveHelp - Brak administracji!");
				$ts->sendMessage(1, $client['clid'], "Na serwerze nie ma żadnego administratora. Zapraszamy później.");
				$ts->sendMessage(1, $livehelp, "!play " . $cfg['no_admins']);
				sleep($cfg['time_no_admins']);
				$ts->sendMessage(1, $livehelp, "!play " . $cfg['after']);
				$ts->sendMessage(1, $livehelp, "!vol 100");
				sleep($cfg['after_time']);
				$ts->sendMessage(1, $livehelp, "!bot name LiveHelp!");
				$ts->clientKick($client['clid'], 'channel', "Brak administracji");
			}else{
				$admins = $core->getClientsCountGroup($ts, $cfg['supporter_group']);
				$ts->sendMessage(1, $livehelp, "!vol 100");
				$ts->sendMessage(1, $livehelp, "!bot name LiveHelp - Proszę czekać");
				$ts->sendMessage(1, $client['clid'], "Na serwerze jest[b] " . $admins . "[/b] administratorów. Wkrótce ktoś udzieli Ci pomocy");
				$ts->sendMessage(1, $livehelp, "!play " . $cfg['yes_admins']);
				$core->sendTelegram($cfg['chat_id'], "Użytkownik " . $client['client_nickname'] . " oczekuje na pomoc.", $cfg['telegram_api']);
				sleep($cfg['time_yes_admins']);
				$ts->sendMessage(1, $livehelp, "!vol 100");
				$ts->sendMessage(1, $livehelp, "!play " . $cfg['after']);
				sleep($cfg['after_time']);
				$ts->clientMove($client['clid'], $cfg['channel_to_move']);
				$ts->sendMessage(1, $livehelp, "!bot name LiveHelp!");
			}
			
		}
	}
}
?>
