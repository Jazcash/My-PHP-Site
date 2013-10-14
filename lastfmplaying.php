<?php
	require 'lastfmapi/lastfmapi.php';
	$authVars['apiKey'] = 'fa3af76b9396d0091c9c41ebe3c63716';
	$auth = new lastfmApiAuth('setsession', $authVars);
	$apiClass = new lastfmApi();
	$userClass = $apiClass->getPackage($auth, 'user');
	$methodVars = array('user' => 'Jazcash');
	if ($tracks = $userClass->getRecentTracks($methodVars)) {
		if (array_key_exists("nowplaying", $tracks[0])){
			echo ("<b>Currently listening to: </b><a href='".$tracks[0]["url"]."' target='_blank'>".$tracks[0]["artist"]["name"]." - ".$tracks[0]["name"]."</a>");
		}
	}
?>