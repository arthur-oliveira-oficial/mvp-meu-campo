<?php

/**
 * Script para testar a conexão com o banco de dados.
 *
 * Este script utiliza a classe de configuração para obter uma instância do PDO
 * e verifica se a conexão pode ser estabelecida com sucesso.
 */

// Exibe todos os erros para facilitar a depuração.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define o cabeçalho para texto plano para uma saída limpa no navegador.
header('Content-Type: text/plain; charset=utf-8');

// Inclui o arquivo da classe de conexão com o banco de dados.
// O caminho __DIR__ . '/../' garante que estamos partindo do diretório raiz do projeto.
require_once __DIR__ . '/../config/config_database.php';

// Utiliza o namespace da classe de banco de dados para facilitar a chamada.
use Config\Database;

echo "Iniciando teste de conexão com o banco de dados...\n\n";

try {
    // Tenta obter a instância da conexão PDO.
    $pdo = Database::getInstancia();

    // Se a linha acima for executada sem erros, a conexão foi bem-sucedida.
    echo "[SUCESSO] Conexão com o banco de dados estabelecida com sucesso!\n";

    // Opcional: Exibe alguns atributos da conexão para verificação.
    $versao_servidor = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
    $status_conexao = $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);

    echo "Versão do Servidor: $versao_servidor\n";
    echo "Status da Conexão: $status_conexao\n";

} catch (PDOException $e) {
    // Captura exceções específicas do PDO que podem ocorrer durante a conexão.
    echo "[ERRO] Falha ao conectar com o banco de dados.\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    // Captura outras exceções gerais.
    echo "[ERRO] Ocorreu um erro inesperado.\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
}
