<?php

function removePerm() {
	
	global $clients, $ts, $core, $pdo, $config;
	
	$cfg = $config[1]['functions']['removePerm'];

	
	foreach($clients as $client){
		
		
		
		if($client['client_type'] == 0){
		
			
			$perms = $ts->clientPermList($client['client_database_id']);
			

			
			if(!isset($bypass)){
				if($client['client_type'] == 0){
					$perm = $perms['data'];
					if(is_array($perm)){
						foreach($perm as $del){
							if(!in_array($del['permid'], $cfg['ignored_perms'])){
								$ts->clientDelPerm($client['client_database_id'], [$del['permid']]);
								$cfg['message'] = str_replace("[PERM]", $ts->permGet($del['permid'])['data']['permsid'], $cfg['message']);
								$ts->sendMessage(1, $client['clid'], $cfg['message']);
								unset($cfg['message']);
							}
						}
					}
				}
			}
		}
	}
}

