<?php

namespace D8devs\SocialPoster;

use PDO;

class Database extends Base
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
        if (!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @return PDO
     */
    public function getConnection()
    {

        try {
            if ($this->Config->env == 'test') {
                $this->connection = new PDO('sqlite::memory:');
            }
            if ($this->Config->env == 'development') {
                $this->connection = new PDO('sqlite:' . __DIR__ . '/Database/database.sqlite3');
            }
            if ($this->Config->env == 'production') {
                $this->connection = new PDO('sqlite:' . __DIR__ . '/Database/database.sqlite3');
            }
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTables();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

        return $this->connection;
    }

    private function createTables()
    {
        $this->connection->exec("CREATE TABLE IF NOT EXISTS posts (
            id INTEGER PRIMARY KEY,
            for TEXT,
            target INTEGER,
            message TEXT,
            link TEXT,
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
}
