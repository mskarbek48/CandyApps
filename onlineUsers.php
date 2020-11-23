<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: onlineUsers.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function onlineUsers()
    {
		
		global $ts, $config, $p, $footer, $clients, $server_info, $core;
		
		$count = 1;
		$desc = $config['1']['functions']['onlineUsers']['top_desc'];
		
		foreach($clients as $client)
		{
			if($client['client_type'] == 0)
			{
				$channel = $ts->getElement('data', $ts->channelInfo($client['cid']));
				if($config['1']['functions']['onlineUsers']['ip_display'] == true){
					$desc .= "[size=11]› [/size] [size=10] [b][URL=client://".$client['clid']."/".$client['client_unique_identifier']."]".$client['client_nickname']."[/url] [/b]\n     Kanał: [b][url=channelId://".$client['cid']."]".$channel['channel_name']."[/url] [/b]\n     ID z bazy danych: [b]".$client['client_database_id']."\n     [/b]IP klienta: [b]".$client['connection_client_ip']."[/b][/size]\n";
				}else{
					$desc .= "[size=11]› [/size] [size=10] [b][URL=client://".$client['clid']."/".$client['client_unique_identifier']."]".$client['client_nickname']."[/url] [/b]\n     Kanał: [b][url=channelId://".$client['cid']."]".$channel['channel_name']."[/url] [/b]\n     ID z bazy danych: [b]".$client['client_database_id']."[/b][/size]\n";
				}
			}
		}	
		
		$iinfo = $server_info;
        $name = str_replace('[users]', $core->getOnline($ts, $config), $config['1']['functions']['onlineUsers']['channel_name']);

        $ts->channelEdit($config['1']['functions']['onlineUsers']['channel_id'], [
            'channel_name' => $name	
			
          ]);
		$desc = $desc.$footer;
		$ts->channelEdit($config['1']['functions']['onlineUsers']['channel_id'], array('channel_description' => $desc));

    }
?>