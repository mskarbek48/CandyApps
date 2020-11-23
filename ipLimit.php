<?php
function ipLimit($clid, $dbid, $clip){
	
	global $ts, $core, $config, $clients;
	
	$cfg = $config[1]['onServerJoin']['ipLimit'];
	
	foreach($cfg['ignoredGroups'] as $ignored){
		if($core->checkIfIn($ts, $clid, $ignored, $clients)){
			$notip = 1;
		}
	}
	foreach($cfg['ignoredIps'] as $igip){
		if($ts->clientInfo($clid)['data']['connection_client_ip'] == $igip){
			$notip = 1;
		}
	}
	
	if(!isset($notip)){
		if($core->clientsCountFromIp($ts, $dbid) > $cfg['max']){
			$ts->clientKick($clid, 'server', $cfg['kickMessage']);
		}
	}
}