<?php

namespace core\database;


class Builder
{
    use DBCrud;

    private Model $model;
    private string $table;

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
            $this->create($attributes);
            return;
        }
        dd('update');
    }

    public function where(string $field, string $operator, string $value)
    {
        dd($field, $operator, $value);
    }
}
