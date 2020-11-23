<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: channels.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function channels()
    {
		
		global $ts, $config, $server_info;
		
        $name = str_replace('[channels]', round($server_info['virtualserver_channelsonline'], 2), $config['1']['functions']['channels']['channel_name']);

        $ts->channelEdit($config['1']['functions']['channels']['channel_id'], [
            'channel_name' => $name	
			
          ]);

    }
?>