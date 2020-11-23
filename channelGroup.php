<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: channelGroup.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function channelGroup(){
	global $ts, $config, $core, $clients;
	
	$cfg = $config[1]['functions']['channelGroup'];
	
	foreach($cfg['channels'] as $channels){
		foreach($clients as $client){
			if($client['cid'] == $channels['channel']){
				$check = $core->checkIfIn($ts, $client['clid'], $channels['group'], $clients);
				if(!$check){
					$ts->clientKick($client['clid'], 'channel', $cfg['messageOnAssign']);
					$ts->serverGroupAddClient($channels['group'], $client['client_database_id']);
				}else{
					$ts->clientKick($client['clid'], 'channel', $cfg['messageOnRevoke']);
					$ts->serverGroupDeleteClient($channels['group'], $client['client_database_id']);
				}
			}
		}
	}
}
		



