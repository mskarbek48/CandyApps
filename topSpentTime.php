s<?php
function topSpentTime(){
	
	global $ts, $core, $config, $pdo, $clients;
	
	$cfg = $config[4]['functions']['topSpentTime'];
	
	foreach($clients as $client){
		if($client['client_type'] == 0){
		
			foreach($cfg['ignoredGroups'] as $ignored){
				if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
					$bypass = 1;
				}
			}
			foreach($cfg['ignoredIps'] as $igip){
				if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
					$bypass = 1;
				}
			}
			
			if(!isset($bypass)){
		
				$request = $pdo->prepare("SELECT * FROM topSpentTime where client_database_id=:dbid");
				$request->execute([':dbid' => $client['client_database_id']]);
				
				$data = $request->fetch(PDO::FETCH_ASSOC);
				
				if(!$data['Id']){
					$request = $pdo->prepare("INSERT INTO topSpentTime (`client_database_id`, `spentTime`) VALUES (:dbid, :spentTime)");
					$request->execute([':dbid' => $client['client_database_id'], ':spentTime' => 0]);
				}else{
					
					$request = $pdo->prepare("SELECT spentTime FROM topSpentTime WHERE client_database_id=:dbid");
					$request->execute([':dbid' => $client['client_database_id']]);
					
					$oldtime = $request->fetch(PDO::FETCH_ASSOC)['spentTime'];
					
					$newtime = $oldtime + convertinterval($config['4']['functions']['topSpentTime']['time_interval']);
					
					$request = $pdo->prepare("UPDATE topSpentTime SET spentTime=:spentTime WHERE client_database_id=:dbid");
					$request->execute([':spentTime' => $newtime, ':dbid' => $client['client_database_id']]);
				}
			}
		}
	}
}
		
		
	
	