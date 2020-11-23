<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: onlineFromGuild.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function onlineFromGuild(){
	
	global $ts, $core, $config, $clients, $pdo, $footer;
	$cfg = $config[3]['functions']['onlineFromGuild'];
	$top = $cfg['top_desc'];
	
	$data = $pdo->query("Select * FROM guildCreator");
	if($data->rowCount() > 0){
		$result = $data->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}
	
	foreach($data as $strefa){
		$group = $strefa['group'];
		$channelid = $strefa['online'];
		$online = $core->getOnlineCountFromGroup($ts, $group);
		$all = $core->getClientsCountGroup($ts, $group);
		$offline = $all - $online;
		$users = $core->getList($ts, $group);
		$type = $strefa['type'];
		$name = $strefa['name'];
		$desc = "";
		foreach($users as  $key => $user){
			foreach($clients as $client){
				if($client['client_database_id'] == $user){
					$desc .= "› [size=10][b]" . $core->getId($ts, $client['clid']) . " [/b]jest [b][color=#009C4E]Online[/color][/b] na kanale: [b][URL=channelid://".$client['cid']."]" . $core->getChannelName($ts, $client['cid']) . "[/URL][/b][/size]\n";
					unset($users[$key]);
				}
			}
		}
		
		foreach($users as $user){
			$info = $ts->clientDbInfo($user)['data'];
			$desc .= "› [size=10][b]".$info['client_nickname']."[/b] jest [color=#DE0B0B][b]Offline[/b][/color] od [b](".gmdate("H:i/d.m.Y", $info['client_lastconnected']).")[/b][/size]\n";
		}
		
			
		
		$now = $ts->channelInfo($channelid)['data']['channel_name'];
		
		$top = str_replace("[TYPE]", $type, $top);
		$top = str_replace("[NAME]", $name, $top);
		
		$chname = str_replace("[ONLINE]", $online, $cfg['channel_name']);
		$chname = str_replace("[MAX]", $all, $chname);
		$chname = str_replace("[NAME]", $strefa['name'], $chname);
		
		if($now != $chname){
			$ts->channelEdit($channelid, array('channel_name' => $chname));
			$ts->channelEdit($channelid, array('channel_description' => $top.$desc.$footer));
		}
	}
}
		