<?php
function meetingCMD($clid, $message){
	global $ts, $core, $config, $pdo, $clients;
	
	if($message=='!meeting'){
		
		$request = $pdo->query("SELECT * FROM guildCreator");
		$data = $request->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $guild){
			if($guild['leaderdbid'] == $core->getDBID($ts, $clid)){
				$hasGuild = 1;
				$guildGroup = $guild['group'];
				$lobbyChannel = $guild['channelmain'];
			}
		}
		if(isset($hasGuild)){
			$ts->sendMessage(1, $clid, "Przenoszę wszystkich użytkowników na konferencje.");
			foreach($clients as $client){
				if($core->checkIfIn($ts, $client['clid'], $guildGroup, $clients)){
					$ts->clientMove($client['clid'], $lobbyChannel);
					$ts->sendMessage(1, $client['clid'], "Zostałeś przeniesiony na konferencję przez [b]lidera[/b] gildii.");
				}
			}
		}else{
			$ts->sendMessage(1, $clid, "Nie posiadasz gildii.");
		}
	}
}