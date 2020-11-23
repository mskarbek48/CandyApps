<?php
function youtube(){
	
	global $ts, $core, $config, $footer;
	
	$cfg = $config[1]['functions']['youtube'];
	$key = $cfg['api_key'];
	
	foreach($cfg['channels'] as $ytc){
		$yt = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$ytc['yt_channel_id'].'&key='.$key), true);
		$yt2 = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=snippet&id='.$ytc['yt_channel_id'].'&key='.$key), true);

		$ytreplace = $cfg['yt_desc'];
		$ytreplace2 = $cfg['yt_name'];

		
		$subs = $yt['items'][0]['statistics']['subscriberCount'];
		$allviews = $yt['items'][0]['statistics']['viewCount'];
		$allvideo = $yt['items'][0]['statistics']['videoCount'];
		
		$ytname = $yt2['items']['0']['snippet']['title'];
		$ytdesc = $yt2['items']['0']['snippet']['description'];
		$ytcreated = $yt2['items']['0']['snippet']['publishedAt'];
		
		$logo = "[IMG]".$yt2['items']['0']['snippet']['thumbnails']['medium']['url']."[/IMG]";
		
		
		$ytDesc = str_replace(["[SUBS]", "[VIEWS]", "[VIDEOS]", "[NAME]", "[DESC]", "[CREATED]", "[LOGO]", ], [$subs, $allviews, $allvideo, $ytname, $ytdesc, $ytcreated, $logo], $ytreplace);
		$ytName = str_replace(["[SUBS]", "[VIEWS]", "[VIDEOS]", "[NAME]", "[DESC]", "[CREATED]"], [$subs, $allviews, $allvideo, $ytname, $ytdesc, $ytcreated], $ytreplace2);
		
		$info = $ts->channelEdit($ytc['channel_id'], ['channel_description' => $cfg['top_desc'].$ytDesc.$footer, 'channel_name' => $ytName]);
		if($info['errors']){
			$ts->channelEdit($ytc['channel_id'], ['channel_description' => $cfg['top_desc'].$ytDesc.$footer]);
		}
	}
}
	