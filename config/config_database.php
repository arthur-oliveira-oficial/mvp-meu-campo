<?php

namespace Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;

/**
 * Classe de conexão com o banco de dados utilizando o padrão Singleton.
 *
 * Garante que apenas uma instância da conexão PDO seja criada e utilizada
 * durante o ciclo de vida da aplicação.
 */
class Database
{
    /**
     * @var PDO|null A instância única da conexão PDO.
     */
    private static ?PDO $instancia = null;

    /**
     * Construtor privado para prevenir a criação de instâncias diretas.
     */
    private function __construct()
    {
    }

    /**
     * Previne a clonagem da instância.
     */
    private function __clone()
    {
    }

    /**
     * Obtém a instância única da conexão PDO.
     *
     * Se a instância ainda não existir, ela será criada utilizando as
     * variáveis de ambiente carregadas pelo Dotenv.
     *
     * @return PDO A instância da conexão PDO.
     */
    public static function getInstancia(): PDO
    {
        if (self::$instancia === null) {
            // Carrega as variáveis de ambiente do arquivo .env
            require_once __DIR__ . '/../vendor/autoload.php';
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            $db_host = $_ENV['DB_HOST'];
            $db_name = $_ENV['DB_NAME'];
            $db_user = $_ENV['DB_USER'];
            $db_pass = $_ENV['DB_PASS'];
            $db_charset = $_ENV['DB_CHARSET'];

            $dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";

            $opcoes = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instancia = new PDO($dsn, $db_user, $db_pass, $opcoes);
            } catch (PDOException $e) {
                // Em um ambiente de produção, seria melhor logar o erro.
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }

        return self::$instancia;
    }
}
