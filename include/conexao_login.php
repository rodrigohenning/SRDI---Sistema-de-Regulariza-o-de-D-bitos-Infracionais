<?php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'db_drdi');


$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('não foi possivel conectar ao banco');

?>