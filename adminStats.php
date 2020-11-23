<?php

function adminStats(){
	
	global $config, $pdo, $core, $ts, $footer;
	
	$cfg = $config[4]['functions']['adminStats'];
	
	$top = $cfg['top_desc'];
	
	$connections = $pdo->query("SELECT * FROM addedGroups ORDER BY added DESC LIMIT 10");
	$con= $connections->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	
	foreach($con as $once){
		$dbid = $once['client_database_id'];
		$cons = $once['added'];
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $cfg['user'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[ADDED]", $cons, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	$ts->channelEdit($cfg['channel_id'], ['channel_description' => $top.$user.$footer]);
}
	
	?>