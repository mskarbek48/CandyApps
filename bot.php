<?php 
function restartCMD($clid, $message){
	
	global $ts, $config, $core, $clients, $pdo;
	
	
	if(strpos($message, '!') === 0){
		$bans = $ts->banList()['data'];
		$message = str_replace(" ", "/", $message);
		$strArray = explode('/',$message);
		if($strArray[0] == '!bot'){
			if(isset($strArray[1])){
				$botid = $strArray[1];
			}
			
			foreach($config[5]['onChat']['restartCMD']['allowgroups'] as $group){
				if($core->checkIfIn($ts, $clid, $group, $clients)){
					$hasgroup = 1;
				}
			}
		
		
			if(isset($hasgroup) && $hasgroup == 1){
				if(isset($botid)){
					print_r($botid);
					exec('screen -X -S Candy_Instance'.$botid.' quit');
				}
			}else{
				$ts->sendMessage(1, $clid, "Nie masz permisji do użycia tej komendy!");	
			}
		}
	}
}