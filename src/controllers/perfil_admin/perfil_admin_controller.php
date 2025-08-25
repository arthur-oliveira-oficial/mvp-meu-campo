<?php

namespace Src\Controllers\PerfilAdmin;

use Src\Models\PerfilAdmin\PerfilAdminModel;

class PerfilAdminController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param PerfilAdminModel $model O modelo de perfil de administrador.
     */
    public function __construct(PerfilAdminModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todos os perfis de administrador.
     *
     * @return void
     */
    public function listarTodos()
    {
        $perfis = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os perfis.
    }

    /**
     * Busca um perfil de administrador pelo ID.
     *
     * @param int $id O ID do perfil.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $perfil = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar o perfil.
    }

    /**
     * Cria um novo perfil de administrador.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_usuario' => 1, // Exemplo
            'nivel_acesso' => 'total'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza um perfil de administrador existente.
     *
     * @param int $id O ID do perfil.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nivel_acesso' => 'parcial'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um perfil de administrador.
     *
     * @param int $id O ID do perfil.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
