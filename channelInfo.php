<?php
function channelInfo(){
	
	global $ts, $pdo, $core, $config, $clients;
	
	foreach($clients as $client){
		if($client['cid'] == $config[1]['functions']['channelInfo']['channel_id']){
			$info = $ts->clientInfo($client['clid'])['data'];
			$platform = $info['client_unique_identifier'];
			$version = $info['client_version'];
			$firstcon = gmdate("H:i/d.m.Y", $info['client_created']);
			$totalcon = $info['client_totalconnections'];
			$talkp = $info['client_talk_power'];
			
			$gbupload = $core->bconv($info['client_total_bytes_uploaded'], 'M');
			$gbdownloaded = $core->bconv($info['client_total_bytes_downloaded'], 'M');
			$clientip = $info['connection_client_ip'];
			$request = $pdo->prepare("SELECT * FROM levels WHERE client_database_id=:dbid");
			$request->execute([':dbid' => $core->getDBID($ts, $client['clid'])]);
			$level = $request->fetch(PDO::FETCH_ASSOC)['level'];
			
			$msg = $config[1]['functions']['channelInfo']['messages'];
			$ts->clientKick($client['clid'], 'channel');
			foreach($msg as $message){
				
				$message = str_replace("[PLATFORM]", $platform, $message);
				$message = str_replace("[VERSION]", $version, $message);
				$message = str_replace("[FIRSTCON]", $firstcon, $message);
				$message = str_replace("[TOTALCON]", $totalcon, $message);
				$message = str_replace("[TALKPOWER]", $talkp, $message);
				$message = str_replace("[GBUPLOAD]", $gbupload, $message);
				$message = str_replace("[GBDOWNLOAD]", $gbdownloaded, $message);
				$message = str_replace("[CLIENTIP]", $clientip, $message);
				$message = str_replace("[LEVEL]", $level, $message);
				
				$ts->sendMessage(1, $client['clid'], $message);
			}
			
		}
	}
}