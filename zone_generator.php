<?php

function zone_generator(){
	
	global $ts, $core, $config, $pdo, $clients, $footer;
	
	$cfg = $config[5]['functions']['zone_generator'];
	
	$request = $pdo->query("SELECT * FROM zones");
	$request = $request->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($request as $once){
		$test = $ts->channelInfo($once['cid']);
		if($test['errors']){
			$test = $pdo->prepare("DELETE FROM zones WHERE cid=:cid");
			$test->execute([':cid' => $once['cid']]);
		}
	}
	
	
	foreach($clients as $client){
		foreach($cfg['zones'] as $zone){
			if($client['cid'] == $zone['get_channel_id']){
				
				$request = $pdo->query("SELECT * FROM zones WHERE type='".$zone['name']."' ORDER BY id DESC LIMIT 1");
				$last = $request->fetch(PDO::FETCH_ASSOC);
				
				$last = $last;
				
				
				if(!isset($last['cid'])){
					$last = $zone['first_channel'];
				}else{
					$last = $last['cid'];
				}
				
				$passwd = rand(9999, 99999);
				$desc = str_replace("[NICK]", $client['client_nickname'], $zone['desc']);
				$spacer = str_replace("[NICK]", $client['client_nickname'], $zone['emptyspacer']);
				
				$get = $ts->channelCreate([
				'channel_name' => $spacer,
				'channel_flag_permanent' => 1,
				'channel_order' => $last,
				'CHANNEL_MAXCLIENTS' => $zone['maxClients'],
				'channel_flag_maxclients_unlimited'=> $zone['maxClients'],
				'channel_flag_maxfamilyclients_unlimited'=> $zone['maxClients'],
				'channel_flag_maxfamilyclients_inherited'=> $zone['maxClients'],
				]);
				
				
				
				$chname = str_replace("[NAME]", $zone['name'], $zone['cname']);
				$chname = str_replace("[NICK]", $client['client_nickname'], $chname);
				
				$created = $ts->channelCreate([
				'channel_name' => $chname,
				'channel_description' => $desc.$footer,
				'channel_flag_permanent' => 1,
				'CHANNEL_MAXCLIENTS' => $zone['maxClients'],
				'channel_password' => $passwd,
				'channel_flag_maxclients_unlimited'=> $zone['maxClients'],
				'channel_flag_maxfamilyclients_unlimited'=> $zone['maxClients'],
				'channel_flag_maxfamilyclients_inherited'=> $zone['maxClients'],
				'cpid' => $get['data']['cid'],
				]);
				
				for ($i = 1; $i <= $zone['subChannels']; $i++) {
					$subchannel = $ts->channelCreate([
					'channel_name' => str_replace('[num]', $i, $zone['subChannelName']),
					'channel_password' => $passwd,
					'channel_description' => $desc.$footer,
					'channel_flag_permanent' => 1,
					'cpid' => $created['data']['cid'],
					]);
				}
				
				$ts->clientMove($client['clid'], $created['data']['cid']);
				$msg = str_replace('[PASS]', $passwd, $zone['message']);
				$ts->sendMessage(1, $client['clid'], $msg);
				if($created['success']){
				
					$request = $pdo->prepare("INSERT INTO zones (`cid`, `type`, `leaderdbid`) VALUES (:cid, :type, :dbid)");
					$request->execute([':cid' => $get['data']['cid'], ':type' => $zone['name'], ':dbid' => $client['client_database_id']]);
					
				}else{
					
					$ts->clientKick($client['clid'], 'channel', "Wystąpił błąd z bazą danych!");
					
				}
				
				
			}
		}
	}
}
					