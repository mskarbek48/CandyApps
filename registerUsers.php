<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: registerUsers.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function registerUsers(){
	global $ts, $config, $core;
	
	$cfg=$config[1]['functions']['registerUsers'];
	
	$registerUsers = $core->getClientsCountGroup($ts, $cfg['registerGroup']);
	
	$chname = str_replace("[register]", $registerUsers, $cfg['channel_name']);
	
	$ts->channelEdit($cfg['channel_id'], ['channel_name' => $chname]);
}