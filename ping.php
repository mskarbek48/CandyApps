<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: ping.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function ping()
    {
		global $ts, $config, $p;
		
		$server_info = $ts->getElement('data', $ts->serverInfo());
        $name = str_replace('[ping]', round($server_info['virtualserver_total_ping'], 2), $config['1']['functions']['ping']['channel_name']);

        $ts->channelEdit($config['1']['functions']['ping']['channel_id'], [
            'channel_name' => $name	
			
          ]);

    }
?>