<?php

namespace Src\Controllers\PerfilConsultor;

use Src\Models\PerfilConsultor\PerfilConsultorModel;

class PerfilConsultorController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param PerfilConsultorModel $model O modelo de perfil de consultor.
     */
    public function __construct(PerfilConsultorModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todos os perfis de consultor.
     *
     * @return void
     */
    public function listarTodos()
    {
        $perfis = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os perfis.
    }

    /**
     * Busca um perfil de consultor pelo ID.
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
     * Cria um novo perfil de consultor.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_usuario' => 1, // Exemplo
            'bio' => 'Biografia do consultor',
            'disponibilidade' => 'integral',
            'curriculo' => 'link_para_o_curriculo.pdf'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza um perfil de consultor existente.
     *
     * @param int $id O ID do perfil.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'bio' => 'Biografia atualizada'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um perfil de consultor.
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
