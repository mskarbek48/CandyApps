<?php

function deletePrivateChannels(){
	
	global $ts, $core, $config;
	
	$channels = $ts->channelList()['data'];
	$after = $config[1]['functions']['deletePrivateChannels']['afterDays'];
	$maincid = $config[1]['onMove']['privateChannel']['main_cid'];
	$alert = $config[1]['functions']['deletePrivateChannels']['alert'];
	$frazes = $config[1]['functions']['deletePrivateChannels']['frazes'];
	
	foreach($channels as $channel){
		if($channel['pid'] == $maincid){
			$info = $ts->channelInfo($channel['cid'])['data']['channel_topic'];
			$name = $ts->channelInfo($channel['cid'])['data']['channel_name'];
			
			foreach($frazes as $fraze){
				if(strpos($name, $fraze) !== false){
					$ts->channelDelete($channel['cid']);
				}
			}
			
			$date = new DateTime(date("d.m.Y"));
			$olddate = new DateTime($info);
			
			$difference = $date->diff($olddate);
			
			if($difference->d > $after){
				$ts->channelDelete($channel['cid']);
			}
			if($difference->d > $alert){
				$info = $ts->channelInfo($channel['cid'])['data']['channel_name'];
				$newname = substr($info,0,25);
				$chname = $newname."[DATA]";
				if(!strpos($info, "[DATA]")){
					$ts->channelEdit($channel['cid'], ['channel_name' => $chname]);
				}
			}
		}
	}
}