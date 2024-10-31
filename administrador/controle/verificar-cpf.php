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

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados via POST
    $cpf = $_POST["cpf"];

    // Consulta se o CPF já está cadastrado
    try {
        $query = "SELECT COUNT(*) AS total FROM dados_autuado WHERE cpf = :cpf";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o CPF está cadastrado
        if ($row['total'] > 0) {
            echo "CPF já cadastrado";
        } else {
            echo "CPF não cadastrado";
        }
    } catch(PDOException $e) {
        echo "Erro ao consultar o CPF: " . $e->getMessage();
    }
} else {
    // Se os dados não foram enviados via POST, retorna uma mensagem de erro
    echo "Erro: dados não recebidos via POST";
}
?>
