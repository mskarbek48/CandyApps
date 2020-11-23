<?php
/*
	Candy - Application for your TeamSpeak server
		
	@ File: weather.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl
	
	@ created: 09.10.2020
	@ last modify: 09.11.2020
	@ website: candyapp.pl
	
	@ copyright (C) 2020 Maciej "Lukieer" Skarbek
	
	@ You can:
	 - Modify config, and functions files.
	@ You can't:
	 - Change default prefix of bot
	 - Redistribute this app
	
	@ REDYSTRYBUCJA TYCH PLIKÓW NA INNYCH STRONACH I HOSTINGACH PLIKÓW JEST PRZESTĘPSTWEM KRYMINALNYM, A SPRAWCY BĘDĄ PRZEDMIOTEM STOSOWNYCH DZIAŁAŃ PRAWNYCH.

*/


function k_to_c($temp) {
	if ( !is_numeric($temp) ) { return false; }
	return round(($temp - 273.15));
}
function weather() {
	global $ts, $config;
	$cfg = $config['1']['functions']['weather'];
	$api = callAPI('GET', 'http://api.openweathermap.org/data/2.5/weather?q='.$cfg['miasto'].'&APPID='.$cfg['api_key'].'&lang='.$cfg['language'], false);
	$api = json_decode($api, true);
	$topdesc = $cfg['description']['top_desc'];
	$desc = $cfg['description']['desc'];
	$pogodas = $api['weather'];
	foreach($pogodas as $pogoda){
		$opis = $pogoda['description'];
	}
	$temp = k_to_c($api['main']['temp']);
	$maxtemp = k_to_c($api['main']['temp_max']);
	$mintemp = k_to_c($api['main']['temp_min']);
	$name = $opis;
	$name = str_replace("[opis]", $opis, $cfg['channel_name']);
	$name = str_replace("[temp]", $temp."°C", $name);
	$desc = str_replace("[opis]", $opis, $cfg['description']['desc']);
	$desc = str_replace("[temp]", $temp."°C", $desc);
	$name = str_replace("[max]", $maxtemp."°C", $name);
	$name = str_replace("[min]", $mintemp."°C", $name);
	$desc = str_replace("[max]", $maxtemp."°C", $desc);
	$desc = str_replace("[min]", $mintemp."°C", $desc);
	$ts->channelEdit($cfg['channel_id'], array
	(
	'channel_name' => $name,
	));
	$ts->channelEdit($cfg['channel_id'], array
	(
		'channel_description' => $topdesc.$desc.$footer
	));
	
}