<?php
/*
========================================Database:
CREATE TABLE `cs_current_offers` (
  `id` int NOT NULL,
  `account_old` int NOT NULL,
  `account_new` int NOT NULL,
  `price` int NOT NULL,
  `player_id` int NOT NULL,
  `dateStart` date NOT NULL,
  `dateEnd` date NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

ALTER TABLE `cs_current_offers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cs_current_offers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `cs_transaction_history` (
  `id` int NOT NULL,
  `type` int NOT NULL,
  `date` date NOT NULL,
  `player_id` int NOT NULL,
  `seller_account` int NOT NULL,
  `buyer_account` int NOT NULL,
  `price` int NOT NULL,
  `offer_date_start` date NOT NULL,
  `offer_date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

ALTER TABLE `cs_transaction_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cs_transaction_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

======================================== config.local.php:
$config['char-shop'] = array();
$config['char-shop']['tax'] = 20;
$config['char-shop']['sell_tax'] = 0.1;
$config['char-shop']['min_level'] = 8;
$config['char-shop']['min_offer_price'] = 50;
$config['char-shop']['min_expire_days'] = 2;
$config['char-shop']['temp_account_id'] = 5;
$config['char-shop']['exaust_sell'] = 7;

*/
defined('MYAAC') or die('Direct access not allowed!');

class CharShop {

  public static function checkOfferDate($offer) : bool
  {
    if(self::dateIsExpired($offer['dateEnd'])){
      self::cancelOfferById($offer['id']);
      return true;
    }
    return false;
  }
  
  public static function dateIsExpired( $end) : bool
  {
    if(strtotime(date('Y-m-d')) >= strtotime($end)){
      return true;
    }
    return false;
  }

	public static function getOffers() : array
  {
    global $db;
    $offers = array();
    $offers_list = $db->query('SELECT * FROM ' . $db->tableName('cs_current_offers') . ';');
    if(is_object($offers_list)) {
      foreach($offers_list as $offer) {
        if(!self::checkOfferDate($offer)){
          $offers[] = $offer;
        }
      }
    }
    return $offers;
  }
  
  public static function getAccountTransactionHistory(OTS_Account $account) : array
  {
    global $db;
    $result = array();
    if(!$account->isLoaded()){
      return $result;
    }
    $history_list = $db->query('SELECT * FROM '.$db->tableName('cs_transaction_history').' WHERE (`seller_account` = '.$account->getId().') OR (`buyer_account` = '.$account->getId().');');
    if(is_object($history_list)) {
      foreach($history_list as $history) {
        $result[] = $history;
      }
    }
    return $result;
  }

  public static function getOffersBySeller(OTS_Account $seller) : array
  {
    global $db;
    $offers = array();
    if(!$seller->isLoaded()){
      return $offers;
    }
    $offers_list = $db->query('SELECT * FROM ' . $db->tableName('cs_current_offers') . ' WHERE `account_old` = '.$seller->getId().';');
    if(is_object($offers_list)){
      foreach($offers_list as $offer) {
        $offers[] = $offer;
      }
    }
    return $offers;
  }

  public static function getOfferById(int $id) : array
  {
    global $db;
    $id = self::validateInput($id);
    $dboffer = $db->query('SELECT * FROM ' . $db->tableName('cs_current_offers') . ' WHERE `id` = '.$id.';');
    if($dboffer->rowCount() <= 0){
      return false;
    }
    $dboffer = $dboffer->fetch();
    return $dboffer;
  }
  
  public static function getPlayerOutfitsCount(OTS_Player $player)
  {
    global $db;
    $count = 0;
    if (!$player->isLoaded()) {
      return false;
    }
    $outf = $db->query('SELECT * FROM `player_storage` WHERE `player_id` = '.$player->getId().' AND (`key` >= 10001000 and `key` <= 10001500);')->rowCount();
    if($outf > 0){
      return $outf - 1;
    }
    return $count;
  }

  public static function getPlayerMountsCount(OTS_Player $player){
    global $db;
    $count = 0;
    if (!$player->isLoaded()) {
      return false;
    }
    $outf = $db->query('SELECT * FROM `player_storage` WHERE `player_id` = '.$player->getId().' AND (`key` >= 10002001 and `key` <= 10003000);')->rowCount();
    if($outf > 0){
      return $outf - 1;
    }
    return $count;
  }
  public static function guildCheck(OTS_Player $player){
    global $db;
    if (!$player->isLoaded()) {
      return false;
    }
    $getGuildOwner = $db->query('SELECT `ownerid`' . 'FROM `guilds`' . 'WHERE `ownerid` = ' . $player->getId() .'');
    $getGuildOwner = $getGuildOwner->fetch();
    
    $getGuildInvited = $db->query('SELECT `player_id`' . 'FROM `guild_invites`' . 'WHERE `player_id` = ' . $player->getId() .'');
    $getGuildInvited = $getGuildInvited->fetch();

    $getGuildMember = $db->query('SELECT `player_id`' . 'FROM `guild_membership`' . 'WHERE `player_id` = ' . $player->getId() .'');
    $getGuildMember = $getGuildMember->fetch();
    if($getGuildOwner == 0 and $getGuildInvited == 0 and $getGuildMember == 0) {
      return true;
    }
    return false;
  }
  
  public static function getPlayerSlotItem(OTS_Player $player, $x){
    global $db;
    if (!$player->isLoaded()) {
      return false;
    }
    $x = self::validateInput($x);
    $i = 0;
    $asd = $db->query('SELECT `itemtype`, `pid` FROM `player_items` WHERE `player_id` = '.$player->getId().' AND `pid` = '.$x.'');
    if(is_object($asd)){
      foreach($asd as $a){
        $i = $a['itemtype'];
      }
    }
    return $i;
  }
  
  public static function getItemLinkImage(string $itemtype) : string
  {
	global $config;
    if($itemtype <= 0){
      return '/images/items/empty.gif';
    }
    $link = $config['item_images_url'] . $itemtype.'.png';
    // $config['item_images_url'] . $file_name
    return $link;
  }
  
  public static function getPlayerOutfitImage(OTS_Player $player){
    global $db;
	global $config;
    if (!$player->isLoaded()) {
      return false;
    }
    $imglink = $imglink = $config['outfit_images_url'];
    $params = '?id='.$player->getLookType().'&addons='.$player->getLookAddons().'&head='.$player->getLookHead().'&body='.$player->getLookBody().'&legs='.$player->getLookLegs().'&feet='.$player->getLookFeet().'&mount=0';
    return $imglink.$params;
  }
  
  public static function marketCheck(OTS_Player $player){
    global $db;
    if (!$player->isLoaded()) {
      return false;
    }
    $getMarket = $db->query('SELECT `player_id`' . 'FROM `market_offers`' . 'WHERE `player_id` = ' . $player->getId() .'');
    $getMarket = $getMarket->fetch();
    if($getMarket == 0){
      return true;
    }
    return false;
  }
  
  public static function charIsInExaust(OTS_Player $player){
    global $db;
    global $config;
    if(!$player->isLoaded()){
      return true;
    }
    $history = $db->query('SELECT * FROM '.$db->tableName('cs_transaction_history').' WHERE `player_id` = '.$player->getId().';');
    
    if(is_object($history)){
      foreach($history as $h_offer){
        $dataToCanSell = date('Y-m-d', strtotime($h_offer['date'].'+ '.$config['char-shop']['exaust_sell'].' days'));
        $today = date('Y-m-d');
        if($h_offer['type'] == 1){
          if(strtotime($dataToCanSell) > strtotime($today)){
            return true;
          }
        }
      }
    }
    return false;
  }
  
  public static function getImageByCheck($str){
    $imgs = array(
      'yes' => '<img src="images/success.png"/>',
      'no' => '<img src="images/error.png"/>',
    );
    if($imgs[$str]){
      return $imgs[$str];
    }
    return '';
  }
  
  public static function displayCreateRequeriments(OTS_Player $player, OTS_Account $account){
    global $config;
    $checks = array(
      'registred' => 'yes',
      'recent-trade' => 'yes',
      'has-coins' => 'yes',
      'char-level' => 'yes',
      'char-house' => 'yes',
      'char-online' => 'yes',
      'char-guild' => 'yes',
      'char-market' => 'yes',
      'all' => 'yes',
    );

    $recovery_key = $account->getCustomField('key');
    if(empty($recovery_key)){
      $checks['registred'] = 'no';
      $checks['all'] = 'no';
    }
    if(self::charIsInExaust($player)){
      $checks['recent-trade'] = 'no';
      $checks['all'] = 'no';
    }
    $end_cost = $config['char-shop']['tax'];
    if(self::getCoins($account) < $end_cost){
      $checks['has-coins'] = 'no';
      $checks['all'] = 'no';
    }
    if($player->getLevel() < $config['char-shop']['min_level']){
      $checks['char-level'] = 'no';
      $checks['all'] = 'no';
    }
    if($player->getHouse()){
      $checks['char-house'] = 'no';
      $checks['all'] = 'no';
    }
    if($player->isOnline()){
      $checks['char-online'] = 'no';
      $checks['all'] = 'no';
    }
    if(!self::guildCheck($player)){
      $checks['char-guild'] = 'no';
      $checks['all'] = 'no';
    }
    if(!self::marketCheck($player)){
      $checks['char-market'] = 'no';
      $checks['all'] = 'no';
    }
    return $checks;
  }
  
  public static function checkCreateRequeriments(OTS_Player $player, OTS_Account $account, $price, $expire_days){
    global $config;
    $errors = array();
    $price = self::validateInput($price);
    $expire_days = self::validateInput($expire_days);
    if (!$account->isLoaded() || !$player->isLoaded()) {
      return $errors;
    }
		if ($account->getId() != $player->getAccountId()){
			$errors[] = 'Entrada inválida';
		}
    $recovery_key = $account->getCustomField('key');
    if(empty($recovery_key)){
      $errors[] = 'Conta não registrada';
    }
    if(self::charIsInExaust($player)){
      $errors[] = 'O personagem pode ser vendido novamente apos '.$config['char-shop']['exaust_sell'].' dias';
    }
    if($expire_days < $config['char-shop']['min_expire_days']){
      $errors[] = 'Minimo '.$config['char-shop']['min_expire_days'].' dias';
    }
    if($price < $config['char-shop']['min_offer_price']){
      $errors[] = 'Preço minimo: '.$config['char-shop']['min_offer_price'].' coins';
    }
    $end_cost = $config['char-shop']['tax'];
    if(self::getCoins($account) < $end_cost){
      $errors[] = 'Coins insuficientes';
    }
    if($player->getLevel() < $config['char-shop']['min_level']){
      $errors[] = 'Level insuficientes';
    }
    if($player->getHouse()){
      $errors[] = 'Character não pode ter house';
    }
    if($player->isOnline()){
      $errors[] = 'Character não pode estar online';
    }
    if(!self::guildCheck($player)){
      $errors[] = 'Character não pode ser dono/estar em uma guild, ou ter invites.';
    }
    if(!self::marketCheck($player)){
      $errors[] = 'Character não pode ter ofertas no market';
    }
    return $errors;
  }
  
  public static function createOffer(OTS_Player $player, OTS_Account $account, $price, $expire_days){
    global $db;
    global $config;
    $price = self::validateInput($price);
    $expire_days = self::validateInput($expire_days);
    if (!$account->isLoaded() || !$player->isLoaded()) {
      return false;
    }
    $errors = self::checkCreateRequeriments($player, $account, $price, $expire_days);
    if(count($errors) > 0){
      return false;
    }
    $accountNewId = $config['char-shop']['temp_account_id'];
    $accountNew = new OTS_Account();
    $accountNew->load($accountNewId);
    if(!$accountNew->isLoaded()){
      return false;
    }
    
    $coinsToRemove = $config['char-shop']['tax'];
    if(!self::removeCoins($account, $coinsToRemove)){
      return false;
    }
    
    if(!self::setCharacterAccount($player, $accountNew)){
      return false;
    }
    
    $player_id = $player->getId();
    $accountOld = $account->getId();
    $start = date('Ymd');
    $end = date('Ymd', strtotime('+ '.$expire_days.' days'));

    $colums = '(account_old, account_new, price, player_id, dateStart, dateEnd, status)';
    $values = '(' .$accountOld. ', ' .$accountNewId. ', ' .$price. ', ' .$player_id. ', ' .$start. ', ' .$end. ', 1)';

    $final_q = 'INSERT INTO ' . $db->tableName('cs_current_offers') . $colums . ' values ' . $values . ';';
    $db->query($final_q);
    self::storeTransactionHistory(2, $player_id, $accountOld, 0, $price, $start, $end);
    return true;
  }
  
  public static function storeTransactionHistory($type, $player_id, $seller_account, $buyer_account, $price, $offer_date_start, $offer_date_end){
    global $db;
    $date = date('Ymd');
    $colums = '(type, date, player_id, seller_account, buyer_account, price, offer_date_start, offer_date_end)';
    $values = '('.$type.', '.$date.', '.$player_id.', '.$seller_account.', '.$buyer_account.', '.$price.', '.$date.', '.$date.')';
    $db->exec('INSERT INTO '.$db->tableName('cs_transaction_history') . $colums.' values '.$values.';');
  }
  
  public static function cancelOfferById($id){
    $id = self::validateInput($id);
    $offer = self::getOfferById($id);
    if(!$offer || !is_array($offer)){
      return false;
    }
    $char = new OTS_Player();
    $char->load($offer['player_id']);
    $account_back = new OTS_Account();
    $account_back->load($offer['account_old']);
    if(!$account_back->isLoaded() || !$char->isLoaded()){
      return false;
    }
    if(!self::setCharacterAccount($char, $account_back)){
      return false;
    }
    self::storeTransactionHistory(3, $offer['player_id'], $offer['account_old'], 0, $offer['price'], $offer['dateStart'], $offer['dateEnd']);
    self::deleteOffer($id);
    return true;
  }
  
  public static function deleteOffer($offer_id){
    global $db;
    $offer = self::getOfferById($offer_id);
    if(!$offer || !is_array($offer)){
      return false;
    }
    $db->exec('DELETE FROM '.$db->tableName('cs_current_offers').' WHERE `id` = '.$offer_id.';');
    return true;
  }

  public static function doBuyOfferTransaction(OTS_Account $buyer_account, $offer_id){
    $offer_id = self::validateInput($offer_id);
		global $config;
    if(!$buyer_account->isLoaded()){
      return false;
    }
    $offer = self::getOfferById($offer_id);
    $price = $offer['price'];
    $char_id = $offer['player_id'];
    $char = new OTS_Player();
    $char->load($char_id);
    $start = $offer['dateStart'];
    $end = $offer['dateEnd'];
		$sell_tax = $price * $config['char-shop']['sell_tax'];
    if(!$char->isLoaded()){
      return false;
    }
    $account_oldid = $offer['account_old'];
    $account_newid = $offer['account_new'];
    // here account old is temp_account
    // $old_acc = new OTS_Account();
    // $old_acc->load($account_oldid);
    $seller_account = new OTS_Account();
    $seller_account->load($account_oldid);
    if(!$seller_account->isLoaded()){
      return false;
    }
    if($buyer_account->getId() == $account_oldid || $buyer_account->getId() == $account_newid){
      return false;
    }
    if(self::getCoins($buyer_account) < $price){
      return false;
    }
    if(!self::addCoins($seller_account, $price - $sell_tax)){ // apply here the sell tax
      return false;
    }
    if(!self::removeCoins($buyer_account, $price)){
      return false;
    }
    if(!self::setCharacterAccount($char, $buyer_account)){
      return false;
    }
    self::storeTransactionHistory(1, $char_id, $account_oldid, $buyer_account->getId(), $price, $start, $end);
    self::deleteOffer($offer_id);
    return true;
  }
  
  public static function setCharacterAccount(OTS_Player $char, OTS_Account $newaccount){
    global $db;
    if (!$newaccount->isLoaded() || !$char->isLoaded()) {
      return false;
    }
    $update = $db->exec('UPDATE `players` SET `account_id` = '.$newaccount->getId().' WHERE `id` = '.$char->getId().';');
    return true;
  }
  
  public static function setCoins(OTS_Account $account, $value){
    global $db;
    if(!$account->isLoaded()){
      return false;
    }
    $db->exec('UPDATE `accounts` SET `coins` = '.$value.' WHERE `id` = '.$account->getId().';');
    return true;
  }
  
  public static function getCoins(OTS_Account $account){
    global $db;
    $coins = 0;
    if(!$account->isLoaded()){
      return false;
    }
    $getcoins = $db->query('SELECT `coins` FROM `accounts` WHERE `id` = '.$account->getId().';');
    if($getcoins->rowCount() <= 0){
      return $coins;
    }
    $getcoins = $getcoins->fetch();
    return $getcoins['coins'];
  }
  
  public static function addCoins(OTS_Account $account, $amount){
    $amount = self::validateInput($amount);
    if(!$account->isLoaded()){
      return false;
    }
    $newcoins = self::getCoins($account) + $amount;
    self::setCoins($account, $newcoins);
    return true;
  }
  
  public static function removeCoins(OTS_Account $account, $amount){
    $amount = self::validateInput($amount);
    if(!$account->isLoaded()){
      return false;
    }
    $actcoins = self::getCoins($account);
    if($actcoins < $amount){
      return false;
    }
    $newcoins = $actcoins - $amount;
    self::setCoins($account, $newcoins);
    return true;
  }
  
  public static function valideAction($str){
    $action_list = array('error', 'offers', 'buy', 'finalizebuy', 'createoffer', 'myoffers', 'mytransactions');
    foreach($action_list as $action){
      if($str == $action){
        return true;
      }
    }
    return false;
  }
  // CharShop::validateInput
  public static function validateInput($input){
    $validate = filter_var($input, FILTER_SANITIZE_ADD_SLASHES);
    $validate = filter_var($validate, FILTER_SANITIZE_SPECIAL_CHARS);
    $validate = htmlspecialchars($validate);
    return $validate;
  }
  
  public static function getPlayerDepotItems($player){
    global $db;
    $item_list = array();
    if(!$player->isLoaded()){
      return $item_list;
    }
    $items = $db.exec('SELECT `itemtype`, `count` FROM '.$db->tableName('player_depotitems').' WHERE (`player_id` = '.$player->getId().');');
    if(is_object($items)) {
      foreach($items as $item) {
        $item_list[] = $item;
      }
    }
    return $item_list;
  }
  
  public static function getPlayerInboxItems($player){
    global $db;
    $item_list = array();
    if(!$player->isLoaded()){
      return $item_list;
    }
    $items = $db.exec('SELECT `itemtype`, `count` FROM '.$db->tableName('player_inboxitems').' WHERE (`player_id` = '.$player->getId().');');
    if(is_object($items)) {
      foreach($items as $item) {
        $item_list[] = $item;
      }
    }
    return $item_list;
  }
  
  public static function errorAlertWithDelay($text, $link){
    $str = '<script>
      alert("'.$text.'");
      setTimeout(function(){
        window.location.replace("'.$link.'");
      }, 1000);
    </script>';
    return $str;
  }
  
  public static function getGender(OTS_Player $player){
    $gender = '';
    if(!$player->isLoaded()){
      return $gender;
    }
    $sex = $player->getSex();
    if($sex == 1){
      $gender = 'male';
    } elseif ($sex == 2){
      $gender = 'female';
    }
    return $gender;
  }
  
  public static function getOfferPlayerInfo(OTS_Player $player){
    $info = array();
    if(!$player->isLoaded()){
      return $info;
    }
    $info['name'] = $player->getName();
    $info['level'] = $player->getLevel();
    $info['voc'] = $player->getVocationName();
    $info['ml'] = $player->getMagLevel();
    $info['dist'] = $player->getSkill(4);
    $info['club'] = $player->getSkill(1);
    $info['sword'] = $player->getSkill(2);
    $info['axe'] = $player->getSkill(3);
    $info['shield'] = $player->getSkill(5);
    $info['fish'] = $player->getSkill(6);
    $info['first'] = $player->getSkill(0);
    $info['balance'] = $player->getBalance();
    $info['looktypeimg'] = self::getPlayerOutfitImage($player);
    $info['slot1'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 1));
    $info['slot2'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 4));
    $info['slot3'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 6));
    $info['slot4'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 7));
    $info['gender'] = self::getGender($player);
    // $info['charms'] = self::getCharmPoints($player);
    $info['allBlessings'] = self::hasAllBlessings($player);
    $info['soulwar'] = self::hasSoulWar($player);
    $info['ThirdPreySlot'] = self::hasThirdPreySlot($player);
    return $info;
  }
  
  public static function getPlayerInfoByName($name){
    $name = self::validateInput($name);
    $player = new OTS_Player();
    $player->find($name);
    $result = array();
    if(!$player->isLoaded()){
      return $result;
    }
    $result['id'] = $player->getId();
    $result['level'] = $player->getLevel();
    $result['voc'] = $player->getVocationName();
    $result['magic'] = $player->getMagLevel();
    $result['distance'] = $player->getSkill(4);
    $result['club'] = $player->getSkill(1);
    $result['sword'] = $player->getSkill(2);
    $result['axe'] = $player->getSkill(3);
    $result['shielding'] = $player->getSkill(5);
    $result['outfit'] = self::getPlayerOutfitImage($player);
    $result['slot_head'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 1));
    $result['slot_necklace'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 2));
    $result['slot_backpack'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 3));
    $result['slot_armor'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 4));
    $result['slot_right'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 5));
    $result['slot_left'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 6));
    $result['slot_legs'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 7));
    $result['slot_feet'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 8));
    $result['slot_ring'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 9));
    $result['slot_ammo'] = self::getItemLinkImage(self::getPlayerSlotItem($player, 10));
    return $result;
  }
  
  public static function validaPassword(OTS_Account $account, $password){
    if(!$account->isLoaded()){
      return false;
    }
    $password = self::validateInput($password);
    if($account->getPassword() != encrypt($password)){
      return false;
    }
    return true;
  }
  
  public static function validaRKey(OTS_Account $account, $key){
    if(!$account->isLoaded()){
      return false;
    }
    $key = self::validateInput($key);
    if($account->getCustomField('key') != $key){
      return false;
    }
    return true;
  }
  
  public static function getCharmPoints(OTS_Player $player){
    global $db;
    if(!$player->isLoaded()){
      return 0;
    }
    $result = $db->query('SELECT `charmpoints` FROM `players` WHERE `id` = '.$player->getId().';');
    $result = $result->fetch();
    return $result['charmpoints'];
  }
  
  public static function hasAllBlessings(OTS_Player $player){
    global $db;
    if(!$player->isLoaded()){
      return false;
    }
    $all = 'yes';
    $colums = '`blessings1`, `blessings2`, `blessings3`, `blessings4`, `blessings5`, `blessings6`, `blessings7`, `blessings8`';
    $result = $db->query('SELECT '.$colums.' from `players` WHERE `id` = '.$player->getId().';');
    $result = $result->fetch();
    if($result > 0){
      for ($i = 1; $i <= 8; $i++) {
        $x = 'blessings'.$i;
        if($result[$x] == 0){
          $all = 'no';
        }
      }
    }
    return $all;
  }

  public static function hasSoulWar(OTS_Player $player){
    global $db;
    if(!$player->isLoaded()){
      return 'no';
    }
    if($player->getStorage(1023) > 0){
      return 'yes';
    }
    return 'no';
  }
  
  public static function hasThirdPreySlot(OTS_Player $player){
    global $db;
    if(!$player->isLoaded()){
      return 'no';
    }
    if($player->getStorage(63253) > 0){
      return 'yes';
    }
    return 'no';
  }
}