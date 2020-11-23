<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: revokeGroup.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function revokeGroup(){
	
	global $ts, $core, $config, $clients, $pdo;
	$cfg = $config[3]['functions']['revokeGroup'];
	$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -uid"));
	
	$data = $pdo->query("Select * FROM guildCreator");
	if($data->rowCount() > 0){
		$result = $data->fetchAll(PDO::FETCH_ASSOC);
		$data = $result;
	}
	
	foreach($data as $strefa){
		foreach($clients as $client){
			if($client['cid'] == $strefa['revoke']){
				$ts->serverGroupDeleteClient( $strefa['group'], $client['client_database_id']);
				$ts->clientKick($client['clid'], 'channel', "Ranga została zabrana!");
				$ts->clientPoke($client['clid'], "Ranga została zabrana!");
				$allcids = explode(", ", $strefa['allcid']);
				foreach($allcids as $cid){
					if($client['client_database_id'] != $strefa['leaderdbid']){
						$ts->channelGroupAddClient($cfg['defaultChannelGroup'], $cid, $client['client_database_id']);
					}
				}
			}
		}
	}
	
}