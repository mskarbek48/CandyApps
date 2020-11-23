<?php
function registerAfterTime(){
	
	global $core, $config, $ts, $clients;
	
	$cfg = $config[4]['functions']['registerAfterTime'];
	
	foreach($clients as $client){
	
		foreach($cfg['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
				$bypass = 1;
			}
		}
		foreach($cfg['ignoredIps'] as $igip){
			if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
				$bypass = 1;
			}
		}
		
		if(!isset($bypass)){
			
			
			if(isset($core->getInfoFromSQL($client['clid'])['spentTime'])){
				$time = $core->getInfoFromSQL($client['clid'])['spentTime'];
				if($cfg['time'] * 60 <= $time){
					
					foreach($cfg['registerGroups'] as $group){	
						$add = $ts->serverGroupAddClient($group, $client['client_database_id']);
					}
					if($add['success']){
						$message = str_replace("[TIME]", $cfg['time'] * 60, $cfg['message']);
						$ts->sendMessage(1, $client['clid'], $message);
					}
				}
			}
		}		
	}
}