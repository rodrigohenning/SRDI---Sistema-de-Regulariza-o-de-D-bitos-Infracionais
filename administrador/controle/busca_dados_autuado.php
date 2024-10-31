<?php

// Configurações do banco de dados
include('../../include/conexao.php');

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}

// Consulta para selecionar os dados da tabela 'autuados'
$query = "SELECT id_autuado, cpf, nome, telefone, email, endereco, cidade FROM dados_autuado";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro ao executar a consulta: " . $e->getMessage());
}

//var_dump($resultados);

// Retornar os resultados no formato JSON
 header('Content-Type: application/json');
 echo json_encode($resultados);

// Retornar os resultados no formato JSON
//echo json_encode($resultados);


?>