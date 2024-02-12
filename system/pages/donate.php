<?php
defined('MYAAC') or die('Direct access not allowed!');
$title = 'Donate';

function valideSteps($str){
  $action_list = array('rulesagree', 'method', 'payment');
  foreach($action_list as $action){
    if($str == $action){
      return true;
    }
  }
  return false;
}

function valideMethods($str){
  $action_list = array('pix', 'pagseguro', 'mercadopago');
  foreach($action_list as $action){
    if($str == $action){
      return true;
    }
  }
  return false;
}

$step = "";

if (isset($_GET['step'])) {
	$step = $_GET['step'];
}

if(!valideSteps($step)){
  $step = 'rulesagree';
}

// if($logged){
if($step != 'rulesagree' && !$logged){
  echo '<p>Você precisa estar logado. <a href="?account/manage">Fazer login</a></p>';
}

?>
<style>
    .continue_btn{
        height: 34px;
        width: 142px;
        border: 0;
        background: url('templates/tibiacom/images/themeboxes/donate_button.png');
        font-family: Verdana;
        font-weight: 100;
        color: #d5c3af;
        font-size: 12px;
        cursor: pointer;
        margin: 20;
    }
    .continue_btn:hover{
        background: url('templates/tibiacom/images/themeboxes/donate_button_hover.png');
        color: #fff;
    }
   .PAYMETHOD {
    background-image:url(/templates/tibiacom/images/shop_item_bg.png);
    padding: 10px;
    margin: 10px;
    width: 130px;
    height: 130px;
    background-repeat: no-repeat;
    font-size: 11px;
    }
    .PAYMETHOD_DISABLED {
      opacity: 0.5;
      background-image:url(/templates/tibiacom/images/shop_item_bg.png);
      padding: 10px;
      margin: 10px;
      width: 130px;
      height: 130px;
      background-repeat: no-repeat;
      font-size: 11px;
    }
    .PAYMETHOD_NAME {
      text-align: center;
      padding-top: 7px;
      color: white;
    }
    .PAYMETHOD_IMAGE {
      margin-top: 15px;
      padding-top: 7px;
      text-align: center;
    }
    .PAYMETHOD_IMAGE>img {
      max-height: 59px;
    }
    .PAYMETHOD_BUTTON {
      padding-top: 15px;
      text-align: center;
      color: white;
    }
    .PAYMETHOD_CHECKBOX {
      padding-top: 30px;
      text-align: center;
      color: white;
    }
</style>

<?php 
  if($step == 'rulesagree'){
    ?>
      <div class="TableContainer" style="border: 1px solid #000000; position: relative; width: 100%; font-size: 1px; color: #5a2800; font-family: Verdana, Arial, 'Times New Roman', sans-serif;">
        <div class="CaptionContainer" style="position: relative; font-size: 1pt; height: 23px; width: 100%; background-color: #5f4d41 !important;">
          <div class="CaptionInnerContainer" style="position: relative; width: 100%; height: 20px; padding-top: 2px; padding-bottom: 4px;">
            <span class="CaptionEdgeLeftTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionEdgeRightTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionBorderTop" style="background-image:url(/templates/tibiacom/images/global/content/table-headline-border.gif);"></span> <span class="CaptionVerticalLeft" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
            <div class="Text">Donation Rules</div>
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
                                <tr>
                                  <td width="100%">
                                    <p>
                                      Ao fazer uma doação, você ajuda a estabilidade do servidor e aumenta a qualidade dele.
                                    </p>
                                    <p>
                                      Os pontos que são repassados ​​aos jogadores doadores representam apenas nosso bônus, ou seja, você não está comprando pontos, mas recebendo um bônus simbólico (em forma de pontos) que o beneficia dentro do jogo; você pode usar seus pontos da maneira que quiser.
                                    </p>
                                    <p>
                                      Entendemos sua doação como uma via de mão dupla para obter credibilidade. Acreditando que vale a pena investir em manutenção de servidores, investimos em você creditando pontos, que, como eu disse anteriormente, podem ser usados ​​da maneira que melhor lhe convier.
                                    </p>
                                    <p>
                                      Ao doar para o servidor , você entende e aceita as seguintes condições:
                                    </p>
                                    <p>
                                  <br><br>1.1 O doador está ciente que não está comprando, mas está doando e, como bônus, adicionaremos coins (item virtual) a conta do doador.
                                  <br><br>1.2 O servidor não é responsável por Accounts, Characters, Items e coins. Accounts, Characters, Items e coins é de total responsabilidade do player! Nós não recuperamos Accounts, Characters, Items e coins perdidos ou roubados.
                                  <br><br>1.3 Pagamentos fraudulentos são uma violação dos nossos termos. Se você efetuar um pagamento fraudulento, todas as suas contas serão permanentemente bloqueadas sem aviso prévio.
                                  <br><br>1.4 Os coins (Item virtual) por pagamentos automaticos serão entregues dentro do prazo de 24 horas úteis na conta do doador.
                                    </p>
                                    
                                    
                                    <p>
                                      Clicando em continue, você concorda com todos as regras.
                                    </p>
                                    
                                    <center>
                                      <a href="https://merakiglobal.com.br/?subtopic=donate&step=method">
                                        <button class="continue_btn">Continue</button>
                                      </a>
                                    </center>
                                  </td>
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
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </tbody>
        </table>
      </div><br/><br/>
    <?php
  }
  if($step == 'method' && $logged){
    
      ?>
      
      

      <div class="TableContainer" style="border: 1px solid #000000; position: relative; width: 100%; font-size: 1px; color: #5a2800; font-family: Verdana, Arial, 'Times New Roman', sans-serif;">
        <div class="CaptionContainer" style="position: relative; font-size: 1pt; height: 23px; width: 100%; background-color: #5f4d41 !important;">
          <div class="CaptionInnerContainer" style="position: relative; width: 100%; height: 20px; padding-top: 2px; padding-bottom: 4px;">
            <span class="CaptionEdgeLeftTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionEdgeRightTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionBorderTop" style="background-image:url(/templates/tibiacom/images/global/content/table-headline-border.gif);"></span> <span class="CaptionVerticalLeft" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
            <div class="Text">Select payment method</div>
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
                            
							<form method="post" action="?subtopic=donate&step=payment">
                            <table>
                              <tbody>
                                <tr>
                                  <td width="100%" style="border: 0px">
                                    
                                      <table>
                                        <tbody>
                                          <tr>
											
                                            <!--<td width="50%">
                                              <div class="PAYMETHOD">
                                                <div class="PAYMETHOD_NAME">Pix</div>
                                                <div class="PAYMETHOD_IMAGE"><img src="/templates/tibiacom/images/logo-pix.png"/></div>
                                                <div class="PAYMETHOD_BUTTON">Donate with pix</div>
                                                <div class="PAYMETHOD_CHECKBOX">
                                                  <input type="radio" name="paymentmethod" value="pix" checked>
                                                </div>
                                              </div>
                                            </td>-->
											
											<td width="50%" style="border: 0px">
                                              <div class="PAYMETHOD">
                                                <div class="PAYMETHOD_NAME">Mercado pago</div>
                                                <div class="PAYMETHOD_IMAGE"><img src="/templates/tibiacom/images/mercado-pago.png"/></div>
                                                <div class="PAYMETHOD_BUTTON">Automático</div>
                                                <div class="PAYMETHOD_CHECKBOX">
                                                  <input type="radio" name="paymentmethod" value="mercadopago" checked>
                                                </div>
                                              </div>
                                            </td>
											
											<!--
											<td width="50%" style="border: 0px">
                                              <div class="PAYMETHOD" >
                                                <div class="PAYMETHOD_NAME">PagSeguro</div>
                                                <div class="PAYMETHOD_IMAGE"><img src="/templates/tibiacom/images/logo-pagseguro.png"/></div>
                                                <div class="PAYMETHOD_BUTTON">Automático</div>
                                                <div class="PAYMETHOD_CHECKBOX">
                                                  <input type="radio" name="paymentmethod" value="pagseguro">
                                                </div>
                                              </div>
                                            </td>-->
																						
                                            
																						
                                          </tr>
                                        </tbody>
                                      </table>
                                      
                                     </div>
									</div>
                                    
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                         <p><br/><br/><br/><center>
                          <button type="submit" class="continue_btn">Continue</button>
                        </center></p>
                        </form>
                        <div class="TableShadowContainer" style="position: relative; margin-right: 5px;">
                          <div class="TableBottomShadow" style="position: relative; font-size: 1px; height: 5px; width: 731px; padding: 0px; margin: 0px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-bm.gif');">
                            <div class="TableBottomLeftShadow" style="position: relative; height: 5px; width: 4px; float: left; padding: 0px; margin: 0px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-bl.gif');">&nbsp;</div>
                            <div class="TableBottomRightShadow" style="position: relative; float: right; right: -2px; top: 0px; height: 5px; width: 4px; background-image: url('<?=$template_path?>/images/global/content/table-shadow-br.gif');">&nbsp;</div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </tbody>
        </table>
      </div><br/><br/>
      <?php
      
    
  }
  if($step == 'payment' && $logged){
    if(!isset($_POST['paymentmethod'])){
      die(header('Location: ' . BASE_URL . '?subtopic=donate&step=method'));
    }
    $method = $_POST['paymentmethod'];
    if(!valideMethods($method)){
      die(header('Location: ' . BASE_URL . '?subtopic=donate&step=method'));
    }
    if($method == 'pix'){
?>

<div class="TableContainer" style="border: 1px solid #000000; position: relative; width: 100%; font-size: 1px; color: #5a2800; font-family: Verdana, Arial, 'Times New Roman', sans-serif;">
  <div class="CaptionContainer" style="position: relative; font-size: 1pt; height: 23px; width: 100%; background-color: #5f4d41 !important;">
    <div class="CaptionInnerContainer" style="position: relative; width: 100%; height: 20px; padding-top: 2px; padding-bottom: 4px;">
      <span class="CaptionEdgeLeftTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionEdgeRightTop" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionBorderTop" style="background-image:url(/templates/tibiacom/images/global/content/table-headline-border.gif);"></span> <span class="CaptionVerticalLeft" style="background-image:url(/templates/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
      <div class="Text">Donate with pix</div>
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
                          <tr>
                            <td width="100%">
																			  
																																					
																																					 
																				
                              <p><center>Chave pix: <b>*********</b> / Titular: ******</center></p>
																				
                              <p><center>Enviar comprovante do PIX, junto ao seu nome completo, valor e nome do seu personagem para o nosso whatsapp.</center></p>
                              <p><center><b><a style="color:green;" href="/" target="_blank">WHATSAPP OFICIAL</a></b></center></p>
                              <p><center>Você também pode usar o whatsapp para dúvidas ou ajuda.</center></p>
                              <p><center><a href="?subtopic=donate"><button class="continue_btn">Back</button></a></center></p>
                            </td>
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
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
</div><br/><br/>

<?php
	$urlhttps = 'https://merakiglobal.com.br/';
    } elseif($method == 'pagseguro'){
			die(header('Location: ' . $urlhttps . '?subtopic=points&system=pagseguro'));
    } elseif($method == 'mercadopago'){
			die(header('Location: ' . $urlhttps . '?jpaydonate'));
		}
  }