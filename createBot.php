<?php

function createBot($clid, $message){
	
	global $ts, $clients, $config, $core;
	
	$cfg = $config[5]['onChat']['createBot'];
	
	if(strpos($message, '!') === 0){
		$message = str_replace(" ", "/", $message);
		$strArray = explode('/',$message);
		if($strArray[0] == '!construct'){
			if(isset($strArray[1])){
				$args = $strArray;
			}
		}
		
		foreach($config[5]['onChat']['createBot']['allowgroups'] as $group){
			if($core->checkIfIn($ts, $clid, $group, $clients)){
				$hasgroup = 1;
			}
		}
		
		if(isset($hasgroup) && $hasgroup == 1){
			$botip = 'tscuksy.pl';
			$botcid = $args[2];
			$botcount = $args[3];
			$i = 1;
			
			if(!isset($botcount)){
				$ts->sendMessage(1, $clid, "Poprawne użycie: !construct <nazwa gildii>, <główny kanał gildii>, <ilość botów>");
			}
			foreach($clients as $client){
				if($client['cid'] == $cfg['bots_channel']){
					$botname = 'Guild | '.$args[1].' #'.$i;
					$ts->sendMessage(1, $client['clid'], "!bot name \"".$botname."\"");
					usleep(50000);
					$ts->sendMessage(1, $client['clid'], "!setting set connect.name ".$botname);
					usleep(10000);
					$ts->sendMessage(1, $client['clid'], "!setting set connect.channel \"/".$botcid."\"");
					usleep(10000);
					$ts->clientMove($client['clid'], $botcid);
					$ts->sendMessage(1, $clid, "Bot: ".$botname." created.");
					
					$i++;
				}
				if($i > $botcount){
					break;
				}
			}
		}else{
			$ts->sendMessage(1, $clid, "Nie masz permisji!");
		}
	}
}