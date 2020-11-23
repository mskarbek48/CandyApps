<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: getCreate.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function getCreate(){
	
	global $ts, $config, $core, $clients;
	$cfg = $config[1]['functions']['getCreate'];
	
	foreach($cfg['channels'] as $channel){
		foreach($clients as $client){
			if($client['cid'] == $channel['id']){
				$count = $core->getChannelCout($ts, $channel['id']);
				if($count >= $channel['count']){
					if(strpos($client['client_nickname'], $cfg['leaderNickContains']) !== false){
						$ts->clientMove($client['clid'], $channel['idToMove']);
					}
				}
			}
		}
	}
}
		