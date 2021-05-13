<?php
  
	session_start();
	
	$email_recebe = "gestao.ti@cmgb.com.br";
	$email_envio  = "gestao.ti@cmgb.com.br";
	
	////////////////////////////////////////
	$name   		= $_POST['inputNome'];
	$email   		= $_POST['inputEmail'];		
	$telefone   	= $_POST['inputTelefone'];	
	$vaga			= $_POST['inputVaga'];			
	$messagem 		= $_POST['inputObs'];	
 
	$assunto = $vaga;

	///////////////////////
	if(isset($_POST['upload'])){
		
		foreach($_FILES["anexar_documento"]["name"] as $key => $valor){
									
			$pasta = '../download/';		
						
			$tmp_name   = $_FILES["anexar_documento"]["tmp_name"][$key];
	 		$nome       = $_FILES["anexar_documento"]["name"][$key];
			$uploadfile = $pasta . basename($nome);
			
			move_uploaded_file($tmp_name, $uploadfile);
			
			
			
		}
													
	}
				
		
	
	////////////////////////////////////////
	/* Medida preventiva para evitar que outros domínios sejam remetente da sua mensagem. */
	if (preg_match('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
			$emailsender='vagas@portal.cmgb.com.br'; // Substitua essa linha pelo seu e-mail@seudominio
	} else {
			$emailsender = "vagas@portal.cmgb.com.br";
			// Na linha acima estamos forçando que o remetente seja 'webmaster@seudominio',
			// você pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
	}
	 
	/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
	if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
	elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
	else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
			 
	/* Montando a mensagem a ser enviada no corpo do e-mail. */
	$mensagemHTML = '
	
		<div style="margin: 10px 200px;">
			<p>Nome do Candidato: '.$name.'</p>
			<p>email: '.$email.'</p>
			<p>Telefone: '.$telefone.'</p>
			<p>Vaga: '.$vaga.'</p>
			<p>Mensagem: '.$messagem.'</p>
			<p>Currículo: <a href="http://portal.cmgb.com.br/download/'.$nome.'" target="_blank">anexo</a></p>
			<br></br>
			<strong>NÃO RESPONDA ESTE E-MAIL!</strong>
		</div>
	';
	
	
	/* Montando o cabeçalho da mensagem */
	$headers = "MIME-Version: 1.1".$quebra_linha;
	$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
	// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
	$headers .= "From: Portal CMGB<vagas@portal.cmgb.com.br>";
	//$headers .= "Cc: ".$comcopia.$quebra_linha;
	//$headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
	//$headers .= "Reply-To: ".$emailsender.$quebra_linha;
	// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
	 
	/* Enviando a mensagem */
	//Verificando qual é o MTA que está instalado no servidor e efetuamos o ajuste colocando o paramentro -r caso seja Postfix
	
	
	if(!mail("selecao3@cmgb.com.br", $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
		$headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
		mail("selecao3@cmgb.com.br", $assunto, $mensagemHTML, $headers );
		
	}
	
	
	
	////////////////////////////////
	
	header('Location: http://portal.cmgb.com.br/formul%C3%A1rios/form3.html');
	exit;
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

////////////////////////////////////////
?>
