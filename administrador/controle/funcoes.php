<?php

// Função para buscar os dados do autuado pelo CPF
function buscarDadosAutuadoPorCPF($cpf) {
    // Configurações do banco de dados
    $host = "";
    $dbname="";
    include('../../include/conexao.php');
    
    try {
        // Conexão com o banco de dados usando PDO
        $conexao = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
        // Define o modo de erro do PDO para exceção
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a consulta SQL para buscar os dados do autuado pelo CPF
        $stmt = $conexao->prepare("SELECT `id_autuado`, `cpf`, `nome`, `telefone`, `email`, `endereco`, `cidade` FROM `dados_autuado` WHERE `cpf` = :cpf");

        // Executa a consulta com o parâmetro do CPF
        $stmt->execute(array('cpf' => $cpf));

        // Obtém os dados do autuado
        $dadosAutuado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fecha a conexão com o banco de dados
        $conexao = null;

        $jsonDadosAutuado = json_encode($dadosAutuado);

        // Retorna os dados do autuado
        return $jsonDadosAutuado;

    } catch(PDOException $e) {
        // Em caso de erro, imprime a mensagem de erro
        echo "Erro na consulta: " . $e->getMessage();
        // Retorna false em caso de erro
        return false;
    }
}



?>