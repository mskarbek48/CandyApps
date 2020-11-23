<?php
function guildStats(){
	
	global $ts, $core, $pdo, $footer, $config;
	
	$test = $pdo->query("Select * FROM guildCreator");
	if($test->rowCount() > 0){
		$result = $test->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}
	
	$all = 0;
	$allcon = 0;
	
	foreach($data as $guild){
		$name = $guild['name'];
		$type = $guild['type'];
		$users = $core->getList($ts, $guild['group']);
		
		foreach($users as $user){
			$request = $pdo->prepare("SELECT * FROM saveUsers WHERE client_database_id=:dbid");
			$request->execute([':dbid' => $user]);
			$stats[$user] = $request->fetchAll(PDO::FETCH_ASSOC);
		}
		foreach($stats as $gstats){
			$all = $gstats[0]['allTimes'] + $all;
			$allcon = $gstats[0]['connections'] + $allcon;
		}
		$guildSpentTime = $ts->convertSecondsToStrTime($all);
		$guildConnection = $allcon;
		
		$desc = $config[3]['functions']['guildStats']['desc'];
		$desc = str_replace("[NAME]", $guild['name'], $desc);
		$desc = str_replace("[TYPE]", $guild['type'], $desc);
		$desc = str_replace("[SPENT]", $guildSpentTime, $desc);
		$desc = str_replace("[CONNECTIONS]", $guildConnection, $desc);
		
		$ts->channelEdit($guild['stats'], ['channel_description' => $desc.$footer]);
	}
}
		