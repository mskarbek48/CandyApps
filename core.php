<?php
/*
	Candy - Application for your TeamSpeak server
		
	@ File: core.php
	@ Author: Lukieer
	@ TeamSpeak: TSCuksy.Pl
	@ Contact: maciekv@onet.pl
	
	@ created: 09.10.2020
	@ last modify: 09.11.2020
	@ website: candyapp.pl
	
	@ copyright (C) 2020 Maciej "Lukieer" Skarbek
	
	@ You can:
	 - Modify config, and functions files.
	@ You can't:
	 - Change default prefix of bot
	 - Redistribute this app
	
	@ REDYSTRYBUCJA TYCH PLIKÓW NA INNYCH STRONACH I HOSTINGACH PLIKÓW JEST PRZESTĘPSTWEM KRYMINALNYM, A SPRAWCY BĘDĄ PRZEDMIOTEM STOSOWNYCH DZIAŁAŃ PRAWNYCH.

*/


$version = '1.2';
foreach (glob("inc/functions/Controller/*.php") as $filename)
{
    include_once $filename;
}
foreach (glob("inc/functions/Guild/*.php") as $filename)
{
    include_once $filename;
}
foreach (glob("inc/functions/Stats/*.php") as $filename)
{
    include_once $filename;
}
foreach (glob("inc/functions/Helper/*.php") as $filename)
{
    include_once $filename;
}
foreach (glob("inc/functions/Guild/*.php") as $filename)
{
    include_once $filename;
}
foreach (glob("inc/functions/Administrat/*.php") as $filename)
{
    include_once $filename;
}
foreach (glob("inc/functions/*.php") as $filename)
{
    include_once $filename;
}
require_once('inc/config.php');
require_once('inc/classes/ts3admin.class.php');
require_once('inc/classes/core.class.php');
require_once('inc/classes/ts3audiobot.class.php');
require_once('inc/classes/csgo.class.php');
require_once('inc/classes/antileak.class.php');

$instance = getopt("i:");




$l = " \e[92m:: License system :: \e[0m";
$p = " \e[33m:: Query :: \e[0m";
$c = " \e[92m:: Core :: \e[0m";
$e = " \e[31m:: ERROR! :: \e[0m";
$al = " \e[31m:: License :: \e[0m";
$db = " \e[36m:: MySQL :: \e[0m";
$audio = " \e[36m:: TS3AudioBot :: \e[0m";
system('clear');

echo "\n\n";
echo "\e[33m @ App: Candy - Application for your TeamSpeak or Discord server\n";
echo "\e[33m @ Version: " . $version . "    	    \n";
echo " @ copyright (C) 2020 Maciej \"Lukieer\" Skarbek                   \n";
echo "\e[35m @ Application is starting.  \e[0m\n\n\n";


if(!$instance){
	echo $e."Proszę wybrać numer instancji -> php core.php -i <1-5>\n\n";
	die();
}else{
	if(!isset($config[$instance['i']])){
		echo $e."Nie ma takiej instancji. Użyj -> php core.php -i <1-5>\n\n";
		//_log('[CORE] Nie ma takiej instacji.');
		die();
		}
	}
	
#$antileak = new antiLeak();
#$antileak->checkLicense($config, $al);

$footer = "[hr][right][size=13]Wygenerowano przez [b]Candy[/b][/size]\n[size=8]Coded and created by: [URL=https://www.facebook.com/noooheej/][b]Lukieer[/b][/URL] [/right]";

if($config['prefix'] == 1){
	$prefix = "Candy › ";
}
if($config['prefix'] == 2){
	$prefix = "cBot › ";
}
if($config['prefix'] == 3){
	$prefix = "@lukieerBot › ";
}
if($config['prefix'] == 4){
	$prefix = "(cBot) ";
}
if($config['prefix'] == 5){
	$prefix = "(Candy) ";
}
if($config['prefix'] == 6){
	$prefix = "[cBot] ";
}
if($config['prefix'] == 7){
	$prefix = "cBot » ";
}
if($config['prefix'] == 8){
	$prefix = "Candy » ";
}


$allprefixes = [
1 => 'Candy ›',
2 => 'cBot ›',
3 => '@lukieerBot ›',
4 => '(cBot)',
5 => '(Candy)',
6 => '[cBot]',
7 => 'cBot »',
8 => 'Candy »',
];




//_log('[MYSQL] Łączenie z bazą danych');

try {
  $pdo = new PDO("mysql:host=" . $config['database']['ip'] . ";dbname=" . $config['database']['dbname'] . "", $config['database']['login'], $config['database']['password']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo $db."Connected to database\n\n";
} catch(PDOException $e) {
  echo $e."Unable to connect to database\n" . $e->getMessage();
  die();
}	
	
	$ts = new query($config[$instance['i']]['connection']['ip'], $config[$instance['i']]['connection']['queryPort']); 
	
	
	if($ts->getElement('success', $ts->connect())){
		echo $p."Connecting...\n";
	}else{ 
		echo $e."\e[0;31;40mServerQuery unable to connect.\e[0m\n"; 
		//_log('ServerQuery unable to connect.');
		die();
	}
	if($ts->getElement('success', $ts->login($config[$instance['i']]['connection']['login'], $config[$instance['i']]['connection']['password']))){ 
		echo $p."logged\n";
	}else{ 
		echo $e."\e[0;31;40m Access denied to ServerQuery\e[0m\n"; 
		//_log('Access denied to ServerQuery.');
		die();
	}
	if($ts->getElement('success', $ts->selectServer($config[$instance['i']]['connection']['port']))){
			echo $p."selected server with port 9987\n\n";
		}else{ 
			echo $e."\e[0;31;40mServerQuery cannot select serverID\e[0m\n"; 
			//_log('ServerQuery cannot select serverID.');
			die();
			}
	if(!$ts->getElement('success', $ts->setName($prefix.$config[$instance['i']]['connection']['nickname']))) { 
		echo $e."\e[0;31;40mServerQuery cannot change the own nickname\e[0m\n"; 
		//_log('ServerQuery cannot change the own nickname.');
		}  
		$ts->clientMove($ts->whoAmI()['data']['client_id'], $config[$instance['i']]['connection']['channel']); 
		echo "\n".$c."\e[0;32;40mServerQuery connected as nickname ".$prefix.$config[$instance['i']]['connection']['nickname']."\e[0m\n\n"; 
		//_log('ServerQuery connected');
		
	//print_r($allprefixes);

		
	$nick = $ts->whoAmI()['data']['client_nickname'];
	

	
	$arr = explode(' ', $nick);
	
	$default = $arr[0];
	
	foreach($allprefixes as $allowedp){
		if(strpos($allowedp, $default)){
			$PrefixCheck = 1;
		}
	}
	

	
	
	if(!isset($PrefixCheck)){
		
		echo " # Uwaga! Prawdopobodnie któryś z plików jest uszkodzony! #".PHP_EOL;
		echo " # Druga opcja, to próba ominięcia domyślnego prefixu bota. #".PHP_EOL;
		echo " # Sprawdź konfiguracje i spróbuj ponownie, lub skontakuj się z supportem #".PHP_EOL.PHP_EOL;
		//_log(' # Uwaga! Prawdopobodnie któryś z plików jest uszkodzony! #');
		//_log(' # Druga opcja, to próba ominięcia domyślnego prefixu bota. #');
		//_log(' # Sprawdź konfiguracje i spróbuj ponownie, lub skontakuj się z supportem #');
		die();
	}
	
	
	
	
	
	
	
	
	
	
	//_log('[CORE] Wczytywanie...');
	$core = new core();
	
	
	
	$start = true;
	usleep(100000);
	if(isset($config[$instance['i']]['functions'])){
		foreach($config[$instance['i']]['functions'] as $key => $value){
			$functions[] = $key;
		}
		$config['bot']['functions'] = $functions;
	}
	$config[4]['functions']['levels']['time_interval'] = ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 10];
	usleep(100000);
	if(isset($config[$instance['i']]['functions'])){
		foreach($config['bot']['functions'] as $function){
			$config[$instance['i']]['functions'][$function]['date'] = date('Y-m-d G:i:s');
			if(isset($config[$instance['i']]['functions'][$function]['sleep'])){
				$config[$instance['i']]['functions'][$function]['time_interval'] = ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => $config[$instance['i']]['functions'][$function]['sleep']];
			}
			if(!isset($config[$instance['i']]['functions'][$function]['time_interval'])){
				$config[$instance['i']]['functions'][$function]['time_interval'] = ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 0];
			}
		}
	}
	
	
	if($instance['i'] == 1){
		if($config['functionInfo']['enabled']){
			functionInfo($ts);
		}
	}
	$channel = $ts->execOwnCommand(1, 'servernotifyregister event=channel id=0');
	
	foreach($ts->getElement('data', $ts->clientList("-uid -groups -ip -times -voice -away")) as $client){
		$old[] = $client['clid'];
	}
	
	$cs = new csgo();

	
	if($instance['i'] == 5){
		if($config[5]['musicBot']['enabled']){
			$ab = new ts3AudioBot();
			$ab->test();
		//	$ab->upDateSQL($pdo);
		}
	}

	
	
	
while(true) {

	if($instance['i'] !== '6'){
		//$test = $cs->getTimePlayed(76561198398982363);
		
		//print_r($test);
		
		if(date("H:i:s") == "04:00:00" or date("H:i:s") == "04:00:01"){
			die();
		}

		$test = $ts->execOwnCommand(1, 'servernotifyregister event=textprivate');
		if(isset($config[$instance['i']]['onChat'])){
			if(isset($test['data']['notifytextmessage'])){
				$info = $test;
				$info = $info['data'];
				$clid = $info['invokerid'];
				$message = $info['msg'];
				echo $p.$info['invokername'].": ".$message."\n";
				foreach($config[$instance['i']]['onChat'] as $key => $value){
					if($value['enabled']){
						$key($clid, $message);
					}
				}
			}
		}



		$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times -voice -away"));
		$server_info = $ts->getElement('data', $ts->serverInfo());
		$channels = $ts->channelList()['data'];
		$groups = $ts->serverGroupList()['data'];
		
		$datapetli = date('Y-m-d G:i:s');
		if(isset($config[$instance['i']]['functions'])){
			foreach($config['bot']['functions'] as $all){
				for($i=0; $i<count($config['bot']['functions']); $i++) {
					if($config[$instance['i']]['functions'][$config['bot']['functions'][$i]]['enabled']){
						if(can_do($datapetli, $config[$instance['i']]['functions'][$config['bot']['functions'][$i]]['date'], convertinterval($config[$instance['i']]['functions'][$config['bot']['functions'][$i]]['time_interval']))){
							$funkcja = $config['bot']['functions'][$i];
							$funkcja();
							print_r($funkcja);
							$config[$instance['i']]['functions'][$config['bot']['functions'][$i]]['date'] = $datapetli;
						}
					}
					
				}
				break;
			}
		}
		
		if(isset($config[$instance['i']]['onServerJoin'])){
			foreach($config[$instance['i']]['onServerJoin'] as $funkcja => $info){
				if($config[$instance['i']]['onServerJoin'][$funkcja]['enabled']){
					$clients = $ts->getElement('data', $ts->clientList("-uid -groups -ip -times -voice -away"));
					foreach($clients as $client){
						if(!in_array($client['clid'], $old)){
							$funkcja($client['clid'], $client['client_database_id'], $client['connection_client_ip']);
							$old[] = $client['clid'];
						}
					}
					
				}
			}
		}	
		usleep($config[$instance['i']]['connection']['idle']);
	}
}



function clients(){global $ts,$idle;$clients=$ts->getElement('data',$ts->clientList("-uid -groups -ip"));return $clients;}function checkAdminGroup($dbid,$ad_rank){$lista=clients();foreach($lista as $client){if($client['client_database_id']!=1&&$client['client_database_id']==$dbid){$client_groups=explode(",",$client['client_servergroups']);foreach($client_groups as $client_group)if(in_array($client_group,$ad_rank))return true;}}return false;}function callAPI($method,$url,$data){$curl=curl_init();switch($method){case "POST":curl_setopt($curl,CURLOPT_POST,1);if($data)curl_setopt($curl,CURLOPT_POSTFIELDS,$data);break;case "PUT":curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");if($data)curl_setopt($curl,CURLOPT_POSTFIELDS,$data);break;default:if($data)$url=sprintf("%s?%s",$url,http_build_query($data));}curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_HTTPHEADER,array('APIKEY: 111111111111111111111','Content-Type: application/json',));curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC);$result=curl_exec($curl);if(!$result){die("Connection Failure");}curl_close($curl);return $result;}
function convertinterval($interval) {
		
		$interval['hours'] = $interval['hours'] + $interval['days']*24;
		$interval['minutes'] = $interval['minutes'] + $interval['hours']*60;
		$interval['seconds'] = $interval['seconds'] + $interval['minutes']*60;
		
		return $interval['seconds'];
}

function can_do($date1, $date2, $interval) {
		
		//global $antileak, $ts;
		
		//$antileak->loadFunction($ts);
		$time2 = strtotime($date2);
		$time1 = strtotime($date1);
		$sum = $time1 - $time2;
		
		if($sum >= $interval) {
				$cando = true;
		} else {
				$cando  = false;
		}
		
		return $cando;
}

?>
