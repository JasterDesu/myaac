<?php
require_once '../common.php';
require_once PLUGINS . 'jpay/config.php';
require_once PLUGINS . 'jpay/vendor/autoload.php';
require SYSTEM . 'functions.php';
require SYSTEM . 'init.php';
require SYSTEM . 'hooks.php';
require SYSTEM . 'template.php';
require SYSTEM . 'login.php';
require SYSTEM . 'status.php';

use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use MercadoPago\Payment;

	\MercadoPago\SDK::setAccessToken($config['mercadopago']['ACESS_TOKEN']);
    \MercadoPago\SDK::setClientId($config['mercadopago']['CLIENT_ID']);
    \MercadoPago\SDK::setClientSecret($config['mercadopago']['CLIENT_SECRET']);
	
    if(isset($_POST)){
        // SALVAR EM TXT O IP

        $request = json_decode(file_get_contents('php://input'), true);
        $id = $request["data"]["id"];
        if(!isset($id)){
            $id = $request["data_id"];
        }
        if(!isset($id)){
            $id = $POST["data"]["id"];
        }
        if(!isset($id)){
            $id = $POST["data_id"];
        }
        if (isset($id)) {
            $payment = \MercadoPago\Payment::find_by_id($id);
            $status = $payment->status;
            $external_reference = $payment->external_reference;
            if (!isset($status)) {
                die('Direct access not allowed!');
            }
            if (!isset($external_reference)) {
                die('Direct access not allowed!');
            }
            if ($status == 'approved') {
                // adicionar coin
                //     $coins = $user['coins'] + (intval($_POST['currency']) * $multiplier);
                //     $db->query("UPDATE accounts SET coins = '$coins' WHERE id = '$user[id]'");
                // select user by external_reference
                $ref = $db->query("SELECT * FROM `order` WHERE `ref` = '{$external_reference}'")->fetch();
                if (!isset($ref)) {
                    die('Direct access not allowed!');
                }
                // ATUALIZA O STATUS DO PEDIDO
                $atualiza = $db->query("UPDATE `order` SET status = '1' WHERE `ref` = '{$external_reference}'");
                // PROCURA O USUARIO PELO ID DO PEDIDO
                if(!isset($atualiza)){
                    die('Direct access not allowed!');
                }
                $id = intval($ref['user']);
                $user = $db->query("SELECT * FROM `accounts` WHERE `id` = {$id}")->fetch();
                if (!isset($user)) {
                    die('Direct access not allowed!');
                }
                // ADICIONA O COIN AO USUARIO
                $userCoins = intval($user['coins']);
                $refCoins = intval($ref['coins']);
                $multiplier = intval($config['mercadopago']['MILTIPLICADOR']);
                $coins = $userCoins + ($refCoins * $multiplier);
				$coinsWithBonus = getDonateBonus($coins, true);
                $db->query("UPDATE `accounts` SET `coins` = '{$coins}' WHERE `id` = '{$user['id']}'");
                exit;
            }
        }

    }