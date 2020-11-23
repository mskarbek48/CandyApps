<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: assignGroup.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function assignGroup(){
	
	global $ts, $core, $config, $clients, $pdo;
	$cfg = $config[3]['functions']['assignGroup'];
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times"));
	$data = $pdo->query("Select * FROM guildCreator");
	if($data->rowCount() > 0){
		$result = $data->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}
	
	foreach($data as $strefa){
		foreach($clients as $client){
			if($client['cid'] == $strefa['assign']){
				$ts->serverGroupAddClient( $strefa['group'], $client['client_database_id']);
				$ts->clientMove($client['clid'], $strefa['channelmain']);
				$ts->clientPoke($client['clid'], "Ranga została nadana!");
				$allcids = explode(", ", $strefa['allcid']);
				foreach($allcids as $cid){
					if($client['client_channel_group_id'] == $cfg['defaultChannelGroup']){
						$ts->channelGroupAddClient($cfg['verifedChannelGroup'], $cid, $client['client_database_id']);
					}
				}
			}
		}
	}
	
}