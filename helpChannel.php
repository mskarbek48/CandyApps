<?php
/*
	Candy - Aplikacja pod twój serwer TeamSpeak
			
	Author: Lukieer

*/
function helpChannel(){
	global $ts, $config, $p, $footer;
	
	$cfg = $config['1']['functions']['helpChannel'];
	
	$openTime = explode(":", $cfg['openTime']);
	$closeTime = explode(":", $cfg['closeTime']);
	$openTimenow = mktime($openTime[0], $openTime[1], 0, date('m'), date('d'), date('Y'));
	$closeTimenow = mktime($closeTime[0], $closeTime[1], 0, date('m'), date('d'), date('Y'));
	
	$channel = array();

	if(time()>=$openTimenow && time()<$closeTimenow)
		{
			$channel['channel_name'] = $cfg['channel_name_open'];
			$channel['channel_flag_maxclients_unlimited'] = 1;
			$channel['channel_maxclients'] = '-1';
		}
		else
		{
			$channel['channel_name'] = $cfg['channel_name_close'];
			$channel['channel_flag_maxclients_unlimited'] = 0;
			$channel['channel_maxclients'] = '0';
		}
			$ts->channelEdit($cfg['channel_id'], $channel);
}