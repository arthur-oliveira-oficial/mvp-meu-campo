<?php

namespace Src\Controllers\Lavouras;

use Src\Models\Lavouras\LavourasModel;

class LavourasController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param LavourasModel $model O modelo de lavouras.
     */
    public function __construct(LavourasModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todas as lavouras.
     *
     * @return void
     */
    public function listarTodos()
    {
        $lavouras = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar as lavouras.
    }

    /**
     * Busca uma lavoura pelo ID.
     *
     * @param int $id O ID da lavoura.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $lavoura = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar a lavoura.
    }

    /**
     * Cria uma nova lavoura.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_propriedade' => 1, // Exemplo
            'id_cultura' => 1, // Exemplo
            'ano_plantio' => 2023,
            'area_plantada_ha' => 50
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza uma lavoura existente.
     *
     * @param int $id O ID da lavoura.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'area_plantada_ha' => 60
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta uma lavoura.
     *
     * @param int $id O ID da lavoura.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
