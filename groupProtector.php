<?php
function groupProtector(){
	
	global $ts, $core, $config, $clients;
	$cfg = $config['1']['functions']['groupProtector'];
	
	foreach($clients as $client){
		
		if(!$client['client_type']){
		
			$clgroups = explode(',', $client['client_servergroups']);

			if(!isset($config[1]['functions']['groupProtector']['clients'][$client['client_database_id']])){
				foreach($config[1]['functions']['groupProtector']['protectgroups'] as $group){	
					if(in_array($group, $clgroups)){
						$ts->serverGroupDeleteClient($group, $client['client_database_id']);
						$ts->clientKick($client['clid'], "server", $cfg['kickMessage']);
					}
				}
			}else{
				foreach($config[1]['functions']['groupProtector']['protectgroups'] as $group){
					if(!in_array($group, $config[1]['functions']['groupProtector']['clients'][$client['client_database_id']])){
						if(isset($group)){
							if(in_array($group, $clgroups)){
								$ts->serverGroupDeleteClient($group, $client['client_database_id']);
								$ts->clientKick($client['clid'], "server", $cfg['kickMessage']);
							}
						}
					}
				}
			}
		}
	}
}