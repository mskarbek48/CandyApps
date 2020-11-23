<?php

function helpCount(){
	
	global $clients, $core, $ts, $config, $pdo;
	
	$cfg = $config[4]['functions']['helpCount'];
	
	foreach($clients as $client){
		foreach($cfg['channel_helps'] as $cp){
			if($client['cid'] == $cp){
				if($core->checkIfIn($ts, $client['clid'], 865, $clients)){
					$date = $pdo->prepare("SELECT * FROM helpCount WHERE client_database_id=:dbid");
					$date->execute([':dbid' => $client['client_database_id']]);
					$date = $date->fetch(PDO::FETCH_ASSOC);
					
					if(!$date['client_database_id']){
						$r = $pdo->prepare("INSERT INTO helpCount (`client_database_id`, `count`) VALUES (:dbid, :count)");
						$r->execute([':dbid' => $client['client_database_id'], ':count' => 1]);
					}else{
						$r = $pdo->prepare("SELECT count FROM helpCount WHERE client_database_id=:dbid");
						$r->execute([':dbid' => $client['client_database_id']]);
						$date = $r->fetch(PDO::FETCH_ASSOC);
						if($date['count']){
							$newcount = $date['count'] + 1 * 10;
							$r = $pdo->prepare("UPDATE helpCount SET count=:count WHERE client_database_id=:dbid");
							$r->execute([':count' => $newcount, ':dbid' => $client['client_database_id']]);
						}
					}
				}
			}
		}
	}
	
}