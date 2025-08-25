# Copilot Instructions para mvp-meu-campo

> Compatível e otimizado para PHP 8.2+

## Recomendações Específicas para PHP 8.2
- Utilize tipagem explícita em funções e métodos (`public function exemplo(int $id): string`)
- Prefira `readonly` em propriedades de classes imutáveis
- Use `enum` para valores fixos e estados ao invés de constantes
- Utilize `#[Attribute]` para metadados em classes e métodos
- Evite funções e sintaxes obsoletas (ex: `each()`, `create_function()`)
- Aproveite melhorias de performance e segurança nativas do PHP 8.2

## Visão Geral da Arquitetura
- Projeto PHP estruturado em MVC: `src/controller/`, `src/models/`, `views/`.
- Roteamento centralizado em `routes/routes.php`.
- Entrada principal via `public/index.php`.
- Configurações de banco em `config/config_database.php`.
- Assets estáticos em `public/assets/` e `assets/`.
- Código orientado a objetos, aproveitando recursos modernos do PHP 8.2.

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
- **Tipagem:** Sempre que possível, declare tipos de parâmetros e retorno nas funções e métodos.
- **Enums:** Utilize `enum` para representar estados fixos (exemplo: status de pagamento, tipo de usuário).
- **Readonly:** Use propriedades `readonly` para objetos que não devem ser alterados após construção.
- **Atributos:** Utilize `#[Attribute]` para metadados e validações customizadas.

## Idioma do Código
Todo o código fonte do projeto (nomes de variáveis, funções, comentários e textos) deve ser escrito em português brasileiro (pt-br).
Comentários devem ser claros e objetivos, explicando regras de negócio e decisões técnicas.

## Integrações e Dependências
- Utiliza pacotes do Composer (ex: `vlucas/phpdotenv`, `nikic/fast-route`).
- Frameworks JS/CSS (Bootstrap, Alpine.js) em `assets/` e `public/assets/`.
- Não há integração direta com frameworks PHP modernos (ex: Laravel), mas utiliza padrões similares.

## Exemplos de Padrões Modernos
- Para criar um novo controller/model:
  - Crie arquivos em `src/controller/<domínio>/<domínio>_controller.php` e `src/models/<domínio>/<domínio>_models.php`.
  - Utilize tipagem explícita e, se aplicável, `readonly` e `enum`.
  - Registre rotas em `routes/routes.php`.
- Para adicionar uma dependência:
  - Execute `composer require <pacote>` e inclua via autoload.
- Para acessar variáveis de ambiente:
  - Use `vlucas/phpdotenv` conforme configurado no projeto.
- Para metadados customizados:
  - Utilize `#[Attribute]` em classes e métodos.

## Referências de Arquivos-Chave
- `public/index.php`: bootstrap da aplicação.
- `routes/routes.php`: definição de rotas.
- `config/config_database.php`: configuração do banco.
- `src/controller/`, `src/models/`: lógica de negócio.
- `views/`: templates e includes.
- `composer.json`: defina a versão mínima do PHP para 8.2 ou superior.

---


---

## Tabela de Vulnerabilidades e Soluções em PHP

| Vulnerabilidade                      | Solução Principal                   | Funções/Conceitos Chave em PHP                                      |
|--------------------------------------|-------------------------------------|---------------------------------------------------------------------|
| SQL Injection                        | Prepared Statements                 | PDO::prepare(), PDOStatement::execute(), mysqli_prepare()           |
| Cross-Site Scripting (XSS)           | Output Escaping                     | htmlspecialchars()                                                  |
| Cross-Site Request Forgery (CSRF)    | Tokens Anti-CSRF                    | random_bytes(), $_SESSION, hash_equals()                            |
| Falhas de Autenticação               | Hashing Seguro de Senhas            | password_hash(), password_verify(), tipos e enums para roles        |
| Gerenciamento de Sessão              | Práticas Seguras de Sessão          | session_regenerate_id(), HTTPS, HttpOnly cookies, tipagem           |
| Controle de Acesso (IDOR)            | Verificação de Permissões no Servidor| Checagens de $_SESSION['user_id'] ou enums para roles               |
| Upload de Arquivos Maliciosos        | Validação Rigorosa de Arquivos      | Validar extensão, tipo MIME, renomear arquivos, armazenar fora      |
| Tipagem e Enums                      | Segurança e legibilidade            | `readonly`, `enum`, tipagem explícita                               |

---

<<<<<<< HEAD
=======

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
>>>>>>> 67e6327 (Adiciona tabela de vulnerabilidades e soluções em PHP ao documento de instruções do Copilot)
