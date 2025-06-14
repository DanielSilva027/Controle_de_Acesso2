<?php
//Iniciar  Sessão
session_start();

//Conexão
require_once 'conexao.php';

if(isset($_POST['btn-cadastrar'])):
	$nome=mysqli_escape_string($connect,$_POST['cpf']);
	$sobrenome=mysqli_escape_string($connect,$_POST['nome']);
	$email=mysqli_escape_string($connect,$_POST['email']);
	$idade=mysqli_escape_string($connect,$_POST['telefone']);
  $nome=mysqli_escape_string($connect,$_POST['tpc']);
	$sobrenome=mysqli_escape_string($connect,$_POST['face']);
	$email=mysqli_escape_string($connect,$_POST['senha']);
	
	$sql="INSERT INTO user(nome,cpf,email,telefone,tpc,face,senha) VALUES ('$nome', '$cpf', '$email', $telefone,$tcp,$face,$senha)";
	echo $sql;
	if(mysqli_query($connect,$sql)):
		$_SESSION['mensagem'] = "Cadastro com sucesso!";
		header('Location: ../28crud_index.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";		
		header('Location: ../28crud_index.php?erro');
	endif;
endif;	

?>