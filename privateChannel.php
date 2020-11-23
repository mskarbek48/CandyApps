<?php
function privateChannel(){
	
	global $ts, $core, $config, $footer;
	
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times"));
	$channels = $ts->channelList()['data'];
	
	$cfg = $config[1]['functions']['privateChannel'];
	
	$count = 0;
	
	$date = date("d.m.Y");
	
	if($cfg['upDateOnJoin']){
		foreach($channels as $pvch){
			if($pvch['pid'] == $cfg['main_cid']){
				$chg = $ts->channelGroupClientList($pvch['cid']);
				foreach($clients as $client){
					if($client['client_database_id'] == $chg['data'][0]['cldbid']){
						if($ts->channelInfo($chg['data'][0]['cid'])['data']['channel_topic'] != $date){
							$ts->channelEdit($chg['data'][0]['cid'], ['channel_topic' => $date]);
						}
					}
				}
			}
		}
	}
			
	
	
	foreach($clients as $client){
		if($client['cid'] == $cfg['get_cid']){
			
			
			foreach($channels as $pvch){
				if($pvch['pid'] == $cfg['main_cid']){
					$count++;
					$chg = $ts->channelGroupClientList($pvch['cid']);
					if(isset($chg)){
						foreach($chg['data'] as $ch){
							if($ch['cldbid'] == $client['client_database_id'] && $ch['cgid'] == $cfg['leaderchgroup']){
								$ts->sendMessage(1, $client['clid'], $cfg['hasChannelMessage']);
								$ts->clientMove($client['clid'], $ch['cid']);
								return false;
							}
						}
					}
				}
			}
			if(!isset($count)){
				$count = 1;
			}
			if($count == 0){
				$count = 1;
			}else{
				$count = $count + 1;
			}
			$passwd = rand(9999, 99999);
			$date = date("d.m.Y");
			
			$desc = str_replace("[NICK]", $client['client_nickname'], $cfg['desc']);
			$desc2 = str_replace("[NICK]", $client['client_nickname'], $cfg['descsubchannel']);
			
			if($client['client_type'] == 0 && $client['client_database_id'] != 1){
				$private = $ts->channelCreate(
				[
				'channel_name' => $count.". ".$client['client_nickname']." - prywatny kanał",
				'channel_flag_permanent' => 1,
				'cpid' => $cfg['main_cid'],
				'channel_description' => $desc.$footer,
				'channel_password' => $passwd,
				'channel_topic' => $date,
				]);
				for ($i = 1; $i <= $cfg['subchannels']; $i++) {
					$ts->channelCreate([
						  'channel_name' => str_replace('[num]', $i, "[num] Podkanał"),
						  'channel_flag_permanent' => 1,
						  'channel_password' => $passwd,
						  'channel_description' => $desc2.$footer,
						  'cpid' => $private['data']['cid'],
						]);
				}
			}
			$message = str_replace("[PASS]", $passwd, $cfg['message']);
			$ts->sendMessage(1, $client['clid'], $message);
			$ts->setClientChannelGroup($cfg['leaderchgroup'], $private['data']['cid'], $client['client_database_id']);
			$ts->clientMove($client['clid'], $private['data']['cid']);
		}
	}
}