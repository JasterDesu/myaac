<?php

require_once PLUGINS . 'jpay/vendor/autoload.php';
require_once PLUGINS . 'jpay/config.php';
	
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;

if (isset($_POST) && !empty($_POST)) {
    // amount < 3
    if ($_POST['currency'] < 1 || !filter_var($_POST['currency'], FILTER_VALIDATE_FLOAT)) {
        echo '
        <div class="alert alert-warning" role="alert">
        O valor mínimo para doação é R$ 1,00
        </div>';
        exit;
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo '
        <div class="alert alert-warning" role="alert">
        E-mail inválido
        </div>';
        exit;
    }

    \MercadoPago\SDK::setAccessToken($config['mercadopago']['ACESS_TOKEN']);
    \MercadoPago\SDK::setClientId($config['mercadopago']['CLIENT_ID']);
    \MercadoPago\SDK::setClientSecret($config['mercadopago']['CLIENT_SECRET']); 

    // item mercadopago
    $ref = 'OTS'.md5(time().$_POST['email']);
    $item = [
        'title' => 'Doação para o site',
        'quantity' => 1,
        'currency_id' => 'BRL',
        'unit_price' => intval($_POST['currency']),
        'description' => 'Doação para o site',
        'picture_url' => BASE_URL . '/templates/tibiacom/images/header/dh.jpg',
        'email' => $_POST['email'],
        'reference' => $ref
    ];
    $preference = new \MercadoPago\Preference();
    $preference->items = [$item];
	// se for excluido ate o end libera todos os metodos
	$preference->payment_methods = array(
            "excluded_payment_types" => array(
                    array(
                        "id" => "credit_card",
                    ),
                    array(
                        "id" => "debit_card",
                    ),
            ),
            "excluded_payment_methods" => array(
                    array(
                        "id" => "paypal",
                    )
            ),
    );
	//end
    $preference->back_urls = [
        'success' => BASE_URL . 'mpret.php',
        'pending' => BASE_URL . 'mpret.php',
        'failure' => BASE_URL . 'mpret.php',
        'failure_auto_return' => BASE_URL . 'mpret.php'
    ];
    $preference->auto_return = "approved";
    $preference->return_url = BASE_URL . "mpret.php";
    $preference->notification_url = $config['mercadopago']['URL_BASE'] . 'mercadopago.php';
    $preference->external_reference = $ref;
    $preference->email = $item['email'];
    $preference->save();
    // coins
    // identificar o usuario pelo email
    $user = $db->query("SELECT * FROM accounts WHERE email = '{$_POST['email']}'")->fetch();
    $multiplier = 1;
    $coins = intval($_POST['currency']) * $multiplier;
    // inserir na tabela order
    // $insert = $db->insert("INSERT INTO order (id, ref, user, coins, status) VALUES (NULL, '{$ref}', '{$user['id']}', '{$_POST['currency']}', , 'PENDING')", true);
    // 	$db->insert(TABLE_PREFIX . 'config', array('name' => $name, 'value' => $value));
    $insert = $db->insert('order', array(
        'id' => NULL,
        'ref' => $ref,
        'user' => $user['id'],
        'coins' => $coins,
        'status' => '2'
    ));

    if(!$insert) {
        echo '<div class="alert alert-warning" role="alert">
        Erro no pagamento  </div>';
    }
    // if (1==1) {
			// echo '<div>'.$preference->init_point.'</div>';
			// return;
		// }
    echo '<script>window.location.href = "'.$preference->init_point.'"</script>';
}else{
    die('Direct access not allowed!');
} 