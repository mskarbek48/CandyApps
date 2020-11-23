<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: covidInfo.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function covidInfo(){
	global $ts, $config, $footer;
	
	
	$cfg = $config['1']['functions']['covidInfo'];
	
	$api = callAPI('GET', 'https://corona.lmao.ninja/v2/countries/'.$cfg['country_code'], false);
	$covid = json_decode($api, true);
	
	$kraj = $covid['country']; // KRAJ
	$przypadki = $covid['cases']; // ilosc przypadkow łącznie w kraju
	$dzisiaj1 = $covid['todayCases']; // Ilosc przypadkow potwierdzonych dzisiaj
	$dzisiaj = $covid['todayCases']; // Ilosc przypadkow potwierdzonych dzisiaj
	$smierci = $covid['deaths']; // smierci lacznie
	$sdzisiaj = $covid['todayDeaths']; // smierci dzisiaj
	$uratowano = $covid['recovered']; // uratowano dzisiaj
	$uratowanodzis = $covid['todayRecovered']; // uratowano dzis
	$maketest = $covid['tests'];
	$ludzie = $covid['population'];
	$aktywne = $covid['active'];
	$krytyczne = $covid['critical'];
	
	if($kraj == "Poland"){
		$kraj = "Polsce";
	}
	
	if($dzisiaj == "0"){
		$dzisiaj = "?";
		$sdzisiaj = "?";
		$uratowanodzis = "?";
	}
	
	/*$message = str_replace("[krytyczne]", $krytyczne, $cfg['alert']['message']);
	$message = str_replace("[smierci]", $smierci, $message);
	$message = str_replace("[sdzisiaj]", $sdzisiaj, $message);
	$message = str_replace("[dzisiaj]", $dzisiaj, $message);
	$message = str_replace("[przypadki]", $przypadki, $message);
	$message = str_replace("[uratowanodzis]", $uratowanodzis, $message);
	$message = str_replace("[uratowano]", $uratowano, $message);
	$message = str_replace("[aktywne]", $aktywne, $message);
	$message = str_replace("[ludzie]", $ludzie, $message);
	$message = str_replace("[maketest]", $maketest, $message);
	$message = str_replace("[kraj]", $kraj, $message);
	
	
	if($cfg['alert']['enabled']){
		$clients = clients();
		foreach($clients as $client){
			$ts->sendMessage(1, $client['clid'], $message);
		}
	}*/
	
	$top_desc = $cfg['description']['top_desc'];
	
	$waiting = $cfg['description']['waiting'];
		
	
	$today_desc_without_dead = str_replace("[krytyczne]", $krytyczne, $cfg['description']['today_desc_without_dead']);
	$today_desc_without_dead = str_replace("[smierci]", $smierci, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[sdzisiaj]", $sdzisiaj, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[dzisiaj]", $dzisiaj, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[przypadki]", $przypadki, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[uratowanodzis]", $uratowanodzis, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[uratowano]", $uratowano, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[aktywne]", $aktywne, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[ludzie]", $ludzie, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[maketest]", $maketest, $today_desc_without_dead);
	$today_desc_without_dead = str_replace("[kraj]", $kraj, $today_desc_without_dead);

	
	$today_desc = str_replace("[krytyczne]", $krytyczne, $cfg['description']['today_desc']);
	$today_desc = str_replace("[smierci]", $smierci, $today_desc);
	$today_desc = str_replace("[sdzisiaj]", $sdzisiaj, $today_desc);
	$today_desc = str_replace("[dzisiaj]", $dzisiaj, $today_desc);
	$today_desc = str_replace("[przypadki]", $przypadki, $today_desc);
	$today_desc = str_replace("[uratowanodzis]", $uratowanodzis, $today_desc);
	$today_desc = str_replace("[uratowano]", $uratowano, $today_desc);
	$today_desc = str_replace("[aktywne]", $aktywne, $today_desc);
	$today_desc = str_replace("[ludzie]", $ludzie, $today_desc);
	$today_desc = str_replace("[maketest]", $maketest, $today_desc);
	$today_desc = str_replace("[kraj]", $kraj, $today_desc);
	
	$desc = str_replace("[krytyczne]", $krytyczne, $cfg['description']['desc']);
	$desc = str_replace("[smierci]", $smierci, $desc);
	$desc = str_replace("[sdzisiaj]", $sdzisiaj, $desc);
	$desc = str_replace("[dzisiaj]", $dzisiaj, $desc);
	$desc = str_replace("[przypadki]", $przypadki, $desc);
	$desc = str_replace("[uratowanodzis]", $uratowanodzis, $desc);
	$desc = str_replace("[uratowano]", $uratowano, $desc);
	$desc = str_replace("[aktywne]", $aktywne, $desc);
	$desc = str_replace("[ludzie]", $ludzie, $desc);
	$desc = str_replace("[maketest]", $maketest, $desc);
	$desc = str_replace("[kraj]", $kraj, $desc);
	
	if($sdzisiaj == '?' & $dzisiaj == '?'){
		$desc = $top_desc.$waiting.$desc.$footer;
	}else{
		if($sdzisiaj == 0 & $dzisiaj != 0){
			$desc = $top_desc.$today_desc_without_dead.$desc.$footer;
		}else{
			$desc = $top_desc.$today_desc.$desc.$footer;
		}
	}
	
	
	$name = $cfg['channel_name'];
	$name = str_replace("[dzisiaj]", $dzisiaj, $name);
	
	
	$ts->channelEdit($cfg['channel_id'], array
	(
	'channel_description' => $desc
	));
	
	$ts->channelEdit($cfg['channel_id'], array
	(
	'channel_name' => $name
	));
	
	
	}