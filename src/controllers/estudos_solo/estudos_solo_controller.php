<?php

namespace Src\Controllers\EstudosSolo;

use Src\Models\EstudosSolo\EstudosSoloModel;

class EstudosSoloController
{
    protected $model;
    private $upload_dir = __DIR__ . '/../../../upload/estudos_solo/';


    /**
     * Construtor do controlador.
     *
     * @param EstudosSoloModel $model O modelo de estudos de solo.
     */
    public function __construct(EstudosSoloModel $model)
    {
        $this->model = $model;
    }

    /**
     * Exibe o formulário para registrar um novo estudo de solo.
     *
     * @return void
     */
    public function exibirFormularioRegistro()
    {
        // Aqui você chamaria a view com o formulário de registro.
        // Exemplo: require __DIR__ . '/../../views/estudos_solo/registrar_estudo.php';
        echo "<h1>Registrar Novo Estudo de Solo</h1>";
        // Adicione o formulário HTML aqui.
    }

    /**
     * Cria um novo estudo de solo com upload de arquivo.
     *
     * @return void
     */
    public function registrarEstudo()
    {
        // 1. Validação dos dados de entrada
        if (empty($_POST['id_lavoura']) || empty($_FILES['arquivo_pdf'])) {
            http_response_code(400);
            echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos.']);
            return;
        }

        // 2. Validação do Upload do Arquivo
        if ($_FILES['arquivo_pdf']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no upload do arquivo.']);
            return;
        }

        // 3. Validação do Tipo de Arquivo
        $tipo_arquivo = mime_content_type($_FILES['arquivo_pdf']['tmp_name']);
        if ($tipo_arquivo !== 'application/pdf') {
            http_response_code(400);
            echo json_encode(['status' => 'erro', 'mensagem' => 'O arquivo deve ser um PDF.']);
            return;
        }

        // 4. Obter nome da propriedade para o nome do arquivo
        $id_lavoura = filter_input(INPUT_POST, 'id_lavoura', FILTER_SANITIZE_NUMBER_INT);
        $nome_propriedade = $this->model->buscarNomePropriedadePorLavouraId($id_lavoura);

        if (!$nome_propriedade) {
            http_response_code(404);
            echo json_encode(['status' => 'erro', 'mensagem' => 'Lavoura ou propriedade não encontrada.']);
            return;
        }

        // 5. Preparar o nome e o caminho do arquivo
        $nome_propriedade_seguro = preg_replace("/[^a-zA-Z0-9-]/", "_", strtolower($nome_propriedade));
        $nome_arquivo = $nome_propriedade_seguro . '_' . time() . '.pdf';
        
        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0777, true);
        }
        $caminho_arquivo = $this->upload_dir . $nome_arquivo;

        // 6. Mover o arquivo para o diretório de upload
        if (!move_uploaded_file($_FILES['arquivo_pdf']['tmp_name'], $caminho_arquivo)) {
            http_response_code(500);
            echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao salvar o arquivo.']);
            return;
        }

        // 7. Salvar os dados no banco de dados
        $dados_estudo = [
            'id_lavoura' => $id_lavoura,
            'data_estudo' => filter_input(INPUT_POST, 'data_estudo', FILTER_SANITIZE_STRING) ?: date('Y-m-d'),
            'ph' => filter_input(INPUT_POST, 'ph', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'nitrogenio' => filter_input(INPUT_POST, 'nitrogenio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'fosforo' => filter_input(INPUT_POST, 'fosforo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'potassio' => filter_input(INPUT_POST, 'potassio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'calcio' => filter_input(INPUT_POST, 'calcio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'magnesio' => filter_input(INPUT_POST, 'magnesio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'enxofre' => filter_input(INPUT_POST, 'enxofre', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'boro' => filter_input(INPUT_POST, 'boro', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'cobre' => filter_input(INPUT_POST, 'cobre', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'ferro' => filter_input(INPUT_POST, 'ferro', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'manganes' => filter_input(INPUT_POST, 'manganes', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'zinco' => filter_input(INPUT_POST, 'zinco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'arquivo_pdf' => $caminho_arquivo
        ];

        $id_estudo = $this->model->criar($dados_estudo);

        if ($id_estudo) {
            http_response_code(201);
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Estudo de solo registrado com sucesso!', 'id' => $id_estudo]);
        } else {
            // Se falhar, remover o arquivo que foi salvo
            unlink($caminho_arquivo);
            http_response_code(500);
            echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao salvar os dados no banco de dados.']);
        }
    }
}