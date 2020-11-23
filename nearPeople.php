<?php

function nearPeople(){
	
	global $ts, $clients, $config, $core, $pdo;
	
	$cfg = $config[2]['functions']['nearPeople'];
	
	$ok = 0;
	
	foreach($clients as $client){
		
		if($client['client_type'] == 0){
			
			foreach($config[4]['functions']['topSendedBytes']['ignoredGroups'] as $ignored){
				
				
				if(!$core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
					
					$request = $pdo->prepare("SELECT * FROM userCity WHERE client_database_id=:dbid");
					$request->execute([':dbid' => $client['client_database_id']]);
					$return = $request->fetch(PDO::FETCH_ASSOC);
					
					
					if(!$return['client_database_id']){
						$data = json_decode(file_get_contents("http://api.ipstack.com/".$client['connection_client_ip']."?access_key=321cf88c77f4bf1a45dd11a1858ef068"), true);
						$sql = $pdo->prepare("INSERT INTO userCity (`client_database_id`, `client_nickname`, `client_city`, `client_region`) VALUES (:dbid, :nick, :city, :region)");
						$sql->execute([':dbid' => $client['client_database_id'], ':nick' => $client['client_nickname'], ':city' => $data['city'], ':region' => $data['region_name']]);
					}
					break;
				}
			}
		}
	}
}

?>