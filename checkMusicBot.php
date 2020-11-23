<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: checkMusicBot.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function checkMusicBot(){
	global $ts, $config, $clients, $core;
	
	$cfg = $config[1]['functions']['checkMusicBot'];
	
	foreach($clients as $client){
		if($client['cid'] == $cfg['lobby_channel']){
			$check = $core->checkIfIn($ts, $client['clid'], $cfg['group'], $clients);
			if($check){
				$dbid = $client['client_database_id'];
				$message = $client['clid'];
				$ts->clientMove($client['clid'], $cfg['movetoChannel']);
				foreach($cfg['commands'] as $command){
					$command = str_replace("[db]", $dbid, $command);
					$ts->sendMessage(1, $client['clid'], $command);
				}
			}
		}
	}
}


