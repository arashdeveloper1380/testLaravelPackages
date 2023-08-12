<?php

namespace Core\QueryBuilder;

use PDO;

class QueryBuilder {

    protected $pdo;
    protected $table;
    protected $whereConditions = [];
    // protected $selectColumns = ['*'];
    protected $orderByColumn;
    protected $orderByDirection;

    public static function qb($host, $database, $username, $password){
        $dsn = "mysql:host={$host};dbname={$database}";
        $pdo = new PDO($dsn, $username, $password);
        return new self($pdo);
    }

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function table($table){
        $this->table = $table;
        return $this;
    }

    public function where($column, $oparator = '=',  $value){
        $this->whereConditions[] = [$column, $oparator, $value];
        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->orderByColumn = $column;
        $this->orderByDirection = $direction;
        return $this;
    }

    public function first($select = ['*']){

        $query = "SELECT ";

    }

    public function get($select = ['*']){
        $query = "SELECT " . implode(', ', $select) . " FROM {$this->table}";

        if (!empty($this->whereConditions)) {
            $query .= " WHERE ";
            foreach ($this->whereConditions as $condition) {
                $query .= "{$condition[0]} {$condition[1]} :{$condition[0]} AND ";
            }
            $query = rtrim($query, " AND ");
        }

        if ($this->orderByColumn) {
            $query .= " ORDER BY {$this->orderByColumn} {$this->orderByDirection}";
        }

        $statement = $this->pdo->prepare($query);

        foreach ($this->whereConditions as $condition) {
            $statement->bindValue(":{$condition[0]}", $condition[2]);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}