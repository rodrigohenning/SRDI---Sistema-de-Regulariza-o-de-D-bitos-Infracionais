<?php
session_start();
include('include/conexao_login.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select usuario, id_usuario from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$usuario_data = mysqli_fetch_assoc($result);
    $_SESSION['usuario'] = $usuario_data['usuario'];
    $_SESSION['id_usuario'] = $usuario_data['id_usuario'];
	header('Location: administrador/index.php');
	exit();
} else {
	$_SESSION['senha_invalida'] = true;
	header('Location: index.php');
	exit();
}