<?php

class core {
	
	public $logs;
	public $socket;

		
	
	public function getLatestLog(){
		global $ts, $config, $core, $clients;
		if($this->logs !== $ts->logView(1)['data'][0]['l']){
			$this->logs = $ts->logView(1)['data'][0]['l'];
			return $this->logs = $ts->logView(1)['data'][0]['l'];
		}
		
	}
	
	public function renderAdmin($dbid){
		
	global $core, $ts, $config, $footer,$pdo;
	if($config[1]['functions']['adminsStatus']['enabled']){
		$cfg = $config[1]['functions']['adminsStatus'];
			foreach($cfg['admins'] as $admin){
				if($admin['dbid'] == $dbid){
					$data = $ts->clientDbInfo($dbid)['data'];
					if(isset($data['client_unique_identifier'])){
						$request = $pdo->prepare("SELECT * FROM addedGroups WHERE client_database_id=".$dbid);
						$request->execute();
						$changedGr = $request->fetch(PDO::FETCH_ASSOC);
						$spentTimer = $pdo->prepare("SELECT * FROM topSpentTime WHERE client_database_id=".$dbid);
						$spentTimer->execute();
						$spentTime = $spentTimer->fetch(PDO::FETCH_ASSOC);
						$desc = $cfg['top_desc'];
						$id = "[URL=client://1/".$data['client_unique_identifier']."]".$data['client_nickname']."[/url]";
						$desc = str_replace("[GROUP]", $core->getName($ts, $admin['group']), $desc);
						$desc = str_replace("[NICK]", $id, $desc);
						$desc = str_replace("[DBID]", $data['client_database_id'], $desc);
						$desc = str_replace("[UQID]", $data['client_unique_identifier'], $desc);
						$desc = str_replace("[CONNECTIONS]", $data['client_totalconnections'], $desc);
						$desc = str_replace("[FIRSTCONNECT]", gmdate("d.m.Y", $data['client_created']), $desc);
						$desc = str_replace("[DESC]", $data['client_description'], $desc);
						if(isset($changedGr['added'])){
							$desc = str_replace("[ADDGR]", $changedGr['added'], $desc);
						}else{
							$desc = str_replace("[ADDGR]", '0', $desc);
						}
						if(isset($changedGr['removed'])){
							$desc = str_replace("[DELGR]", $changedGr['removed'], $desc);
						}else{
							$desc = str_replace("[DELGR]", '0', $desc);
						}
						if(isset($spentTime['spentTime'])){
							$desc = str_replace("[SPENT]", $ts->convertSecondsToStrTime($spentTime['spentTime']), $desc);
						}
						return $desc.$footer;	
					}
				}
			}
		}
	}
	
	public function bconv($bytes, $to, $decimal_places = 1) {
		$formulas = array(
			'K' => number_format($bytes / 1024, $decimal_places),
			'M' => number_format($bytes / 1048576, $decimal_places),
			'G' => number_format($bytes / 1073741824, $decimal_places)
		);
		return isset($formulas[$to]) ? $formulas[$to] : 0;
	}
		
		
	
	public function getOnline($ts, $config){
		
		global $clients;
		$count = 0;
		foreach($clients as $client){
			if($client['client_type'] == 0){
				foreach($config['ignoredGroup'] as $ignored){
					$clgroups = explode(',', $client['client_servergroups']);
					if(!in_array($ignored, $clgroups)){
						$count++;
					}
				}
			}
		}return $count;
	}	
			
	
	public function getName($ts, $sgid) {
		
		global $groups;
		
		foreach($groups as $key => $group){
			if(isset($sgid)){
				if($group['sgid'] == $sgid){
					return $group['name'];
					break;
				}
			}
		}
	}
	
	public function getNick($ts, $dbid) {
		global $clients;
			foreach($clients as $client){
				if($client['client_database_id'] == $dbid){
					return $client['client_nickname'];
					break;
			}
		}
	}

	
	public function getAdminList($ts, $config){
		
		foreach($config['1']['adminsGroups'] as $group){
			$admins = $ts->serverGroupClientList($group, true)['data'];
			if(isset($admins)){
				foreach($admins as $admin){
					if(!empty($admin)){
						if(isset($admin['cldbid'])){
							$adminList[$group][] = $admin['cldbid'];
						}
					}
				}
			}
		}return $adminList;
	}
	
	public function getAdminList2($ts, $list){
		
		foreach($list as $group){
			$admins = $ts->serverGroupClientList($group, true)['data'];
			foreach($admins as $admin){
				if(!empty($admin)){
					if(isset($admin['cldbid'])){
						$adminList1[] = $admin['cldbid'];
					}
				}
			}
		}
		return $adminList1;
	}
	
	public function getList($ts, $group){
		
		$users = $ts->serverGroupClientList($group, true)['data'];
		foreach($users as $user){
			if(!empty($user)){
				if(isset($user['cldbid'])){
					$usersList[] = $user['cldbid'];
				}
			}
		}return $usersList;
	}
	
	public function getClientsCountGroup($ts, $sgid) {
		
        $count = $ts->serverGroupClientList($sgid)['data'];
        if (empty($count[0]['cldbid'])) {
            return 0;
        } else {
            return count($count);
        }
    }
	public function sendTelegram($chatID, $messaggio, $token) {

		$url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID . "&parse_mode=html";
		$url = $url . "&text=" . urlencode($messaggio);
		$ch = curl_init();
		$optArray = array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $optArray);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	
	public function checkIsInGroup($ts, $dbid, $ranks){
		
		global $clients;
		
		foreach($clients as $client){
			if($client['client_database_id']!=1&&$client['client_database_id']==$dbid){
				$client_groups=explode(",",$client['client_servergroups']);
				foreach($client_groups as $client_group){
					if(in_array($client_group, $ranks)){
						return true;
					}else{
						return false;
					}
				}
			
			}
		}
	}
	public function checkIfIn($ts, $clid, $group, $clients){
		
		$groups = explode(",", $ts->clientInfo($clid)['data']['client_servergroups']);
		
		//foreach($groups as $clgr){
			if(in_array($group, $groups)){
				return true;
			}else{
				return false;
			}
		//}
	}
	public function getDBID($ts, $clid){
		global $clients;
		foreach($clients as $client){
			if($client['clid'] == $clid){
				return $client['client_database_id'];
			}
		}
	}
	
	public function getCity($pdo, $dbid){
		
		$request = $pdo->prepare("SELECT client_city FROM userCity WHERE client_database_id=:dbid");
		$request->execute([':dbid' => $dbid]);
		
		return $request->fetch(PDO::FETCH_ASSOC)['client_city'];
	}
	
	public function getOnlineCountFromGroup($ts, $group){
		
		global $clients;
		$count = 0;
		
		foreach($clients as $client){
			$client_groups=explode(",",$client['client_servergroups']);
			if(in_array($group, $client_groups)){
				$count++;
			}
		}return $count;
		
	}
	
	public function getClid($ts, $dbid){
		
		global $clients;
		
		foreach($clients as $client){
			if($client['client_database_id'] == $dbid){
				return $client['clid'];
			}
		}
	}
	public function getIdle($ts, $dbid){
		
		global $clients;
	
		foreach($clients as $client){
			if($client['client_database_id'] == $dbid){
				return $client['client_idle_time'];
			}
		}
	}
	
	public function getChannelCout($ts, $id){
		
		global $clients;
		$count = 0;
		foreach($clients as $client){
			if($client['cid'] == $id){
				$count++;
			}
		}
		return($count);
	}
	public function getChannelName($ts, $cid){
		
		$channels = $ts->channelList()['data'];
		foreach($channels as $channel){
			if($channel['cid'] == $cid){
				return $channel['channel_name'];
			}
		}
	}
	public function getId($ts, $clid){
		
		global $clients;
		
		foreach($clients as $client){
			if($client['clid'] == $clid){
				return "[URL=client://".$client['clid']."/".$client['client_unique_identifier']."]".$client['client_nickname']."[/url]";
			}
		}
	}
	
	public function checkWhoIsInChannel($ts, $channel){
		
		global $clients;
		
		foreach($clients as $client){
			if($client['cid'] == $channel){
				return $client['clid'];
			}
		}
	}
	public function checkStatus($ts, $dbid){
		
		global $clients;
		
		foreach($clients as $client){
			
			if($client['client_database_id'] == $dbid){
				if($client['client_output_muted']){
					return true;
				}
				if($client['client_away']){
					return true;
				}
			}
		}
	}
	public function getConnections($ts){
		
		$db = $ts->clientDbList();
		$all = 0;
		foreach($db['data'] as $client){
			$connections = $client['client_totalconnections'];
			$all = $all + $connections;
		}
		return $all;
	}
	
	public function clientsCountFromIp($ts, $dbid){
		
		global $clients;
		$count = 0;
		
		foreach($clients as $client){
			if($client['client_database_id'] == $dbid){
				$ip = $client['connection_client_ip'];
				break;
			}
		}
		
		foreach($clients as $client){
			if($client['connection_client_ip'] == $ip){
				$count++;
			}
		}
		
		return $count;
	}
	
	public function checkOnline($ts, $dbid){
		global $clients;
		$online = 0;
		foreach($clients as $client){
			if($client['client_database_id'] == $dbid){
				$online = 1;
			}
		}return $online;
	}
	public function statsInfo($ts){
	
		$db = $ts->clientDbList()['data'];
		return count($db);
	}
		
	
	public function replaceWelcomeMessage($ts, $clid, $message){
		
		$client = $ts->clientInfo($clid)['data'];
		$serverInfo = $ts->getElement('data', $ts->serverInfo());
		
		$date = new DateTime(gmdate("Y-m-d H:i:s", $client['client_created']));
		$datenow = new DateTime();
		
		if($date->diff($datenow)->format("%y") == 0){
			$clientfirst = $date->diff($datenow)->format("%m miesięcy, %d dni, %h godzin i %i minut");
			if($date->diff($datenow)->format("%m") == 0){
				$clientfirst = $date->diff($datenow)->format("%d dni, %h godzin i %i minut");
				if($date->diff($datenow)->format("%d") == 0){
					$clientfirst = $date->diff($datenow)->format("%h godzin i %i minut");
				}
			}
		}else{
			$clientfirst = $date->diff($datenow)->format("%y lat, %m miesięcy, %d dni, %h godzin i %i minut");
		}
		
		//print_r(self::getInfoFromSQL($clid));
		
		$editMessage = [
			"[SERVER_NAME]" => $serverInfo['virtualserver_name'],
			"[SERVER_HOST_MESSAGE]" => $serverInfo['virtualserver_hostmessage'],
			"[SERVER_WELCOME_MESSAGE]" => $serverInfo['virtualserver_welcomemessage'],
			
			"[SERVER_UPTIME]" => self::uptime($ts),
			"[SERVER_MAX_CLIENTS]" => $serverInfo['virtualserver_maxclients'],
			
			"[SERVER_VERSION]" => $serverInfo['virtualserver_version'],	
			"[SERVER_PLATFORM]" => $serverInfo['virtualserver_platform'],	
			
			"[SERVER_PACKET]" => $serverInfo['virtualserver_total_packetloss_total'],
			"[SERVER_PING_TOTAL]" => $serverInfo['virtualserver_total_ping'],
			
			"[CLIENT_NAME]" => $client['client_nickname'],
			"[CLIENT_CREATED]"	=> gmdate("d.m.Y", $client['client_created']),
			"[CLIENT_CREATED_DAYS]" => $clientfirst,
			"[CLIENT_IDENTIFIER]" => $client['client_unique_identifier'],
			"[CLIENT_DATABASE_ID]" => $client['client_database_id'],
			"[CLIENT_CONNECTIONS]" => $client['client_totalconnections'],
			"[CLIENT_LAST_CONNECT]" => date('d.m.Y H:i:s', $client['client_lastconnected']),
			"[CLIENT_COUNTRY]" => $client['client_country'],
			//"[CLIENT_LEVEL]" => self::getInfoFromSQL($clid)['level'],
			//"[CLIENT_SPENTTIME]" => $ts->convertSecondsToStrTime(self::getInfoFromSQL($clid)['spentTime']),
			
		];
		return @str_replace(array_keys($editMessage), array_values($editMessage), $message); 
	}
	
	public function getInfoFromSQL($clid){
		global $pdo, $ts;
		
		$request = $pdo->prepare("SELECT * FROM levels WHERE client_database_id=:dbid");
		$request->execute([':dbid' => self::getDBID($ts, $clid)]);
		
		@$level = $request->fetch(PDO::FETCH_ASSOC)['level'];
		
		$request = $pdo->prepare("SELECT * FROM topSpentTime WHERE client_database_id=:dbid");
		$request->execute([':dbid' => self::getDBID($ts, $clid)]);
		
		@$spentTime = $request->fetch(PDO::FETCH_ASSOC)['spentTime'];
		
		if(isset($spentTime)){
			$info = [
				'spentTime' => $spentTime,
				'level' => $level,
				];
		}
		
		if(isset($info)){
			return $info;
		}else{
			return false;
		}
	}
		
		
		
	
	public function uptime($ts){
		
		$server_info = $ts->getElement('data', $ts->serverInfo());
		$seconds = $server_info['virtualserver_uptime'];
		$minutes = $server_info['virtualserver_uptime'] / 60;
		$hours = $server_info['virtualserver_uptime'] / 3600;
		$days = $hours / 24;
		if($days >= 1){
			$uptime = floor($days);
			$next = $hours - 24*$uptime;
			$uptime = floor($days)." dni, ".floor($next)." godz.";
		}else{
			if($hours >= 1) {
				$uptime = floor($hours);
				$next = $minutes - 60*$uptime;
				$uptime = floor($hours)." godz. ".floor($next)."min.";
			}else{
				if($minutes >= 1) {
					$uptime = floor($minutes)." min.";
				}else{
					$uptime = floor($seconds)." sec.";
				}
			}
		}
		return $uptime;
	}
	
	public function convertTime($time){
		
		$seconds = $time;
		$minutes = $seconds / 60;
		$hours = $minutes/ 60;
		$days = $hours / 24;
		if($days >= 1){
			$uptime = floor($days);
			$next = $hours - 24*$uptime;
			$uptime = floor($days)." dni";
		}else{
			if($hours >= 1) {
				$uptime = floor($hours);
				$next = $minutes - 60*$uptime;
				$uptime = floor($hours)." godz. ".floor($next)."min.";
			}else{
				if($minutes >= 1) {
					$uptime = floor($minutes)." min.";
				}else{
					$uptime = floor($seconds)." sec.";
				}
			}
		}
		return $uptime;
	}
	
	public function checkPorn($image_path, $config){
		
		$ch = curl_init();

		$mime = "image/png";

		$cfile = curl_file_create($image_path,$mime);
		$data = array('file_image' => $cfile,
				'API_KEY' => $config['onServerJoin']['checkPorn']['api_key'],
				'task' => 'porn_moderation,gore_moderation',
				 'origin_id' => "xxxxxx",
				 'reference_id' => "yyyyyy"

		);

		curl_setopt($ch, CURLOPT_URL,'https://www.picpurify.com/analyse/1.1');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
		curl_setopt($ch,CURLOPT_SAFE_UPLOAD,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		$output = curl_exec($ch);

		return json_decode($output, true);
	}
		

	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
}
		