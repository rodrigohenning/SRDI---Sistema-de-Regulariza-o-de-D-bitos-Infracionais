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

// Consulta para selecionar todos os status da tabela 'status'
$query = "SELECT `id_status`, `descricao`, `prazo_dias` FROM `status`;";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro ao executar a consulta: " . $e->getMessage());
}

// Retornar os resultados no formato JSON
header('Content-Type: application/json');
echo json_encode($resultados);

?>
