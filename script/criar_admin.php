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

// Funções utilitárias para cores ANSI
function cor($texto, $cor) {
    $cores = [
        'reset' => "\033[0m",
        'vermelho' => "\033[31m",
        'verde' => "\033[32m",
        'amarelo' => "\033[33m",
        'azul' => "\033[34m",
        'magenta' => "\033[35m",
        'ciano' => "\033[36m",
        'negrito' => "\033[1m"
    ];
    return ($cores[$cor] ?? $cores['reset']) . $texto . $cores['reset'];
}

use Src\Models\Usuarios\UsuariosModel;
use Config\Database;


echo cor(str_repeat("=", 40), 'azul') . "\n";
echo cor("   CRIAÇÃO DE NOVO ADMINISTRADOR", 'negrito') . "\n";
echo cor(str_repeat("=", 40), 'azul') . "\n\n";

// Coleta de dados do usuário
$nome = readline("Digite o nome completo: ");
$email = readline("Digite o email: ");
$senha = readline("Digite a senha: ");

// Validação simples

if (empty($nome) || empty($email) || empty($senha)) {
    echo cor("\n[ERRO] Todos os campos são obrigatórios.\n", 'vermelho');
    exit(1);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo cor("\n[ERRO] Formato de email inválido.\n", 'vermelho');
    exit(1);
}

// Hash da senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

try {
    // Instancia o modelo de usuários
    $usuarios_model = new UsuariosModel();

    // Verifica se o e-mail já existe

    if ($usuarios_model->buscarPorEmail($email)) {
        echo cor("\n[ERRO] O email '{$email}' já está cadastrado.\n", 'vermelho');
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
        echo cor("\n[S U C E S S O] Administrador '", 'verde') . cor($nome, 'negrito') . cor("' criado com sucesso! ID: {$novo_id}\n", 'verde');
        echo cor(str_repeat("-", 40), 'azul') . "\n";
    } else {
        echo cor("\n[ERRO] Não foi possível criar o administrador.\n", 'vermelho');
        exit(1);
    }

} catch (PDOException $e) {
    echo cor("\n[ERRO DE BANCO DE DADOS] " . $e->getMessage() . "\n", 'vermelho');
    exit(1);
} catch (\Exception $e) {
    echo cor("\n[ERRO INESPERADO] " . $e->getMessage() . "\n", 'vermelho');
    exit(1);
}
