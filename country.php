<?php
function country($clid, $dbid, $clip){
	
	global $ts, $core, $config, $clients;
	
	$cfg = $config[1]['onServerJoin']['country'];
	
	foreach($cfg['ignoredGroups'] as $ignored){
		if($core->checkIfIn($ts, $clid, $ignored, $clients)){
			$bypass= 1;
		}
	}
	foreach($cfg['ignoredIps'] as $igip){
		if($ts->clientInfo($clid)['data']['connection_client_ip'] == $igip){
			$bypass= 1;
		}
	}
	
	if(!isset($bypass)){
		foreach($cfg['country_codes'] as $cc){
			if($cfg['mode'] == 'block'){
				if(isset($ts->clientInfo($clid)['data']['client_country'])){
					if($ts->clientInfo($clid)['data']['client_country'] == $cc){
						$ts->clientKick($clid, 'server', $cfg['kickMessage']);
					}
				}
			}else{
				if(isset($ts->clientInfo($clid)['data']['client_country'])){
					if(!$ts->clientInfo($clid)['data']['client_country'] == $cc){
						$ts->clientKick($clid, 'server', $cfg['kickMessage']);
					}
				}
			}
		}
	}
}