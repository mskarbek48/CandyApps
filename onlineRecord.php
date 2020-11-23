<?php
function onlineRecord(){
	global $ts, $config, $pdo;
	$request = $pdo->prepare("SELECT * FROM data WHERE name=:name");
	$request->execute([':name' => "onlineRecord"]);
	$data = $request->fetch(PDO::FETCH_ASSOC);
	$record = $data['data'];
	$chname = str_replace("[count]", $record, $config[1]['functions']['onlineRecord']['channel_name']);
	$ts->channelEdit($config[1]['functions']['onlineRecord']['channel_id'], ['channel_name' => $chname]);
}