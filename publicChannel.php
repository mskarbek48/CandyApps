<?php

function publicChannels(){
	
	global $ts, $config;
	
	$cfg = $config[1]['functions']['publicChannels'];
	
	foreach($cfg['channels'] as $channelsector){
		$all = 0;
		foreach($ts->channelList()['data'] as $channel){
			if($channel['pid'] == $channelsector['channel_id']){
				$all++;
				if($channel['total_clients'] == 0){
					$channels[$channelsector['channel_id']][] = $channel['cid'];
				}
			}
		}
		
		
		if(count($channels[$channelsector['channel_id']]) > $channelsector['defaultChannels']){
			for($i = count($channels[$channelsector['channel_id']]) - 1; $i >= $channelsector['defaultChannels']; $i--){
				$ts->channelDelete($channels[$channelsector['channel_id']][$i]);
			}
		}
		
		
		if(count($channels[$channelsector['channel_id']]) < $channelsector['defaultChannels']){
			for($ch = count($channels[$channelsector['channel_id']]); $ch < $channelsector['defaultChannels']; $ch++){
				$all++;
				if($channelsector['maxClients'] == 0){
					
					$created = $ts->channelCreate([
					  'channel_name' => str_replace('[num]', $all, $channelsector['channel_name']),
					  'cpid' => $channelsector['channel_id'],
					  'channel_flag_permanent' => 1,
					  'channel_flag_maxclients_unlimited' => 1,
					  'channel_flag_maxfamilyclients_unlimited' => 1,
					  'channel_codec_quality' => $cfg['codec']
					]);
					$ts->channelAddPerm($created['data']['cid'], ['i_icon_id' => $channelsector['icon']]);
					
					
				}else{
					
					$created = $ts->channelCreate([
						'channel_name' => str_replace('[num]', $all, $channelsector['channel_name']),
						'cpid' => $channelsector['channel_id'],
						'channel_maxclients' => $channelsector['maxClients'],
						'channel_flag_permanent' => 1,
						'channel_flag_maxclients_unlimited' => 0,
						'channel_flag_maxfamilyclients_unlimited' => 1,
						'channel_codec_quality' => $cfg['codec']
					  ]);
					  $ts->channelAddPerm($created['data']['cid'], ['i_icon_id' => $channelsector['icon']]);
				}
			}
			unset($ch);
		}
	}
	unset($channels);
}