<?php

namespace Src\Controllers\Usuarios;

use Src\Models\Usuarios\UsuariosModel;

class UsuariosController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param UsuariosModel $model O modelo de usuários.
     */
    public function __construct(UsuariosModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todos os usuários.
     *
     * @return void
     */
    public function listarTodos()
    {
        $usuarios = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os usuários.
        // Exemplo: require __DIR__ . '/../../views/usuarios/lista.php';
    }

    /**
     * Busca um usuário pelo ID.
     *
     * @param int $id O ID do usuário.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $usuario = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar o usuário.
        // Exemplo: require __DIR__ . '/../../views/usuarios/detalhes.php';
    }

    /**
     * Cria um novo usuário.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Novo Usuário',
            'email' => 'email@exemplo.com',
            'senha' => 'senha_hash',
            'perfil' => 'agricultor',
            'ativo' => 1
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza um usuário existente.
     *
     * @param int $id O ID do usuário.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Usuário Atualizado'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um usuário.
     *
     * @param int $id O ID do usuário.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
