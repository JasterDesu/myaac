<?php

defined('MYAAC') or die('Direct access not allowed!');

require_once PLUGINS . 'jpay/config.php';

$title = 'Donate Mercado Pago';

if (!$logged || !$account_logged->isLoaded()) {
	$errors[] = 'Please login first';
	$twig->display('error_box.html.twig', array('errors' => $errors));
	return;
}

?>

<div class="terms" style="display:none;">
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
	<p>1.1 O doador está ciente que não está comprando, mas está doando e, como bônus, adicionaremos Premium Points (item virtual) a conta do doador.</p>
		<p>1.2 O servidor não é responsável por Accounts, Characters, Items e Premium Points. Accounts, Characters, Items e Premium Points é de total responsabilidade do player! Nós não recuperamos Accounts, Characters, Items e Premium Points perdidos ou roubados.</p>
		<p>1.3 Pagamentos fraudulentos são uma violação dos nossos termos. Se você efetuar um pagamento fraudulento, todas as suas contas serão permanentemente bloqueadas sem aviso prévio.</p>
		<p>1.4 Os Premium Points (Item virtual) por pagamentos manuais serão entregues dentro do prazo de 8 horas úteis na conta do doador.</p>
				
    <br>
    <hr style="border-bottom:2px solid #5a2800;">
    <div class="text-center">
        <p>Se aceitar as regras informadas acima clique em <strong>Concordo</strong></p>
        <div class="input-group text-center" style="display:flex; justify-content:center;">
        <input type="checkbox" id="terms">
        <label for="terms">Eu aceito os <a href="?terms" target="_blank">termos</a> e desejo prosseguir.</label>
        </div>
        <button class="btn btn-success btn-term" onclick="confirmTerm()" disabled>Concordo</button>
    </div>
</div>
<!-- style="display:none;" -->
<style>
.lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ripple div {
  position: absolute;
  border: 3px solid #000;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  4.9% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  5% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}

</style>
<center>
<div class="lds-ripple" style="display: none; margin-block: 100px;"><div></div><div></div></div>
</center>
<div class="formDonate" style="padding: 20px;">
    <div class="msg" style="text-align: center; padding: 10px;"></div>
    <form action="" method="POST" class="form">
        <div class="row">
            <div class="col-md-6">
			<center><img src="/templates/tibiacom/images/vip.png"><br><br></center>
								<center>
								
                <label for="amount" >Valor:</label>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input type="text" class="form-control" id="currency" name="currency" min="1" style="max-width: 150px;">
                    <span class="input-group-addon">.00</span>
                </div>
                <input type="hidden" name="email" value="<?= $account_logged->getEMail() ?>">
                <br>
                <label for="receberAmount" style="font-weight:bold;">Pontos a receber:</label>
                <input type="text" class="form-control" id="receberAmount" value="0" disabled style="max-width: 150px;">
                <br>
                <input type="submit" value="Donate" min="1" class="btn btn-success"></center>
            </div>
        </div>
    </form>
</div>
<script>
	
	
	
    function confirmTerm() {
        $('.formDonate').show();
        $('.terms').hide();
        $('.msg').html('<div class="alert alert-success">Escolha o valor da doação!</div>');
    }
	function getDonateBonus(v) {
		var bonus = <?php echo json_encode($config['donate_bonus']); ?>;
		var r = 1.0;
		for(var i = 0; i < bonus.length; i++) {
			var x = bonus[i];
			if(v >= x[0] && v >= x[1]) {
				r = x[2];
			}
		}
		return Math.floor(v * r);
	}
    $('#terms').change(function() {
		
		
        if($(this).is(":checked")) {
            $('.btn-term').removeAttr('disabled');
        } else {
            $('.btn-term').attr('disabled', 'disabled');

        }
    });

    $('#currency').keyup(function() {
        var amount = $(this).val();
        var receberAmount = amount * <?php echo $config['mercadopago']['MILTIPLICADOR']; ?>;
        $('#receberAmount').val(getDonateBonus(receberAmount));
    }).keyup();

    $(function(){
        $('form').submit(function(e){
            e.preventDefault();
            var valor = $('input[type="currency"]').val();
            if(valor == ''){
                alert('Digite o valor');
                return false;
            }
						$('.lds-ripple').css("display","block");
						$('.formDonate').css("display","none");
            $.ajax({
                url: '<?php echo $config['mercadopago']['URL_BASE']; ?>?jpayprocess',
                type: 'POST',
                data: $(this).serialize(),
				
                success: function(data){
                    $('.msg').html(data);
                },
                error: function(){
										// $('.lds-ripple').css("display","none");
										// $('.formDonate').css("display","block");
                    $('.msg').html('<div class="alert alert-danger">Erro ao processar a doação!</div>');
                }
            });
            return false;
        });
    });


</script>