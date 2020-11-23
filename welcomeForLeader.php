<?php
function welcomeForLeader($clid, $dbid, $clip){
	
	global $ts, $core, $pdo, $config;
	
	$cfg = $config[3]['onServerJoin']['welcomeForLeader'];
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times -voice"));
	
	$test = $pdo->query("Select * FROM guildCreator");
	if($test->rowCount() > 0){
		$result = $test->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}
	
	
	foreach($data as $guild){
		if($guild['leaderdbid'] == $core->getDBID($ts, $clid)){
			foreach($cfg['messages'] as $msg){
				$ts->sendMessage(1, $clid, $msg);
			}
		}
	}
}