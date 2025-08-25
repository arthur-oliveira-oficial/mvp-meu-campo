<?php

namespace Src\Controllers\PerfilAgricultor;

use Src\Models\PerfilAgricultor\PerfilAgricultorModel;

class PerfilAgricultorController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param PerfilAgricultorModel $model O modelo de perfil de agricultor.
     */
    public function __construct(PerfilAgricultorModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todos os perfis de agricultor.
     *
     * @return void
     */
    public function listarTodos()
    {
        $perfis = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os perfis.
    }

    /**
     * Busca um perfil de agricultor pelo ID.
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
     * Cria um novo perfil de agricultor.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_usuario' => 1, // Exemplo
            'interesses' => 'Soja, Milho',
            'nivel_experiencia' => 'iniciante'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza um perfil de agricultor existente.
     *
     * @param int $id O ID do perfil.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'interesses' => 'Soja, Milho, Trigo'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um perfil de agricultor.
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
