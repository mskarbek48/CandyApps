<?php

function renderPeople(){
	
	global $ts, $core, $pdo, $config, $footer;
	
	$cid = $config[2]['functions']['renderPeople']['channel_id'];
	$desc = '';
	$request = $pdo->prepare("SELECT * FROM userCity");
	$request->execute();
	$return = $request->fetchAll(PDO::FETCH_ASSOC);
	
	$top = '[hr][center][size=15][b]Stalking List[/b][/size][/center][hr]\n';
	
	foreach($return as $once){
		$desc .= "› Nick: [b]".$once['client_nickname']."[/b]\n      Miasto: [b]".$once['client_city']."[/b]\n      Województwo: [b]".$once['client_region']."[/b]\n\n";
	}
	
	$ts->channelEdit($cid, ['channel_description' => $top.$desc.$footer]);
}