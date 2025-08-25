<?php

namespace Src\Controllers\AvaliacaoConsultoria;

use Src\Models\AvaliacaoConsultoria\AvaliacaoConsultoriaModel;

class AvaliacaoConsultoriaController
{
    protected $model;

    /**
     * Construtor do controlador.
     *
     * @param AvaliacaoConsultoriaModel $model O modelo de avaliação de consultoria.
     */
    public function __construct(AvaliacaoConsultoriaModel $model)
    {
        $this->model = $model;
    }

    /**
     * Lista todas as avaliações de consultoria.
     *
     * @return void
     */
    public function listarTodos()
    {
        $avaliacoes = $this->model->buscarTodos();
        // Aqui você chamaria a view para renderizar as avaliações.
    }

    /**
     * Busca uma avaliação de consultoria pelo ID.
     *
     * @param int $id O ID da avaliação.
     * @return void
     */
    public function buscarPorId(int $id)
    {
        $avaliacao = $this->model->buscarPorId($id);
        // Aqui você chamaria a view para renderizar a avaliação.
    }

    /**
     * Cria uma nova avaliação de consultoria.
     *
     * @return void
     */
    public function criar()
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'id_consultoria' => 1, // Exemplo
            'nota' => 5,
            'comentario' => 'Ótima consultoria!'
        ];
        $this->model->criar($dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Atualiza uma avaliação de consultoria existente.
     *
     * @param int $id O ID da avaliação.
     * @return void
     */
    public function atualizar(int $id)
    {
        // Os dados viriam da requisição (ex: $_POST)
        $dados = [
            'nota' => 4,
            'comentario' => 'Consultoria muito boa, mas pode melhorar.'
        ];
        $this->model->atualizar($id, $dados);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }

    /**
     * Deleta uma avaliação de consultoria.
     *
     * @param int $id O ID da avaliação.
     * @return void
     */
    public function deletar(int $id)
    {
        $this->model->deletar($id);
        // Redirecionar ou mostrar uma mensagem de sucesso.
    }
}
