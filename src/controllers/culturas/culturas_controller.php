<?php

namespace Src\Controllers\Culturas;

use Src\Models\Culturas\CulturasModel;

class CulturasController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param CulturasModel $model O modelo de culturas.
     */
    public function __construct(CulturasModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todas as culturas.
     *
     * @return void
     */
    public function listarTodos()
    {
        $culturas = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar as culturas.
    }

    /**
     * Busca uma cultura pelo ID.
     *
     * @param int $id O ID da cultura.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $cultura = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar a cultura.
    }

    /**
     * Cria uma nova cultura.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Nova Cultura',
            'tipo' => 'Tipo da cultura'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza uma cultura existente.
     *
     * @param int $id O ID da cultura.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nome' => 'Cultura Atualizada'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta uma cultura.
     *
     * @param int $id O ID da cultura.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
