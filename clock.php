<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: clock.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function clock(){
	
	global $ts, $config, $footer;

	$channel = array();
	$channel['channel_name'] = str_replace("[time]", date('G:i'), $config['1']['functions']['clock']['channel_name']);
	$channel['channel_description'] = str_replace("[time]", date('G:i'), $config['1']['functions']['clock']['top_desc']);
	
	$ts->channelEdit($config['1']['functions']['clock']['channel_id'], $channel);
	}
?>