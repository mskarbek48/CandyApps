<?php
function checkNumbersGuild(){
	
	global $ts, $core, $pdo, $config, $footer;
	
	$name = $config[3]['functions']['checkNumbersGuild']['channel_name'];
	
	$test = $pdo->query("Select * FROM guildCreator");
	if($test->rowCount() > 0){
		$result = $test->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}else{
		return false;
	}
	
	if(isset($data)){
		$count = count($data) + 1;
	}else{
		$count = 1;
	}
	
	foreach($data as $guild){
		$channels[$guild['type']][] = $guild['counter'];
	}
	
	foreach($channels as $guilds){
		foreach($guilds as $number => $cid){
			$num = $number + 1;
			foreach($data as $guild){
				if($guild['counter'] == $cid){
					$tag = $guild['name'];
					$type = $guild['type'];
					$leader = $ts->clientDbInfo($guild['leaderdbid'])['data']['client_nickname'];
					$date = $guild['date'];
				}
			}
			
			$desc = $config[3]['functions']['checkNumbersGuild']['desc'];
			
			$desc = str_replace("[TYPE]", $type, $desc);
			$desc = str_replace("[NAME]", $tag, $desc);
			$desc = str_replace("[LEADER]", $leader, $desc);
			$desc = str_replace("[DATE]", $date, $desc);
			
			$chname = str_replace("[NUMBER]", $num, $name);
			$chname = str_replace("[NAME]", $tag, $chname);
			$chname = str_replace("[TYPE]", $type, $chname);
			$ts->channelEdit($cid, ['channel_name' => $chname, 'channel_description' => $desc.$footer]);
		}
	}
	
	
}