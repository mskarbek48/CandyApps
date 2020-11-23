<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: adminsOnline.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function adminsOnline(){
	
	global $ts, $config, $footer, $clients, $core;
	$cfg = $config[1]['functions']['adminsOnline'];
	$adminscount = 0;
	$all = 0;
	$desc = "";
	$top_desc = $cfg['top_desc'];
	$admin = "";
	$rank_desc = "";
	$admins = 0;
	
	
	foreach($cfg['adminsGroups'] as $adminGroup){
		$adminscount = $adminscount + $core->getClientsCountGroup($ts, $adminGroup);
		$all = $all + $core->getOnlineCountFromGroup($ts, $adminGroup);
		foreach($clients as $client){
			if($core->checkIfIn($ts, $client['clid'], $adminGroup, $clients)){
				$group = $core->getName($ts, $adminGroup);
				$admin .= "[size=11]\n› " . $core->getId($ts, $client['clid']) . "\n[/size][size=9]    › Kanał: [b][URL=channelId://" . $client['cid'] . "]" . $core->getChannelName($ts, $client['cid']) . "[/b]\n    › Grupa: [b] [" . $group . "][/b]\n[/size]";
				$admins++;
			}
			
			$desc = $admin;
		}
		
	}
	
	$chname = str_replace("[online]", $admins, $cfg['channel_name']);
	$chname = str_replace("[all]", $adminscount, $chname);
	
	$ts->channelEdit($cfg['channel_id'], ['channel_description' => $top_desc.$desc.$footer, 'channel_name' => $chname]);
	
	
	
}
?>	