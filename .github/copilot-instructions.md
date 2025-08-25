# Copilot Instructions for mvp-meu-campo

## Visão Geral da Arquitetura
- Projeto PHP estruturado em MVC: `src/controller/`, `src/models/`, `views/`.
- Roteamento centralizado em `routes/routes.php`.
- Entrada principal via `public/index.php`.
- Configurações de banco em `config/config_database.php`.
- Assets estáticos em `public/assets/` e `assets/`.

## Fluxos de Desenvolvimento
- Não há scripts de build/teste automatizados detectados; desenvolvimento é direto em PHP.
- Para dependências, utilize `composer install` na raiz do projeto.
- O autoload do Composer é feito via `vendor/autoload.php`.
- Para rodar localmente, use Apache/XAMPP apontando para `public/` como raiz do site.

## Convenções Específicas
- Controllers e Models seguem nomes e pastas por domínio (ex: `consultoria_controller.php`, `consultoria_models.php`).
- Novos domínios devem ser criados em subpastas de `src/controller/` e `src/models/`.
- Views são separadas por contexto em `views/` e incluem componentes em `views/includes/`.
- Rotas devem ser registradas em `routes/routes.php`.
- Configurações sensíveis (ex: credenciais) ficam em `config/config_database.php`.

## Regras Obrigatórias de Segurança e Boas Práticas

- **Model:** Usar PDO com Prepared Statements para TODAS as queries, sem exceção.
- **Controller:** Validar e sanitizar todos os dados de entrada (`$_GET`, `$_POST`, etc.) antes de passá-los para o Model.
- **View:** Escapar toda e qualquer saída de dados com `htmlspecialchars()` para prevenir XSS.

## Idioma do Código
Todo o código fonte do projeto (nomes de variáveis, funções, comentários e textos) deve ser escrito em português brasileiro (pt-br).

## Integrações e Dependências
- Utiliza pacotes do Composer (ex: `vlucas/phpdotenv`, `nikic/fast-route`).
- Frameworks JS/CSS (Bootstrap, Alpine.js) em `assets/` e `public/assets/`.
- Não há integração direta com frameworks PHP modernos (ex: Laravel), mas utiliza padrões similares.

## Exemplos de Padrões
- Para criar um novo controller/model:
  - Crie arquivos em `src/controller/<domínio>/<domínio>_controller.php` e `src/models/<domínio>/<domínio>_models.php`.
  - Registre rotas em `routes/routes.php`.
- Para adicionar uma dependência:
  - Execute `composer require <pacote>` e inclua via autoload.
- Para acessar variáveis de ambiente:
  - Use `vlucas/phpdotenv` conforme configurado no projeto.

## Referências de Arquivos-Chave
- `public/index.php`: bootstrap da aplicação.
- `routes/routes.php`: definição de rotas.
- `config/config_database.php`: configuração do banco.
- `src/controller/`, `src/models/`: lógica de negócio.
- `views/`: templates e includes.

---


---

## Tabela de Vulnerabilidades e Soluções em PHP

| Vulnerabilidade                      | Solução Principal                   | Funções/Conceitos Chave em PHP                                      |
|--------------------------------------|-------------------------------------|---------------------------------------------------------------------|
| SQL Injection                        | Prepared Statements                 | PDO::prepare(), PDOStatement::execute(), mysqli_prepare()           |
| Cross-Site Scripting (XSS)           | Output Escaping                     | htmlspecialchars()                                                  |
| Cross-Site Request Forgery (CSRF)    | Tokens Anti-CSRF                    | random_bytes(), $_SESSION, hash_equals()                            |
| Falhas de Autenticação               | Hashing Seguro de Senhas            | password_hash(), password_verify()                                  |
| Gerenciamento de Sessão              | Práticas Seguras de Sessão          | session_regenerate_id(), HTTPS, HttpOnly cookies                    |
| Controle de Acesso (IDOR)            | Verificação de Permissões no Servidor| Checagens de $_SESSION['user_id'] ou roles em cada request          |
| Upload de Arquivos Maliciosos        | Validação Rigorosa de Arquivos      | Validar extensão, tipo MIME, renomear arquivos, armazenar fora      |

---

> Atualize este documento conforme novas convenções ou fluxos forem adotados.
