<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: changeServerName.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
	function changeServerName()
	{
		global $ts, $config, $p, $core, $server_info;
		
		$online = $core->getOnline($ts, $config);
		$maxclients = $server_info['virtualserver_maxclients'];
		$uptime = $core->uptime($ts);
		$percent = round($online/$maxclients*100);
		$allfromdb = floor($core->statsInfo($ts));
		$name = $config[1]['functions']['changeServerName']['serverName'];
		
		$name = str_replace(["[ONLINE]", "[MAX]", "[UPTIME]", "[PERCENT]", "[ALLCL]"], [$online, $maxclients, $uptime, $percent, $allfromdb], $name);
		
		$ts->serverEdit(['virtualserver_name' => $name]);
		
	}
?>