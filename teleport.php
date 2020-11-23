<?php
function teleport($clid, $dbid, $clip){
	
	global $ts, $core, $pdo, $config;
	
	$cfg = $config[3]['onServerJoin']['teleport'];
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times -voice"));
	
	$test = $pdo->query("Select * FROM guildCreator");
	if($test->rowCount() > 0){
		$result = $test->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}
	
	
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
		foreach($data as $guild){
			$group = $guild['group'];
			if($core->checkIfIn($ts, $clid, $group, $clients)){
				foreach($data as $guild){
					if($guild['group'] == $group){
						$ts->clientMove($clid, $guild['teleport']);
						$ts->sendMessage(1, $clid, $cfg['message']);
					}
				}
			}
		}
	}
}