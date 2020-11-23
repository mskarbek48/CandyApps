<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: createBackup.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function createBackup(){
	
	global $config, $ts, $telegram;
	
	$cfg = $config['1']['functions']['createBackup'];
	$token = $cfg['telegram_api'];
	$chatid = $cfg['chat_id'];
	
	$backup = $ts->serverSnapshotCreate();
	$name = "snapshotcuksy.txt";
	file_put_contents($name, $backup['data']);
	$filepath = realpath($name);
	$post = array('chat_id' => $chatid,'document'=>new CurlFile($filepath));    
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot" . $token . "/sendDocument");
	curl_setopt($ch, CURLOPT_POST, 1);   
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_exec ($ch);
	curl_close ($ch); 
	exec("rm ".$name);
}
?>