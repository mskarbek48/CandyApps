<?php
//error_reporting(0);
function adminList(){
	
	global $config, $ts, $core, $pdo;
	$cfg = $config[1]['functions']['adminList'];
	$nick = "";
	$descGroup = "";
	$desc2 = "";
	
	foreach($config[1]['adminsGroups'] as $group){
	
		if($core->getClientsCountGroup($ts, $group)	!= 0){
			$descGroup = $core->getName($ts, $group);
		}
		foreach($ts->serverGroupClientList($group, true)['data'] as $admin){
			if(isset($admin['cldbid'])){
				$data = $pdo->prepare("SELECT * FROM saveUsers WHERE client_database_id=:dbid");
				$data->execute([':dbid' => $admin['cldbid']]);
				$data = $data->fetch(PDO::FETCH_ASSOC);
				if($data){
					$nick = $data['client_nickname'];
					$alltimes = $data['allTimes'];
					$descgroups[$descGroup][] = array($data['client_database_id'], $alltimes, $nick, $data['client_lastconnected'], $data['client_servergroups'], $data['connections'], $data['connections']);
					}
				}
			}
		}
	foreach($descgroups as $key => $groups){
		$desc = "Ranga: ".$key."\n";
		$desc2= "";
		foreach($groups as $admin){
			$desc2 .= "Admin: " . $admin[2] . "\n";
		}
		$final++;
		$final .= $desc.$desc2;
	}
	
	
	$ts->channelEdit($cfg['channel_id'], ['channel_description' => $final]);
}