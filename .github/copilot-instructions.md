# Instruções para o GitHub Copilot (versão reafirmada)

Este documento descreve as convenções e pontos importantes para gerar/alterar código neste repositório. Siga sempre as diretrizes abaixo ao editar ou criar novos arquivos.

## Visão geral rápida
- Arquitetura: Monolito PHP 8.2 seguindo MVC.
- Autoload: PSR-4 definido em [composer.json](composer.json).
- Rotas: definidas em [routes/routes.php](routes/routes.php).
- Conexão com BD: use [`Config\Database`](config/config_database.php).
- Classe base dos modelos: [`Src\Models\BaseModel`](src/models/BaseModel.php).

## Estrutura principal (exemplos)
- Controladores: `src/controllers/...` — ex.: [`Src\Controllers\Auth\AuthController`](src/controllers/auth/auth_controller.php)
- Modelos: `src/models/...` — ex.: [`Src\Models\Auth\AuthModel`](src/models/auth/auth_models.php)
- Views: `src/views/...`
- Scripts utilitários: [script/criar_admin.php](script/criar_admin.php), [script/testar_conexaodb.php](script/testar_conexaodb.php)
- Frontend inicial: [public/index.php](public/index.php)

## Convenções obrigatórias
1. Idioma: todo o código (comentários, nomes, PHPDoc) em Português do Brasil (pt-br).
2. Nomenclatura:
   - Controladores: CamelCase + sufixo `Controller`, arquivos em `src/controllers/nome_modulo/nomeController.php`.
   - Modelos: CamelCase + sufixo `Model`, arquivos em `src/models/nome_modulo/nomeModel.php`.
   - Views: minúsculas, palavras separadas por `_`.
   - Métodos: camelCase.
   - Variáveis: snake_case.
3. Padrões:
   - Estilo PSR-12.
   - Todas as classes, métodos e funções devem ter PHPDoc claros (propósito, parâmetros, retorno).
   - Separação de responsabilidades: lógica de negócio em modelos/controladores; views apenas apresentação.
4. Segurança:
   - Nunca exponha credenciais no código. Use variáveis de ambiente carregadas por [`vlucas/phpdotenv`](composer.json).
   - Ao executar queries, sempre usar prepared statements (veja [`Src\Models\BaseModel`](src/models/BaseModel.php)).
5. Banco de dados:
   - Acesso via singleton [`Config\Database`](config/config_database.php).
   - Modelos devem fornecer métodos CRUD (criar, buscarPorId, buscarTodos, atualizar, deletar).
6. Uploads e recursos:
   - Validar tipos MIME, tamanho e permissões antes de salvar arquivos (ex.: fluxo em [`Src\Controllers\EstudosSolo\EstudosSoloController`](src/controllers/estudos_solo/estudos_solo_controller.php) com suporte ao modelo [`Src\Models\EstudosSolo\EstudosSoloModel`](src/models/estudos_solo/estudos_solo_models.php)).

## Como adicionar um novo módulo (resumo)
1. Criar modelo em `src/models/nome_modulo/NomeModuloModel.php` estendendo [`Src\Models\BaseModel`](src/models/BaseModel.php).
2. Criar controlador em `src/controllers/nome_modulo/NomeModuloController.php`.
3. Criar views em `src/views/nome_modulo/`.
4. Registrar rotas em [routes/routes.php](routes/routes.php) apontando para `Namespace\ControllerClass` e método.
5. Atualizar testes/documentação conforme necessário.

## Boas práticas ao gerar código
- Priorize reutilização (herdar de `BaseModel`, extrair helpers).
- Trate erros e retorne respostas HTTP adequadas para endpoints.
- Use nomes de variáveis descritivos em snake_case e métodos em camelCase.
- Adicione comentários explicando decisões complexas; evite comentários óbvios.
- Mantenha commits pequenos e com mensagens descritivas.

## Exemplos de referência
- Conexão BD: [`Config\Database`](config/config_database.php)
- Modelo base: [`Src\Models\BaseModel`](src/models/BaseModel.php)
- Controller de estudos de solo: [`Src\Controllers\EstudosSolo\EstudosSoloController`](src/controllers/estudos_solo/estudos_solo_controller.php)
- Rotas: [routes/routes.php](routes/routes.php)
- Arquivo de entrada: [public/index.php](public/index.php)
- Composer/autoload: [composer.json](composer.json)

## Checklist rápido antes de PR
- [ ] Código em pt-br e com PHPDoc.
- [ ] Segue PSR-12.
- [ ] Sem credenciais hardcoded.
- [ ] Prepared statements para SQL.
- [ ] Rotas atualizadas e testadas.
- [ ] Caso faça upload, validações e permissões aplicadas.

Seguir estas instruções garante consistência, segurança e facilidade de manutenção
