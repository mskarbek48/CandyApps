<?php
function audioBot(){
	
	global $ts, $core, $config, $clients;
	
	$cfg = $config[2]['functions']['audioBot'];
	
	foreach($clients as $client){
		if($core->checkIfIn($ts, $client['clid'], $cfg['group'], $clients)){
			if($cfg['commander']){
				if($client['client_is_channel_commander'] == 0){
					$ts->sendMessage(1, $client['clid'], $cfg['commander_cmd']);
				}
			}
			foreach($cfg['cmds'] as $cmds){
				if($client['client_database_id'] == $cmds['dbid']){
					if($core->getIdle($ts, $client['client_database_id']) > $cfg['idle'] * 1000){
						$ts->sendMessage(1, $client['clid'], $cmds['cmd']);
					}
				}
			}
		}
	}
}