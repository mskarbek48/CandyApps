<?php
function renameCMD($clid, $message){
	
	global $ts, $core, $config, $pdo;
	
	if(strpos($message, '!') === 0){
		$message = str_replace(" ", "/", $message);
		$strArray = explode('/',$message);
		if($strArray[0] == '!rename'){
			if(isset($strArray[1])){
				$newName = $strArray[1];
				$request = $pdo->query("SELECT * FROM guildCreator");
				$data = $request->fetchAll(PDO::FETCH_ASSOC);
				foreach($data as $guild){
					if($guild['leaderdbid'] == $core->getDBID($ts, $clid)){
						$hasGuild = 1;
						$editGuild = $guild['name'];
						$editGuildGroup = $guild['group'];
					}
				}
			if(isset($editGuild)){
				$change = $ts->serverGroupRename($editGuildGroup, $newName);
				if($change['success']){
					$ts->sendMessage(1, $clid, "Nazwa grupy została zmieniona(Nazwa gildii nie uległa zmianie)");
				}else{
					$ts->sendMessage(1, $clid, "Taka nazwa gildii już istnieje!");
				}
			}else{
				$ts->sendMessage(1, $clid, "Brak uprawnień/brak gildii");
			}
				
			}else{
				$ts->sendMessage(1, $clid, "Podaj tag gildii!");
			}
		}
	}
	
}
	
	