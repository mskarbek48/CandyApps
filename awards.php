<?php
function awards(){
	
	global $ts, $core, $pdo, $config, $clients;
	
	$cfg = $config[4]['functions']['awards'];
	
	// top Connection
	$awards = $cfg['awards']['topConnections']['ranks'];
	
	foreach($awards as $number => $award){
		foreach($clients as $client){
			
			$clid = $client['clid'];
			$bypass = array();
			foreach($cfg['ignoredGroups'] as $ignored){
				if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
					$bypass[$clid] = 1;
				}
			}
			foreach($cfg['ignoredIps'] as $igip){
				if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
					$bypass[$clid] = 1;
				}
			}
			if(!isset($bypass[$client['clid']])){
				$request = $pdo->prepare("SELECT * FROM topConnections WHERE client_database_id=:dbid");
				$request->execute([':dbid' => $client['client_database_id']]);
				$data = $request->fetch(PDO::FETCH_ASSOC);
				
				if(isset($data['Connections'])){
					if($data['Connections'] >= $award['connections']){
						$toadd[$client['client_database_id']] = $award;
					}
				}
			}
		}
	}
	
	foreach($toadd as $dbid => $add){
		$done = $ts->serverGroupAddClient($add['rank'],$dbid);
		if($done['success']){
			$ts->sendMessage(1, $core->getClid($ts, $dbid), $add['message']);
		}
	
		foreach($cfg['awards']['topConnections']['allGroups'] as $award){
			if($award != $add['rank']){
				$ts->serverGroupDeleteClient($award, $dbid);
			}
		}
	
	}
	unset($awards);
	unset($toadd);
	unset($bypass);
	// top Spent Time
	$awards = $cfg['awards']['topSpentTime']['ranks'];
	
	foreach($awards as $number => $award){
		foreach($clients as $client){
			$clid = $client['clid'];
			$bypass = array();
			foreach($cfg['ignoredGroups'] as $ignored){
				if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
					$bypass[$clid] = 1;
				}
			}
			foreach($cfg['ignoredIps'] as $igip){
				if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
					$bypass[$clid] = 1;
				}
			}
			if(!isset($bypass[$client['clid']])){
				$request = $pdo->prepare("SELECT * FROM topSpentTime WHERE client_database_id=:dbid");
				$request->execute([':dbid' => $client['client_database_id']]);
				$data = $request->fetch(PDO::FETCH_ASSOC);
				
				if(isset($data['spentTime'])){
					if($data['spentTime']/3600 >= $award['hours']){
						$toadd[$client['client_database_id']] = $award;
					}
				}
			}
		}
	}
	if(isset($toadd)){
		foreach($toadd as $dbid => $add){
			$done = $ts->serverGroupAddClient($add['rank'],$dbid);
			if($done['success']){
				$ts->sendMessage(1, $core->getClid($ts, $dbid), $add['message']);
			}
		
			foreach($cfg['awards']['topSpentTime']['allGroups'] as $award){
				if($award != $add['rank']){
					$ts->serverGroupDeleteClient($award, $dbid);
				}
			}
		
		}
	}
	
}