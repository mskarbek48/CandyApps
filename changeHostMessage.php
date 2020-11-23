e<?php
function changeHostMessage(){
	
	global $ts, $core, $config, $server_info;
	
	$online = $core->getOnline($ts, $config);
	$maxclients = $server_info['virtualserver_maxclients'];
	$uptime = $core->uptime($ts);
	$percent = round($online/$maxclients*100);
	$spenttime = floor($core->statsInfo($ts)/3600);
	
	$msg = $config[1]['functions']['changeHostMessage']['message'];
	
	$msg = str_replace(["[ONLINE]", "[MAXCLIENTS]", "[UPTIME]", "[PERCENT]", "[ALLCL]"], [$online, $maxclients, $uptime, $percent, $allfromdb], $msg);
	
	$ts->serverEdit(['virtualserver_hostmessage' => $msg]);
}