<?php
/*
	Candy - Aplikacje pod twój serwer TeamSpeak
		
	@ Plik: queryUsers.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl

*/
function queryUsers()
    {
		
		$footer = "\n[hr][/size][right][size=7]Wygenerowano przez [b]Candy @ Controller [/b][/size]\n[size=5]Aplikacja stworzona przez [URL=https://www.facebook.com/noooheej/][b]Lukieer[/b][/URL][/right]";
		
		global $ts, $config, $p, $core, $clients;
		$count = 1;
		$desc = $config['1']['functions']['queryUsers']['top_desc'];
		foreach($clients as $client)
		{
			if($client['client_type'] == 1)
			{
				$channel = $ts->getElement('data', $ts->channelInfo($client['cid']));
				$groups = explode(",", $client['client_servergroups']);
				$groupsName = "";
				foreach($groups as $group){
					$groupsName .= $core->getName($ts, $group) . ", ";
				}
				$desc .= "[size=11]› [/size] [size=10] [b][URL=client://".$client['clid']."/".$client['client_unique_identifier']."]".$client['client_nickname']."[/url] [/b]\n     Kanał: [b][url=channelId://".$client['cid']."]".$channel['channel_name']."[/url] [/b]\n     ID z bazy danych: [b]".$client['client_database_id']."[/b]\n     Grupy: " . $groupsName . "[/size]\n";
				unset($groupsName);
			}
		}	
		$server_info = $ts->getElement('data', $ts->serverInfo());
        $name = str_replace('[users]', round($server_info['virtualserver_queryclientsonline'], 2), $config['1']['functions']['queryUsers']['channel_name']);
        $ts->channelEdit($config['1']['functions']['queryUsers']['channel_id'], [
            'channel_name' => $name	
          ]);
		$desc = $desc.$footer;
		$ts->channelEdit($config['1']['functions']['queryUsers']['channel_id'], array('channel_description' => $desc));

    }
?>