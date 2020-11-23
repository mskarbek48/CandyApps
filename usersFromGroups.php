<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: usersFromGroup.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function usersFromGroups(){
	
	global $ts, $config, $footer, $clients, $core, $footer;
	$cfg = $config[1]['functions']['usersFromGroups'];
	
	foreach($cfg['channels'] as $channel){
		$group = $channel['group'];
		$name = $channel['name'];
		$top_desc = $channel['top_desc'];
		
		$online = $core->getOnlineCountFromGroup($ts, $group);
		$all = $core->getClientsCountGroup($ts, $group);
		$nameg = $core->getName($ts, $group);
		
		
		
		$chtop_desc = str_replace(["[ONLINE]", $online], ["[ALL]", $all], $top_desc);
		foreach($clients as $client){
			$group = array($channel['group']);
			if($core->checkIsInGroup($ts, $client['client_database_id'], $group)){
				$desc .= "› [size=10][b]" . $core->getId($ts, $client['clid']) . "[/b][/size]\n[size=10]     › Kanał: [b]" . $core->getChannelName($ts, $client['cid']) . "[/b][/size]\n\n";
			}
		}
		
		
		$chtop_desc = str_replace("[GROUP]", $nameg, $top_desc);
		$chname = str_replace("[MAX]", $all, $name);
		$chname = str_replace("[ONLINE]", $online, $chname);
		$ts->channelEdit($channel['id'], array('channel_description' => $chtop_desc.$desc.$footer));
		$ts->channelEdit($channel['id'], array('channel_name' => $chname));
	}
}
?>	