<?php

function registerCSGO($clid, $message){
	
	global $ts, $core, $pdo, $cs;
	
	if(strpos($message, '!') === 0){
		$message = str_replace(" ", "/", $message);
		$strArray = explode('/',$message);
		if($strArray[0] == '!csgo'){
			if(isset($strArray[1])){
				$newName = $strArray[1];
			}
		}
		
		
		if(isset($newName)){
			
			if(!strpos($newName, 'http') !== FALSE){
			
				if($cs->test($newName)){
					
					$ts->sendMessage(1, $clid, "[b]Poprawny kod![/b]");
					$request = $pdo->prepare("SELECT * FROM csgoStats where client_database_id=:dbid");
					$request->execute([':dbid' => $core->getDBID($ts, $clid)]);
					$data = $request->fetch(PDO::FETCH_ASSOC);
					
					
					if(!$data['id']){
						$r = $pdo->prepare("INSERT INTO csgoStats (`steamid`, `kills`, `playedtime`, `client_database_id`) VALUES (:steamid, :kills, :played, :dbid)");
						$r->execute([':steamid' => $newName, ':kills' => $cs->getKills($newName), ':played' => $cs->getTimePlayed($newName), ':dbid' => $core->getDBID($ts,$clid)]);
					}else{
						$ts->sendMessage(1, $clid, "[b]ERROR: [/b] Powtórzony wpis w bazie!");
					}
					
				}else{
					
					$ts->sendMessage(1, $clid, "[b]Podałeś niepoprawny SteamID! Spróbuj ponownie![/b]");
				}
			}else{
				$ts->sendMessage(1, $clid, "[b]Musisz podać swój SteamID w formacie kodu![/b]");
			}
			
		}else{
			$ts->sendMessage(1, $clid, "[b]Poprawne użycie: !csgo <steamId>[/b]");
		}
	}
}
		
		