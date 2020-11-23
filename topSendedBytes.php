<?php
function topSendedBytes(){
	
	global $ts, $core, $config, $clients, $pdo;
	
	$cfg = $config[4]['functions']['topSendedBytes'];
	
	foreach($clients as $client){
		
		
		foreach($config[4]['functions']['topSendedBytes']['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
				$bypass = 1;
			}
		}
		foreach($config[4]['functions']['topSendedBytes']['ignoredIps'] as $igip){
			if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
				$bypass = 1;
			}
		}
		
		if(!isset($bypass)){	
			if($client['client_type'] == 0){
				
				$request = $pdo->prepare("SELECT * FROM topSendedBytes WHERE client_database_id=:dbid");
				$request->execute([':dbid' => $client['client_database_id']]);
				$data = $request->fetch(PDO::FETCH_ASSOC);
				
				print_r($data['client_database_id']);
				
				if(!$data['client_database_id']){
					
					$request = $pdo->prepare("INSERT INTO topSendedBytes (`client_database_id`, `sendedBytes`) VALUES (:dbid, :sendedBytes)");
					$request->execute([':dbid' => $client['client_database_id'], ':sendedBytes' => 0]);
					
				}
				if(!isset($data['client_database_id'])){
					
					$bytes = $ts->clientInfo($client['clid'])['data']['client_month_bytes_uploaded'];
					$request = $pdo->prepare("UPDATE topSendedBytes SET sendedBytes=:bytes WHERE client_database_id=:dbid");
					$request->execute([':bytes' => $bytes, ':dbid' => $client['client_database_id']]);
					
				}
				
				
				
			}
		}
	}
}