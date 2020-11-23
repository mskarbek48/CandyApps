<?php
function countryList(){
	
	global $ts, $core, $config, $footer, $clients;
	
	$cfg = $config[1]['functions']['countryList'];
	$count = 0;
	$desc = "";
	
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times"));
	
	foreach($clients as $client){
		if($client['client_type'] == 0){
			foreach($cfg['ignoredGroups'] as $ignored){
				if($core->checkIfIn($ts, $client['clid'], $ignored, $clients)){
					$bypass= 1;
				}
			}	
			foreach($cfg['ignoredIps'] as $igip){
				if($ts->clientInfo($client['clid'])['data']['connection_client_ip'] == $igip){
					$bypass= 1;
				}
			}
			
			if(!isset($bypass)){
				if($cfg['ignored_country'] != $ts->clientInfo($client['clid'])['data']['client_country']){
					$desc .= "[b][color=#FF7105]✖[/color][/b]Nick: " . $core->getId($ts, $client['clid']) . "\n[b][color=#FF7105]✖[/color][/b]Kraj: "  . $ts->clientInfo($client['clid'])['data']['client_country'] . "\n[b][color=#FF7105]✖[/color][/b]Kanał: [URL=channelid://" . $client['cid'] . "] " . $core->getChannelName($ts, $client['cid']) . "[/URL]\n \n\n";
					$count++;
				}
			}
		}
	}
	$chname = str_replace("[COUNT]", $count, $cfg['channel_name']);
	$ts->channelEdit($cfg['channel_id'], ['channel_name' => $chname, 'channel_description' => $cfg['top_desc'].$desc.$footer]);
}