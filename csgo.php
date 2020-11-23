<?php


function csgoStats(){
	
	global $core, $cs, $config, $pdo, $ts, $footer;
	
	
	
	
	$request = $pdo->prepare("SELECT * FROM csgoStats");
	$request->execute();
	$date = $request->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($date as $dat){
		
		$steamid = $dat['steamid'];
		$kills = $dat['kills'];
		$played = $dat['playedtime'];
		$dbid = $dat['client_database_id'];
		
		$nkills = $cs->getKills($steamid);
		$nplayed = $cs->getTimePlayed($steamid);
		
		$request = $pdo->prepare("UPDATE csgoStats SET kills=:kills WHERE client_database_id=:dbid");
		$request->execute([':kills' => $nkills, ':dbid' => $dbid]);
		$request = $pdo->prepare("UPDATE csgoStats SET playedtime=:nplayed WHERE client_database_id=:dbid");
		$request->execute([':nplayed' => $nplayed, ':dbid' => $dbid]);
		
	}
	
	$top = $config[4]['functions']['csgoStats']['top_desc'];
	
	$kills = $pdo->query("SELECT * FROM csgoStats ORDER BY kills DESC LIMIT 10");
	$kills= $kills->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	
	foreach($kills as $once){
		$dbid = $once['client_database_id'];
		$kills = $once['kills'];
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $config[4]['functions']['csgoStats']['user'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[KILLS]", $kills, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	$ts->channelEdit($config[4]['functions']['csgoStats']['channel_id'], ['channel_description' => $top.$user.$footer]);
	
	$top = $config[4]['functions']['csgoStats']['top_desc_times'];
	
	$kills = $pdo->query("SELECT * FROM csgoStats ORDER BY playedtime DESC LIMIT 10");
	$kills= $kills->fetchAll(PDO::FETCH_ASSOC);
	$i = 0;
	$user = "";
	
	foreach($kills as $once){
		$dbid = $once['client_database_id'];
		$kills = $once['playedtime']/60 . " godzin";
		$nick = $ts->clientDbInfo($dbid)['data']['client_nickname'];
		$lastseen = gmdate("H:i/d.m.Y", $ts->clientDbInfo($dbid)['data']['client_lastconnected']);
		$uniqueid = $ts->clientDbInfo($dbid)['data']['client_unique_identifier'];
		$i++;
		$user .= $config[4]['functions']['csgoStats']['user_time'];
		$user = str_replace("[I]", $i, $user);
		$user = str_replace("[NICK]", $nick, $user);
		$user = str_replace("[TIME]", $kills, $user);
		$user = str_replace("[LAST]", $lastseen, $user);
	}
	
	$ts->channelEdit($config[4]['functions']['csgoStats']['channel_id2'], ['channel_description' => $top.$user.$footer]);
		
		
	
}


?>