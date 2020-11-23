<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: packetLoss.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function packetLoss()
    {
		
		global $ts, $config, $p, $server_info;
		
		
        $name = str_replace('[packets]', round($server_info['virtualserver_total_packetloss_total'], 2), $config['1']['functions']['packetLoss']['channel_name']);

        $ts->channelEdit($config['1']['functions']['packetLoss']['channel_id'], [
            'channel_name' => $name	
			
          ]);
    }
?>