<?php

namespace Core\QueryBuilder;

use PDO;

class QueryBuilder {

    protected $pdo;
    protected $table;
    protected $limit;
    // protected $selectColumns = ['*'];
    protected $orderByColumn;
    protected $orderByDirection;
    protected $insertData       = [];
    protected $joinConditions   = [];
    protected $whereConditions  = [];

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

    public function limit($limit){
        $this->limit = $limit;
        return $this;
    }

    public function first($select = ['*']){
        $query = "SELECT " . implode(', ', $select) . " FROM {$this->table}";
        if(!empty($this->whereConditions)){
            $query .= " WHERE ";
            foreach ($this->whereConditions as $condition){
                $query .= "{$condition[0]} {$condition[1]} :{$condition[0]} AND ";
            }
            $query = rtrim($query, " AND ");

            if ($this->orderByColumn) {
                $query .= " ORDER BY {$this->orderByColumn} {$this->orderByDirection}";
            }

            $query .= " LIMIT 1";

            $statement = $this->pdo->prepare($query);

            foreach ($this->whereConditions as $condition) {
                $statement->bindValue(":{$condition[0]}", $condition[2]);
            }

            $statement->execute();

            return $statement->fetch(PDO::FETCH_OBJ);

            return $this;
        }
    }

    public function join($table, $firstColumn, $operator, $secondColumn){
        $this->joinConditions[] = [
            'table'         => $table,
            'firstColumn'   => $firstColumn,
            'operator'      => $operator,
            'secondColumn'  => $secondColumn
        ];
        return $this;
    }

    public function delete()
    {
        $query = "DELETE FROM {$this->table}";

        if (!empty($this->whereConditions)) {
            $query .= " WHERE ";
            foreach ($this->whereConditions as $condition) {
                $query .= "{$condition[0]} {$condition[1]} :{$condition[0]} AND ";
            }
            $query = rtrim($query, " AND ");
        }

        $statement = $this->pdo->prepare($query);

        foreach ($this->whereConditions as $condition) {
            $statement->bindValue(":{$condition[0]}", $condition[2]);
        }

        $statement->execute();
    }

    public function get($select = ['*']){
        $query = "SELECT " . implode(', ', $select) . " FROM {$this->table}";

        if($this->joinConditions){
            foreach ($this->joinConditions as $joinCondition) {
                $query .= " JOIN {$joinCondition['table']} ON {$joinCondition['firstColumn']} {$joinCondition['operator']} {$joinCondition['secondColumn']}";
            }
        }

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

        if($this->limit){
            $query .= " LIMIT {$this->limit}";
        }

        $statement = $this->pdo->prepare($query);

        foreach ($this->whereConditions as $condition) {
            $statement->bindValue(":{$condition[0]}", $condition[2]);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id, $select = ['*']){
        $query = "SELECT " . implode(', ', $select) . " FROM {$this->table} WHERE id = :id";
        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function insert($data = []){
        $this->insertData = $data;
        $columns = implode(', ', array_keys($this->insertData));
        $values = implode(", ", array_fill(0, count($this->insertData), "?"));
        $bindings = array_values($this->insertData);

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $statement = $this->pdo->prepare($query);
        $statement->execute($bindings);
    }

    public function update($data = []){
        $columns = implode(' = ?, ', array_keys($data)) . ' = ?';
        $bindings = [];

        $query = "UPDATE {$this->table} SET {$columns}";

        if (!empty($this->whereConditions)) {
            $whereConditions = [];
            foreach ($this->whereConditions as $index => $condition) {
                $whereConditions[] = "{$condition[0]} {$condition[1]} ?";
                $bindings[] = $condition[2];
            }
            $query .= " WHERE " . implode(' AND ', $whereConditions);
        }

        $statement = $this->pdo->prepare($query);
        
        $statement->execute($bindings);
    }


}