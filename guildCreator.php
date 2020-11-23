<?php				
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: guildCreator.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function guildCreator(){

	global $ts, $core, $config, $clients, $pdo, $ab;
	$cfg = $config[3]['functions']['guildCreator'];
	
	$test = $pdo->query("Select * FROM guildCreator");
	if($test->rowCount() > 0){
		$result = $test->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}
	
	if($cfg['mode'] == 1){
		$wait = 0;
	}else{
		if($cfg['mode'] == 2){
			$wait = 10000;
		}else{
			if($cfg['mode'] == 3){
				$wait = 100000;
			}else{
				if($cfg['mode'] == 4){
					$wait = 300000;
				}else{
					if($cfg['mode'] == 5){
						$wait = 600000;
					}
				}
			}
		}
	}
	
	
	$all = $cfg['allSectors'];
	foreach($all as $guildChannel){
			
		$last = $pdo->query("SELECT lastChannel FROM guildCreator WHERE type='".$guildChannel['name']."' ORDER BY id DESC LIMIT 1");
		
		$last = $last->fetch(PDO::FETCH_ASSOC);
		
		
		if($last){ 
			$lastChannel  = $last['lastChannel']; 
			}else{
				$lastChannel = $guildChannel['channelFirst'];
			}

		if(isset($data)){
			$count = count($data) + 1;
		}else{
			$count = 1;
		}


	
		
		if(isset($data)){
			foreach($data as $guild){
				if(!$guild['lastChannel']){
					$lastChannel = $guildChannel['lastChannel'];
				}
				if($guild['lobby']){
					if($info = $ts->channelInfo($guild['lobby'])){
						if($info['errors']){
							$allcid = explode(', ', $guild['allcid']);
							foreach($allcid as $todel){
								usleep($wait);
								$ts->channelDelete($todel);
								foreach($data as $key => $value){
									if(in_array($guild['allcid'], $value)){
										$ts->serverGroupDelete($guild['group'], 1);
										$pdo->exec("DELETE FROM `guildCreator` WHERE lobby='".$guild['lobby']."'");
									}
								}
							}
						}
					}
				}
			}
		}			
			
		$type = $guildChannel['name'];
		$id = $guildChannel['channelId'];
		foreach($clients as $client){
			if($client['cid'] == $id){
				$clid = $client['clid'];
				$guildName = $ts->clientInfo($client['clid'])['data'];
				$guildName = $guildName['client_description'];
				if(isset($data)){
					foreach($data as $names){
						if($names['name'] == $guildName){
							$ts->clientKick($client['clid'], 'channel', "Gildia z taką nazwą już istnieje!");
							return false;
						}
					}
				}
				if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $guildName)){
						$ts->clientKick($client['clid'], 'channel', "Nazwa gildii zawiera niedozwolone znaki!");
						return false;
				}
				if(!$guildName){
						$ts->clientKick($client['clid'], 'channel', "Nazwa gildii jest za krótka!");
						return false;				
				}
				if(strlen($guildName) <= 5){
					foreach($guildChannel['channels'] as $gc){
						usleep($wait);
						if(isset($gc['channel_first'])){
							$gc['channelName'] = str_replace("[ONLINE]", '0', $gc['channelName']);
							$gc['channelName'] = str_replace("[MAX]", '0', $gc['channelName']);
							$gc['channelName'] = str_replace("[NUMBER]", $count, $gc['channelName']);
							$gc['channelName'] = str_replace("[NAME]", $guildName, $gc['channelName']);
							$lobby = $ts->channelCreate(
							[
							'channel_name' => $gc['channelName'],
							'channel_flag_permanent' => 1,
							'channel_order' => $lastChannel,
							'CHANNEL_MAXCLIENTS' => $gc['maxClients'],
							'channel_flag_maxclients_unlimited'=> $gc['maxClients'],
							'channel_flag_maxfamilyclients_unlimited'=> $gc['maxClients'],
							'channel_flag_maxfamilyclients_inherited'=> $gc['maxClients'],
							]
							);
							$cidlobby = $lobby['data']['cid'];
							if(isset($lobby['data']['cid'])){
								$lastChannel = $lobby['data']['cid'];
							}
							if(!$lobby['success']){
								$ts->clientKick($client['clid'], 'channel', "Wystąpił błąd");
							}
						}else{
						$gc['channelName'] = str_replace("[ONLINE]", '0', $gc['channelName']);
						$gc['channelName'] = str_replace("[MAX]", '0', $gc['channelName']);
						$gc['channelName'] = str_replace("[NUMBER]", $count, $gc['channelName']);
						$gc['channelName'] = str_replace("[NAME]", $guildName, $gc['channelName']);
							$channel = $ts->channelCreate(
							[
							'channel_name' => $gc['channelName'],
							'channel_flag_permanent' => 1,
							'channel_order' => $lastChannel,
							'CHANNEL_MAXCLIENTS' => $gc['maxClients'],
							'channel_flag_maxclients_unlimited'=> $gc['maxClients'],
							'channel_flag_maxfamilyclients_unlimited'=> $gc['maxClients'],
							'channel_flag_maxfamilyclients_inherited'=> $gc['maxClients'],
							]);
							if(isset($gc['channel_is_last'])){
								$lastChannel = $channel['data']['cid'];
							}
							if(isset($gc['channel_main'])){
								$channelmain = $channel['data']['cid'];
							}
							if(isset($gc['channel_online'])){
								$channelonline = $channel['data']['cid'];
							}
							if(isset($gc['channel_counter'])){
								$channelcounter = $channel['data']['cid'];
							}
							if(isset($gc['channel_stats'])){
								$channelstats = $channel['data']['cid'];
							}
							$test = $ts->channelAddPerm($channel['data']['cid'], [140 => $gc['neededJoinPower']]);
							$channels[] = $channel['data']['cid'];
							if(isset($gc['channels_control'])){
								$assign = $ts->channelCreate([
									'channel_name' => $cfg['assign_name'],
									'channel_flag_permanent' => 1,
									'CHANNEL_MAXCLIENTS' => 0,
									'channel_flag_maxclients_unlimited'=> 0,
									'channel_flag_maxfamilyclients_unlimited'=> 0,
									'channel_flag_maxfamilyclients_inherited'=> 0,
									'cpid' => $channel['data']['cid'],	]);
								usleep($wait);
								$revoke = $ts->channelCreate([
									'channel_name' => $cfg['revoke_name'],
									'channel_flag_permanent' => 1,
									'CHANNEL_MAXCLIENTS' => 0,
									'channel_flag_maxclients_unlimited'=> 0,
									'channel_flag_maxfamilyclients_unlimited'=> 0,
									'channel_flag_maxfamilyclients_inherited'=> 0,
									'cpid' => $channel['data']['cid'],	]);
								usleep($wait);
								$teleport = $ts->channelCreate([
									'channel_name' => $cfg['teleport_name'],
									'channel_flag_permanent' => 1,
									'CHANNEL_MAXCLIENTS' => 0,
									'channel_flag_maxclients_unlimited'=> 0,
									'channel_flag_maxfamilyclients_unlimited'=> 0,
									'channel_flag_maxfamilyclients_inherited'=> 0,
									'cpid' => $channel['data']['cid'],	]);
							}							
							if($gc['subChannels'] >= 0){
							for ($i = 1; $i <= $gc['subChannels']; $i++) {
								usleep($wait);
								$subchannel = $ts->channelCreate([
									  'channel_name' => str_replace('[num]', $i, "[num]".$gc['subChannelName']),
									  'channel_flag_permanent' => 1,
									  'cpid' => $channel['data']['cid'],
									]);
									$ts->channelAddPerm($subchannel['data']['cid'], [140 => $gc['neededJoinPower']]);
									$channels[] = $subchannel['data']['cid'];
								}
							}
						$lastChannel = $channel['data']['cid'];
						//$ts->channelAddPerm($channel['data']['cid'], [NEEDED_JOIN_POWER => $gc['neededJoinPower'], NEEDED_JOIN_POWER => $gc['neededSubscribePower']]);
						}
					
					}
					
					$ggroup = $ts->serverGroupCopy($cfg['groupToCopy'], 0, $guildName, 1);
					$request = $pdo->prepare("INSERT INTO `guildCreator` (`type`, `name`, `assign`, `revoke`, `lobby`, `allcid`, `lastChannel`, `group`, `channelmain`, `leaderdbid`, `online`, `counter`, `date`, `stats`, `teleport`) VALUES (:type, :name, :assign, :revoke, :lobby, :allcid, :lastch, :group, :main, :ldbid, :online, :counter, :date, :statscid, :teleport)");
					$request->execute([':type' => $guildChannel['name'],  ':name' => $guildName, ':assign' => $assign['data']['cid'], ':revoke' => $revoke['data']['cid'], ':lobby' => $cidlobby, ':allcid' => implode(", ", $channels), ':lastch' => $lastChannel, ':group' => $ggroup['data']['sgid'], ':main' => $channelmain, ':ldbid' => $client['client_database_id'], ':online' => $channelonline, ':counter' => $channelcounter, ':date' => date("d.m.Y"), ':statscid' => $channelstats, ':teleport' => $teleport['data']['cid']]);
					foreach($channels as $cids){
						$ts->channelGroupAddClient($cfg['leaderChannelGroup'], $cids, $client['client_database_id']);
					}						
					$ts->clientMove($client['clid'], $assign['data']['cid']);	
					for($i = 1; $i <= $guildChannel['musicBots']; $i++){
						foreach($clients as $client){
							if($client['cid'] == $cfg['musicbotcid']){
								$ts->clientMove($client['cid'], $cidlobby);
								$ts->sendMessage(1, $client['clid'], '!bot name Guild | '.$guildName.' #'.$i);
								usleep($wait);
								$ts->sendMessage(1, $client['clid'], '!setting set connect.channel "/'.$channelmain.'"');
								usleep($wait);
								$ts->sendMessage(1, $client['clid'], '!setting set connect.name "Guild | '.$guildName.' #'.$i.'"');
								$ts->clientMove($client['clid'], $channelmain);
								break;
								$done = 1;
							}							
						}
					}	
				}else{
					$ts->clientKick($client['clid'], 'channel', "Twoja nazwa gildii jest za długa!");
				}
			}
		}
	}
}
?>