<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: uptime.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function uptime()
    {
		global $ts, $config, $p;
		
		$server_info = $ts->getElement('data', $ts->serverInfo());
		$seconds = $server_info['virtualserver_uptime'];
		$minutes = $server_info['virtualserver_uptime'] / 60;
		$hours = $server_info['virtualserver_uptime'] / 3600;
		$days = $hours / 24;
		if($days >= 1){
			$uptime = floor($days);
			$next = $hours - 24*$uptime;
			$uptime = floor($days)." dni, ".floor($next)." godz.";
		}else{
			if($hours >= 1) {
				$uptime = floor($hours);
				$next = $minutes - 60*$uptime;
				$uptime = floor($hours)." godz. ".floor($next)."min.";
			}else{
				if($minutes >= 1) {
					$uptime = floor($minutes)." min.";
				}else{
					$uptime = floor($seconds)." sec.";
				}
			}
		}		
        $name = str_replace('[uptime]', $uptime, $config['1']['functions']['uptime']['channel_name']);
        $ts->channelEdit($config['1']['functions']['uptime']['channel_id'], [
            'channel_name' => $name
          ]);

    }
?>