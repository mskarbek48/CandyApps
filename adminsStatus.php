<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: adminsStatus.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function adminsStatus(){
	
	global $ts, $core, $config;
	
	$cfg = $config[1]['functions']['adminsStatus'];
	foreach($cfg['admins'] as $admin){
		$groupname = $core->getName($ts, $admin['group']);
		$dbid = $admin['dbid'];
		$nick = $core->getNick($ts, $admin['dbid']);
		if($core->checkOnline($ts, $admin['dbid'])){
			$clid = $core->getClid($ts,$admin['dbid']);
			if($ts->clientInfo($clid)['data']['client_output_muted']){
				$chname = str_replace(["[GROUP]","[STATUS]","[NICK]"], [$groupname, $cfg['afk'], $nick], $cfg['channel_name']);
			}else{
				$chname = str_replace(["[GROUP]","[STATUS]","[NICK]"], [$groupname, $cfg['online'],  $nick], $cfg['channel_name']);
			}
		}else{
			$chname = str_replace(["[GROUP]","[STATUS]","[NICK]"], [$groupname, $cfg['offline'], $ts->clientDbInfo($admin['dbid'])['data']['client_nickname']], $cfg['channel_name']);
		
		}
		$ts->channelEdit($admin['channel_id'], ['channel_name' => $chname, 'channel_description' => $core->renderAdmin($dbid)]);
		
		unset($chname);
		
	//	if($ts->channelInfo($admin['channel_id'])['data']['channel_name'] !== $chname){
			
				
				
	//	}
	

	}
}


				
		