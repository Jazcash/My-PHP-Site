<?php
    $api = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=2410ED5416447916B5D2E2DDD7400A21&steamids=76561197998402796";
    $json = file_get_contents($api);
    $schema = json_decode($json, true);
    if (isset($schema["response"]["players"][0]["gameextrainfo"])){
        $game = $schema["response"]["players"][0]["gameextrainfo"];
        if ($game == "Warsow"){
        	echo("<b>Currently playing: </b>"."<a target='_blank' href='http://www.warsow.net/wmm/profile/5190'>".$game."</a>");
        } else{
        	$gameID = $schema["response"]["players"][0]["gameid"];
        	echo("<b>Currently playing: </b>"."<a target='_blank' href='http://store.steampowered.com/app/".$gameID."'>".$game."</a>");
        }  
    } else {
    	
    }
?>