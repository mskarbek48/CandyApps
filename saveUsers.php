<?php

function saveUsers(){
	
	global $clients, $pdo, $ts, $config, $core;
	
	$online = $core->getOnline($ts, $config);
	
	$request = $pdo->prepare("SELECT data FROM data WHERE name=:onlineRecord");
	$request->execute([':onlineRecord' => "onlineRecord"]);
	$data=$request->fetch(PDO::FETCH_ASSOC);
	if(!$data['data']){
		$request = $pdo->prepare("INSERT INTO data (`name`, `data`) VALUES (:name, :data)");
		$request->execute([':name' => "onlineRecord", ':data' => $core->getOnline($ts, $config)]);
	}
	if($data['data'] <= $online){
		$request = $pdo->prepare("UPDATE data SET data=:data WHERE name=:onlineRecord");
		$request->execute([':data' => $online, ':onlineRecord' => "onlineRecord"]);
	}
	
	foreach($clients as $client){
		if($client['client_type'] == 0){
			$request = $pdo->prepare("SELECT * FROM saveUsers WHERE client_database_id=:dbid");
			$request->execute([':dbid' => $client['client_database_id']]);
			
			$data = $request->fetch(PDO::FETCH_ASSOC);
			
			if(!$data['Id']){
				$clinfo = $ts->clientInfo($client['clid'])['data'];
				$request = $pdo->prepare("INSERT INTO saveUsers (`client_database_id`, `client_nickname`, `client_unique_identifier`, `client_description`, `client_lastconnected`, `client_servergroups`, `client_spentTime`, `client_topspentTime`, `connections`, `allTimes`) VALUES (:dbid, :nick, :uq, :desc, :last, :groups, :spentTime, :topspentTime, :connections, :alltimes)");
				$request->execute([':dbid' => $client['client_database_id'], ':nick' => $client['client_nickname'], ':uq' => $client['client_unique_identifier'], ':desc' => 0, ':last' => $client['client_lastconnected'], ':groups' => $client['client_servergroups'], ':spentTime' => 0, ':topspentTime' => 0, ':connections' => $clinfo['client_totalconnections'], ':alltimes' => 0]);
			}else{
				$clinfo = $ts->clientInfo($client['clid'])['data'];
				if($clinfo['client_description']){
					$request = $pdo->prepare("UPDATE saveUsers SET client_description=:desc WHERE client_database_id=:dbid");
					$request->execute([':desc' => $clinfo['client_description'], ':dbid' => $client['client_database_id']]);
				}				
				$request = $pdo->prepare("UPDATE saveUsers SET client_spentTime=:spent WHERE client_database_id=:dbid");
				$request->execute([':spent' => $clinfo['connection_connected_time']/1000, ':dbid' => $client['client_database_id']]);
				
				$request = $pdo->prepare("SELECT client_topspentTime FROM saveUsers WHERE client_database_id=:dbid");
				$request->execute([':dbid' => $client['client_database_id']]);

				$topSpent = $request->fetch(PDO::FETCH_ASSOC)['client_topspentTime'];
				if($topSpent < $clinfo['connection_connected_time']/1000){
					$request = $pdo->prepare("UPDATE saveUsers SET client_topspentTime=:top WHERE client_database_id=:dbid");
					$request->execute([':top' => $clinfo['connection_connected_time']/1000, ':dbid' => $client['client_database_id']]);
				}
				
				$request = $pdo->prepare("SELECT allTimes FROM saveUsers WHERE client_database_id=:dbid");
				$request->execute([':dbid' => $client['client_database_id']]);
				$allTimes = $request->fetch(PDO::FETCH_ASSOC)['allTimes'];
				
				$newTime = $allTimes + convertinterval($config['1']['functions']['saveUsers']['time_interval']);
				
				$request = $pdo->prepare("UPDATE saveUsers SET allTimes=:new WHERE client_database_id=:dbid");
				$request->execute([':new' => $newTime, ':dbid' => $client['client_database_id']]);
				
				$request = $pdo->prepare("UPDATE saveUsers SET client_nickname=:nick WHERE client_database_id=:dbid");
				$request->execute([':nick' => $client['client_nickname'], ':dbid' => $client['client_database_id']]);
				
				$request = $pdo->prepare("UPDATE saveUsers SET client_servergroups=:clg WHERE client_database_id=:dbid");
				$request->execute([':clg' => $client['client_servergroups'], ':dbid' => $client['client_database_id']]);
				
			}
		}
	}
}
		