<?php
  defined('MYAAC') or die('Direct access not allowed!');


  $title = 'charstore';
  require_once(LIBS . 'char-shop.php');


  if(!$logged){
    die(header('Location: ' . BASE_URL . '?accountmanagement'));
  }
  
  $action = filter_var($_GET['action'], FILTER_SANITIZE_ENCODED);
  if(!CharShop::valideAction($action)){
    die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=offers'));
  }
  // 1071
  $errors_str = [
    1 => 'Incorrect password',
    2 => 'Incorrect Recovery key',
    3 => 'Fill all inputs',
    4 => "You don't have enough coins",
    5 => "You don't have any characters",
  ];
  if($account_logged->getId() != 1071){
    // die(header('Location: ' . BASE_URL . ''));
  }
  if($action == 'offers'){
?>

<div class="TableContainer" style="border: 1px solid #000000; position: relative; width: 100%; font-size: 1px; color: #5a2800; font-family: Verdana, Arial, 'Times New Roman', sans-serif;">
  <div class="CaptionContainer" style="position: relative; font-size: 1pt; height: 23px; width: 100%; background-color: #5f4d41 !important;">
    <div class="CaptionInnerContainer" style="position: relative; width: 100%; height: 20px; padding-top: 2px; padding-bottom: 4px;">
      <span class="CaptionEdgeLeftTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionEdgeRightTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionBorderTop" style="background-image:url(/templates/tibiacom/images/global/content/table-headline-border.gif);"></span> <span class="CaptionVerticalLeft" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
      <div class="Text">Informações <b style="color: yellow;">Character Bazaar</b></div>
      <span class="CaptionVerticalRight" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-vertical.gif);"></span> <span class="CaptionBorderBottom" style="background-image:url(/templates/tibiacom/images/global/content/table-headline-border.gif);"></span> <span class="CaptionEdgeLeftBottom" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionEdgeRightBottom" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span>
    </div>
  </div>
  <table class="Table3" style="width: 100%; border: 2px solid #55636c; background-color: #f1e0c5;" cellspacing="0" cellpadding="0">
    <tbody>
      <tr>
      <td style="font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt;">
        <div class="InnerTableContainer" style="width: 100%; position: relative; margin-top: 5px; margin-left: 3px;">
          <table style="width: 100%;">
            <tbody>
              <tr>
                <td style="font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt;">
                  <div class="TableShadowContainerRightTop" style="position: relative; top: 0px; right: 3px; margin-right: 0px; font-size: 1px; float: right; z-index: 99;">
                    <div class="TableShadowRightTop" style="position: absolute; top: 0px; right: 0px; width: 4px; height: 5px; z-index: 99; background-image: url('<?=$template_path?>/images/global/content/table-shadow-rt.gif');;">&nbsp;</div>
                  </div>
                  
                  <div class="TableContentAndRightShadow" style="position: relative; background-repeat: repeat-y; background-position: right top; margin-right: 3px; font-size: 1px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-rm.gif');">
                    <div class="TableContentContainer" style="border: 1px solid #5f4d41; position: relative; margin-right: 4px;  background-color: #d4c0a1; padding: 0px;">
                      <table class="TableContent" style="width: 100%; border-collapse: collapse; border: 1px solid #faf0d7;" width="100%">
                        <tbody>
                          <tr><td style="padding: 8px 5px; background-color: #d5c0a1; font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt; border: 1px solid #faf0d7;" width="100%"><center>Ao colocar o personagem no bazar, será cobrada uma taxa fixa de <strong>10 Coins</strong>.</center></td></tr>
                          <tr><td style="padding: 8px 5px; background-color: #f1e0c5; font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt; border: 1px solid #faf0d7;" width="100%"><center>O valor da oferta de qualquer personagem, deve ser superior a <strong>30 Coins</strong>.</center></td></tr>
                          <tr><td style="padding: 8px 5px; background-color: #d5c0a1; font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt; border: 1px solid #faf0d7;" width="100%"><center>Ao vender seu char é cobrado <strong>10 %</strong> do valor total, esse valor é cobrado automaticamente.</center></td></tr>
                          <tr><td style="padding: 8px 5px; background-color: #f1e0c5; font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt; border: 1px solid #faf0d7;" width="100%"><center>Ao comprar um personagem, entre em sua account novamente para ele aparecer em sua lista.</center></td></tr>
                          <tr><td style="padding: 8px 5px; background-color: #d5c0a1; font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt; border: 1px solid #faf0d7;" width="100%"><center>Ao confirmar a compra, as coins são <strong>descontadas imediatamente</strong> de sua account.</center></td></tr>
                          <tr><td style="padding: 8px 5px; background-color: #f1e0c5; font-family: Verdana, Arial, 'Times New Roman', sans-serif; font-size: 10pt; border: 1px solid #faf0d7;" width="100%"><center>Caso remova o personagem do bazar, o valor da taxa paga <strong>não</strong> será devolvido.</center></td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div><br/>
                  
                  <div class="TableContentAndRightShadow" style="position: relative; background-repeat: repeat-y; background-position: right top; margin-right: 3px; font-size: 1px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-rm.gif');">
                    <div class="TableContentContainer" style="border: 1px solid #5f4d41; position: relative; margin-right: 4px;  background-color: #d4c0a1; padding: 0px;">
                      <table class="TableContent" style="width: 100%; border-collapse: collapse; border: 1px solid #faf0d7;" width="100%">
                        <tbody>
                          <tr>
                            <td><strong><center>você precisa ter coins suficientes</center></strong></td>
                          </tr>
                          <tr>
                            <td><strong><center>O personagem deve ter pelo menos nível 8</center></strong></td>
                          </tr>
                          <tr>
                            <td><strong><center>O personagem não pode ter casa</center></strong></td>
                          </tr>
                          <tr>
                            <td><strong><center>O Personagem não pode estar online</center></strong></td>
                          </tr>
                          <tr>
                            <td><strong><center>O personagem não pode ser dono de uma guilda</center></strong></td>
                          </tr>
                          <tr>
                            <td><strong><center>O personagem não pode ter convites pendentes para outros personagens</center></strong></td>
                          </tr>
                          <tr>
                            <td><strong><center>O Personagem não pode ter ofertas no mercado</center></strong></td>
                          </tr>
                          <tr>
                            <td><strong><center>Sua conta deve ser registrada</center></strong></td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="TableShadowContainer" style="position: relative; margin-right: 5px;">
                    <div class="TableBottomShadow" style="position: relative; font-size: 1px; height: 5px; width: 731px; padding: 0px; margin: 0px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-bm.gif');">
                      <div class="TableBottomLeftShadow" style="position: relative; height: 5px; width: 4px; float: left; padding: 0px; margin: 0px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-bl.gif');">&nbsp;</div>
                      <div class="TableBottomRightShadow" style="position: relative; float: right; right: -2px; top: 0px; height: 5px; width: 4px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-br.gif');">&nbsp;</div>
                    </div>
                  </div><br>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
</div><br>
<?php
}
?>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/templates/tibiacom/css/char-shop-style.css">
<div class="panel panel-default">
    <div class="panel-body">
        
        <table width="100%" class="table CUSTOM_SHADOW"> 
          <tr style="background-color: #d4c0a1; border:1px solid black; text-align: center;" >
            <td>
              <a href="?subtopic=charstore&action=offers"><div  class="TOP_BUTTONS_MENU"><b>View offers</b></div></a>
            </td>
            <td>
              <a href="?subtopic=charstore&action=createoffer"><div  class="TOP_BUTTONS_MENU"><b>Create offer</b></div></a>
            </td>
            <td>
              <a href="?subtopic=charstore&action=myoffers"><div  class="TOP_BUTTONS_MENU"><b>My offers</b></div></a>
            </td>
            <td>
              <a href="?subtopic=charstore&action=mytransactions"><div  class="TOP_BUTTONS_MENU"><b>My transactions</b></div></a>
            </td>
          </tr>
          <div class="COINS_COUNT">You have <b><?= CharShop::getCoins($account_logged);?></b> <img src="/templates/tibiacom/images/account/icon-tibiacoin.png" /> coins</div>
          
        </table>
        <?php
          if($action == 'error'){
            $error_id = $_GET['id'];
            if(!empty($error_id)){
              if($errors_str[$error_id]){
                echo '
                  <div class="ERROR_MSG">
                    <b id="error_text">'.$errors_str[$error_id].'</b><br/><br/>
                    <b><a href="/?subtopic=charstore&action=offers">back</a></b>
                  </div>
                ';
              }
            }
          }
        ?>
       
        
<?php
if($action == 'buy'){
    $offer_id = filter_var($_POST['offerid'], FILTER_SANITIZE_ADD_SLASHES);
    if (empty($offer_id)){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=offers'));
    }
    $offer = CharShop::getOfferById($offer_id);
    if(!$offer){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=offers'));
    }
    $player = new OTS_Player();
    $player->load($offer['player_id']);
    if(CharShop::getCoins($account_logged) < $offer['price']){
      echo '
        <table width="100%" class="table CUSTOM_SHADOW"> 
          <tr style="background-color: #d4c0a1; border:1px solid black;" >
            <td style="text-align: center; width: 100%;">
              <b>insufficient coins</b></br>
              <b><a href="/?subtopic=charstore&action=offers">back</a></b>
            </td>
          </tr>
        </table>
      ';
    } else {
    $pinfo = CharShop::getOfferPlayerInfo($player);
    
?>

<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="text-align: center; width: 100%;">
      <b>You are buying:</b>
    </td>
  </tr>
</table>

<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="width: 100%;"> 
      <b><a href="<?= '/?characters/'.$pinfo['name'];?>"><?= $pinfo['name'];?></b></a><br/>
      Level: <?= $pinfo['level'];?> | <?= $pinfo['voc'];?> | <?= $pinfo['gender'];?>
      <table width="100%" class="table">
        <tr style="background-color: #E5DCCD; border:1px solid black;" >
          <td style="width: 10%;">
            <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">
              <img src="<?= $pinfo['looktypeimg']; ?>>" width="64" height="64" border="0" alt="" />
            </div>
          </td>
          <td style="width: 10%;">
            <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">
              <img class="SLOT_ITEM" style="margin: 5px;" src="<?= $pinfo['slot1'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin-bottom: 5px;" src="<?= $pinfo['slot2'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin: 5px;" src="<?= $pinfo['slot3'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin-bottom: 5px;" src="<?= $pinfo['slot4'];?>" width="32" height="32" border="0" alt="" />
            </div>
          </td>
          <td style="width: 55%;">
            <div class="OTHER_INFO">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Started in:</td>
                    <td style="width: 50%; text-align: right;"><?= $offer['dateStart'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Ends in:</td>
                    <td style="width: 50%; text-align: right;"><?= $offer['dateEnd'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
          <td style="width: 25%;">
            <div style="height: 85px; width: 100%; background-color: #D0C2AB; border:1px solid #352F26; text-align: center;">
              <p style="margin: 20px;">
                <b>Price:</b> <?= filter_var($offer['price'], FILTER_SANITIZE_ADD_SLASHES) ?> coins
              </p>
            </div>
          </td>
        </tr>
      </table>
      <table width="100%" class="table INSIDE_INFO_SHADOW">
        <tr style="background-color: #E5DCCD; border:1px solid black;" >
          <td style="width: 35%;">
            <div class="OTHER_INFO_BOTTOM">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Magic Level:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['ml'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">First:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['first'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Club:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['club'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Sword:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['sword'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Axe:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['axe'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Distance:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['dist'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Shielding:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['shield'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Fishing:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['fish'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
          <td style="width: 65%;">
            <div class="OTHER_INFO_BOTTOM">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Soul War quest:</td>
                    
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['soulwar']);?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Third prey slot:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['ThirdPreySlot']);?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Charm points:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['charms'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">All Blessings:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['allBlessings']);?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Bank balance:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['balance'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="text-align: center; width: 100%;">
      <b>Do you really want to buy this character?</b><br/>
      
      <form method="post" action="?subtopic=charstore&action=finalizebuy">
        <input type="hidden" name="offerid" value="<?= $offer['id']; ?>"/>
        <label for="passwd">Enter your password:</label><br/>
        <input type="password" id="passwd" name="passwd" placeholder="senha"><br/><br/>
        <input type="submit" value="confirm"/>
      </form>
      
    </td>
  </tr>
</table>

<?php 
  }
}
if($action == 'finalizebuy'){
  if (empty(filter_var($_POST['offerid'], FILTER_SANITIZE_ADD_SLASHES))){
    die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=offers'));
  }
  $password_input = filter_var($_POST['passwd'], FILTER_SANITIZE_ADD_SLASHES);
  echo '<script>alert('.$password_input.')</script>'; //
  if(empty($password_input)){
    //header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=1');
    die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=1'));
  }
  if(!CharShop::validaPassword($account_logged, $password_input)){
    die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=1'));
  }
  $offer = CharShop::getOfferById(filter_var($_POST['offerid'], FILTER_SANITIZE_ADD_SLASHES));
  if(!$offer){
    die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=offers'));
  }
  
  echo '
    <table width="100%" class="table CUSTOM_SHADOW"> 
        <tr style="background-color: #d4c0a1; border:1px solid black;" >  
          <td style="text-align: center; width: 100%;">
            <b>Aviso:</b><br/>
            <p>
  ';
    if(CharShop::doBuyOfferTransaction($account_logged, filter_var($_POST['offerid'], FILTER_SANITIZE_ADD_SLASHES))){
      echo '<b style="color: green;">Personagem comprado com sucesso!</b>';
    } else {
      echo '<b style="color: red;">Ops! tente mais tarde!</b>';
    }
  echo '
          </p>
          <b><a href="?subtopic=charstore">Back</a></b>
        </td>
      </tr>
    </table>
  ';
}
?>

<?php
if($action == 'offers'){
?>
<div class="ACTION_TITTLE_BOX">
  <b>Offers</b>
</div>
<?php
  $offers = CharShop::getOffers();
  if(count($offers) >= 1){
    foreach($offers as $offer){
      if($offer['account_old'] != $account_logged->getId()){
        $player = new OTS_Player();
        $player->load($offer['player_id']);
        if ($player->isLoaded()) {
          $pinfo = CharShop::getOfferPlayerInfo($player);
?>

<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="width: 100%;">
      <b><?= getPlayerLink($pinfo['name']);?></b><br/>
      Level: <?= $pinfo['level'];?> | Vocation: <?= $pinfo['voc'];?> | <?= $pinfo['gender'];?>
      <table width="100%" class="table CUSTOM_SHADOW">
        <tr style="background-color: #E5DCCD; border:1px solid black;" >
          <td style="width: 10%;">
            <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">
              <img src="<?= $pinfo['looktypeimg']; ?>>" width="64" height="64" border="0" alt="" />
            </div>
          </td>
          <td style="width: 10%;">
            <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">
							<img class="SLOT_ITEM" style="margin: 5px;" src="<?= $pinfo['slot1'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin-bottom: 5px;" src="<?= $pinfo['slot2'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin: 5px;" src="<?= $pinfo['slot3'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin-bottom: 5px;" src="<?= $pinfo['slot4'];?>" width="32" height="32" border="0" alt="" />
            </div>
          </td>
          <td style="width: 55%;">
            <div class="OTHER_INFO">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Started in:</td>
                    <td style="width: 50%; text-align: right;"><?= $offer['dateStart'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Ends in:</td>
                    <td style="width: 50%; text-align: right;"><?= $offer['dateEnd'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
          <td style="width: 25%;">
            <div style="height: 85px; width: 100%; background-color: #D0C2AB; border:1px solid #352F26; text-align: center;">
              <p style="margin: 5px;">
                <b>Price:</b> <?= $offer['price'];?> coins
              </p>
              <form method="post" action="?subtopic=charstore&action=buy">
                <input type="hidden" name="offerid" value="<?= $offer['id']; ?>"/>
                <input type="submit" value="Buy"/>
              </form>
            </div>
          </td>
        </tr>
      </table>
      <table width="100%" class="table INSIDE_INFO_SHADOW">
        <tr style="background-color: #E5DCCD; border:1px solid black;" >
          <td style="width: 35%;">
            <div class="OTHER_INFO_BOTTOM">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Magic Level:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['ml'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">First:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['first'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Club:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['club'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Sword:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['sword'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Axe:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['axe'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Distance:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['dist'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Shielding:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['shield'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Fishing:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['fish'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
          <td style="width: 65%;">
            <div class="OTHER_INFO_BOTTOM">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Soul War quest:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['soulwar']);?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Third prey slot:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['ThirdPreySlot']);?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Charm points:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['charms'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">All Blessings:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['allBlessings']);?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Bank balance:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['balance'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php
        }
      }
    }
  } else {
?>
  <div class="NO_OFFERS">
    <b id="error_text">No offers at the moment.</b>
  </div>
<div class="OFFER_GHOST">
  <table width="100%" class="table CUSTOM_SHADOW"> 
    <tr style="background-color: #d4c0a1; border:1px solid black;" >
      <td style="width: 100%;">
        <b>Character</b><br/>
        Level: 0 | Vocation: Paladin
        <table width="100%" class="table CUSTOM_SHADOW">
          <tr style="background-color: #E5DCCD; border:1px solid black;" >
            <td style="width: 10%;">
              <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">

              </div>
            </td>
            <td style="width: 10%;">
              <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">
                <div class="SLOT_ITEM" > </div>
                <div class="SLOT_ITEM" > </div>
                <div class="SLOT_ITEM" > </div>
                <div class="SLOT_ITEM" > </div>
              </div>
            </td>
            <td style="width: 55%;">
              <div class="OTHER_INFO">
                <table class="SHOP_TABLE_LIST">
                  <tbody>
                    <tr class="yes">
                      <td style="width: 50%;">Started in:</td>
                      <td style="width: 50%; text-align: right;">0000/00/00</td>
                    </tr>
                    <tr class="no">
                      <td style="width: 50%;">Ends in:</td>
                      <td style="width: 50%; text-align: right;">0000/00/00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
            <td style="width: 25%;">
              <div style="height: 85px; width: 100%; background-color: #D0C2AB; border:1px solid #352F26; text-align: center;">
                <p style="margin: 5px;">
                  <b>Price:</b> 0 coins
                </p>
              </div>
            </td>
          </tr>
        </table>
        <table width="100%" class="table INSIDE_INFO_SHADOW">
          <tr style="background-color: #E5DCCD; border:1px solid black;" >
            <td style="width: 35%;">
              <div class="OTHER_INFO_BOTTOM">
                <table class="SHOP_TABLE_LIST">
                  <tbody>
                    <tr class="yes">
                      <td style="width: 50%;">Magic Level:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="no">
                      <td style="width: 50%;">First:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="yes">
                      <td style="width: 50%;">Club:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="no">
                      <td style="width: 50%;">Sword:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="yes">
                      <td style="width: 50%;">Axe:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="no">
                      <td style="width: 50%;">Distance:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="yes">
                      <td style="width: 50%;">Shielding:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="no">
                      <td style="width: 50%;">Fishing:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
            <td style="width: 65%;">
              <div class="OTHER_INFO_BOTTOM">
                <table class="SHOP_TABLE_LIST">
                  <tbody>
                    <tr class="yes">
                      <td style="width: 50%;">Soul War quest:</td>
                      <td style="width: 50%; text-align: right;">no</td>
                    </tr>
                    <tr class="no">
                      <td style="width: 50%;">Third prey slot:</td>
                      <td style="width: 50%; text-align: right;">no</td>
                    </tr>
                    <tr class="yes">
                      <td style="width: 50%;">Charm points:</td>
                      <td style="width: 50%; text-align: right;">0</td>
                    </tr>
                    <tr class="no">
                      <td style="width: 50%;">All Blessings:</td>
                      <td style="width: 50%; text-align: right;">no</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
<?php
  }
}
?>


<?php 
if($action == 'createoffer'){
?>
<div class="ACTION_TITTLE_BOX">
  <b>Create Offer</b>
</div>
<?php
  $step = $_GET['step'];
  if($step == ''){
    die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=createoffer&step=choosechar'));
  }
  if($step == 'choosechar'){
    if(count($account_logged->getPlayersList()) == 0){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=5'));
    }
?>
<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="text-align: center; width: 100%;">
      <b>Choose the character you want to sell:</b>
       <form method="post" action="?subtopic=charstore&action=createoffer&step=requirements">
        <select name="characters" id="characters">
        <?php
          
          $account_players = $account_logged->getPlayers();
          
          foreach($account_players as $pl){
        ?>
          <option value="<?= $pl->getId();?>"><?= $pl->getName();?></option>
        <?php
          }
        ?>
        </select><br/><br/>
        <label for="passwd">Enter your password:</label><br/>
        <input type="password" id="passwd" name="passwd" placeholder="senha"><br/><br/>
        <label for="recoverykey">Enter your recovery key:</label><br/>
        <input type="text" id="recoverykey" name="recoverykey" placeholder="recovery key"><br/><br/>
        <input type="submit" value="continue"/>
      </form>
    </td>
  </tr>
</table>
<?php
  }
  if($step == 'requirements'){
    $choosed_char_id = filter_var($_POST['characters'], FILTER_SANITIZE_ADD_SLASHES);
    $rk_input = filter_var($_POST['recoverykey'], FILTER_SANITIZE_ADD_SLASHES);
    $password_input = filter_var($_POST['passwd'], FILTER_SANITIZE_ADD_SLASHES);
    if(empty($rk_input)){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=2'));
    }
    if(empty($password_input)){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=1'));
    }
    if(empty($choosed_char_id)){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=createoffer&step=choosechar'));
    }
    $player = new OTS_Player();
    $player->load($choosed_char_id);
    if(!CharShop::validaPassword($account_logged, $password_input)){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=1'));
    }
    if(!CharShop::validaRKey($account_logged, $rk_input)){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=error&id=2'));
    }
    if (!$player->isLoaded()){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=createoffer&step=choosechar'));
    }
    $checking = CharShop::displayCreateRequeriments($player, $account_logged);
    
?>
<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="width: 100%;">
      <p style="text-align: center;"><b>*Rules for creating an offer*</b></p>
      <div class="CHECK_LIST_INFO">
        <table class="SHOP_TABLE_LIST">
          <tbody>
            <tr class="yes">
              <td class="CHECK_LIST_INSIDE">have enough coins</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['has-coins']);?></td>
            </tr>
            <tr class="no">
              <td class="CHECK_LIST_INSIDE">Character must have a minimum level</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['char-level']);?></td>
            </tr>
            <tr class="yes">
              <td class="CHECK_LIST_INSIDE">Character cannot have House</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['char-house']);?></td>
            </tr>
            <tr class="no">
              <td class="CHECK_LIST_INSIDE">Character cannot be online</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['char-online']);?></td>
            </tr>
            <tr class="yes">
              <td class="CHECK_LIST_INSIDE">Character cannot be a guild owner</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['char-guild']);?></td>
            </tr>
            <tr class="no">
              <td class="CHECK_LIST_INSIDE">Character cannot be in a guild</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['char-guild']);?></td>
            </tr>
            <tr class="yes">
              <td class="CHECK_LIST_INSIDE">Character cannot have pending invites for other characters</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['char-guild']);?></td>
            </tr>
            <tr class="no">
              <td class="CHECK_LIST_INSIDE">Character cannot have offers in the market</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['char-market']);?></td>
            </tr>
            <tr class="yes">
              <td class="CHECK_LIST_INSIDE">Character has not participated in a transaction for at least <?= $config['char-shop']['exaust_sell'];?> day(s)</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['recent-trade']);?></td>
            </tr>
            <tr class="no">
              <td class="CHECK_LIST_INSIDE">Your account must be registered</td>
              <td style="text-align: right;"><?= CharShop::getImageByCheck($checking['registred']);?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </td>
  </tr>
</table>
<?php
  if($checking['all'] == 'yes'){
?>
<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >  
    <td style="text-align: center; width: 100%;">
      <b>You are selling the character: <i style="color: green"><?= $player->getName(); ?></i></b><br/>
      <b>Fill in the offer information:</b><br/>
      <form method="post" action="?subtopic=charstore&action=createoffer&step=final">
        <input type="hidden" name="char_id" value="<?= $choosed_char_id;?>"/>
        <label for="price">Price</label><br/>
        <input type="number" id="price" name="price" placeholder="min <?= $config['char-shop']['min_offer_price'];?> coins"><br/>
        <label for="expiredays">Offer Duration</label><br/>
        <input type="number" id="expiredays" name="expiredays" placeholder="min <?= $config['char-shop']['min_expire_days'];?> days"><br/>
        <input type="submit" value="Create Offer"/>
      </form>
    </td>
  </tr>
</table>
<?php
  } else {
    echo '
      <div class="ERROR_MSG">
        <b id="error_text">All rules must be respected to create offer</b><br/><br/>
        <b><a href="/?subtopic=charstore&action=offers">Back</a></b>
      </div>
    ';
  }
?>

<?php
  }
  if($step == 'final'){
    $choosed_id = filter_var($_POST['char_id'], FILTER_SANITIZE_ADD_SLASHES);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_ADD_SLASHES);
    $expire_days = filter_var($_POST['expiredays'], FILTER_SANITIZE_ADD_SLASHES);
    if(empty($choosed_id) || empty($price) || empty($expire_days)){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=createoffer&step=choosechar'));
    }
    $player = new OTS_Player();
    $player->load($choosed_id);
    if(!$player->isLoaded()){
      die(header('Location: ' . BASE_URL . '?subtopic=charstore&action=createoffer&step=choosechar'));
    }
    
    $check_erros = CharShop::checkCreateRequeriments($player, $account_logged, $price, $expire_days);
    if(count($check_erros) > 0){
      echo '
        <table width="100%" class="table CUSTOM_SHADOW"> 
            <tr style="background-color: #d4c0a1; border:1px solid black;" >  
              <td style="text-align: center; width: 100%;">
                <b>Erros:</b><br/>
                <p>
      ';
      foreach($check_erros as $err){
        echo '<b style="color: red;">'. $err .'</b><br/>';
      }
      echo '
              </p>
              <b><a href="?subtopic=charstore">Back</a></b>
            </td>
          </tr>
        </table>
      ';
    } elseif(count($check_erros) == 0){
      echo '
        <table width="100%" class="table CUSTOM_SHADOW"> 
            <tr style="background-color: #d4c0a1; border:1px solid black;" >  
              <td style="text-align: center; width: 100%;">
                <b>Aviso:</b><br/>
                <p>
      ';
      if(CharShop::createOffer($player, $account_logged, $price, $expire_days)){
        echo '<b style="color: green;">Offer created!</b>';
      } else {
        echo '<b style="color: red;">Oops, try again later.</b>';
      }
      echo '
              </p>
              <b><a href="?subtopic=charstore">Back</a></b>
            </td>
          </tr>
        </table>
      ';
    }
  }
}
if($action == 'myoffers'){
?>
<div class="ACTION_TITTLE_BOX">
  <b>My Offers</b>
</div>
<?php
  if(isset($_POST['canceloffer']) && !empty(filter_var($_POST['canceloffer'], FILTER_SANITIZE_ADD_SLASHES))){
    $offerid_to_cancel = filter_var($_POST['canceloffer'], FILTER_SANITIZE_ADD_SLASHES);
    echo '
      <table width="100%" class="table CUSTOM_SHADOW"> 
          <tr style="background-color: #d4c0a1; border:1px solid black;" >  
            <td style="text-align: center; width: 100%;">
              <b>Aviso:</b><br/>
              <p>
    ';
    if(CharShop::cancelOfferById($offerid_to_cancel)){
      echo '<b style="color: green;">Offer canceled!</b>';
    } else {
      echo '<b style="color: red;">Oops, try again later.</b>';
    }
    echo '
          </p>
          <b><a href="?subtopic=charstore">Back</a></b>
        </td>
      </tr>
    </table>
  ';
  
  } else {
  $offers = CharShop::getOffersBySeller($account_logged);
  if(count($offers) == 0){
?>
  <div class="NO_OFFERS">
    <b id="error_text">You have no offers.</b>
  </div>
<?php

  }
    foreach($offers as $offer){
      $player = new OTS_Player();
      $player->load($offer['player_id']);
        if ($player->isLoaded()){
          $pinfo = CharShop::getOfferPlayerInfo($player);
?>
<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="width: 100%;"> 
      <b><a href="<?= '/?characters/'.$pinfo['name'];?>"><?= $pinfo['name'];?></b></a><br/>
      Level: <?= $pinfo['level'];?> | <?= $pinfo['voc'];?> | <?= $pinfo['gender'];?>
      <table width="100%" class="table">
        <tr style="background-color: #E5DCCD; border:1px solid black;" >
          <td style="width: 10%;">
            <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">
              <img src="<?= $pinfo['looktypeimg']; ?>>" width="64" height="64" border="0" alt="" />
            </div>
          </td>
          <td style="width: 10%;">
            <div style="height: 85px; width: 85px; background-color: #D0C2AB; border:1px solid #352F26;">
              <img class="SLOT_ITEM" style="margin: 5px;" src="<?= $pinfo['slot1'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin-bottom: 5px;" src="<?= $pinfo['slot2'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin: 5px;" src="<?= $pinfo['slot3'];?>" width="32" height="32" border="0" alt="" />
              <img class="SLOT_ITEM" style="margin-bottom: 5px;" src="<?= $pinfo['slot4'];?>" width="32" height="32" border="0" alt="" />
            </div>
          </td>
          <td style="width: 55%;">
            <div class="OTHER_INFO">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Started in:</td>
                    <td style="width: 50%; text-align: right;"><?= $offer['dateStart'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Ends in:</td>
                    <td style="width: 50%; text-align: right;"><?= $offer['dateEnd'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
          <td style="width: 25%;">
            <div style="height: 85px; width: 100%; background-color: #D0C2AB; border:1px solid #352F26; text-align: center;">
              <p style="margin: 5px;">
                <b>Price:</b> <?= $offer['price'];?> coins
              </p>
              
              <form method="post" action="?subtopic=charstore&action=myoffers">
                <input type="hidden" name="canceloffer" value="<?= $offer['id']; ?>"/>
                <input style="background-color: #FF0000;" type="submit" value="Cancel"/>
              </form>
              
            </div>
          </td>
        </tr>
      </table>
      <table width="100%" class="table INSIDE_INFO_SHADOW">
        <tr style="background-color: #E5DCCD; border:1px solid black;" >
          <td style="width: 35%;">
            <div class="OTHER_INFO_BOTTOM">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Magic Level:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['ml'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">First:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['first'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Club:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['club'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Sword:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['sword'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Axe:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['axe'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Distance:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['dist'];?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Shielding:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['shield'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Fishing:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['fish'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
          <td style="width: 65%;">
            <div class="OTHER_INFO_BOTTOM">
              <table class="SHOP_TABLE_LIST">
                <tbody>
                  <tr class="yes">
                    <td style="width: 50%;">Soul War quest:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['soulwar']);?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">Third prey slot:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['ThirdPreySlot']);?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Charm points:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['charms'];?></td>
                  </tr>
                  <tr class="no">
                    <td style="width: 50%;">All Blessings:</td>
                    <td style="width: 50%; text-align: right;"><?= CharShop::getImageByCheck($pinfo['allBlessings']);?></td>
                  </tr>
                  <tr class="yes">
                    <td style="width: 50%;">Bank balance:</td>
                    <td style="width: 50%; text-align: right;"><?= $pinfo['balance'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php
      }
    }
  }
}
if($action == 'mytransactions'){

?>
<div class="ACTION_TITTLE_BOX">
  <b>My transactions</b>
</div>
<table width="100%" class="table CUSTOM_SHADOW"> 
  <tr style="background-color: #d4c0a1; border:1px solid black;" >
    <td style="text-align: center; width: 100%;">
      <table width="100%" class="table">
        <tr>
          <th>Type</th>
          <th>Date</th>
          <!-- <th>Seller</th> -->
          <th>Price</th>
          <!-- <th>Buyer</th> -->
        </tr>
        <?php 
          $history_list = CharShop::getAccountTransactionHistory($account_logged);
          foreach ($history_list as $history){
            $temp_type_strings = array('', 'Buy', 'Sell', 'Cancellation');
            
            echo '
              <tr>
                <td>'.$temp_type_strings[$history['type']].'</td>
                <td>'.$history['date'].'</td>
                <td>'.$history['price'].'</td>
              </tr>
            ';
          }
        ?>
      </table>
    </td>
  </tr>
</table>

<?php
}
?>
    </div>
</div>