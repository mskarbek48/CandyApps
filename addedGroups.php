<?php
function addedGroups(){
	
	global $ts, $core, $pdo, $config;
	
	$logs = $ts->logView(10);
	foreach($logs['data'] as $key => $log){
		if(strpos($log['l'], 'was added to servergroup') !== false){
			preg_match_all('/\(([^\)]*)\)/', $log['l'], $matches);
			$date = explode("|", $log['l'], 2)[0];
			$result = array();
			foreach ($matches[1] as $match)
			{
				$match = explode('id:', $match);
				$result[] = $match;
			}
			$res['dbid'] = $result[0][1];
			$res['groupid'] = $result[1][1];
			$res['dbid'] = $result[2][1];
			$res['date'] = $date;
			
			$request = $pdo->prepare("SELECT * FROM addedGroups WHERE client_database_id=".$res['dbid']);
			$request->execute();
			
			$data = $request->fetch(PDO::FETCH_ASSOC);
			
			if(!$data['Id']){
				$request = $pdo->prepare("INSERT INTO addedGroups (`client_database_id`, `added`, `lastDate`, `removed`) VALUES (".$res['dbid'].", 1, 1, 1)");
				$request->execute();
			}else{
				$count = $data['added'];
				$newcount = $count + 1;
				if($data['lastDate'] !== $res['date']){
					$request = $pdo->prepare("UPDATE addedGroups SET lastDate='".$res['date']."' WHERE client_database_id=".$res['dbid']);
					$request->execute();
					$request = $pdo->prepare("UPDATE addedGroups SET added=".$newcount." WHERE client_database_id=".$res['dbid']);
					$request->execute();
				}
			}
			
		}
	}
	
	foreach($logs['data'] as $key => $log){
		if(strpos($log['l'], 'was removed from servergroup') !== false){
			preg_match_all('/\(([^\)]*)\)/', $log['l'], $matches);
			$date = explode("|", $log['l'], 2)[0];
			$result = array();
			foreach ($matches[1] as $match)
			{
				$match = explode('id:', $match);
				$result[] = $match;
			}
			$res['dbid'] = $result[0][1];
			$res['groupid'] = $result[1][1];
			$res['dbid'] = $result[2][1];
			$res['date'] = $date;
			
			$request = $pdo->prepare("SELECT * FROM addedGroups WHERE client_database_id=".$res['dbid']);
			$request->execute();
			
			$data = $request->fetch(PDO::FETCH_ASSOC);
			
			if(!$data['Id']){
				$request = $pdo->prepare("INSERT INTO addedGroups (`client_database_id`, `removed`, `lastDate`, `added`) VALUES (".$res['dbid'].", 1, 1, 1)");
				$request->execute();
			}else{
				$count = $data['removed'];
				$newcount = $count + 1;
				if($data['lastDate'] !== $res['date']){
					$request = $pdo->prepare("UPDATE addedGroups SET lastDate='".$res['date']."' WHERE client_database_id=".$res['dbid']);
					$request->execute();
					$request = $pdo->prepare("UPDATE addedGroups SET removed=".$newcount." WHERE client_database_id=".$res['dbid']);
					$request->execute();
				}
			}	
		}
	}
	
	
}