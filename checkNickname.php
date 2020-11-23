<?php
function checkNickname(){
	
	global $ts, $core, $config, $clients;
	
	$cfg = $config[1]['functions']['checkNickname'];
	
	foreach($clients as $client){
		foreach($cfg['block'] as $fraze){
			if(strpos($client['client_nickname'], $fraze) !== false){
				if($cfg['mode'] == 'ban'){
					$cfg['blockMessage'] = str_replace("[BLOCK]", $fraze, $cfg['blockMessage']);
					$ts->banAddByUid($client['client_unique_identifier'], $cfg['time'], $cfg['blockMessage']);
				}else{
					$ts->clientKick($client['clid'], 'server', $cfg['blockMessage']);
				}
			}
		}
	}
}