<?php
function blockRecord(){
	
	global $ts, $clients, $config, $core;
	
	$cfg = $config[1]['functions']['blockRecord'];
	
	
	
	foreach($clients as $client){
		
		$clinf = $ts->clientInfo($client['clid'])['data'];
		
		
		foreach($cfg['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
				$bypass = 1;
			}
		}
		foreach($cfg['ignoredIps'] as $igip){
			if(isset($clinf['connection_client_ip'])){
				if($clinf['connection_client_ip'] == $igip){
					$bypass = 1;
				}
			}
		}
		foreach($cfg['ignoredCids'] as $igCids){
			if($client['cid'] == $igCids){
				$bypass = 1;
			}
		}
		
		
		
		if(!isset($bypass)){
			if($clinf['client_is_recording'] == 1){
				if($ts->clientInfo($client['clid'])['data']['client_is_recording'] == 1){
					$check = $ts->clientKick($client['clid'], 'server', $cfg['kickMessage']);
				}
			}
		}
	}
}