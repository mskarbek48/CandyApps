<?php
function renderDesc(){
	
	global $ts, $core, $config, $pdo, $footer;
	
	$cfg = $config[4]['functions']['renderDesc'];
	
	
	$top = $cfg['topConnections']['top_desc'];
	
	$connections = $pdo->query("SELECT * FROM topConnections ORDER BY Connections DESC LIMIT 10");
	$con= $connections->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	
	foreach($con as $once){
		$dbid = $once['client_database_id'];
		$cons = $once['Connections'];
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $cfg['topConnections']['user'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[CONS]", $cons, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	$ts->channelEdit($cfg['topConnections']['channel_id'], ['channel_description' => $top.$user.$footer]);
	
	
	
	$spenttime = $pdo->query("SELECT * FROM topSpentTime ORDER BY spentTime DESC LIMIT 10");
	$spent = $spenttime->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	$top = $cfg['topSpentTime']['top_desc'];
	foreach($spent as $once){
		$dbid = $once['client_database_id'];
		$time = $ts->convertSecondsToStrTime($once['spentTime']);
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $cfg['topSpentTime']['user'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[TIME]", $time, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	$ts->channelEdit($cfg['topSpentTime']['channel_id'], ['channel_description' => $top.$user.$footer]);
	
	
	$ctime = $pdo->query("SELECT * FROM topConnectionTime ORDER BY connectionTime DESC LIMIT 10");
	$ntime = $ctime->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	$top = $cfg['topConnectionTime']['top_desc'];
	foreach($ntime as $once){
		$dbid = $once['client_database_id'];
		$time = $ts->convertSecondsToStrTime($once['connectionTime']);
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $cfg['topConnectionTime']['user'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[TIME]", $time, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	$ts->channelEdit($cfg['topConnectionTime']['channel_id'], ['channel_description' => $top.$user.$footer]);
	
	
	
	$top = $cfg['topLevel']['top_desc'];
	
	$connections = $pdo->query("SELECT * FROM levels ORDER BY level DESC LIMIT 10");
	$con= $connections->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	
	foreach($con as $once){
		$dbid = $once['client_database_id'];
		$cons = $once['level'];
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $cfg['topLevel']['user'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[LVL]", $cons, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	$ts->channelEdit($cfg['topLevel']['channel_id'], ['channel_description' => $top.$user.$footer]);
	
	
	$top = $cfg['topSendedBytes']['top_desc'];
	
	$connections = $pdo->query("SELECT * FROM topSendedBytes ORDER BY sendedBytes DESC LIMIT 10");
	$con= $connections->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	
	foreach($con as $once){
		$dbid = $once['client_database_id'];
		$cons = $once['sendedBytes'];
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $cfg['topSendedBytes']['user'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[B]", $cons, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	$ts->channelEdit($cfg['topSendedBytes']['channel_id'], ['channel_description' => $top.$user.$footer]);
	
}