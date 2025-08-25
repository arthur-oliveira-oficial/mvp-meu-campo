# Instruções para o GitHub Copilot

## Visão Geral do Projeto

Este é um projeto de um aplicativo monolítico em PHP 8.2 que utiliza o padrão de arquitetura Model-View-Controller (MVC). O projeto foi desenvolvido para ser executado em um ambiente com MySQL e utiliza as seguintes dependências principais:

- `php-di/php-di` para injeção de dependência
- `nikic/fast-route` para roteamento
- `vlucas/phpdotenv` para gerenciamento de variáveis de ambiente

## Estrutura do Projeto

A estrutura do projeto segue o padrão MVC, com os seguintes diretórios principais:

- `src/controller`: Contém os controladores, que são responsáveis por receber as requisições do usuário, interagir com os modelos e selecionar a view apropriada para renderização.
- `src/models`: Contém os modelos, que são responsáveis por interagir com o banco de dados e conter a lógica de negócios da aplicação.
- `src/views`: Contém as views, que são responsáveis por apresentar os dados ao usuário.
- `routes`: Contém as definições de rotas da aplicação.
- `config`: Contém os arquivos de configuração, como a conexão com o banco de dados.
- `public`: Contém os arquivos públicos da aplicação, como o `index.php` e os assets (CSS, JS, imagens).

## Convenções de Código

Ao gerar código para este projeto, siga as seguintes convenções:

### Nomenclatura

- **Controladores:** Os nomes dos controladores devem seguir o padrão `NomeDoModuloController.php` e a classe deve ser nomeada como `NomeDoModuloController`.
- **Modelos:** Os nomes dos modelos devem seguir o padrão `NomeDoModuloModel.php` e a classe deve ser nomeada como `NomeDoModuloModel`.
- **Views:** Os nomes das views devem ser descritivos e estar em minúsculas, com palavras separadas por `_`.
- **Métodos:** Os nomes dos métodos devem ser em `camelCase`.
- **Variáveis:** Os nomes das variáveis devem ser em `snake_case`.

### Estilo de Código

- **Idioma:** Todo o código-fonte, incluindo comentários, nomes de variáveis, classes e métodos, deve ser escrito em português do Brasil (pt-br).
- **PHPDoc:** Todas as classes, métodos e funções devem ter blocos de comentários PHPDoc que documentem seu propósito, parâmetros e valores de retorno.
- Utilize o estilo de código PSR-12.
- Adicione comentários para explicar lógicas complexas, mas evite comentários óbvios.
- Mantenha a separação de responsabilidades entre as camadas do MVC.

## Interação com o Banco de Dados

A interação com o banco de dados é feita através dos modelos. Ao criar ou modificar um modelo, certifique-se de que ele contenha os métodos necessários para realizar as operações de CRUD (Create, Read, Update, Delete) no banco de dados.

## Rotas

As rotas são definidas no arquivo `routes/routes.php`. Ao adicionar uma nova rota, certifique-se de que ela aponte para o controlador e o método corretos.

## Views

As views devem ser o mais simples possível, contendo apenas a lógica de apresentação. Evite colocar lógica de negócios nas views.

## Exemplo de um Novo Módulo

Ao criar um novo módulo, siga a seguinte estrutura:

1.  **Crie o controlador:** Crie um novo arquivo em `src/controller/nome_do_modulo/NomeDoModuloController.php`.
2.  **Crie o modelo:** Crie um novo arquivo em `src/models/nome_do_modulo/NomeDoModuloModel.php`.
3.  **Crie as views:** Crie os arquivos de view necessários em `src/views/nome_do_modulo/`.
4.  **Adicione as rotas:** Adicione as rotas para o novo módulo no arquivo `routes/routes.php`.

Seguindo estas instruções, o GitHub Copilot será capaz de gerar um código mais consistente e alinhado com a arquitetura e as convenções deste projeto.
