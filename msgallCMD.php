<?php
function msgallCMD($clid, $message){
	
	global $ts, $core, $config, $pdo, $clients;
	
	if(strpos($message, '!') === 0){
		$message = str_replace(" ", "/", $message);
		$strArray = explode('/',$message);
		if($strArray[0] == '!msgall'){
			if(isset($strArray[1])){
				$newName = $strArray[1];
			}
		
			$request = $pdo->query("SELECT * FROM guildCreator");
			$data = $request->fetchAll(PDO::FETCH_ASSOC);
			foreach($data as $guild){
				if($guild['leaderdbid'] == $core->getDBID($ts, $clid)){
					$hasGuild = 1;
					$guildGroup = $guild['group'];
				}
			}
			if(isset($hasGuild)){
				$ts->sendMessage(1, $clid, "Wysłałem wszystkim wiadomość!");
				foreach($clients as $client){
					if($core->checkIfIn($ts, $client['clid'], $guildGroup, $clients)){
						$ts->sendMessage(1, $client['clid'], $newName);
					}
				}
			}else{
				$ts->sendMessage(1, $clid, "Nie posiadasz gildii.");
			}
		}
	}
}