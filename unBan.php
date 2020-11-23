<?php 
function unbanCMD($clid, $message){
	
	global $ts, $config, $core, $clients, $pdo;
	
	
	if(strpos($message, '!') === 0){
		$bans = $ts->banList()['data'];
		$message = str_replace(" ", "/", $message);
		$strArray = explode('/',$message);
		if($strArray[0] == '!unban'){
			if(isset($strArray[1])){
				$banid = $strArray[1];
			}
			
		foreach($config[5]['onChat']['unbanCMD']['allowgroups'] as $group){
			if($core->checkIfIn($ts, $clid, $group, $clients)){
				$hasgroup = 1;
			}
		}
	
	
		if(isset($hasgroup) && $hasgroup == 1){
			if(isset($banid)){
				foreach($bans as $ban){
					if($ban['banid'] == $banid){
						$yes = 1;
						if(isset($ban['banid'])){
							$id = $banid;
						}else{
							$id = 0;
						}if(isset($ban['ip'])){
							$ip = $ban['ip'];
						}else{
							$ip = 0;
						}if(isset($ban['lastnick'])){
							$lastnick = $ban['lastnick'];
						}else{
							$lastnick = 0;
						}if(isset($ban['created'])){
							$created = $ban['created'];
						}else{
							$created = 0;
						}if(isset($ban['duration'])){
							if($ban['duration'] !== 0){
								$duration = $ban['duration'];
							}else{
								$duration = 0;
							}
						}else{
							$duration = 'unknown';
						}if(isset($ban['invokername'])){
							$invname = $ban['invokername'];
						}else{
							$invname = 'unknown';
						}if(isset($ban['reason'])){
							$reason = $ban['reason'];
						}else{
							$reason = 0;
						}
						
						if(isset($ban['name'])){
							$name = $ban['name'];
						}else{
							$name = 0;
						}
						
						if(isset($ban['uid'])){
							$uid = $ban['uid'];
						}else{
							$uid = 0;
						}
						if(isset($ban['mytsid'])){
							$id2 = $ban['mytsid'];
						}else{
							$id2 = 0;
						}
						
						$unbanUser = $core->getNick($ts, $core->getDBID($ts, $clid));
						$unbanTime = date('d.m.Y');
						$dbid = $core->getDBID($ts, $clid);
						$unban = $ts->banDelete($banid);
						
						if($unban['success']){
							$request = $pdo->prepare("INSERT INTO unBanlog (`banid`, `name`, `ip`, `lastnickname`, `created`, `duration`, `invokername`, `reason`, `unbanUser`, `unbanTime`, `unbandbID`, `uid`, `mytsid`) VALUES (:id, :name, :ip, :lastnick, :created, :duration, :invname, :reason, :unbanUser, :unbanTime, :dbid, :uid, :id2)");
							$request->execute([':id' => $id, ':name' => $name, ':ip' => $ip, ':lastnick' => $lastnick, ':created' => $created, ':duration' => $duration, ':invname' => $invname, ':reason' => $reason, ':unbanUser' => $unbanUser, ':unbanTime' => $unbanTime, ':dbid' => $dbid, ':uid' => $uid, ':id2' => $id2]);
							$ts->sendMessage(1, $clid, "Osoba o nicku: [b]".$ban['lastnickname']."[/b] została odblokowana. Jej były powód bana to: [b]".$ban['reason']."[/b] jego autorem był: [b]".$ban['invokername'].".[/b] Ten indydent został zapisany w bazie danych :)");
							if($ban['invokerid'] !== $core->getDBID($ts, $clid)){
								$ts->sendMessage(1, $clid, "[b][color=#B8510D]Odbanowałeś osobę, której nie byłeś autorem. Pamiętaj że jeśli robisz to bez zgody banującego możesz otrzymać konsekwencje.[/color][/b]");
							}
						}else{
							print_r($unban['errors'][0]);
							$ts->sendMessage(1, $clid, $unban['errors'][0]);
						}
						}
					}
					if(!isset($yes)){
						$ts->sendMessage(1, $clid, "Nie ma takiego bana przyjacielu :(");
					}
			
				}
			}
		}
	}
}