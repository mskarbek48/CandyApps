<?php
function randomName(){
	global $ts, $config, $core;
	$cfg = $config[1]['functions']['randomName'];
	
	$name = array_rand($cfg['names']);
	
	$ts->channelEdit($cfg['channel_id'], ['channel_name' => $cfg['names'][$name]['name'], 'channel_description' => $cfg['names'][$name]['desc']]);
}