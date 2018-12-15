<?php
namespace d8devs\socialposter;

use PDO;
use phpDocumentor\Reflection\Types\Self_;

class Database
{

    /**
     *
     * @var string
     */
    private static $instance;

    /** @var PDO */
    private $connection;

    public static function getInstance()
    {
        if (! self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }


    private function createTables()
    {
        $this->connection->exec("CREATE TABLE IF NOT EXISTS posts (
            id INTEGER PRIMARY KEY,
            for TEXT,
            target INTEGER,
            message TEXT,
            attachments TEXT,
            status INTEGER,
            report TEXT,
            sended_at TEXT,
            created_at TEXT
        )");

        $this->connection->exec("CREATE TABLE IF NOT EXISTS facebook_pages (
            id INTEGER PRIMARY KEY,
            description TEXT,
            page TEXT,
            app_id TEXT,
            app_secret TEXT,
            default_graph_version TEXT,
            access_token TEXT,
            created_at TEXT
        )");

        $this->connection->exec("CREATE TABLE IF NOT EXISTS twitter_accounts (
            id INTEGER PRIMARY KEY,
            description TEXT,
            consumer_key TEXT,
            consumer_secret TEXT,
            access_token TEXT,
            access_token_secret TEXT,
            created_at TEXT
        )");


        $this->connection->exec("CREATE TABLE IF NOT EXISTS instagram_accounts (
            id INTEGER PRIMARY KEY,
            description TEXT,
            username TEXT,
            password TEXT,
            created_at TEXT
        )");
    }

    /**
     *
     * @return PDO
     */
    public function getConnection()
    {

        try {
            if (CURRENT_ENV == 'test') {
                $this->connection = new PDO('sqlite::memory:');
            }
            if (CURRENT_ENV == 'development') {
                $this->connection = new PDO('sqlite:' . __DIR__ . '/Database/database.sqlite3');
            }
            if (CURRENT_ENV == 'production') {
                $this->connection = new PDO('sqlite:' . __DIR__ . '/Database/database.sqlite3');
            }
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTables();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $this->connection;
    }
}
