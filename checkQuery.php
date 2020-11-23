<?php 
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: checkQuery.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function checkQuery(){
	
	global $ts, $telegram, $config, $core, $server_info, $clients;
	
	$cfg = $config['1']['functions']['checkQuery'];
	
	if($cfg['enabled']){
		
		$token = $cfg['telegram_api'];
		$chatid = $cfg['chat_id'];
		
		$count = 0;
		$query = 0;
		$admins = [315];
		
		$query = $server_info['virtualserver_queryclientsonline'];
		
		if($query >= $cfg['query_count']){
				//
		}else{
			$core->sendTelegram($chatid, "<b>============================</b>", $token);
			$core->sendTelegram($chatid, "<i>Godzina: ".date('H:i')."</i>"."\n\n<b>KLIENCI QUERY:</b>", $token);
			foreach($clients as $client){
				if($client['client_type'] == 1){
					$core->sendTelegram($chatid, "<code>".$client['client_nickname']."</code>", $token);
					}
				}
			$core->sendTelegram($chatid, "<b>UWAGA! </b> Wygląda na to, że któryś z klientów query jest <b>OFFLINE</b>!", $token);
			foreach($clients as $client){
				if(checkAdminGroup($client['client_database_id'], $admins)){
					$ts->sendMessage(1, $client['clid'], "Któryś z klientów QUERY jest offline!");
				}
			}
		}
	}
}