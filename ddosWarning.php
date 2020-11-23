<?php

function ddosWarning(){
	
	global $ts, $config, $server_info, $clients, $core;
	
	$packets = floor($server_info['virtualserver_total_packetloss_total']);
	
	$cfg = $config[5]['functions']['ddosWarning'];
	
	if($packets >= $cfg['max_packets']){
		$core->sendTelegram($cfg['chat_id'], $cfg['message'], $cfg['telegram_api']);
	}
	
	
	if($cfg['mode'] == 1){
		if($packets >= $cfg['max_packets']){
			$ts->sendMessage(3, 1, $cfg['message']);
		}
	}else{
		if($packets >= $cfg['max_packets']){
			foreach($clients as $client){
				foreach($cfg['groups'] as $group){
					if($core->checkIfIn($ts, $client['clid'], $group, $clients)){
						$ts->sendMessage(1, $client['clid'], $cfg['message']);
					}
				}
			}
		}
	}
}