<?php

namespace Src\Controllers\Pagamentos;

use Src\Models\Pagamentos\PagamentosModel;

class PagamentosController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param PagamentosModel $model O modelo de pagamentos.
     */
    public function __construct(PagamentosModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todos os pagamentos.
     *
     * @return void
     */
    public function listarTodos()
    {
        $pagamentos = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar os pagamentos.
    }

    /**
     * Busca um pagamento pelo ID.
     *
     * @param int $id O ID do pagamento.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $pagamento = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar o pagamento.
    }

    /**
     * Cria um novo pagamento.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_consultoria' => 1, // Exemplo
            'valor' => 100.50,
            'status' => 'pendente',
            'metodo_pagamento' => 'cartao_de_credito'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza um pagamento existente.
     *
     * @param int $id O ID do pagamento.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'status' => 'pago'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta um pagamento.
     *
     * @param int $id O ID do pagamento.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
