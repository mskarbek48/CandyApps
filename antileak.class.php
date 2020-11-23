<?php
class antiLeak {
	public static function checkLicense($config, $al){
		
		
	print_r($al."Checking your license code");
	
	$ch = curl_init("https://candyapp.pl/license/?key=" . $config['license']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	if($data){
		print_r("\n".$al."\e[0;32;40mYour license key is VALID! Thank you for buy our application!\e[0m\n\n\n");
	}else{
		print_r("\n".$al."\e[0;31;40mYour license key is NOT VALID! Buy here: maciekv@onet.pl or facebook.com/CandyCBot\n\n\n\e[0m");
		die();
		}
	}
	public static function loadFunction($ts){
		$al = " \e[31m:: ANTILEAK :: \e[0m";
		$nick = $ts->whoAmI()['data']['client_nickname'];
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
		foreach($allprefixes as $prefix){
			if(strstr($nick, $prefix)){
				$ok = 1;
			}
		}
				
		if($ok==1){
			return true;
		}else{
			print_r($al."Please set the correct prefix on the bot!\n");
			die();
		}
	}
}

