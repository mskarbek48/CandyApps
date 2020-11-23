<?php

function usersFromMyCity(){
	
	global $ts,$core,$pdo,$config,$clients;
	
	$cfg = $config[2]['functions']['usersFromMyCity'];
	
	foreach($clients as $client){
		if($client['cid'] == $cfg['channel_id']){
			
			if($core->checkIfIn($ts, $client['clid'], $cfg['group'], $clients)){
			
				$clCity = $core->getCity($pdo, $client['client_database_id']);
				print_r( $clCity );
				$request = $pdo->prepare("SELECT * FROM userCity WHERE client_city=:city");
				$request->execute([':city' => $clCity]);
				$nearMe = $request->fetchAll(PDO::FETCH_ASSOC);
				$ts->clientKick($client['clid'], 'channel', "Informacje zostały wysłane!");
				$msg = "[b][color=#FF0AD6]                  W pobliżu Ciebie znajdują się: [/color][/b]";
				foreach($nearMe as $near){
					
					$request = $pdo->prepare("SELECT client_servergroups FROM saveUsers WHERE client_database_id=:dbid");
					$request->execute([':dbid' => $near['client_database_id']]);
					$nearGr = explode(',', $request->fetchAll(PDO::FETCH_ASSOC)[0]['client_servergroups']);
					
					if(in_array($cfg['group'], $nearGr)){
						if($near['client_nickname'] !== $client['client_nickname']){
								$message .= '\n[b]                        [/b][b]✖[/b][b][color=#FF3C00] ' . $near['client_nickname']. '[/color][/b][b]([i]'.$clCity.'[/i])';
							}
						
					}else{
						if($near['client_nickname'] !== $client['client_nickname']){
								$message .= '\n[b]                        [/b][b]✖[/b][b][color=#FF3C00] <hidden> [/color][/b][b]([i]'.$clCity.'[/i])';
							}				
						
					}
				}
				if(!isset($message)){
					$message = "\n[b]                        Jesteś całkowicie sam... jak w galaktyce";
				}
				$ts->sendMessage(1, $client['clid'], "\n[b]\n[/b]".$msg.$message);
			}else{
				$ts->clientKick($client['clid'], 'channel', "Najpierw musisz wyrazić zgodę na geolokalizacje na podstawie IP.");
			}

		}
	}
}
	
	