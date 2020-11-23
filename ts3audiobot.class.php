<?php
/*
	TS3AUDIOBOT Class
		
	@ File: ts3audiobot.class.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl
	
	@ created: 23.11.2020
	@ last modify: 23.11.2020
	@ website: candyapp.pl
	
	@ copyright (C) 2020 Maciej "Lukieer" Skarbek
	

*/
class ts3AudioBot {
	
	private $pass;
	private $login;
	private $url;
	public $con;
	public $bots;
	
	public function conv($array){
		
		$rtn = json_decode($array, true);
		
		return($rtn);
	}
	public function test(){
		
		$test = $this->conv($this->call('bot/list'));
		if(isset($test['ErrorMessage'])){
			return ' TS3AudioBot error ('.$test['ErrorCode'].') - '.$test['ErrorMessage'].PHP_EOL;
		}else{
			$count = count($test);
			return ' TS3AudioBot connected and logged! (Loaded ' . $count . ' bots)';
			$this->con = 1;
		}
	}
	
	public function space($string){
		
		return str_replace(" ", "%20", $string);
	}
	
	public function call($api){
		
		$login = $this->login;
		$password = $this->pass;
		$url = $this->url;
		
		$url = $url.'/api/';
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url.$api);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
		$result = curl_exec($ch);
		curl_close($ch);  
		return $result;
	}
	public function __construct(){
		global $config;
		$cfg = $config['ts3audiobot'];
		$this->pass = $cfg['password'];
		$this->login = $cfg['login'];
		$this->url = $cfg['ip'];
	}
	
	public function botList(){
		
		global $clients;
		
		$list =  $this->conv($this->call('bot/list'));
		foreach($list as $key => $bot){
			$list[$key]['cid'] = $this->botInfo($bot['Id'])['Channel'];
			$list[$key]['dbid'] = $this->botInfo($bot['Id'])['DatabaseId'];
			$list[$key]['nick'] = $this->botInfo($bot['Id'])['Name'];
		}
		return $list;
	}
	
	public function upDateSQL($pdo){
		
		$list = $this->botList();
		
		$pdo->query("truncate table musicBots");
		
		foreach($list as $bot){
			if($bot['cid'] !== NULL){
				$rq = $pdo->prepare("INSERT INTO musicBots (`name`, `cid`, `dbid`, `nick`) VALUES (:name, :cid, :dbid, :nick)");
				$rq->execute([':name' => $bot['Name'], ':cid' => $bot['cid'], ':dbid' => $bot['dbid'], ':nick' => $bot['nick']]);
			}
		}
		
	}
		
		
	
	public function botInfo($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/bot/info/client'));
	}

	public function play($botid, $play){
		return $this->conv($this->call('bot/use/'.$botid.'/(/play/'.urlencode($play)));
	}
	public function previous($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/previous'));
	}
	public function add($botid, $add){
		return $this->conv($this->call('bot/use/'.$botid.'/(/play/'.urlencode($add)));
	}
	public function clear($botdid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/clear'));
	}
	public function pause($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/pause'));
	}
	public function repeat($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/repeat'));
	}
	public function reloadRights($botid = 0){
		return $this->conv($this->call('rights/reload'));
	}
	public function setCommander($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/bot/commander/on'));
	}
	public function unsetCommander($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/bot/commander/off'));
	}
	public function disconnect($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/bot/disconnect'));
	}
	public function getMy($botid, $info){
		// $info can be: id, uid, name, channel, dbid, all
		return $this->conv($this->call('bot/use/'.$botid.'/(/getmy/'.$info));
	}
	public function historyClean($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/history/clean'));
	}
	public function historyLast($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/history/last'));
	}
	public function historyAdd($botid, $param){
		return $this->conv($this->call('bot/use/'.$botid.'/(/history/add/'.$param));
	}
	public function avatarSet($botid, $url){
		return $this->conv($this->call('bot/use/'.$botid.'/(/bot/avatar/set/'.urlencode($url)));
	}
	public function avatarClear($botid){
		return $this->conv($this->call('bot/use/'.$botid.'/(/bot/avatar/clear'));
	}
	public function botConnect($address, $password = 0){
		return $this->conv($this->call('bot/connect/to/'.$address.'/'.$password));
	}
	public function botSave($botid, $name){
		return $this->conv($this->call('bot/use/'.$botid.'/bot/save/'.$this->space($name)));
	}
	public function setName($botid, $name){
		return $this->conv($this->call('bot/use/'.$botid.'/(/bot/name/'.$this->space($name)));
	}
	public function setPermName($botid, $name){
		return $this->conv($this->call('bot/use/'.$botid.'/(/settings/set/connect.name/'.$this->space($name)));
	}
	public function changeSettings($botid, $path, $value){
		return $this->conv($this->call('bot/use/'.$botid.'/(/settings/set/'.$path.'/'.$value));
	}
	public function getSettings($botid, $path){
		return $this->conv($this->call('bot/use/'.$botid.'/(/get/'.$path));
	}
	public function cmd($cmd){
		return $this->conv($this->call($this->space($cmd)));
	}
	public function setVol($botid, $vol){
		return $this->conv($this->call('bot/use/'.$botid.'/(/volume/'.$vol));
	}
}