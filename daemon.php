<?php

echo "\n\n@ Candy - App for your TeamSpeak\n";
echo "@ Author: Maciej \"Lukieer\" Skarbek\n";
echo "@ Version: 1.0\n\n\n";


while(true){
	daemon();
	sleep(5);
}


function daemon(){
	exec('screen -ls', $screens);
	foreach($screens as $screen){
		$name = !preg_match( '/\.[^.]*$/', $screen, $matches);
		
		if(isset($matches[0])){
			
			$matches[0] = str_replace(".", "", $matches[0]);
			
			if($matches[0] ==! "0"){
			
				$arr = explode(' ',trim($matches[0]));
				
				$thisscreen = $arr[0];
				
				preg_match('/\([^(]*$/', $thisscreen, $screenm);
				
				$thisscreen = str_replace($screenm, "", $thisscreen);
				
				
				$onlinescreens[] = $thisscreen;
			}
			
		}
	}

	foreach($onlinescreens as $screen){
			
		if(strpos($screen, 'Candy') !== false){
			if(strpos($screen, '_Instance') !== false){
				$candy[] = $screen;
			}
		}
	}

	$all = ['_Instance1', '_Instance2', '_Instance3', '_Instance4', '_Instance5', '_Instance6'];

	if(isset($candy)){
		foreach($candy as $instance){
			foreach($all as $id){
				if(strpos($instance, $id) !== false){
					$ok = $id;
					break;
				}
			}
			$online[] = $ok;
		}
	}else{
		exec('cd .. && ./run start');
	}
	if(isset($online)){
		foreach($all as $need){
			if(!in_array($need, $online)){
				exec('cd .. && ./run start');
			}
		}
	}
	unset($candy);
	unset($ok);
	unset($screens);
	unset($online);
}

?>