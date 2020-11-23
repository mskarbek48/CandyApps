<?php
function checkPorn($clid){
	
	Global $ts, $core, $config;
	
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times"));
	
	foreach($clients as $client){
		if($client['clid'] == $clid){
			$uid = $client['client_unique_identifier'];
			$get = $ts->clientAvatar($client['client_unique_identifier']);
			if($get['success']){
				file_put_contents('avatars/'.$uid.'.png', base64_decode($get['data']));
					if($core->checkPorn('avatars/'.$uid.'.png')['final_decision'] == 'KO'){
						exec('rm avatars/'.$uid.'.png');
						$nick = $client['client_nickname'];
						$ts->sendMessage(1, $client['clid'], 'Wykryto porno');
						$ts->sendMessage(3, 1, $client['client_nickname']." Ma słodkie porno na avatarze, zobacz teraz!");
						foreach($clients as $client){
							if($core->checkIfIn($ts, $client['clid'], $config[1]['onServerJoin']['checkPorn']['notifyGroup'], $clients)){
								$ts->sendMessage(1, $client['clid'], '[b]Użytkownik: [/b]'.$nick.' [b]prawdopodobnie ma ustawione porno na avatarze, prosimy o sprawdzenie![/b]');
							}
						}
					}
				}
			}
		}
	}