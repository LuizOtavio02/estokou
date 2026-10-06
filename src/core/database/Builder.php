<?php

namespace core\database;

use PDO;


class Builder
{
    use DBCrud;

    private Model $model;
    private string $table;
    private array $bindings = [];
    private string $select = '*';
    private array $wheres = [];
    private string $whereLogicOperator;
    private int|string $limit = '';
    private string $orderBy = '';
    private string $groupBy = '';

    public static function getInstance(Model $model)
    {
        $newSelf = new self();
        $newSelf->model = $model;
        $newSelf->setTable();
        return $newSelf;
    }

    private function setTable()
    {
        $reflect = new \ReflectionClass($this->model);
        if (!$reflect->hasProperty('table')) {
            throw new \Exception("Property Table Not Found in " . get_class($this->model));
        }

        $this->table = $reflect->getProperty('table')->getValue(
            $this->model
        );
    }

    public function save()
    {
        $attributes = $this->model->attributes();
        if (!array_key_exists('id', $attributes)) {
            return $this->create($attributes);
        }

        $attributesChanged = $this->model->attributesChanged();
        $where = ['id' => $attributes['id']];
        return $this->update($attributesChanged, $where);
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";

        return $this->get($sql);
    }

    public function select()
    {
        $this->select = (func_num_args() === 0) ? '*' : implode(', ',func_get_args());
        return $this;
    }

    public function and()
    {
        $this->whereLogicOperator = 'AND';
        return $this;
    }

    public function or()
    {
        $this->whereLogicOperator = 'OR';
        return $this;    
    }

    public function groupBy(string $field)
    {
        $this->groupBy = " GROUP BY {$field}";
        return $this;
    }

    public function orderBy(string $field, string $order = 'ASC')
    {
        $this->orderBy = " ORDER BY {$field} {$order}";
        return $this;
    }

    public function limit(int|string $limit)
    {
        $this->limit = ' LIMIT ' . $limit;
        return $this;
    }

    public function find(string $field, mixed $value = '')
    {
        if (func_num_args() === 2) {
            return $this->where($field,$value)->first();
        }

        return $this->where('id', $field)->first();
    }

    public function where(string $field, string $operator, string $value = '')
    {
        $where = empty($this->wheres) ? ' WHERE' : $this->whereLogicOperator;

        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $this->wheres[] = "{$where} {$field} {$operator} :{$field}";

        $this->bindings = [...$this->bindings,$field => $value];

        return $this;
    }

    public function get(string $sql = '')
    {
        return $this->executeStmt($sql)->fetchAll(PDO::FETCH_CLASS, $this->model::class);
    }

    public function first(string $sql = '')
    {
        return $this->executeStmt($sql)->fetchObject($this->model::class);
    }

    public function buildQuery()
    {
        $sql = "SELECT {$this->select} FROM {$this->table}";

        $sql .= implode(' ', $this->wheres);
        $sql .= $this->groupBy;
        $sql .= $this->orderBy;
        $sql .= $this->limit;

        return $sql;
    }

    public function executeStmt(string $sql = '')
    {
        if (empty($sql)) {
            $sql = $this->buildQuery();
        }
        
        return $this->getStmt($sql);
    }

    public function getStmt(string $sql)
    {
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->execute($this->bindings);
        return $stmt;    
    }
}
