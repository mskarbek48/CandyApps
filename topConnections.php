<?php
function topConnections($clid, $dbid, $clip){
	
	global $ts, $core, $config, $pdo;
	
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times -voice"));
	
	foreach($clients as $client){
		if($client['clid'] == $clid){
			if($client['client_type'] == 0){
				
				foreach($config[4]['onServerJoin']['topConnections']['ignoredGroups'] as $ignored){
					if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
						$bypass = 1;
					}
				}
				foreach($config[4]['onServerJoin']['topConnections']['ignoredIps'] as $igip){
					if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
						$bypass = 1;
					}
				}
				if(!isset($bypass)){				
					
					$request = $pdo->prepare("SELECT * FROM topConnections where client_database_id=:dbid");
					$request->execute([':dbid' => $client['client_database_id']]);
				
					$data = $request->fetch(PDO::FETCH_ASSOC);
					
					if(!$data['Id']){
						$clinfo = $ts->clientInfo($client['clid'])['data'];
						$request = $pdo->prepare("INSERT INTO topConnections (`client_database_id`, `Connections`) VALUES (:dbid, :connections)");
						$request->execute([':dbid' => $dbid, ':connections' => $clinfo['client_totalconnections']]);
					}else{
						$clinfo = $ts->clientInfo($client['clid'])['data'];
						$request = $pdo->prepare("UPDATE topConnections SET Connections=:connections WHERE client_database_id=:dbid");
						$request->execute([':connections' => $clinfo['client_totalconnections'], ':dbid' => $dbid]);
					}
				}
			}
		}
	}
}
					
					
	
	