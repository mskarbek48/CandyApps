<?php

function groupLimiter(){

	global $ts, $core, $config, $clients;
	
	$cfg = $config[1]['functions']['groupLimiter'];

	foreach($clients as $client){
		
		foreach($cfg['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
				$notip = 1;
			}
		}
		foreach($cfg['ignoredIps'] as $igip){
			if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
				$notip = 1;
			}
		}
		
		
		
		$clgroups = explode(',', $client['client_servergroups']);
		if(!isset($notip)){
			foreach($cfg['groupLimiters'] as $limits){
				$count = 0;
				foreach($limits['groups'] as $group){
					if(in_array($group, $clgroups)){
						$count++;
					}
				}
				if($count>$limits['limit']){
					$check = $count;
					foreach($limits['groups'] as $group){
						if($check > $limits['limit']){
							if(in_array($group, $clgroups)){
								$ts->serverGroupDeleteClient($group, $client['client_database_id']);
								$ts->sendMessage(1, $client['clid'], $cfg['message']);
								$check--;
							}
						}
					}
				}
			}
		}
	}
}


		
		
		