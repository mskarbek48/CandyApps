<?php

function helpRanks(){
	
	global $ts, $core, $pdo, $config, $clients;
	
	$kills = $pdo->query("SELECT * FROM helpCount ORDER BY count DESC LIMIT 1");
	$kills= $kills->fetch(PDO::FETCH_ASSOC);
	
	$clid = $core->getClid($ts, $kills['client_database_id']);
	$group = $config[4]['functions']['helpRanks']['rank'];
	
	$list = $core->getList($ts, $group);
	
	foreach($list as $dbid){
		if($dbid !== $kills['client_database_id']){
			$ts->serverGroupDeleteClient($group, $dbid);
			$ts->sendMessage(1, $core->getClid($ts, $dbid), "Przykro nam, straciłeś osiągnięcie: [b]".$core->getName($ts, $config[4]['functions']['helpRanks']['rank'])."![/b]");
		}
	}
	
	if(!$core->checkIfIn($ts, $clid, $config[4]['functions']['helpRanks']['rank'], $clients)){
	
		$ts->sendMessage(1, $clid, "Gratulacje, zdobyłeś nowe osiągnięcie: [b]".$core->getName($ts, $config[4]['functions']['helpRanks']['rank'])."![/b]");
		$ts->serverGroupAddClient($config[4]['functions']['helpRanks']['rank'], $kills['client_database_id']);	
	}
	
}