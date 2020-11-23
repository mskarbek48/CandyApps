<?php

function topConnectionTime(){
	
	global $ts, $core, $config, $clients, $pdo;
	
	foreach($clients as $client){
		if($client['client_type'] == 0){
		
			foreach($config[4]['functions']['topConnectionTime']['ignoredGroups'] as $ignored){
				if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
					$bypass = 1;
				}
			}
			foreach($config[4]['functions']['topConnectionTime']['ignoredIps'] as $igip){
				if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
					$bypass = 1;
				}
			}
			if(!isset($bypass)){
				$request = $pdo->prepare("SELECT * FROM topConnectionTime where client_database_id=:dbid");
				$request->execute([':dbid' => $client['client_database_id']]);
				
				$data = $request->fetch(PDO::FETCH_ASSOC);
				
				if(!$data['Id']){
					$request = $pdo->prepare("INSERT INTO topConnectionTime (`client_database_id`, `connectionTime`) VALUES (:dbid, :connectionTime)");
					$request->execute([':dbid' => $client['client_database_id'], ':connectionTime' => 0]);
				}else{
					$clinfo = $ts->clientInfo($client['clid'])['data'];
					$request = $pdo->prepare("SELECT connectionTime FROM topConnectionTime WHERE client_database_id=:dbid");
					$request->execute([':dbid' => $client['client_database_id']]);
					$topSpent = $request->fetch(PDO::FETCH_ASSOC)['connectionTime'];
					if($topSpent < $clinfo['connection_connected_time']/1000){
						$request = $pdo->prepare("UPDATE topConnectionTime SET connectionTime=:top WHERE client_database_id=:dbid");
						$request->execute([':top' => $clinfo['connection_connected_time']/1000, ':dbid' => $client['client_database_id']]);
					}
				}
			}
		}
	}
}
		