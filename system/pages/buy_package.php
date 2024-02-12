<?php
/*
CREATE TABLE `promo_packs` (
  `id` int NOT NULL,
  `player_id` int NOT NULL,
  `package_name` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `time` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `promo_packs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `promo_packs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
*/
defined('MYAAC') or die('Direct access not allowed!');
$title = 'Buy Package';

require_once 'promo_pckg.php';

function playerAlreadyBought($id){
	global $db;
	$AlreadyBought = $db->query("SELECT `player_id` FROM `promo_packs` WHERE `player_id` = ".$id.";");
	$AlreadyBought = $AlreadyBought->fetch();
	if ($AlreadyBought == 0) {
		return false;
	}
	return true;
}

if (!isset($_GET['pckg'])) {
	die(header('Location: ' . BASE_URL . '?promotional'));
}

if (!isset($_POST['character'])) {
	die(header('Location: ' . BASE_URL . '?promotional'));
}
$choosed_char_id = filter_var($_POST['character'], FILTER_SANITIZE_ADD_SLASHES);
$player = new OTS_Player();
$player->load($choosed_char_id);
if (!$player->isLoaded()) {
	die(header('Location: ' . BASE_URL . '?promotional'));
}

if (playerAlreadyBought($choosed_char_id)) {
	die(header('Location: ' . BASE_URL . '?subtopic=promotional&retmsg=alreadybought'));
}

$pckg = $_GET['pckg'];
if (!$promo_pckg || !$promo_pckg[$pckg]){
	die(header('Location: ' . BASE_URL . '?promotional'));
}

$errors = array();
if(!$logged || !$account_logged->isLoaded()) {
	$errors[] = 'Please login first';
	$twig->display('error_box.html.twig', array('errors' => $errors));
	return;
}

$pckg_data = $promo_pckg[$pckg];

if ($account_logged->getCoins() < $pckg_data['coins']) {
	die(header('Location: ' . BASE_URL . '?subtopic=promotional&retmsg=nenoughcoins'));
}

$db->query("INSERT INTO `promo_packs` (player_id, package_name, status, time) VALUES (".$choosed_char_id.", '".$pckg."', 'pending', ".time().");");

$new_coins = $account_logged->getCoins() - $pckg_data['coins'];
$db->query("UPDATE `accounts` SET `coins` = '{$new_coins}' WHERE `id` = '{$account_logged->getId()}'");

die(header('Location: ' . BASE_URL . '?subtopic=promotional&retmsg=purchasecompleted&char='.$player->getName()));
?>