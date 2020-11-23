<?php
function removeChPerm(){
	
	global $ts, $core, $config, $clients;
	
	$cfg = $config[1]['functions']['removeChPerm'];
	
	foreach($clients as $client){

		
		if(!isset($bypass)){
			if($client['client_type'] == 0){
				$perm = $ts->channelClientPermList($client['cid'], $client['client_database_id']);
				if($perm['data']){
					foreach($perm['data'] as $del){
						if(!in_array($del['permid'], $cfg['ignored_perms'])){
							$ts->channelClientDelPerm($client['cid'], $client['client_database_id'], [$del['permid']]);
							$cfg['message'] = str_replace("[PERM]", $ts->permGet($del['permid'])['data']['permsid'], $cfg['message']);
							$ts->sendMessage(1, $client['clid'], $cfg['message']);
						}
					}
				}
			}
		}
	}
}


