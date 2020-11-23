<?php

function levels(){
	
	global $ts, $core, $config, $pdo, $clients;
	
	foreach($clients as $client){
		
		if($client['client_type'] == 0){
		
		
				foreach($config[4]['functions']['levels']['ignoredGroups'] as $ignored){
					if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
						$bypass = 1;
					}
				}
				foreach($config[4]['functions']['levels']['ignoredIps'] as $igip){
					if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
						$bypass = 1;
					}
				}
				if(!isset($bypass)){		
		
				
					$request = $pdo->prepare("SELECT * FROM levels where client_database_id=:dbid");
					$request->execute([':dbid' => $client['client_database_id']]);
					
					$data = $request->fetch(PDO::FETCH_ASSOC);
					
					if(!$data['Id']){
						
						$request = $pdo->prepare("INSERT INTO levels (`client_database_id`, `spentTime`, `level`) VALUES (:dbid, :spentTime, :level)");
						$request->execute([':dbid' => $client['client_database_id'], ':spentTime' => 0, ':level' => 0]);
						
					}else{
						
						$request = $pdo->prepare("SELECT * FROM levels WHERE client_database_id=:dbid");
						$request->execute([':dbid' => $client['client_database_id']]);
						$oldtime = $request->fetch(PDO::FETCH_ASSOC)['spentTime'];
						$newtime = $oldtime + convertinterval($config[4]['functions']['levels']['time_interval']);
						
						
						$request = $pdo->prepare("UPDATE levels SET spentTime=:spentTime WHERE client_database_id=:dbid");
						$request->execute([':spentTime' => $newtime, ':dbid' => $client['client_database_id']]);
						
						$request = $pdo->prepare("SELECT * FROM levels WHERE client_database_id=:dbid");
						$request->execute([':dbid' => $client['client_database_id']]);
						$spenttime = $request->fetch(PDO::FETCH_ASSOC)['spentTime'];
						
						$levels = $config[4]['functions']['levels']['levels'];
						
						foreach($levels as $level => $data){
							if($spenttime == $data[1]){
								$ts->sendMessage(1, $client['clid'], "Gratulacje! Awansowałeś na kolejny poziom!");
								$ts->serverGroupAddClient($data[0], $client['client_database_id']);
								
								$request = $pdo->prepare("SELECT * FROM levels WHERE client_database_id=:dbid");
								$request->execute([':dbid' => $client['client_database_id']]);
								$levelsql = $request->fetch(PDO::FETCH_ASSOC)['level'];
								
								foreach($levels as $leveltodel => $data1){
									if($leveltodel == $levelsql){
										$ts->serverGroupDeleteClient($data1[0], $client['client_database_id']);
										$request = $pdo->prepare("UPDATE levels SET level=:lvl WHERE client_database_id=:dbid");
										$newlevel = $levelsql + 1;
										$request->execute([':lvl' => $newlevel, ':dbid' => $client['client_database_id']]);
									}else{
										if($levelsql == 0){
											$request = $pdo->prepare("UPDATE levels SET level=:lvl WHERE client_database_id=:dbid");
											$newlevel = 1;
											$request->execute([':lvl' => $newlevel, ':dbid' => $client['client_database_id']]);
									}
								}			
							}	
						}
					}	
				}
			}
		}
	}
}
	
	