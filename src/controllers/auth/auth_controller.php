<?php

namespace Src\Controllers\Auth;

use Src\Models\Auth\AuthModel;

class AuthController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param AuthModel $model O modelo de autenticação.
     */
    public function __construct(AuthModel $model)
    {
        $this->model = $model;
    }

    /**
     * Realiza o login do usuário.
     * Espera os campos POST: 'email' e 'senha'.
     * Valida entradas, verifica credenciais e redireciona para o dashboard
     * correspondente ao perfil do usuário.
     *
     * @return void
     */
    public function login()
    {
        // Ler e validar entrada
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

        if (empty($email) || empty($senha)) {
            http_response_code(400);
            echo 'Parâmetros inválidos.';
            return;
        }

        try {
            $usuario = $this->model->buscarPorEmail($email);
        } catch (\Throwable $e) {
            // Em caso de erro no modelo/DB, retornar 500
            http_response_code(500);
            echo 'Erro interno.';
            return;
        }

        // Verifica usuário e senha
        if (! $usuario || ! isset($usuario['senha']) || ! password_verify($senha, $usuario['senha'])) {
            // Mensagem genérica para não expor existência de usuário
            http_response_code(401);
            echo 'Credenciais inválidas.';
            return;
        }

        // Iniciar sessão de forma segura
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        // Evitar session fixation
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = (int) ($usuario['id'] ?? 0);
        $_SESSION['usuario_perfil'] = $usuario['perfil'] ?? 'usuario';

        // Redirecionar conforme perfil
        $perfil = $_SESSION['usuario_perfil'];
        switch ($perfil) {
            case 'admin':
                $rota = '/admin/dashboard';
                break;
            case 'agricultor':
                $rota = '/agricultor/dashboard';
                break;
            case 'consultor':
                $rota = '/consultor/dashboard';
                break;
            default:
                $rota = '/';
        }

        header('Location: ' . $rota);
        exit;
    }

    /**
     * Realiza o logout do usuário.
     * Limpa a sessão, apaga cookie de sessão e redireciona para a tela de login.
     *
     * @return void
     */
    public function logout()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Limpar variáveis de sessão
        $_SESSION = [];

        // Apagar cookie de sessão se necessário
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'] ?? '/',
                $params['domain'] ?? '',
                $params['secure'] ?? false,
                $params['httponly'] ?? true
            );
        }

        session_destroy();

        header('Location: /login');
        exit;
    }
}
