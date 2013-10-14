<?php
    $api = "http://www.warsow.net/wmm/matches/Jazcash/1?json";
    $json = file_get_contents($api);
    $schema = json_decode($json, true);



   	$timeOfLastGame = date("U", $schema["player"]["matchesList"][1]["created_unixtime"]);

   	print date("r", $timeOfLastGame);

?>