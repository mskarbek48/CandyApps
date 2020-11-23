<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: config.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function joinFunctions($clid, $dbid, $clip){
	
	global $ts, $config, $core, $channels;
	
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times"));

	if(isset($client['client_type']) || $client['client_type'] == 1){
		return false;
	}
	
	$cfgt = $config[1]['onServerJoin']['joinFunctions']['teleport'];
	$cfgw = $config[1]['onServerJoin']['joinFunctions']['welcomeMessage'];
	$cfgip = $config[1]['onServerJoin']['joinFunctions']['groupForIp'];
	$cfgagc = $config[1]['onServerJoin']['joinFunctions']['assignGroupByConnection'];
	
	if($cfgw['enabled']){
		if($core->checkIfIn($ts, $clid, $cfgw['group'], $clients)){
			if($cfgw['mode'] == 2){
				if($ts->clientInfo($clid)['data']['client_platform'] == "Windows" || $ts->clientInfo($clid)['data']['client_platform'] == "Linux"  || $ts->clientInfo($clid)['data']['client_platform'] == "macOS"){
					foreach($cfgw['messages'] as $message){
							$message = $core->replaceWelcomeMessage($ts, $clid, $message);
							$ts->sendMessage(1, $clid, $message);
					}
				}
			}else{
				foreach($cfgw['messages'] as $message){
						$message = $core->replaceWelcomeMessage($ts, $clid, $message);
						$ts->sendMessage(1, $clid, $message);
					}
				}	
		}else{
			foreach($cfgw['newMessage'] as $message){
				$message = $core->replaceWelcomeMessage($ts, $clid, $message);
				$ts->sendMessage(1, $clid, $message);
			}
		}
	}		
	
	if($cfgip['enabled']){
		foreach($cfgip['allGroups'] as $data){
			if($clip == $data['ip']){
				$ts->serverGroupAddClient($data['group'], $dbid);
			}
		}
	}
	
	
	if($cfgt['enabled']){
		if($core->checkIfIn($ts, $clid, $cfgt['group'], $clients)){
			foreach($channels as $channel){
				if($channel['pid'] == $cfgt['channel_id']){
					$chclgr = $ts->channelGroupClientList($channel['cid'])['data'];
					foreach($chclgr as $clrank){
						if($clrank['cldbid'] == $dbid){
							if(in_array($clrank['cgid'], $cfgt['channel_groups'])){
								if(!isset($done)){
									$message = str_replace("[name]", $channel['channel_name'], $cfgt['message']);
									$ts->clientMove($clid, $clrank['cid']);
									$ts->sendMessage(1, $clid, $message);
									$done = true;
								}
							}
						}
					}
				}
			}
		}
	}
	if($cfgagc['enabled']){
		foreach($cfgagc['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $clid, $ignored, $clients)){
				$nota = 1;
			}
		}if(!isset($nota)){
			if($ts->clientInfo($clid)['data']['client_totalconnections'] >= $cfgagc['connections']){
				$ts->serverGroupAddClient($cfgagc['group'], $dbid);
			}
		}
	}
	$cfgcp = $config[1]['onServerJoin']['joinFunctions']['groupByPlatform'];
	if($cfgcp['enabled']){
		foreach($cfgcp['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $clid, $ignored, $clients)){
				$notp = 1;
			}
		}
		if(!isset($notp)){
			$platform = $ts->clientInfo($clid)['data']['client_platform'];
			if($platform == "Windows"){
				$ts->serverGroupAddClient($cfgcp['windows_group'], $dbid);
			}else{
				if($platform == "Linux"){
					$ts->serverGroupAddClient($cfgcp['linux_group'], $dbid);
				}else{
					if($platform == "iOS"){
						$ts->serverGroupAddClient($cfgcp['ios_group'], $dbid);
					}else{
						if($platform == "macOS"){
							$ts->serverGroupAddClient($cfgcp['macos_group'], $dbid);
						}else{
							if($platform == "Android"){
								$ts->serverGroupAddClient($cfgcp['android_group'], $dbid);
							}
						}
					}
				}
			}
		}
	}
	$cfgbp = $config[1]['onServerJoin']['joinFunctions']['blockPlatform'];
	if($cfgbp['enabled']){
		foreach($cfgbp['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $clid, $ignored, $clients)){
				$notbp = 1;
			}
		}
		$platform = $ts->clientInfo($clid)['data']['client_platform'];
		if(!isset($notbp)){
			foreach($cfgbp['platform'] as $block){
				if($platform == $block){
					$ts->clientKick($clid, 'server', $cfgbp['kickMessage']);
				}
			}
		}
	}
	$cfgpb = $config[1]['onServerJoin']['joinFunctions']['proxyBlocker'];
	if($cfgpb['enabled']){
		foreach($cfgpb['ignoredGroups'] as $ignored){
			if($core->checkIfIn($ts, $clid, $ignored, $clients)){
				$notip = 1;
			}
		}
		foreach($cfgpb['ignoredIps'] as $igip){
			if($ts->clientInfo($clid)['data']['connection_client_ip'] == $igip){
				$notip = 1;
			}
		}
		if(!isset($notip)){
			
			$check = json_decode(file_get_contents("https://proxycheck.io/v2/".$clip."?vpn=1&asn=1"), true);
			if($check[$clip]['proxy'] == 'yes'){
				$message = str_replace("[CONT]", $check[$clip]['continent'], $cfgpb['kickMessage']);
				$ts->clientKick($clid, 'server', $message);
				if($cfgpb['iptables']){
					exec('iptables -A INPUT -s '.$clip.' -j DROP');
				}
			}
		}
	}
	
}
?>
















