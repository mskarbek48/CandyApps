<?php

function afkChecker(){
	
	global $ts, $core, $config, $clients, $clientold;
	
	$cfg = $config[1]['functions']['afkChecker'];
	
	foreach($clients as $client){
		
		if(!$core->checkIfIn($ts, $client['clid'], $cfg['ignored_group'], $clients)){
		
			if($core->getIdle($ts, $client['client_database_id']) >= $cfg['idle_time'] * 1000){
				
				if($client['cid'] == $cfg['channelToMove']){
				}else{
				
					foreach($cfg['groupToAdd'] as $group){
						$ts->serverGroupAddClient($group, $client['client_database_id']);
					}
					$ts->clientMove($client['clid'], $cfg['channelToMove']);
					$ts->sendMessage(1, $client['clid'], $cfg['message']);
				}
				
			}else{
					
				if($client['cid'] != $cfg['channelToMove']){
					
					foreach($cfg['groupToAdd'] as $group){
						$ts->serverGroupDeleteClient($group, $client['client_database_id']);
					}
				}
			}
		}
	}
}