<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: data.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function data(){
	
	global $ts, $config, $p, $footer;

	$channel = array();
	$channel['channel_name'] = str_replace("[time]", date('d.m.Y'), $config['1']['functions']['data']['channel_name']);
	
	$ts->channelEdit($config['1']['functions']['data']['channel_id'], $channel);

	
	}
?>