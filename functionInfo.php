<?php
function functionInfo($ts){

	global $config, $footer;
	$desc = "";
	
	$desc .= "\n\n[hr][center][b][size=15] Instancja 1[/size][/b][/center][hr]";
	
	if(isset($config[1]['onMove'])){
		$desc .= "\n\n[b]Funkcje onMove:[/b]\n";
		foreach($config[1]['onMove'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	if(isset($config[1]['functions'])){
		$desc .= "\n\n[b]Funkcje Intervał:[/b]\n";
		foreach($config[1]['functions'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	if(isset($config[1]['onServerJoin'])){
		$desc .= "\n\n[b]Funkcje onServerJoin:[/b]\n";
		foreach($config[1]['onServerJoin'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}}

	if(isset($config[1]['onChat'])){
		$desc .= "\n\n[b]Funkcje onChat:[/b]\n";
		foreach($config[1]['onChat'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	
	
	$desc .= "\n\n[hr][center][b][size=15] Instancja 2[/size][/b][/center][hr]";
	if(isset($config[2]['onMove'])){
		$desc .= "\n\n[b]Funkcje onMove:[/b]\n";
		foreach($config[2]['onMove'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	if(isset($config[2]['functions'])){
		$desc .= "\n\n[b]Funkcje Intervał:[/b]\n";
		foreach($config[2]['functions'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	if(isset($config[2]['onServerJoin'])){
		$desc .= "\n\n[b]Funkcje onServerJoin:[/b]\n";
		foreach($config[2]['onServerJoin'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}}
	
	if(isset($config[2]['onChat'])){
		$desc .= "\n\n[b]Funkcje onChat:[/b]\n";
		foreach($config[2]['onChat'] as $key => $info){
		if($info['enabled']){    
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	
	
	$desc .= "\n\n[hr][center][b][size=15] Instancja 3[/size][/b][/center][hr]";
	if(isset($config[3]['onMove'])){
		$desc .= "\n\n[b]Funkcje onMove:[/b]\n";
		foreach($config[3]['onMove'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}

	if(isset($config[3]['functions'])){
			$desc .="\n\n[b]Funkcje Intervał[/b]:\n";
		foreach($config[3]['functions'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	if(isset($config[3]['onServerJoin'])){
		$desc .= "\n\n[b]Funkcje onServerJoin:[/b]\n";
		foreach($config[3]['onServerJoin'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}}
	
	if(isset($config[3]['onChat'])){
		$desc .= "\n\n[b]Funkcje onChat:[/b]\n";
		foreach($config[3]['onChat'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	
	
	
	$desc .= "\n\n[hr][center][b][size=15] Instancja 4[/size][/b][/center][hr]";
	if(isset($config[4]['onMove'])){
		$desc .= "\n\n[b]Funkcje onMove:[/b]\n";
		foreach($config[4]['onMove'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	if(isset($config[4]['functions'])){
		$desc .= "\n\n[b]Funkcje Intervał:[/b]\n";
		foreach($config[4]['functions'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	if(isset($config[4]['onServerJoin'])){
		$desc .= "\n\n[b]Funkcje onServerJoin:[/b]\n";
		foreach($config[4]['onServerJoin'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}}
	
	if(isset($config[4]['onChat'])){
		$desc .= "\n\n[b]Funkcje onChat:[/b]\n";
		foreach($config[4]['onChat'] as $key => $info){
			if($info['enabled']){
				$enabled = "[b][color=#0F8A05]".$key."[/b]";
				}else{ 
					$enabled = "[b][color=#FF330A]".$key."[/b]";
					}
					
			$desc .= "[b][/b]        ".$enabled."\n";
		}
	}
	
	
	$desc .= "\n\n[hr][center][b][size=15] Instancja 5[/size][/b][/center][hr]";
	if(isset($config[5]['onMove'])){
		$desc .= "\n\n[b]Funkcje onMove:[/b]\n";
		foreach($config[5]['onMove'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	if(isset($config[5]['functions'])){
		$desc .= "\n\n[b]Funkcje Intervał:[/b]\n";
		foreach($config[5]['functions'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}
	}
	
	if(isset($config[5]['onServerJoin'])){
		$desc .= "\n\n[b]Funkcje onServerJoin:[/b]\n";
		foreach($config[5]['onServerJoin'] as $key => $info){
		if($info['enabled']){
			$enabled = "[b][color=#0F8A05]".$key."[/b]";
			}else{ 
				$enabled = "[b][color=#FF330A]".$key."[/b]";
				}
				
		$desc .= "[b][/b]        ".$enabled."\n";
	}}
	
	if(isset($config[5]['onChat'])){
		$desc .= "\n\n[b]Funkcje onChat:[/b]\n";
		foreach($config[5]['onChat'] as $key => $info){
			if($info['enabled']){
				$enabled = "[b][color=#0F8A05]".$key."[/b]";
				}else{ 
					$enabled = "[b][color=#FF330A]".$key."[/b]";
					}
					
			$desc .= "[b][/b]        ".$enabled."\n";
		}
	}
	
	$ts->channelEdit($config['functionInfo']['channel_id'], ['channel_description' => $desc.$footer]);
}
	
	
	
	
	