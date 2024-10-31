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
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $cidade = $_POST["cidade"];

    // Executa a consulta SQL para inserir os dados
    try {
        $query = "INSERT INTO dados_autuado (cpf, nome, telefone, email, endereco, cidade) VALUES (:cpf, :nome, :telefone, :email, :endereco, :cidade)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->execute();

        // Retorna uma mensagem de sucesso para a página anterior
        echo "Dados cadastrados com sucesso";
        exit();
    } catch(PDOException $e) {
        // Retorna uma mensagem de erro para a página anterior
        header("Location: ../cadastro_autuado.php?mensagem=Erro ao cadastrar os dados: " . $e->getMessage());
        exit();
    }
} else {
    // Se os dados não foram enviados via POST, redireciona para a página anterior
    header("Location: pagina_anterior.php");
    exit();
}
?>
