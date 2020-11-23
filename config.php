<?php
/*
	Candy - Application for your TeamSpeak server
		
	@ File: config.php
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


	CREATE USER 'candyapp'@localhost IDENTIFIED BY 'MEDQyeqSSLmJFPT3iySnByhtA2kiK8Q';
	GRANT ALL PRIVILEGES ON *.* TO 'candyapp'@localhost IDENTIFIED BY 'MEDQyeqSSLmJFPT3iySnByhtA2kiK8Q';
*/

$config['ts3audiobot'] = [
	'login' => 'ggELfXbLqY1M30R7peUH6wmvhKk=',
	'password' => 'Y1Mhkwzu7khHOMgcDsxjolYLeJKNgf5V',
	'ip' => 'http://164.132.183.145:58913',
];


/* Database Settings */
$config['database'] = [
	'ip' => 'localhost',
	'login' => 'candyapp',
	'password' => 'MEDQyeqSSLmJFPT3iySnByhtA2kiK8Q',
	'dbname' => 'candyapp',
];
/* Prefix Settings 
	@ Available prefixes: 
	1 - 'Candy ›' 
	2 - 'cBot ›' 
	3 - '@lukieerBot ›'
	4 - '(cBot)'
	5 - '(Candy)'
	6 - '[cBot]'
	7 - 'cBot »'
	8 - 'Candy »'
*/
$config['prefix'] = '1';

$config['messenger'] = 'EAAB5dsVmAikBAIc8USSNG6HprxmqLObSL5cXA2i6jsl5ZCREbAeBCxaNLpdW5qyhtJ4TtgoNjKpNgYbP9RxpFBTsV8h9UnZA6jVEiXJHsj8ht6yYQwhmZALekZBXuOlJEzQkuDSSWC1ZAOrqR2TRkbxuQx2ZABwWLsvsGLS59xFLQk8tf9HObQ';

/* License key 
 @ You can buy own on https://www.facebook.com/candycbot or maciekv@onet.pl
 */

$config['license'] = '5VlHNHgMM0YEMPhre35Knj0ALgEexVi3';
$config['ignoredGroup'] = [113]; // Group to ignore in online.

/* Instance one

@ Global settings

*/


$config['steam_api'] = 'FC140069CE996C5DA62B239F967ED6BF';

$config['functionInfo'] = [
		'enabled' => true,
		'channel_id' => 9763,
	];

$config[1] = [
 'connection' => [
	'ip' => '51.77.49.96', // ip of server
	'queryPort' => '10011', // query port
	'login' => 'querycontroller$*(^#@(*#', // login query
	'password' => '0JvdZ45y', // query password
	'port' => '9987', // port of server
	'nickname' => 'Controller', // nick of bot
	'channel' => '2900', // channel of bot
	'idle' => '100000', // time to idle after all functions is execute.
],
	
	'adminsGroups' => [315, 583, 688, 310, 671,211,264,265,285,283,718],



/*****************************************************************************************
*																						 *
* 				Funkcję wykonywane przy wejściu na serwer							     *
* 				Functions executes when user join server								 *
*																						 *
******************************************************************************************/	
		
	'onServerJoin' => [
		'joinFunctions' => [
			'enabled' => true, // Włączyć czy wyłączyć wszystkie funkcję (true - włączona, false - wyłączona) - Turn on or Turn off all the function (true - on, false - off)
			/*******************************************************************************
			* 			Wysyła wiadomość do użytkownika po wejściu na serwer               *
			* 			Send a message to client when him join server                      *
			*******************************************************************************/
				'welcomeMessage' => [
					'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'mode' => 2, // 1 - Wysyłanie do wszystkich z rangą rejestracyjną, 2 - wysyłanie tylko do użytkowników komputerów z rangą rejestracyjną - 1 - Send to everyone with register rank, 2 - send to  client with specifed rank only
					'group' => 75, // Grupa rejestracyjna - Register groups
					'messages' => // Wiadomości które ma wysłać do zarejestrowanych użytkowników - Message to send to client
					[
						1 => '	',
						2 => '		› Witaj, [b][CLIENT_NAME][/b] na serwerze [b][color=#FFAA00][SERVER_NAME][/color][/b].',
						3 => '		› Jeśli jesteś nowy, ranga upoważniona do pisania, zostanie przypisana za [b][color=#FFAA00]30 minut.[/color][/b]',
						4 => '	',
						5 => '		› Serwer działa bez przerwy: [b][color=#FFAA00][SERVER_UPTIME][/color][/b]',
						7 => '		› Jesteś z nami od: [b][color=#FFAA00][CLIENT_CREATED][/color][/b] czyli od [b][color=#FFAA00][CLIENT_CREATED_DAYS][/color][/b]',
						8 => '		› Połączyłeś się już z nami: [b][color=#FFAA00][CLIENT_CONNECTIONS][/color][/b] razy.',
						9 => '		› Twój poziom: [b][CLIENT_LEVEL][/b], spędziłeś z nami [b][CLIENT_SPENTTIME][/b]',
						11 => '		',
						12 => '		› Nasze IP to CandyApp.pl i nigdy się nie zmieni! Nie klikajcie w niezaufane linki!',
						13 => '		› W razie kłopotów, zapraszamy na [URL=channelid://1148][b][color=#FF0303]centrum pomocy![/color][/b][/URL]',
						14 => '		› Dziękujemy za wybranie naszego serwera',
						15 => '	',
						16 => '		› Dostań się na strefę używając komendy [b][color=#FFAA00]!warp <TAG>[/color][/b]'			
					],
					'newMessage' => // Wiadomość wysyłana do użytkowników którzy nie posiadają rangi rejestracyjnej - Message to clients without register rank
					[
						1 => '	',
						2 => '		› Witaj, [b][CLIENT_NAME][/b] na serwerze [b][color=#FFAA00][SERVER_NAME][/color][/b].',
						3 => '		› Ranga upoważniona do pisania, zostanie przypisana za [b][color=#FFAA00]30 minut.[/color][/b]',
						9 => '		',
						10 => '		› Nasze IP to CandyApp.pl i nigdy się nie zmieni! Nie klikajcie w niezaufane linki!',
						11 => '		› W razie kłopotów, zapraszamy na [URL=channelid://1148][b][color=#FF0303]centrum pomocy![/color][/b][/URL]',
						12 => '		› Dziękujemy za wybranie naszego serwera',
						13 => '	',
						14 => '		› [URL=ts3server://tscuksy.pl?nickname=&addbookmark=Cuksy%20][b][ZAPISZ ZAKŁADKĘ][/b][/url]         [URL=https://tscuksy.pl/Auth][b][DODAJ RANGI NA TS][/b][/URL]         [URL=https://www.facebook.com/TSCuksy][B][NASZ FB][/url]',
					],					
					
				],
				
				
				/*******************************************************************************
				* Przenosi użytkownika na kanał prywatny, gdzie ma range kanałową podaną niżej *
				* Move user to private channel where have specifed group id                    *
				*******************************************************************************/
				'teleport' => [ 
					'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'message' => "Posiadasz rangę [b]ReSpawn[/b] - zostałeś przeniesiony na kanał [b][name]", // Wiadomość którą ma wysłać po przeniesieniu na kanał - message to send after moved
					'channel_groups' => [5, 38, 39, 41, 40, 42, 16, 44], // Grupy kanałowe które ma przenosić - channel groups to move
					'group' => 877, // Grupa którą ma przenosić na kanały prywatne po wejściu - group to move
					'channel_id' => 1248, // Główny kanał gdzie są kanały prywatne - main channel private id
				],
				
				
				/*******************************************************************************
				* Nadaje grupę serwerową po wejściu na serwer danym IP.                        *
				* Assign or revoke group after join the channel                        *
				*******************************************************************************/
				'groupForIp' => [
					'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'allGroups' => [
						'1' => ['ip' => "164.132.183.145", 'group' => 113],
						],
					],
					
				/*******************************************************************************
				* Nadaje groupe np. rejestracyjną po osiągnięciu danej ilości połączeń         *
				* Assign group for example register after get connections count       		   *
				*******************************************************************************/				
				'assignGroupByConnection' => [
					'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'connections' => 10,
					'group' => 75,
					'ignoredGroups' => [354],
					],
					

				/*******************************************************************************
				* Nadaje grupe na podstawie platformy       *
				* Assign group platform after join the server                      		   *
				*******************************************************************************/	
				'groupByPlatform' => [
					'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'windows_group' => 254,
					'ios_group' => 257,
					'macos_group' => 258,
					'linux_group' => 255,
					'android_group' => 256,
					'ignoredGroups' => [355],
					],
					
				
				/*******************************************************************************
				* Blokuje dostęp danym platformom do serwera         *
				* Blocking access for specific platform to server                  		   *
				*******************************************************************************/	
				'blockPlatform' => [
					'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'platform' => ["macOS"],
					'ignoredGroups' => [356],					
					'kickMessage' => "Twoja platforma jest zabroniona!",
				],
				
				
				/*******************************************************************************
				* Blokuje dostęp osobą które korzystają z PROXY lub VPN       *
				* Blocking client with proxy or vpn                      		   *
				*******************************************************************************/	
				'proxyBlocker' => [
					'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'ignoredGroups' => [410],
					'ignoredIps' => ['51.77.49.96', '164.132.183.145', '51.178.140.31', '145.239.81.55', '5.180.62.79', '51.210.96.31'],
					'iptables' => false,
					'kickMessage' => "Proxy is illegal ([CONT]) Your ip is blocked now.", // Dostępne zmienne: [CONT] - Kontynent proxy
					],
				],
				
				
				/*******************************************************************************
				* Sprawdza czy avatar użytkownika posiada w sobie pornografie.         *
				* Checking if avatar of player contains porn        		   *
				*******************************************************************************/	
				'checkPorn' => [
					'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'notifyGroup' => 139,
					'api_key' => "GJ2Uc5ZkTX8oh8OY7GkCTiPIvAMxDkbH", // api key od https://www.picpurify.com/
					],
				
				
				/*******************************************************************************
				* Limituje ilość osób na jednym IP.         *
				* Limit of connection from one IP.     		   *
				*******************************************************************************/					
				'ipLimit' => [
					'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'ignoredIps' => ['127.0.0.1', '145.239.81.55', '164.132.183.145', '51.77.49.96', '51.210.96.31'],
					'max' => 2,
					'ignoredGroups' => [113],
					'kickMessage' => "Z jednego IP możesz być połączony na maksymalnie dwóch kontach!",
				],
				
				
				/*******************************************************************************
				* Blokuje lub pozwala na wejście przez dane kraje         *
				* Block or allow to join from specific country    		   *
				*******************************************************************************/	
				'country' => [
					'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
					'ignoredIps' => ["12.12.12.12"],
					'ignoredGroups' => [164],
					'mode' => 'block', // Allow or block
					'country_codes' => ['SI','TR','KZ','PK','IR','IQ','SY','AM','IN','CN','HK','LK','RU','FI', 'UA', 'TH'],
					'kickMessage' => "Your country is not allowed!",
					],
				],
/*****************************************************************************************
*																						 *
* 				Funkcję wykonywane według intervału.  								     *
*																						 *
******************************************************************************************/	

	'functions' => [
		'privateChannel' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'get_cid' => 4334, // Kanał do tworzenia kanałów prywatnych - Channel to create private channel
			'main_cid' => 4335, // Strefa kanałow prywatnych - Sector of private channel (main channel)
			'subchannels' => 3, // Ilość subkanałów - count of subchannel
			'leaderchgroup' => 9, // Grupa administracyjna kanału - admin group channel for user
			'desc' => '[center][size=13][b][NICK] [/b]- Kanał prywatny[/size]\n\n [size=10] O to twój kanał prywatny, data będzie aktualizowana automatycznie! \n\n[/size][/center]', // Opis kanału prywatnego - Description of private channel
			'descsubchannel' => '[center][size=13][b][NICK][/b],  o to twój subkanał, możesz mieć ich maksymalnie 3.\n[/size][/center]', // Opis subkanałów kanału prywatnego - Desc of subchannel private channel
			'hasChannelMessage' => "[b]Masz już swój kanał![/b]", // Wiadomość, gdy kanał jest już stworzony - Message when user arleady has channel
			'message' => '\n
				[b]›[/b] Brawo, twój kanał prywatny został założony!
				[b]›[/b] Twoje hasło to: [b][PASS][/b], zmień je!', // Wiadomość po utworzeniu kanału - message after channel is created
			'upDateOnJoin' => true, // Czy aktualizować date kanału automatycznie
			],
	

		'channelInfo' => [
				'enabled' => true,
				'channel_id' => 10963, 
				'messages' => [
				
				/* Numer => "Wiadomosc" np. 1 => "Cześć. masz TS3 [PLATFORM] na wersji [VERSION],
				   Number => "Message" for example 1 => "Hello, you have [VERSION] on [PLATFORM] TeamSpeak", */
				
					1 => "	", 
					2 => "	› Twoja platforma to: [b][PLATFORM][/b]",
					3 => "	› Twoja wersja kliencka to: [b][VERSION][/b]",
					4 => "	› Twoje pierwsze połączenie nastąpiło: [b][FIRSTCON][/b]",
					5 => "	› Łączna ilość twoich połączeń to: [b][TOTALCON][/b]",
					6 => "	› Twoje moce konwersacji: [b][TALKPOWER][/b]",
					7 => "	› Łącznie wysłałeś [b][GBUPLOAD] MB [/b]",
					8 => "	› Łącznie pobrałeś [b][GBDOWNLOAD] MB [/b]",
					9 => "	› Twoje IP: [b][CLIENTIP][/b]",
					10 => "	› Twój poziom: [b][LEVEL][/b]",
					11 => "  ",
					
				],
			],
	/********************************************
	*  		 channelGroup  					    *
	* Ustawia grupę serwera po wejściu na kanał *
	* Set the server group after join channel   *
	********************************************/
		'channelGroup' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channels' => [
			
				// W miejscu 'group' wpisujemy grupę jaką ma nadawać po wejściu na kanał, a w miejscu 'channel' - kanał gdzie trzeba wejść
				// In 'group' set the group to assign, in 'channel' set the channel where group is assign
				
				'1' => ['group' => 601, 'channel' => 9089],
				'2' => ['group' => 509, 'channel' => 6741],
				'3' => ['group' => 877, 'channel' => 9559],
				4 => ['group' => 884, 'channel' => 10971],
				],
			'messageOnAssign' => "Grupa została nadana!", // Wiadomość po nadaniu grupy - Kick message after group is assigned
			'messageOnRevoke' => "Grupa została zabrana!", // Wiadomość po usunięcie grupy - Kick message after group is revoked	
			 ], 
			 
			 
	/*******************************************************************\
	*   Monitoring of public channels, create when needed  *
	*   Monitoring kanałow publicznych, tworzy kiedy jest taka potrzeba  *
	/********************************************************************/
		'publicChannels' => [
			'enabled' => true,
			'codec' => 10,
			'channels' => 
			[
			
			0 => ['maxClients' => 0, 'defaultChannels' => 3, 'channel_id' => 1191, 'channel_name' => '• [num]. Kanał bez limitu', 'icon' => '1602411420'],
			1 => ['maxClients' => 2, 'defaultChannels' => 3, 'channel_id' => 1194, 'channel_name' => '• [num]. Kanał max 2', 'icon' => '1821540179'],
			2 => ['maxClients' => 3, 'defaultChannels' => 3, 'channel_id' => 1452, 'channel_name' => '• [num]. Kanał max 3', 'icon' => '2616957632'],
			3 => ['maxClients' => 4, 'defaultChannels' => 3, 'channel_id' => 2654, 'channel_name' => '• [num]. Kanał max 4', 'icon' => '3497455535'],
			4 => ['maxClients' => 5, 'defaultChannels' => 3, 'channel_id' => 2655, 'channel_name' => '• [num]. Kanał max 5', 'icon' => '645346290'],
			
			],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 10],
		],
		
	/*******************************************************************\
	*   				antyIpLogger 						    		*
	*   			Blokada przeciw IP Logger            			    *
	/*******************************************************************/
		'antyIpLogger' => [ 
			'enabled' => false,
		],			


	/*******************************************************************\
	*   Delete private channels after days or if channel contains word  *
	* Usuwa kanał prywatny po braku aktywności lub jeśli zawiera fraze  *
	/********************************************************************/				
		'deletePrivateChannels' => [ // Aby działało, funckja privateChannel musi być skonfigurowana. - private channel must be configured
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'alert' => 5, // Po ilu dniach ma dopisać [DATA] do nazwy kanału - After days add [DATE] to channel name
			'afterDays' => 7, // Po ilu dniach ma usunąć kanał
			'frazes' => ['kurwa', 'tsforum', 'candy >', 'controller', 'guild manager', 'chuj', 'pizd', 'jeb', 'pierdol', 'pindol', 'kutas', 'dziwka', 'jd', 'zapraszam na ts', '[bot]', 'Informacja', 'informacje', 'info', 'tsapps', 'IP:', 'nowe ip', 'brodaci', 'Maciej S', 'CEO', 'য়দতজঠওত চওঈডদশএতদ', '﷽','◦ CEO ◦', '◦ vCEO ◦','◦ Query  ◦','◦ RooT ◦','◦ HSA ◦','◦ SSA ◦','◦ SA ◦','◦ NA ◦','◦ TA ◦','꧂','psie','kurwo','ssie','sci.ek','kur.wa','sciek','.eu','.net','.com','huj','cipa','pizda','kutas','hitler','chuj','[QUERY]','[ROOT]','[HSA]','[SSA]','[SA]','[jSA]','[JSA]','[tSA]','[TSA]','[NA]','Właściciel','tsforum', 'brodaci', 'brodaci.net'], // Kanały z tymi frazami zostaną usunięte
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 5], // Co ile ma sprawdzać wszystkie kanały prywatne
		],
	/*******************************************************************\
	*   Checking number of private channels  *
	* Sprawdza numerowanie kanałów prywatnych  *
	/********************************************************************/	
		'checkPrivateNumber' => [
			'enabled' => false,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 11], // Co ile ma sprawdzać wszystkie kanały prywatne
			],
		
	/*******************************************************************\
	*  	Blocking specific nickname    									*
	*   Blokuje dane frazy w nicku  									*
	/********************************************************************/		

			
			
	/*******************************************************************\
	*   Country List    									*
	*   Tworzy listę osób z innych krajów  									*
	/********************************************************************/	
		'countryList' => [
			'enabled' => true,
			'ignored_country' => "PL",
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [113],
			'top_desc' => "[hr][center][size=13] [b]Lista osób z innych krajów [/b][/size][/center][hr]\n",
			'channel_id' => 9702,
			'channel_name' => '• Osoby z poza kraju: [COUNT]', // Dostępne zmienne: [COUNT]
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 43], 
			],
			
		'removePerm' => [
			'enabled' => true,
			'ignored_perms' => [145],
			'message' => "Permisja [b][PERM][/b] została usunięta.",
			],
		'removeChPerm' => [
			'enabled' => true,
			'ignored_perms' => [145],
			'message' => "Permisja [b][PERM][/b] została usunięta.", // Dostępna zmienna: [PERM]
			],
		'checkNickname' => [
			'enabled' => true,
			'block' =>  ['kurwa', 'xgaming.pl', 'tsforum', 'candy >', 'controller', 'guild manager', 'chuj', 'pizd', 'jeb', 'pierdol', 'pindol', 'kutas', 'dziwka', 'jd', 'zapraszam na ts', '[bot]', 'Informacja', 'informacje', 'info', 'tsapps', 'IP:', 'nowe ip', 'brodaci', 'Maciej S', 'CEO', 'য়দতজঠওত চওঈডদশএতদ', '﷽','◦ CEO ◦', '◦ vCEO ◦','◦ Query  ◦','◦ RooT ◦','◦ HSA ◦','◦ SSA ◦','◦ SA ◦','◦ NA ◦','◦ TA ◦','꧂','psie','kurwo','ssie','sci.ek','kur.wa','sciek','.eu','.net','.com','huj','cipa','pizda','kutas','hitler','chuj','[QUERY]','[ROOT]','[HSA]','[SSA]','[SA]','[jSA]','[JSA]','[tSA]','[TSA]','[NA]','Właściciel','tsforum', 'brodaci', 'brodaci.net'], 
			'mode' => 'ban',
			'time' => 1 * 60, // Jeśli mode = ban (1 godzina = 1 * 60 * 60), perm = 0
			'blockMessage' => "Twój nick zawiera niedozwoloną frazę ([BLOCK]). Zmień nick",
			],

			
			
	/*******************************************************************\
	*   groupsLimiter 												*
	*   Limit grup na dane permisje							*
	/********************************************************************/
		'groupLimiter' => [
			'enabled' => true,
			'ignored_perms' => [145],
			'ignoredGroups' => [16565],
			'ignoredIps' => ["12.12.12.12"],
			'message' => "Posiadałeś zbyt dużo limitowanych grup, jedna z nich została Ci usunięta.",
			'groupLimiters' => [

				['limit' => 3, 'groups' => [96,101,103,104,326,327,328,327,328,329,330,331,332,333,334,335,336,337,338,339,340,399,400,96,524,525,526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,694,723,606,592]], // 4 FUN
				['limit' => 1, 'groups' => [70,424,71,72,73,74,75]], // Wiek
				['limit' => 1, 'groups' => [168,169,170,171,172,173,174,175,176,177,295,296,297,298,299,300,301,302,303,304]], // Poziomy
				['limit' => 1, 'groups' => [601,602,603,604,605,661]], // emotki
				['limit' => 1, 'groups' => [151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,194]], // Wojew
				['limit' => 1, 'groups' => [81,82]], // Wiek
				
			],	
		],

		
	/*******************************************************************\
	*   groupProtector 													*
	*   Chroni użytkowników przez nieuprawnionymi grupami				*
	/********************************************************************/
		'groupProtector' => [
			'enabled' => true,
			'kickMessage' => 'Grupa została Ci usunięta!',
			'protectgroups' => [315,583,310,211,264,265,283,685,686,687,583,688,443,508,523,584,357,718,266,342,671,828],
			'clients' => [
				2459 => [357],
				# CEO
				13 => [315], # Lukieer
				221 => [315],
				# vCEO
				# RooT
				190 => [310], #Karolek88ll
				# HA
				#207 => [211], # Igor
				272 => [686], # Ferreczek
				# SSA
				468 => [264], # meeiiee
				1847 => [264], #meiie 2
				1777 => [211], # Dominik ^^
				856 => [211], # Pexel
				2400 => [264], # SDomino
				# SA
				258 => [265], # KamilK
				196 => [264], # Mickman
				2807 => [265], # KamilK tel
				2227 => [264], #prymex
				# Przyjaciel (uprawnienia jak ROOT)
				115 => [687], # Drodexon
				# Znajomy
				1801 => [686], # HatQVi
				208 => [686], 
				# Zaufany
				563 => [685],
				95 => [685], # TreTek
				439 => [685], # Hrynka	
				323 => [685],
				844 => [685],
				# YouTuber
				1939 => [266], # Dżelka
				2238 => [266],
				#2067 => [266],
				# Twitch 342
				# Menedzer 688
				# Technik 121
				643 => [671], # lajtu
				2358 => [443],
				2761 => [828],
				1754 => [283],
				2971 => [443],
				2952 => [283],
				
			],
		],
			

	/*******************************************************************\
	*  	Blocking recording    											*
	*   Blokuje nagrywanie  *
	/********************************************************************/	
		'blockRecord' => [
			'enabled' => true,
			'kickMessage' => "Nie wolno nagrywać!",
			'ignoredGroups' => [377],
			'ignoredIps' => ["12.12.12.12"],
			'ignoredCids' => ["12", "13"],
			'sleep' => 2,
		],	
		
		
	/*******************************************************************\
	*  		helpChannel     											*
	*   Zmienia nazwe kanału o danej godzinie i blokuje wejście na kanał pomocy  *
	/********************************************************************/		
		'helpChannel' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3509, // Channel id - id kanału
			'openTime' => "18:00", // Godzina o której ma otwierać kanał - Time to open channel
			'closeTime' => "20:00", // Godzina o której ma zamykać kanał - Time to close channel
			'channel_name_open' => "Centrum pomocy otwarte", // name if open
			'channel_name_close' => "Centrum pomocy zamknięte", // name is closed
		],
				
				
	/*******************************************************************\
	*  		afkChecker      											*
	*   Przenosi użytkownika i nadaje mu rangi gdy przekroczy czas AFK  *
	/********************************************************************/			
		'afkChecker' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'groupToAdd' => [349,350,351], // Groups to add
			'idle_time' => 3600, // Idle time to move / max czas afk
			'message' => "Zostałeś przeniesiony na kanał [b]AFK[/b]", // message after move
			'ignored_group' => 352, // ignored group, //ignorowana grupa
			'channelToMove' => 3839, // channel to move when afk - kanał gdzie ma przenieść
		],
		

	/*******************************
	*  		changeServerName       *
	*      Zmienia nazwę serwera   *
	********************************/	
		'changeServerName' => [
			'enabled' => true,  // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'serverName' => "⭐️ TSCuksy.pl Online: [ONLINE] ([PERCENT]%) | [2019-2020]⭐️", // Dostępne zmienne: [ONLINE], [MAX], [UPTIME], [PERCENT], [ALLCL]
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0], 
		],
		
		'changeHostMessage' => [
			'enabled' => true,
			// Dostępne zmienne: [ONLINE], [MAXCLIENTS], [UPTIME], [PERCENT], [SUMSPENTTIME]
			'message' => "[b][color=#F7AD00]» [/color][/b]Witamy na serwerze [b][color=#F707D7]TSCuksy.PL[/color][/b]\n[b][color=#F7AD00]» [/color][/b]Życzymy miłych rozmów! [UPTIME]",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 18], 
		],
			
			
	/*******************************
	*  		clock                  *
	*Ustawia godzinę w nazwie kanału*
	********************************/		
		'clock' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (fales - włączona, false - wyłączona) - Turn on or Turn off the function (fales - on, false - off)
			'channel_name' => "● Godzina: [time]", // Dostępne zmienne: [time]
			'top_desc' => "[b] Możesz wpisać tu jakiś opis kanału! ze zmienną godziny: [time][/b]", // Dostępne zmienne: [time]
			'channel_id' => 3702,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0], // Jak często ma zmieniać nazwę serwera			
		],
			
			
	/*******************************
	*  		upTime                *
	*Ustawia upTime w nazwie kanału*
	********************************/	
		'uptime' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3703,  // Id kanału gdzie ma zmieniać
			'channel_name' => "● Uptime: [uptime]",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],	
			

	/*******************************
	*  		Ping                *
	*Ustawia Ping w nazwie kanału*
	********************************/				
			
		'ping' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3704, // Id kanału gdzie ma zmieniać
			'channel_name' => "● Ping: [ping]", // Nazwa kanału
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0], // Co ile bot ma wykonywać funkcję
		],	
		
		
	/*******************************
	*  		packetLoss          *
	*Ustawia packetLoss w nazwie kanału*
	********************************/	
		'packetLoss' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3705, // Id kanału gdzie ma zmieniać
			'channel_name' => "● Utrata pakietów: [packets]",  // Nazwa kanału
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],
		
		
	/*******************************
	*  		data         *
	*Ustawia date w nazwie kanału*
	********************************/	
		'data' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3707,  // Id kanału gdzie ma zmieniać
			'channel_name' => "● Data: [time]",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],	
		
		
	/*******************************
	*  		channels         *
	*Ustawia ilosc kanalow w nazwie kanału*
	********************************/			
		'channels' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 7500,  // Id kanału gdzie ma zmieniać
			'channel_name' => "● Kanały: [channels]",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 1,'seconds' => 0],
		],
		
		
	/*******************************
	*  		onlineUsers        *
	*Ustawia ilosc osob w nazwie kanalu*
	********************************/	
		'onlineUsers' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'ip_display' => false,
			'channel_id' => 3709,  // Id kanału gdzie ma zmieniać
			'channel_name' => "● Użytkownicy online: [users]",
			'top_desc' => "[hr][center][b][color=#FF7700][size=15]» [color=#000000]Użytkownicy Online[/color] «[/size][/color][/b][/center][hr]\n\n",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],		
		
		
	/*******************************
	*  		COVID-19 INFORMACJE    *
	* Wpisuje statystyki do kanału *
	********************************/
		'covidInfo' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'country_code' => 'pl',
			'channel_id' => 8090,
			'description' => [ // Dostepne zmienne: [dzisiaj], [sdzisiaj], [smierci], [przypadki], [uratowanodzis], [uratowano], [aktywne], [ludzie], [maketest], [kraj]
				'top_desc' => "[hr][center][b][color=#FF7700][size=15]» [color=#000000]COVID-19[/color] «[/size][/color][/b][/center][hr]",
				
				'today_desc' => "\n[size=13]✅ Mamy [b][dzisiaj][/b] nowych i potwierdzonych przypadków zakażenia koronawirusa w 
								[kraj] w ciągu ostatniej doby.
								❌ Z przykrością informujemy o śmierci [b][sdzisiaj][/b] osób w dniu dzisiejszym z powodu koronawirusa.[/size]",
				'today_desc_without_dead' => "\n[size=13]✅ Mamy [b][dzisiaj][/b] nowych i potwierdzonych przypadków zakażenia koronawirusa w 
								[kraj] w ciągu ostatniej doby.[/size]",		
				'waiting' => "\n[size=13] Dzisiejsze statystyki, nie zostały podane jeszcze przez MZ.[/size]",				
				'desc' => "
							[right][size=5][i]Źródło: Ministerstwo Zrowia[/i][/size][/right][hr]
							[center][size=15] Statystyki wirusa COVID-19 w [kraj] [/size][/center]
							
							[size=13]Potwierdzone przypadki:[b][przypadki][/b]
							Potwierdzone śmierci:[b][smierci][/b]
							Uratowane osoby: [b][uratowano][/b]
							Aktywne przypadki: [b][aktywne][/b]
							Zrobionych testów: [b][maketest][/b]
							
							
							Potwierdzone przypadki dzisiaj:[b][dzisiaj][/b]
							Potwierdzone śmierci dzisiaj: [b][sdzisiaj][/b]
							Uratowane osoby dzisiaj: [b][uratowanodzis][/b]
							",
				],
				'channel_name' => '[cspacercov] COVID-19 (+ [dzisiaj])',
				'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 43],
			],
			
			
			
	/*******************************
	*  		 Pogoda 			  *
	* Wpisuje pogode do kanału    *
	********************************/			
		'weather' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'language' => 'pl',
			'country_code' => 'pl',
			'miasto' => 'Warsaw',
			'api_key' => '12c82af4ffafde960c8dc9c1d75ef24a',
			'channel_id' => 3891,
			'description' => [ // Dostępne zmienne: [opis] [temp]
				'top_desc' => "[hr][center][b][color=#FF7700][size=15]» [color=#000000]Pogoda w Warszawie[/color] «[/size][/color][/b][/center][hr]",
				'desc' => "\n[center][size=13]Aktualnie:[b] [temp][/b], [opis][/size][/center]\n[size=13]Dzisiaj [b][color=#FF0D0D]najwyższa[/color][/b] temperatura: [b][max][/b]\nDzisiaj [b][color=#0392FF]najniższa[/color][/b] temperatura: [b][min][/b]" 
				],
			'channel_name' => "[cspacerwet] [opis] [temp]", # Zmienne: [opis] [temp]
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5, 'seconds' => 56],
			],
		
		
	/*******************************
	*  		RandomName 			  *
	* Wpisuje np. partnerów do kanału    *
	********************************/			
		'randomName' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 1388,
			'names' => [
				0 => ['name' => '[cspacer]› Partner: tsApps.PL ‹', 'desc' => ''],
				1 => ['name' => '[cspacer]› Partner: soyoustart.com ‹', 'desc' => ''],
				2 => ['name' => '[cspacer]› Partner: Lvlup.PRO ‹', 'desc' => ''],
				3 => ['name' => '[cspacer]› Partner: SafeTSly.club ‹', 'desc' => ''],
				4 => ['name' => '[cspacer]› Partner: TeamSpeak.com ‹', 'desc' => ''],
				5 => ['name' => '[cspacer]› Partner: CandyApp.pl ‹', 'desc' => ''],
				],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5, 'seconds' => 0],
		],
		
		
	/**********************************
	* 		Connections 			  *
	**********************************/
		'connections' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3845,
			'channel_name' => "● Unikatowych połączeń: [count] ",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5, 'seconds' => 0],
			],
			
			
	/**********************************
	* 		onlineRecord			  *
	**********************************/
		'onlineRecord' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3848,
			'channel_name' => "[cspacer]› Rekord: [count] użytkowników ‹",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5, 'seconds' => 0],
			],
	
	
	/***************************************************************
	*  						checkMusicBot 						   *
	* Przenosi boty z poczekalni na dany kanał i ustala im nazwe   *
	****************************************************************/
		'checkMusicBot' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'group' => 113,
			'lobby_channel' => 1161, 
			'movetoChannel' => 1883,
			'commands' => [
				'1' => '!bot name TSCuksy.PL | #[db]',
				'2' => '!setting set connect.name TSCuksy.PL | #[db]',
				'3' => '!settings set connect.channel "/1883"',
				],	
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 0, 'seconds' => 21],
			],	
			
			
	/*************************************************************************************************************
	*  		 										checkQuery  *
	* Sprawdza czy jest odpowiednia ilość botów query i wysyła wiadomość na telegramie, jeśli jest ich za mało.  *
	**************************************************************************************************************/
		'checkQuery' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'telegram_api' => "1290869335:AAF9YyRcOOK1l5dnwfq4CHwVUzirWto5m4g", // API TOKEN
			'chat_id' => "1187937840", // ID CHATU Z TELEGRAMA
			'query_count' => 7, // ILE MINIMALNIE POWINNO BYĆ BOTÓW QUERY
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 25],
			],
			
			
			
	/*********************************************************
	*  					 createBackup   					 *			
	* Automatycznie tworzy backup i wysyła go na telegramie  *
	**********************************************************/					
		'createBackup' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'telegram_api' => "1290869335:AAF9YyRcOOK1l5dnwfq4CHwVUzirWto5m4g", // API TOKEN
			'chat_id' => "1187937840", // ID CHATU GDZIE MA WYSYŁAĆ
			'time_interval' => ['days' => 0,'hours' => 12,'minutes' => 0,'seconds' => 0],
			],	


		
	/*********************************************************
	* 							info 						 *
	*  WYSYŁA INFORMACJE O DZIAŁANIU SERWERA NA TELEGRAMA    *
	**********************************************************/
		'info' => [ // AUTOMATYCZNY BACKUP I WYSYŁANIE GO NA TELEGRAMA
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'telegram_api' => "1290869335:AAF9YyRcOOK1l5dnwfq4CHwVUzirWto5m4g", // API TOKEN
			'chat_id' => "1187937840", // ID CHATU GDZIE MA WYSYŁAĆ
			'time_interval' => ['days' => 0,'hours' => 12,'minutes' => 0,'seconds' => 0],
			],



	/**********************************************
	*  		 queryUsers 						  *
	* Wpisuje użytkowników online query do kanału *
	***********************************************/
		'queryUsers' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3713,  // Id kanału gdzie ma zmieniać
			'channel_name' => "• SQ: [users]",
			'top_desc' => "[hr][center][b][color=#FF7700][size=15]» [color=#000000]Query Online[/color] «[/size][/color][/b][/center][hr]\n\n",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 46],
			],
			
			
	/***************************************************************************************************************************
	*  														 getCreate 														   *
	* Przenosi na dany kanał np. gildyjne osobe z dopiskiem "lider" w nicku tylko jeśli na kanale jest odpowiednia liczba osób *
	****************************************************************************************************************************/
		'getCreate' => [
			'enabled' => true,
			'leaderNickContains' => "lider",
			'channels' => [
				'1' => ['id' => 3658, 'count' => 5, 'idToMove' => 1147],
				'2' => ['id' => 3659, 'count' => 8, 'idToMove' => 1149],
				'3' => ['id' => 7502, 'count' => 20, 'idToMove' => 2776],

			],
		],
	
	
	/**************************************************
	*  					usersFromGroups   		      *
	* Wyświetla użytkowników online z grupy na kanale *
	***************************************************/	
		'usersFromGroups' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channels' =>
			[
				'1' => ['group' => 81, 'id' => 3847, 'name' => '● Boty Muzyczne: [ONLINE]/[MAX]', 'top_desc' => "[center][size=15]Osoby z grupy: [GROUP][/size][/center][hr]"],
			],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
			],


	/**************************************************
	*  					checkVersion   		      *
	* Sprawdza czy jest aktualizacja TeamSpeak server *
	***************************************************/	
		'checkVersion' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'telegram_api' => "1290869335:AAF9YyRcOOK1l5dnwfq4CHwVUzirWto5m4g", // API TOKEN
			'chat_id' => "1187937840", // ID CHATU GDZIE MA WYSYŁAĆ
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],
	
	
	/**************************************************
	*  					adminStatus   		      *
	* Informuje czy dany admin jest online na serwerze *
	***************************************************/
		'adminsStatus' => [ // Funckja musi być włączona do działania funckji aboutAdmins
			'sleep' => 1,
			'enabled' => true, // Włączyć czy wyłączyć funkcję
			'afk' => '✈', // Co ma się wyświetlać, gdy osoba jest AFK
			'online' => '✔', // Co ma się wyświetlać, gdy osoba jest Online
			'offline' => '✖', // Co ma się wyświetlać gdy osoba jest Offline.
			'top_desc' => "
			
			
			[center][size=15][GROUP]
			[/size][size=15][b][NICK][/b][/size][/center][size=10][hr]
			[b][color=#FF7803]✖[/color][/b] Profil: [URL=https://tscuksy.pl/Profile/[DBID]](Kliknij tutaj)[/URL]
			[b][color=#FF7803]✖[/color][/b] Id z bazy danych:[b] [DBID][/b]
			[b][color=#FF7803]✖[/color][/b] Unikalne ID: [b][UQID][/b]
			[b][color=#FF7803]✖[/color][/b] Ilość połączeń: [b][CONNECTIONS][/b]
			[b][color=#FF7803]✖[/color][/b] Spędzony czas: [b][SPENT][/b]
			[b][color=#FF7803]✖[/color][/b] Pierwsze połączenie: [b][FIRSTCONNECT][/b]
			[b][color=#FF7803]✖[/color][/b] Opis: [b][DESC][/b]
			[b][color=#FF7803]✖[/color][/b] Nadane grupy: [b][ADDGR][/b]
			[b][color=#FF7803]✖[/color][/b] Zdjęte grupy: [b][DELGR][/b]
			[/size]", 
			
			
			
			//Dostępne zmienne: [GROUP], [NICK], [DBID], [UQID], [CONNECTIONS], [FIRSTCONNECT],  [DESC]
			'channel_name' => "٠ [[GROUP]] [NICK] - [STATUS]", // Jak ma wyglądać nazwa kanału.
			'admins' => [
				
				1 => ['group' => 315, 'channel_id' => 1917, 'dbid' => 13], // lukieer // 'group' => Id grupy administracyjnej, 'channel_id' => Id kanału gdzie ma zmienić, 'dbid' => Id z bazy administratora
				2 => ['group' => 211, 'channel_id' => 8208, 'dbid' => 1777],  // dominik
				3 => ['group' => 211, 'channel_id' => 5937, 'dbid' => 856], // pexel
				4 => ['group' => 264, 'channel_id' => 5883, 'dbid' => 2400], // sdomino
				5 => ['group' => 310, 'channel_id' => 1925, 'dbid' => 190], 
				6 => ['group' => 264, 'channel_id' => 6557, 'dbid' => 196], // mickman
				7 => ['group' => 265, 'channel_id' => 2137, 'dbid' => 1755], // kamil
				8 => ['group' => 283, 'channel_id' => 9541, 'dbid' => 1754], // shadeq
				9 => ['group' => 283, 'channel_id' => 11007, 'dbid' => 2952],
				
				],
		],
		
		

		
	/**********************************************
	*  		 registerUsers 						  *
	* Wpisuje użytkowników zarejestrowanych do kanału *
	***********************************************/
		'registerUsers' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'registerGroup' => 75,
			'channel_id' => 3500,  // Id kanału gdzie ma zmieniać
			'channel_name' => "● Zarejestrowanych: [register]",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
			],
			
			
	/**********************************************
	*  		 adminsOnline					  *
	* Wpisuje aktywnych administratorów do opisu kanału *
	***********************************************/			
		'adminsOnline' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 2499,
			'channel_name' => "› Wsparcie: [online]", // Dostępne zmienne: [all], [online]
			'top_desc' => "[hr][center][b][color=#FF7700][size=15]» [color=#000000]Dostępna administracja[/color] «[/size][/color][/b][/center][hr]",
			'adminsGroups' => [315,583,688,310,671,211,264,265,285,283,718],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
			],
			
			
	/**********************************************
	*  		 adminList							  *
	* Wpisuje listę administratorów w opis kanału *
	***********************************************/	
		'adminList' => [
			'enabled' => false, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 3849,
			'channel_name' => "● Lista administracja: [online]/[all]", // Dostępne zmienne: [all], [online]
			'top_desc' => "[hr][center][b][color=#FF7700][size=15]» [color=#000000]Lista administracji[/color] «[/size][/color][/b][/center][hr]",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 1],
			],	
			
			
	/**********************************************
	*  		 banList					  *
	* Wpisuje aktywnych administratorów do opisu kanału *
	***********************************************/
		'banList' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'channel_id' => 1129,
			'top_desc' => "[hr][center][b][color=#FF7700][size=15]» [color=#000000]Lista banów[/color] «[/size][/color][/b][/center][hr]\n\n",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 3,'seconds' => 0],
		],
		
		
	/**********************************************
	*  		 youtube				  *
	* Informacje o danym youtuberze w opisie kanału *
	***********************************************/
		'youtube' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'api_key' => 'AIzaSyCl-jDLonIyEhU9KJuNmGTrkuzCFSWhnpw',
			'top_desc' => "[hr][center][size=13][b]Kanał YT[/b][/size][/center][hr]",
			'yt_desc' => '\n[center][size=15][b][NAME][/size][/center]\n[table]\n[tr]\n[td][LOGO][/td]\n[td][size=10][b][color=#FF6F00]✖[/color][/b] Liczba subskrypcji: [b][SUBS][/b]\n[b][color=#FF6F00]✖[/color][/b] Liczba wyświetleń: [b][VIEWS][/b]\n[b][color=#FF6F00]✖[/color][/b] Liczba filmów: [b][VIDEOS][/b]\n[b][color=#FF6F00]✖[/color][/b] Kanał utworzono: [b][CREATED][/b]\n[b][color=#FF6F00]✖[/color][/b] Opis kanału: \n[b][color=#9C9C9C][DESC][/color][/b]\n[/td][/tr][/table]
			',
			
			'yt_name' => '● [NAME]: [SUBS] subów',
			'channels' => 
				[
				'1' => ['yt_channel_id' => 'UCWOXOP0sL7iizPspONjDRyQ', 'channel_id' => 6787],
				'2' => ['yt_channel_id' => 'UC1GE9PJG2PrNhqsGv-RT6og', 'channel_id' => 9695],
				//'3' => ['yt_channel_id' => 'UCmJICzQIRqRIDQjWAbN7nYA', 'channel_id' => 3844],
				],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
			],
		
		
	/*************************************************************************************
	*  		 saveUser					 												 *
	* Funkcja zapisująca dane użytkowników ( wymagana do wszystkich poniższych funkcji ) *
	**************************************************************************************/
		'saveUsers' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 1,'seconds' => 0], // Jak często ma wpisywać użytkowników do bazy danych
		],
	]
];



/*****************************************************************************************
*																						 *
* 							Instancja 2 - LiveHelp										 *
*																						 *
******************************************************************************************/
$config[2] = [

'connection' => [
	'ip' => '51.77.49.96', // IP SERWERA
	'queryPort' => '10011', // PORT QUERY SERWERA
	'login' => 'querylivehelp', // LOGIN QUERY
	'password' => 'ljoAkDrA', // HASŁO QUERY
	'port' => '9987', // PORT SERWERA
	'nickname' => 'Helper', // NICK BOTA
	'channel' => '2900', // KANAŁ NA KTÓRYM BOT MA SIEDZIEĆ
	'idle' => '1400000', // CZAS JAKI MA ODCZEKAĆ BOT PO WYKONANIU WSZYSTKICH FUNKCJI
],

	'functions' => [
		'audioBot' => [
			'enabled' => true,// Włączyć czy wyłączyć funkcję (true - włączona, false - wyłączona) - Turn on or Turn off the function (true - on, false - off)
			'commander' => true, // Send a commander command when commander is off?
			'commander_cmd' => '!bot commander on', // Commander command
			'group' => 113, // MusicBot group
			'idle' => 10, // Idle time a musicbot to send a cmds
			'cmds' => [ // Cmds to execute
			
				['dbid' => 1248, 'cmd' => '!play http://31.192.216.5:80/rmf_maxxx'],
				['dbid' => 1936, 'cmd' => '!play http://31.192.216.5:80/rmf_maxxx'],
				['dbid' => 1251, 'cmd' => '!play https://stream.open.fm/2'],
				['dbid' => 1249, 'cmd' => '!play http://waw01-01.ic.smcdn.pl:8000/t042-1.mp3'],
				['dbid' => 2432, 'cmd' => '!play https://stream.open.fm/33'],
			
			],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],
		'liveHelp' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję
			'telegram_api' => "1393792850:AAHFotfGQ3k5jpCQidyCPPZt5l-dqiQjR7U", // API TOKEN
			'chat_id' => "1187937840", // ID CHATU GDZIE MA WYSYŁAĆ
			'bot_dbid' => 2459,
			'supporter_group' => 865,
			'supporter_group_chat' => [315,583,688,310,671,211,264,265,283,718],
			'channel_to_move' => 1377,// Id kanału gdzie ma przeniesc
			'no_admins' => "https://info.tscuksy.pl/brakadminow1.wav", // Link co ma odtworzyć gdy nikogo nie ma z administracji
			'time_no_admins' => 6, // Czas ile trwa
			'yes_admins' => "https://info.tscuksy.pl/prosimyochwile1.wav", // Co ma odtworzyć gdy jest administracja
			'time_yes_admins' => 8, // Czas ile trwa
			'after' => "https://info.tscuksy.pl/poczekaj1.wav",
			'after_time' => 15,
			'channel_id' => 1148,
			
		],
		'nearPeople' => [
			'ignoredGroups' => [113],
			'enabled' => true,
			'sleep' => 30,
			],
		'renderPeople' => [
			'enabled' => true,
			'channel_id' => 1891,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 1],
		],
		'usersFromMyCity' => [
			'enabled' => true,
			'group' => 884,
			'channel_id' => 10968,
		],
		'imieniny' => [
			'enabled' => true,
			'channel_id' => 11521,
			'channel_name' => 'Im: [IM]',
			'time_interval' => ['days' => 0,'hours' => 1,'minutes' => 0,'seconds' => 0],
		],
	],
	
];

/*****************************************************************************************
*																						 *
* 							Instancja 3 - Guild Manager									 *
*																						 *
******************************************************************************************/
$config[3]= [

 'connection' => [
	'ip' => '51.77.49.96', // IP SERWERA
	'queryPort' => '10011', // PORT QUERY SERWERA
	'login' => 'administratasd$#@', // LOGIN QUERY
	'password' => 'txNMBzzx', // HASŁO QUERY
	'port' => '9987', // PORT SERWERA
	'nickname' => 'Clans', // NICK BOTA
	'channel' => '2900', // KANAŁ NA KTÓRYM BOT MA SIEDZIEĆ
	'idle' => '120000', // CZAS JAKI MA ODCZEKAĆ BOT PO WYKONANIU WSZYSTKICH FUNKCJI
],


	'onChat' => [
	/**********************************************************************************************
	*  					Commands for guild leader								                  *
	*				 Komendy dla liderów gidlii                 						 		  *
	***********************************************************************************************/		
		'helpCMD' => [ // Komenda !help
			'enabled' => true,
			'messages' => [
				2 => 'Aby założyć gildię, udaj się na kanał: [URL=channelid://3497]Kanał Gildia - 5 osób[/URL] [b]z 5 osobami![/b]',
				3 => 'Aby zmienić nazwę swojej gildii, użyj !rename <newname>',
				4 => 'Aby przywołać wszystkich użytkowników twojej gildii użyj !meeting',
				5 => 'Aby napisać do wszystkich użytkowników swojej gildii użyj !msgall <wiadomosc>',
			],
		],
		
		'renameCMD' => [ // Komenda !rename
			'enabled' => true,	
		],
		'meetingCMD' => [ // Komenda !meeting
			'enabled' => true,
		],
		'msgallCMD' => [ // Komenda !msgall
			'enabled' => true,
		],	
		
	],

	'onServerJoin' => [
	/**********************************************************************************************
	*  						Send a welcome message for leader when his join server                *
	*				 Wysyła wiadomość powitalną do liderów gildii						 		  *
	***********************************************************************************************/	
		'welcomeForLeader' => [
			'enabled' => false,
			'messages' => [
				3 => 'Aby zmienić nazwę swojej gildii, użyj [b]!rename <newname>[/b]',
				4 => 'Aby przywołać wszystkich użytkowników twojej gildii użyj [b]!meeting[/b]',
				5 => 'Aby napisać do wszystkich użytkowników swojej gildii użyj [b]!msgall <wiadomosc>[/b]',	
				],
			],
			
			
	/**********************************************************************************************
	*  						Teleport user to guild channel after server join 	 		      	  *
	*						Przenosi użytkownika na kanał gildyjny po wejściu na serwer			  *
	***********************************************************************************************/
		'teleport' => [ 
			'enabled' => false,
			'ignoredGroups' => [377],
			'ignoredIps' => ["12.12.12.12"],
			'message' => "Zostałeś automatycznie przeniesiony na swój [b]kanał gildyjny[/b]",
		],
	],			
		
	'functions' => [
	
		'assignGroup' => [
			'enabled' => true,
			'defaultChannelGroup' =>8,
			'leaderChannelGroup' => 5,
			'verifedChannelGroup' => 16,
			],
			
			
	/**********************************************************************************************
	*  						Revoke guild group after join revoke channel	 		      		  *
	*				 Zdejmuje grupę gildyjną po wejściu na kanał zdejmowania rangi. 			  *
	***********************************************************************************************/				
		'revokeGroup' => [
			'enabled' => true,
			'leaderChannelGroup' => 5,
			'defaultChannelGroup' => 8,
			],

			
	/**********************************************************************************************
	* 						Display online users in channel name and description 		      	  *
	*				 Wyświetla ilość osób online oraz ich listę w opisie na kanale gildyjnym. 	  *
	***********************************************************************************************/	
		'onlineFromGuild' => [
			'enabled' => true,
			'channel_name' => "[cspacer[NAME]] ✖ Online [ONLINE]/[MAX] ✖",
			'top_desc' => "[center][size=16] [TYPE] [b][NAME][/b] - użytkownicy[/size][/center][hr]\n",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 1,'seconds' => 0],	
			],
			
			
	/**********************************************************************************************
	*  								Check guild number 	 		      			                  *
	*				 Sprawdza numer gildii w nazwie kanału						 				  *
	***********************************************************************************************/			
		'checkNumbersGuild' => [
			'enabled' => true,
			'desc' => "[center][size=16] [TYPE] [b][NAME][/b][hr][size=13][b][color=#FA7D00]✖[/color][/b] Lider: [b][LEADER][/b]\n[b][color=#FA7D00]✖[/color][/b] Stworzona dnia: [b][DATE][/b][/size][/center]",
			'channel_name' => "[cspacer[NAME]]✖ [TYPE] #[NUMBER] ✖",
			],
			
			
	/**********************************************************************************************
	*  					Display guild statisctic in channel for stats 		      			 	  *
	*					 Wyświetla statystyki gildii w opisie kanału 							  *
	***********************************************************************************************/	
		'guildStats' => [
			'enabled' => true,
			'desc' => "[center][size=15]✖ [TYPE]: [b][NAME][/b] ✖ [/size][hr][size=13][b][color=#FA7D00]✖[/color][/b] Spędzony czas: [b][SPENT][/b]\n[size=13][b][color=#FA7D00]✖[/color][/b] Łączna liczba połączeń z serwerem: [b][CONNECTIONS][/b][/size][/center]",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
			],
			
			
	/**********************************************************************************************
	*  									Create te guild channel		      					      *
	*									 Tworzy kanał gildyjny 			 						  *
	***********************************************************************************************/				
		'guildCreator' => [
			'enabled' => true, // Włączyć czy wyłączyć funkcję
			'musicbotcid' => 1883,
			'assign_name' => "• Nadaj rangę",
			'revoke_name' => "• Zdejmij rangę",
			'teleport_name' => "• Spawn",
			'mode' => 4, // 5 - Very slow 4 - Slow, 3 - Normal, 2 - Speed, 1 - without delay 
			'groupToCopy' => 418, // Grupa, którą ma kopiować podczas tworzenia gildii
			'leaderChannelGroup' => 5, // ID grupy kanałowej, którą ma dostać lider
			'allSectors' => [ // Wszystkie sektory gildyjne
				'1' => [
					'musicBots' => 1,
					'name' => "Gildia", // Nazwa strefy
					'channelId' => 357111, // ID kanału, gdzie użytkownik musi wejść, aby otrzymać kanał
					'channelFirst' => 5830111, // Pierwszy kanał
					'channels' => [ // Lista kanałów
									
						'1' => [ 
							'channelName' => "[cspacer[NAME]]↓––––––––– ★ –––––––––↓", // Nazwa kanału
							'neededJoinPower' => 3, // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						'channel_first' => true, // Określa że kanał jest pierwszy (Może być tylko jeden w każdym sektorze)
						],
							
						'2'	=> [
							'channelName' => "[cspacer[NAME]]✖ Gildia #[NUMBER] ✖", // Nazwa kanału
							'neededJoinPower' => 3,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
							
						'channel_counter' => true, // Określa że kanał będzie zawierał w sobie liczbę (Może być tylko jeden w każdym sektorze)
						],
						
						'3' => [
							'channelName' => "[cspacer[NAME]]✖ [NAME] ✖", // Nazwa kanału
							'neededJoinPower' => 3,  // Needed Join Power
							'maxClients' => 0,  // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						],
						
						'4' => [
							'channelName' => "[cspacer[NAME]]✖ Online [ONLINE]/[MAX] ✖", // Nazwa kanału
							'neededJoinPower' => 3,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						'channel_online' => true, // Określa że kanał będzie wyświetlał ilość osób online i osób offline.  (Może być tylko jeden w każdym sektorze)
						],
						
						'5' => [ 
							'channelName' => "[cspacer[NAME]]✖ Statystyki Gildii ✖", // Nazwa kanału
							'neededJoinPower' => 3,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						'channel_stats' => true,  // Określa że kanał będzie wyświetlał statystyki osób online i osób offline.  (Może być tylko jeden w każdym sektorze)
						],

						
						'6' => [
							'channelName' => "[cspacer[NAME]]↑––––––––– ★–––––––––↑", // Nazwa kanału
							'neededJoinPower' => 3,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						],
						
						'7' => [
							'channelName' => "[cspacer[NAME]]× Automatyzacja ×", // Nazwa kanału
							'neededJoinPower' => 3,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						'channels_control' => true,  // Określa że kanał będzie zawierał funkcję automatyzacji  (Może być tylko jeden w każdym sektorze)
						],
						
						'8' => [
							'channelName' => "[cspacer[NAME]]Kanały główne", // Nazwa kanału
							'neededJoinPower' => 3,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 3, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						'channel_main' => true,  // Określa że kanał będzie głównym kanałem. (Może być tylko jeden w każdym sektorze)
						],
						'9' => [
							'channelName' => "[cspacer[NAME]]Rekrutacja", // Nazwa kanału
							'neededJoinPower' => 0,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 3, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						],
						'10' => [
							'channelName' => "[*spacer[NAME]]...", // Nazwa kanału
							'neededJoinPower' => 0,  // Needed Join Power
							'maxClients' => 0, // Maksymalna ilość klientów (domyślnie 0 - np. grupa kanałowa zweryfikowany omija ten limit)
							'subChannels' => 0, // Ilość subkanałów pod tym kanałem
							'subChannelName' => ". Podkanał",
						'channel_is_last' => true, // Określa że kanał będzie ostatnim kanałem. (Może być tylko jeden w każdym sektorze)
						],
					],
				],
				'2' => [
					'musicBots' => 2,
					'name' => "Premium",
					'channelId' => 7969,
					'channelFirst' => 7961,
					'channels' => [
									
						'1' => [ 
							'channelName' => "[cspacer[NAME]]↓––––––––– ★ –––––––––↓",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
						'channel_first' => true,
						],
							
						'2'	=> [
							'channelName' => "[cspacer[NAME]]» Premium #[NUMBER] «",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
							
						'channel_counter' => true,
						],
						
						'3' => [
							'channelName' => "[cspacer[NAME]]» [NAME] «",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
						],
						
						'4' => [
							'channelName' => "[cspacer[NAME]]» Online [ONLINE]/[MAX] «",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
						'channel_online' => true,
						],
						
						'5' => [ 
							'channelName' => "[cspacer[NAME]]» Statystyki [NAME] «",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
						'channel_stats' => true,
						],

						
						'6' => [
							'channelName' => "[cspacer[NAME]]↑––––––––– ★–––––––––↑",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
						],
						
						'7' => [
							'channelName' => "[cspacer[NAME]]× Automatyzacja ×",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
						'channels_control' => true,
						],
						'8' => [
							'channelName' => "[cspacer[NAME]]Liderówka",
							'neededJoinPower' => 1000,

							'maxClients' => 0,
							'subChannels' => 4,
							'subChannelName' => ". Podkanał",
						'channel_main' => true,		
						],
						'9' => [
							'channelName' => "[cspacer[NAME]]Kanał główny",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 4,
							'subChannelName' => ". Podkanał",
						'channel_main' => true,
						],
						'10' => [
							'channelName' => "[cspacer[NAME]]Dodatkowe",
							'neededJoinPower' => 3,

							'maxClients' => 0,
							'subChannels' => 6,
							'subChannelName' => ". Podkanał",
						],
						'11' => [
							'channelName' => "[cspacer[NAME]]Rekrutacja",
							'neededJoinPower' => 0,

							'maxClients' => 0,
							'subChannels' => 3,
							'subChannelName' => ". Podkanał",
						],
						'12' => [
							'channelName' => "[*spacer[NAME]]...",
							'neededJoinPower' => 0,

							'maxClients' => 0,
							'subChannels' => 0,
							'subChannelName' => ". Podkanał",
						'channel_is_last' => true,
						],
					],
				],
			],
		],
	],
];
/*****************************************************************************************
*																						 *
* 							Instancja 4 - Stats										 *
*																						 *
******************************************************************************************/		
$config[4]= [

 'connection' => [
	'ip' => '51.77.49.96', // IP SERWERA
	'queryPort' => '10011', // PORT QUERY SERWERA
	'login' => 'adasdSTATSsfdsad$*#@(SHI', // LOGIN QUERY
	'password' => 'k7uthrok', // HASŁO QUERY
	'port' => '9987', // PORT SERWERA
	'nickname' => 'Stats', // NICK BOTA
	'channel' => '2900', // KANAŁ NA KTÓRYM BOT MA SIEDZIEĆ
	'idle' => '1200000', // CZAS JAKI MA ODCZEKAĆ BOT PO WYKONANIU WSZYSTKICH FUNKCJI
],

	'onChat' => [
		'registerCSGO' => [
			'enabled' => true,
			],
		],

	'onServerJoin' => [
	
		'topConnections' => [
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [81],
			'enabled' => false,
		],
	],
		
	'functions' => [
		'adminStats' => [
			'enabled' => true,
			'user' => "[I]. [b][NICK][/b] nadał [b][color=#FF0000][ADDED][/color][/b] grup!\n",
			'top_desc' => "[center][size=13][b]Top 10 NADANYCH GRUP[/b][/size][/center]\n[hr]\n",
			'channel_id' => 11023,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],
		
		'helpCount' => [
			'enabled' => true,
			'groups' => [315,583,688,310,671,211,264,265,285,283,718],
			'channel_helps' => [1901, 1903],
			'channel_id' => 11024,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 10],
			],
		'renderDescHelp' => [
			'enabled' => true,
			'user' => "[I]. [b][NICK][/b] spędził [b][color=#FF0000][TIME][/color][/b] czasu na kanale pomocy!\n",
			'top_desc' => "[center][size=13][b]Top 10 SPEŁNIONEJ POMOCY[/b][/size][/center]\n[hr]\n",
			'channel_id' => 11024,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],
		'helpRanks' => [
			'enabled' => true,
			'rank' => 903,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 20,'seconds' => 10],
		],
	
		'csgoStats' => [
			'user' => "[I]. [b][NICK][/b] zabił aż [b][color=#FF0000][KILLS][/color][/b] osób!\n",
			'top_desc' => "[center][size=13][b]Top 10 KILLI W CSGO[/b][/size][/center]\n[hr]\n",
			'channel_id' => 11000,
			
			'top_desc_times' => "[center][size=13][b]Top 10 CZASU W CSGO[/b][/size][/center]\n[hr]\n",
			'user_time' => "[I]. [b][NICK][/b] spędził aż [b][color=#FF0000][TIME][/color][/b]!\n",
			'channel_id2' => 11006,
			
			'enabled' => true,
			
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],
		'csgoRanks' => [
			'enabled' => true,
			'rank' => 886,
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 6,'seconds' => 0],
			],
	
		'registerAfterTime' => [
			'enabled' => false,
			'registerGroups' => [169, 75, 154, 103],
			'time' => 30, // Czas spędzony w minutach
			'message' => 'Spędziłeś z nami [b][TIME][/b] minut, więc zostałeś zweryfikowany!',
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [], // Jeśli w topSpentTime jest ignore, to tutaj też.
			'sleep' => 5,
		],
	
		'addedGroups' => [
			'sleep' => 3,
			'enabled' => true,
		],
		
		'awards' => [
			'enabled' => false,
			'sleep' => 3,
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [81, 253],
			'awards' => [
				'topConnections' => [
					'enabled' => true,
					'allGroups' => [198,181,182,183,184,185],
					'ranks' => [
						1 => ['connections' => 1,'rank' => 198,'message' => "Gratulacje! Zdobyłeś nowe osiągnięcie: 1 połączenie z serwerem!"],
						2 => ['connections' => 10, 'rank' => 181,'message' => "Gratulacje! Zdobyłeś nowe osiągnięcie: 10 połączeń z serwerem!"],
						3 => ['connections' => 50,'rank' => 182,'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 50 połączeń z serwerem!"],
						4 => ['connections' => 100, 'rank' => 183,'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 100 połączeń z serwerem!"],
						5 => ['connections' => 500,'rank' => 184,'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 500 połączeń z serwerem!"],
						6 => ['connections' => 1000,'rank' => 185,'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 1000 połączeń z serwerem!"],
					],
				],
				'topSpentTime' => [
					'enabled' => true,
					'allGroups' => [186,187,188,189,190,191],
					'ranks' => [
						1 => ['hours' => 1,'rank' => 186,'message' => "Gratulacje! Zdobyłeś nowe osiągnięcie: 1 spędzona godzina!"],
						2 => ['hours' => 10, 'rank' => 187, 'message' => "Gratulacje! Zdobyłeś nowe osiągnięcie: 10 spędzonych godzin!"],
						3 => ['hours' => 50, 'rank' => 188, 'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 50 spędzonych godzin!"],
						4 => ['hours' => 100, 'rank' => 189, 'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 100 spędzonych godzin!"],
						5 => ['hours' => 500,'rank' => 190, 'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 500 spędzonych godzin!"],
						6 => ['hours' => 1000,'rank' => 191, 'message' => "Gratulacje! Zdobyłeś nowe osiągniecie: 1000 spędzonych godzin!"],
					],
				],
			],
		],
	
		'topSendedBytes' => [
			'enabled' => true,
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [113],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 1],	
		],
	
		'topSpentTime' => [
			'enabled' => false,
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [81],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 3,'seconds' => 0],
		],
		'topConnectionTime' => [
			'enabled' => false,
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [81],
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 3,'seconds' => 0],
		],
		'levels' => [
			'enabled' => false,
			'ignoredIps' => ["12.12.12.12"],
			'ignoredGroups' => [81],
			'levels' => [
				
				1 => [104, 1 * 60 * 60], #numer poziomu -> [grupa, czas w sekundach (np. 1 * 60 * 60 = 1 godzina, 24 * 60 * 60 = 1 dzień itd.)
				2 => [105, 2 * 60 * 60],
				3 => [106, 12 * 60 * 60],
				4 => [107, 1 * 24 * 60 * 60],
				5 => [108, 2 * 24 * 60 * 60],
				6 => [109, 3 * 24 * 60 * 60],
				7 => [110, 5 * 24 * 60 * 60],
				8 => [111, 8 * 24 * 60 * 60],
				9 => [112, 10 * 24 * 60 * 60],
				10 => [113, 15 * 24 * 60 * 60],
				11 => [127, 20 * 24 * 60 * 60],
				12 => [128, 25 * 24 * 60 * 60],
				13 => [129, 30 * 24 * 60 * 60],
				14 => [130, 35 * 24 * 60 * 60],
				15 => [131, 40 * 24 * 60 * 60],
				16 => [132, 45 * 24 * 60 * 60],
				17 => [133, 50 * 24 * 60 * 60],
				18 => [134, 55 * 24 * 60 * 60],
				19 => [135, 60 * 24 * 60 * 60],
				20 => [136, 80 * 24 * 60 * 60],
				21 => [343, 120 * 24 * 60 * 60],
				
			],
				
		],
		
		
		'renderDesc' => [
			'enabled' => true,
			
			'topConnections' => [
				'user' => "[I]. [b][NICK][/b] połączył się z serwerem [b][color=#FF0000][CONS][/color][/b] razy!\n",
				'channel_id' => 331190,
				'top_desc' => "[center][size=13][b]Top 10 POŁĄCZEŃ Z SERWEREM[/b][/size][/center]\n[hr]\n",
			],
			
			'topSpentTime' => [
				'user' => "[I]. [b][NICK][/b] spędził na serwerze [b][color=#FF0000][TIME][/color][/b] !\n",
				'channel_id' => 3311188,
				'top_desc' => "[center][size=13][b]Top 10 SPĘDZONEGO CZASU[/b][/size][/center]\n[hr]\n",
			],
			
			'topConnectionTime' => [
				'channel_id' => 3381117,
				'top_desc' => "[center][size=13][b]Top 10 NAJDŁUŻSZE POŁĄCZENIE[/b][/size][/center]\n[hr]\n",
				'user' => "[I]. [b][NICK][/b] - [b][color=#FF0000][TIME][/color][/b] bez wychodzenia z serwera!\n",
			],
			'topLevel' => [
				'user' => "[I]. [b][NICK][/b] - [b][color=#FF0000][LVL][/color][/b] poziom!\n",
				'channel_id' => 331189,
				'top_desc' => "[center][size=13][b]Top 10 NAJWYŻSZY POZIOM[/b][/size][/center]\n[hr]\n",
			],
			'topSendedBytes' => [
				'user' => "[I]. [b][NICK][/b] - [b][color=#FF0000][B][/color][/b] wysłanych bajtów!\n",
				'channel_id' => 9764,
				'top_desc' => "[center][size=13][b]Top 10 WYSŁANYCH BAJTÓW[/b][/size][/center]\n[hr]\n",
			],
			
			
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0],
		],

		
	],
		
];
/*****************************************************************************************
*																						 *
* 							Instancja 5 - Admin									 *
*																						 *
******************************************************************************************/		
$config[5]= [

 'connection' => [
	'ip' => '51.77.49.96', // IP SERWERA
	'queryPort' => '10011', // PORT QUERY SERWERA
	'login' => 'administratasd$#@', // LOGIN QUERY
	'password' => 'txNMBzzx', // HASŁO QUERY
	'port' => '9987', // PORT SERWERA
	'nickname' => 'Administrat', // NICK BOTA
	'channel' => '2900', // KANAŁ NA KTÓRYM BOT MA SIEDZIEĆ
	'idle' => '1200000', // CZAS JAKI MA ODCZEKAĆ BOT PO WYKONANIU WSZYSTKICH FUNKCJI
],
	'musicBot' => [
		'enabled' => true,
		],
	'functions' => [

		'ddosWarning' => [
			'enabled' => true,
			'mode' => 2, // 1 - Wysyła wiadomość na czacie serwerowym, 2 - wysyła wiadomość do danych grup na pv.
			'groups' => [315,583,688,310,671,211,264,265,285,283,718], // Jeśli type = 2
			'max_packets' => 5, //maksymalna ilość pakietów przed wysłaniem wiadomości
			'telegram_api' => "1393792850:AAHFotfGQ3k5jpCQidyCPPZt5l-dqiQjR7U", // API TOKEN
			'chat_id' => "1187937840", // ID CHATU GDZIE MA WYSYŁAĆ
			'message' => "[b]UWAGA![/b] Ilość pakietów została przekroczona. Prawdopodobnie jesteśmy w trakcie ataku DDoS",
			'time_interval' => ['days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 45],
		],
		'zone_generator' => [
			'enabled' => true,
			'zones' => [
				1 => [
				  'emptyspacer' => "[*spacer[NICK]]",
				  'get_channel_id' => 2836,
				  'name' => 'Partner',
				  'subChannels' => 3,
				  'subChannelName' => '[num]. Podkanał',
				  'first_channel' => 9564,
				  'maxClients' => 0,
				  'cname' => "[NAME]: [NICK]",
				  'youtube_desc_link' => true, // Jeśli opis jest pusty, kanał nie zostanie podpięty. W opisie kanału musi być Youtube ID (to co jest bo youtube.com/channel/<id>
				  'message' => 'Dziękujemy za zostaniem sponsorem naszego serwera. Twoje hasło do kanałów to: [PASS], możesz je zmienić.',
				  'desc' => "[hr][center][size=13][b]Kanał Partnera - [NICK][/b][/size][/center][hr]",
				],
			],
		],
	],
	'onChat' => [
		'createBot' => [
			'enabled' => true,
			'bots_channel' => 1883,
			'allowgroups' => [315,583,688,310,671,211,264,265,285,283,718],
			],
		'banlistCMD' => [
			'enabled' => true,
			'allowgroups' => [315,583,688,310,671,211,264,265,285,283,718],
		],
		'unbanCMD' => [
			'enabled' => true,
			'allowgroups' => [315,583,688,310,671,211,264,265,285,718],
		],
		'restartCMD' => [
			'enabled' => true,
			'allowgroups' => [315],
		],
	],
];



?>