<?php

function banList(){
	
	global $ts, $config, $core, $footer;
	
	$cfg = $config[1]['functions']['banList'];
	
	$bans = $ts->banList()['data'];
	$simpleban = "";
	
	foreach($bans as $ban){
		
		if($ban['ip']){
			$simpleban .= "Użytkownik: [b]" . $ban['lastnickname'] . "[/b]\nPowód: [b]" . $ban['reason'] . "[/b]\nUtworzono: [b]" . gmdate("d.m.Y", $ban['created']) . "[/b]\nPrzez: [b]" . $ban['invokername'] . "[/b]\nCzas trwania: [b]" . $core->convertTime($ban['duration']) . "[/b]\n";
		}	
	}
	
	$ts->channelEdit($cfg['channel_id'], ['channel_description' => $cfg['top_desc'].$simpleban.$footer]);
}
	
	