<?php

namespace core\database;


class Builder
{
    use DBCrud;

    private Model $model;
    private string $table;
    private array $bindings = [];

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
        $where = ['id' => $attributes['id']];
        unset($attributes['id']);
        return $this->update($attributes, $where);
    }

    public function where(string $field, string $operator, string $value)
    {
        dd($field, $operator, $value);
    }

    public function handleStmt(string $sql)
    {
        $stmt = Connection::getInstance()->prepare($sql);
        return $stmt->execute($this->bindings);
    }

    public function execute(string $sql = '')
    {
        if (empty($sql)) {
            return;
        }
        
        return $this->handleStmt($sql);
    }
}
