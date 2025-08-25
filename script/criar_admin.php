<?php

/**
 * Script CLI para criar um novo usuário administrador.
 *
 * Este script solicita nome, email e senha para criar um novo administrador
 * no banco de dados.
 */

// Garante que o script seja executado apenas via CLI
if (php_sapi_name() !== 'cli') {
    die("Este script só pode ser executado a partir da linha de comando.");
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/models/usuarios/usuarios_models.php';
require_once __DIR__ . '/../config/config_database.php';

use Src\Models\Usuarios\UsuariosModel;
use Config\Database;

echo "--- Criação de Novo Administrador ---\\n";

// Coleta de dados do usuário
$nome = readline("Digite o nome completo: ");
$email = readline("Digite o email: ");
$senha = readline("Digite a senha: ");

// Validação simples
if (empty($nome) || empty($email) || empty($senha)) {
    echo "\\nErro: Todos os campos são obrigatórios.\\n";
    exit(1);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "\\nErro: Formato de email inválido.\\n";
    exit(1);
}

// Hash da senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

try {
    // Instancia o modelo de usuários
    $usuarios_model = new UsuariosModel();

    // Verifica se o e-mail já existe
    if ($usuarios_model->buscarPorEmail($email)) {
        echo "\\nErro: O email '{$email}' já está cadastrado.\\n";
        exit(1);
    }

    // Prepara os dados para inserção
    $dados_admin = [
        'nome' => $nome,
        'email' => $email,
        'senha_hash' => $senha_hash,
        'tipo' => 'admin', // Define o tipo de usuário como admin
        'status' => 'ativo', // Define o status como ativo
        'criado_em' => date('Y-m-d H:i:s'),
        'atualizado_em' => date('Y-m-d H:i:s')
    ];

    // Cria o usuário
    $novo_id = $usuarios_model->criar($dados_admin);

    if ($novo_id) {
        echo "\\nAdministrador '{$nome}' criado com sucesso! ID: {$novo_id}\\n";
    } else {
        echo "\\nErro: Não foi possível criar o administrador.\\n";
        exit(1);
    }

} catch (	PDOException $e) {
    echo "\\nErro de banco de dados: " . $e->getMessage() . "\\n";
    exit(1);
} catch (\Exception $e) {
    echo "\\nOcorreu um erro inesperado: " . $e->getMessage() . "\\n";
    exit(1);
}
