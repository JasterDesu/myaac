<?php

// require '../config.php';
// require PLUGINS . 'jpay/config.php';

function getDonateBonus($v, $inc = false)
{
	global $config;
	$bonus = 1.0;
	if (!isset($config['donate_bonus'])){
		return $bonus;
	}
	foreach ($config['donate_bonus'] as $b) {
		if ($v >= $b[0] && $v <= $b[1]) {
			$bonus = $b[2];
		}
	}
	if ($inc) {
		return floor($v * $bonus);
	}
	return $bonus;
}


?>