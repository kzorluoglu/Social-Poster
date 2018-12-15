<?php
/**
 * Created by PhpStorm.
 * User: koray
 * Date: 14.12.18
 * Time: 11:03
 */

namespace d8devs\socialposter\Model;

use d8devs\socialposter\Base;
use d8devs\socialposter\Database;

class Model extends Base
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var string Table
     */
    public $table;

    /**
     * @var array Columuns
     */
    public $columns = array();

    /**
     * @var array Columns Schema
     * Example: ['columnName' => 'columnValue']
     */
    private $formattedColumns = array();


    /**
     * Model constructor.
     */
    public function __construct()
    {
        $db = Database::getInstance();
        $this->db = $db->getConnection();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $query = $this->db->prepare('SELECT * :table WHERE id = :id');
        $query->execute([
            ':table' => $this->table,
            ':id' => $id
        ]);

        return $query->fetchObject('d8devs\socialposter\Model\Post');
    }


    public function getAll($where = array())
    {
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        $query = $this->generateSelectQuery($where);

        $stmt = $this->db->prepare($query);

        try {
            foreach ($where as $key => &$value) {
                $stmt->bindParam(':'.$key, $value);
            }

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_CLASS, get_class($this));
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOne($where = array())
    {
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        $query = $this->generateSelectOneQuery($where);

        $stmt = $this->db->prepare($query);

        try {
            foreach ($where as $key => &$value) {
                $stmt->bindParam(':'.$key, $value);
            }

            $stmt->execute();

            /**
             * @TODO: If 0 return give error
             */
            return $stmt->fetchObject(get_class($this));
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if ($value) {
            $this->columns[$name] = $value;
            $this->formattedColumns[$name] = $value;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (key_exists($name, $this->columns)) {
            return $this->columns[$name];
        } else {
            return null;
        }
    }

    /**
     *  Save to DB
     */
    public function save()
    {
        $query =  $this->generateInsertQuery();

        $stmt = $this->db->prepare($query);

        try {
            foreach ($this->getFormattedColumns() as $key => &$value) {
                $stmt->bindParam(':'.$key, $value);
            }
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update()
    {
        $query = $this->generateUpdateQuery();
        $stmt = $this->db->prepare($query);

        try {
            foreach ($this->getFormattedColumns() as $key => &$value) {
                $stmt->bindParam(':'.$key, $value);
            }
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Format $column array
     *
     * @return array
     */
    public function getFormattedColumns(): array
    {
        return $this->formattedColumns;
    }

    /**
     * Insert Query
     *
     * @return string
     */
    private function generateInsertQuery()
    {
        $columns = $this->getFormattedColumns();

        $changeArrayKeys = array();
        foreach ($columns as $key => $value) {
            $changeArrayKeys[":".$key] = $value;
        }

        $columnString = implode(', ', array_keys($columns));
        $valueString = implode(', ', array_keys($changeArrayKeys));

        return "INSERT INTO ".$this->table." ({$columnString}) VALUES ({$valueString})";
    }

    /**
     * @param $where string
     * @return string
     */
    private function generateSelectQuery($where = array())
    {

        $query = "SELECT * FROM ".$this->table;
        
        if ($where) {
            $changeArrayKeys = array();
            foreach ($where as $key => $value) {
                $changeArrayKeys[$key." = :".$key." AND"] = $value;
            }

            $valueString = implode(', ', array_keys($changeArrayKeys));
            $valueString = rtrim($valueString, ' AND');

            $query .= " WHERE {$valueString}";
        }

        return $query;
    }


    /**
     * @param $where string
     * @return string
     */
    private function generateSelectOneQuery($where = array())
    {

        $query = "SELECT * FROM ".$this->table;

        if ($where) {
            $changeArrayKeys = array();
            foreach ($where as $key => $value) {
                $changeArrayKeys[$key." = :".$key." AND"] = $value;
            }

            $valueString = implode(', ', array_keys($changeArrayKeys));
            $valueString = rtrim($valueString, ' AND');

            $query .= " WHERE {$valueString} ";
        }

        $query .= "LIMIT 1";
        return $query;
    }

    /**
     * @return string
     */
    private function generateUpdateQuery()
    {

        $columns = $this->getFormattedColumns();

        $changeArrayKeys = array();
        foreach ($columns as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $changeArrayKeys[$key." = :".$key] = $value;
        }

        $columnString = implode(', ', array_keys($changeArrayKeys));

        return "UPDATE ".$this->table." SET {$columnString} WHERE id = :id";
    }
}
