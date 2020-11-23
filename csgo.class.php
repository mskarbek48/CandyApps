http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=FC140069CE996C5DA62B239F967ED6BF&steamid=

<?php

class csgo {
	
	public $config;
	
	public function __construct(){
		
		global $config;
		$this->config = $config['steam_api'];
		
	}
	
	public function test($profile){
		
		$apikey = $this->config;
		
		$request = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key='.$apikey.'&steamid='.$profile;
		$data = json_decode(file_get_contents($request), true);
		if(!$data){
			return false;
		}else{
			return true;
		}
		
	}
	
	public function start($profile){
		
		$apikey = $this->config;
		
		$request = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key='.$apikey.'&steamid='.$profile;
		$data = json_decode(file_get_contents($request), true);
		return $data;
		
	}
	
	public function getKills($profile){
		
		$kills = $this->start($profile)['playerstats']['stats'][0]['value'];
		
		return $kills;
	}
	
	public function getTimePlayed($profile){
		
		$time = $this->start($profile)['playerstats']['stats'][1]['value'];
		
		return $time;
	}
		
	
}
		
		