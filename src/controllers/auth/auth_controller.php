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
     *
     * @return void
     */
    public function login()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $email = 'email@exemplo.com';
        $senha = 'senha123';

        $usuario = $this->model->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Iniciar a sessão e armazenar os dados do usuário.
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_perfil'] = $usuario['perfil'];
            // Redirecionar para a página principal.
        } else {
            // Mostrar uma mensagem de erro.
        }
    }

    /**
     * Realiza o logout do usuário.
     *
     * @return void
     */
    public function logout()
    {
        session_start();
        session_destroy();
        // Redirecionar para a página de login.
    }
}
