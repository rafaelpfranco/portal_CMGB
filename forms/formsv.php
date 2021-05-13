<?php
  
	session_start();
	
	$email_recebe = "gestao.ti@cmgb.com.br";
	$email_envio  = "gestao.ti@cmgb.com.br";
	
	////////////////////////////////////////
	//Dados Empresa
	$fantasia   	= $_POST['inputEmpresa'];	
	$cnpj   		= $_POST['inputCnpj'];
	$razao   		= $_POST['inputRazao'];
	$endereco   	= $_POST['inputEndereco'];
	$bairro   		= $_POST['inputBairro'];
	$cidade   		= $_POST['inputCidade'];		
	$cep 			= $_POST['inputCep'];		
	$representante 	= $_POST['inputRepresentante'];	
	$email   		= $_POST['inputEmail'];	
	$telefone   	= $_POST['inputTelefone'];

	//Dados Vaga
	$vaga   		= $_POST['inputVaga'];
	$emailVaga   	= $_POST['inputEmailV'];
	$requisicoes   	= $_POST['inputReq'];
	$habilidades   	= $_POST['inputHab'];		
	$area 			= $_POST['inputArea'];
	$nivel   		= $_POST['inputNivel'];
	$contrato   	= $_POST['inputCont'];
	$horario   		= $_POST['inputHora'];
	$beneficios   	= $_POST['inputBenef'];		
	$salario 		= $_POST['inputSal'];
	$obs   			= $_POST['inputObsC'];
	$escolaNivel   	= $_POST['inputNivelE'];
	$curso   		= $_POST['inputCurso'];
	$especializacao = $_POST['inputEspec'];		

	$assunto = $vaga;
				
		
	if (preg_match('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
		$emailsender = "gestao.ti@cmgb.com.br"; 
	} else {
		$emailsender = "gestao.ti@cmgb.com.br";
	}
	
	
	/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
	if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
	elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
	else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
			 
	/* Montando a mensagem a ser enviada no corpo do e-mail. */
	$mensagemHTML = '
	
		<div style="margin: 10px 200px;">
		<p><strong>Dados da Empresa</strong><p>
	    <p>Nome Fantasia: '.$fantasia.'</p>
	    <p>CNPJ: '.$cnpj.'</p>
	    <p>Razão Social: '.$razao.'</p>
	    <p>Endereço Completo: '.$endereco.'</p>
	    <p>Bairro: '.$bairro.'</p>
	    <p>Cidade/Estado: '.$cidade.'</p>
	    <p>CEP: '.$cep.'</p>
	    <p>Representante: '.$representante.'</p>
		<p>E-mail: '.$email.'</p>
	    <p>Telefone: '.$telefone.'</p>

		<p><strong>Dados da Vaga</strong><p>

	    <p>Nome da Vaga: '.$vaga.'</p>
	    <p>E-mail do setor: '.$emailVaga.'</p>
	    <p>Requisitos: '.$requisicoes.'</p>
	    <p>Habilidades Técnicas: '.$habilidades.'</p>
	    <p>Área de Atuação: '.$area.'</p>
	    <p>Nível da Vaga: '.$nivel.'</p>

		<p>Tipo de Contratação: '.$contrato.'</p>
		<p>Horário de Trabalho: '.$horario.'</p>
		<p>Benefícios: '.$beneficios.'</p>
		<p>Salário de Contratação: '.$salario.'</p>
		<p>Observações Complementares: '.$obs.'</p>
		<p>Nível de Escolaridade: '.$escolaNivel.'</p>
		<p>Curso: '.$curso.'</p>
		<p>Especialização: '.$especializacao.'</p>

		</div>
	';
	
	
	$headers = "MIME-Version: 1.1".$quebra_linha;
	$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;	
	$headers .= "From: Cadastro de Vaga<gestao.ti@cmgb.com.br>";
	
	if(!mail('gestao.ti@cmgb.com.br', $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
		$headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
		mail('gestao.ti@cmgb.com.br', $assunto, $mensagemHTML, $headers );
		
	}
	
	

	header('Location: http://portal.cmgb.com.br/formul%C3%A1rios/solicitarvaga.html');
	exit;

////////////////////////////////////////
?>



