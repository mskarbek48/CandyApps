<?php
function helpCMD($clid, $message){
	
	global $ts, $core, $config;
	
	if(strpos($message, '!') === 0){
		foreach($config[3]['onChat']['helpCMD']['messages'] as $msg){
			if($message == '!help'){
				$ts->sendMessage(1, $clid, $msg);
			}
		}
	}
	
}
	
	