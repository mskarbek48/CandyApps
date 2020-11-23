<?php
function connections(){
	global $ts, $core, $config;
	
	$cfg = $config[1]['functions']['connections'];
	
	$chname = str_replace("[count]", $core->getConnections($ts), $cfg['channel_name']);
	
	$ts->channelEdit($cfg['channel_id'], ['channel_name' => $chname]);
}