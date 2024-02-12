<?php
defined('MYAAC') or die('Direct access not allowed!');

// require_once(LIBS . 'jlib.php');

class JLib {
	// account custom functions
	
	public static function getDonateBonus($v, $inc = false)
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
	
	public static function backupCoinsEnabled()
	{
		global $config;
		if ($config['BACKUP_COINS'] && $config['BACKUP_COINS'] == true){
			return true;
		}
		return false;
	}
	
	public static function getCoinType()
	{
		global $config;
		$coin_type = "coins";
		if ($config['COIN_TYPE']){
			$coin_type = $config['COIN_TYPE'];
		}
		return $coin_type;
	}
	
	public static function getCoins(OTS_Account $account){
		global $db;
		$coins = 0;
		if(!$account->isLoaded()){
		  return false;
		}
		$getcoins = $db->query('SELECT `'.self::getCoinType().'` FROM `accounts` WHERE `id` = '.$account->getId().';');
		if($getcoins->rowCount() <= 0){
		  return $coins;
		}
		$getcoins = $getcoins->fetch();
		return $getcoins['coins'];
	}
	
	public static function setCoins(OTS_Account $account, $value) // jLib::getCoins()
	{
		global $db;
		if(!$account->isLoaded()){
		  return false;
		}
		$db->query("UPDATE `accounts` SET `".self::getCoinType()."` = ".$value." WHERE `id` = ".$account->getId().";");
		return true;
	}
	
	public static function addCoins(OTS_Account $account, $value)
	{
		if(!$account->isLoaded()){
		  return false;
		}
		self::setCoins($account, self::getCoins($account) + $value);
		return true;
	}
	
	public static function getBackupCoins(OTS_Account $account)
	{
		global $db;
		$coins = 0;
		if(!$account->isLoaded()){
		  return $coins;
		}
		$getcoins = $db->query('SELECT `backup_coins` FROM `accounts` WHERE `id` = '.$account->getId().';');
		if($getcoins->rowCount() <= 0){
		  return $coins;
		}
		$getcoins = $getcoins->fetch();
		return $getcoins['backup_coins'];
	}
	
	public static function setBackupCoins(OTS_Account $account, $value)
	{
		global $db;
		if(!$account->isLoaded()){
		  return false;
		}
		$db->exec('UPDATE `accounts` SET `backup_coins` = '.$value.' WHERE `id` = '.$account->getId().';');
		return true;
	}
	
	public static function addBackupCoins(OTS_Account $account, $value)
	{
		if(!$account->isLoaded()){
		  return false;
		}
		self::setBackupCoins($account, self::getBackupCoins($account) + $value);
		return true;
	}
	
	public static function addBackupCoinsByEmail($email, $value)
	{
		$account = new OTS_Account();
		$account->findByEMail($email);
		if(!$account->isLoaded()){
			return false;
		}
		self::addBackupCoins($account, $value);
	}
	
}