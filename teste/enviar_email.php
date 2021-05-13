<?php
	session_start();
	
	$vaga = $_POST['inputVaga'];			
	$arquivo = $_FILES["arquivo"];

	$assunto = $vaga;

	

	/* Função que codifica o anexo para poder ser enviado na mensagem  */
	if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
	
	$fp = fopen($_FILES["arquivo"]["tmp_name"],"rb"); // Abri o arquivo enviado.
	$anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"])); // Le o arquivo aberto na linha anterior
	$anexo = base64_encode($anexo); // Codifica os dados com MIME para o e-mail 
	fclose($fp); // Fecha o arquivo aberto anteriormente
		$anexo = chunk_split($anexo); // Divide a variável do arquivo em pequenos pedaços para poder enviar
		$mensagem = "--$boundary\n"; // Nas linhas abaixo possuem os parâmetros de formatação e codificação, juntamente com a inclusão do arquivo anexado no corpo da mensagem
		$mensagem.= "Content-Transfer-Encoding: 8bits\n"; 
		$mensagem.= "Content-Type: text/html; charset=\"utf-8\"\n\n";
		$mensagem.= "$corpo_mensagem\n"; 
		$mensagem.= "--$boundary\n"; 
		$mensagem.= "Content-Type: ".$arquivo["type"]."\n";  
		$mensagem.= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";  
		$mensagem.= "Content-Transfer-Encoding: base64\n\n";  
		$mensagem.= "$anexo\n";  
		$mensagem.= "--$boundary--\r\n"; 
	}
	else // Caso não tenha anexo
	{
	$mensagem = "--$boundary\n"; 
	$mensagem.= "Content-Transfer-Encoding: 8bits\n"; 
	$mensagem.= "Content-Type: text/html; charset=\"utf-8\"\n\n";
	$mensagem.= "$corpo_mensagem\n";
}
				
		
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
	
	
	
	$headers = "MIME-Version: 1.1".$quebra_linha;
	$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;	
	$headers .= "Candidatura a vaga:";
	
	if(!mail('gestao.ti@cmgb.com.br', $assunto, $mensagem, $headers ,"-r".$emailsender)){ // Se for Postfix
		$headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
		mail('gestao.ti@cmgb.com.br', $assunto, $mensagem, $headers );
		echo "<br><br><center><b><font color='green'>Mensagem enviada com sucesso!";
	}else
	{
	echo "<br><br><center><b><font color='red'>Ocorreu um erro ao enviar a mensagem!";
   }
	

	

////////////////////////////////////////
?>
