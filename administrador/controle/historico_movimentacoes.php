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

// Supondo que você obtenha o ID da autuação da requisição GET
$idAutuacao = $_GET['id'];

// Consulta para selecionar o histórico de movimentações da tabela 'mov_autuacoes' com base no ID da autuação
$query = "SELECT mov_autuacoes.id_mov,
DATE_FORMAT(mov_autuacoes.data, '%d/%m/%Y %H:%i:%s') AS data,
DATE_FORMAT(mov_autuacoes.data_prazo, '%d/%m/%Y') AS data_prazo,
status.descricao AS status_descricao,
mov_autuacoes.descricao,
usuario.usuario AS nome_usuario
FROM mov_autuacoes
INNER JOIN status ON mov_autuacoes.id_status = status.id_status
INNER JOIN usuario ON mov_autuacoes.id_usuario = usuario.id_usuario
WHERE mov_autuacoes.id_autuacao = :idAutuacao
ORDER BY mov_autuacoes.id_mov DESC";

try {
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idAutuacao', $idAutuacao, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro ao executar a consulta: " . $e->getMessage());
}

// Retornar os resultados no formato JSON
header('Content-Type: application/json');
echo json_encode($resultados);

?>
