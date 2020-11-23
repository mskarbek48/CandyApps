<?php

function checkPrivateNumber(){
	
	global $ts, $core, $config;
	
	$channels = $ts->channelList()['data'];
	$maincid = $config[1]['onMove']['privateChannel']['main_cid'];
	$cfg = $config[1]['functions']['checkPrivateNumber'];
	
	foreach($channels as $channel){
		if($channel['pid'] == $maincid){
			$all[] = $channel;
			
		}
	}
	foreach($all as $num => $data){
		$number = $num + 1;
		$cid = $data['cid'];
		$chname = $data['channel_name'];
		
		$ch = explode(".", $chname, 2);

		if($ch[0] != $number){
			$ts->channelEdit($cid, ['channel_name' => $number.".".$ch[1]]);
		}
	}
		
		
}
	
	