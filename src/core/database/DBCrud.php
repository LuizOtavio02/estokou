<?php

namespace core\database;

/**
 * @property string $table
 */
trait DBCrud
{
    public function create(array $data)
    {
        $fields = implode(', ', array_keys($data));
        $values = implode(', ', array_map(function ($key) {
            return ":{$key}";
        }, array_keys($data)));

        $this->bindings = $data;

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";

        return $this->execute($sql);
    }

    public function update(array $data, array $where)
    {
        $this->bindings = [...$data, ...$where];

        $fields = implode(',', array_map(function ($field) {
            return "{$field} = :{$field}";
        }, array_keys($data)));

        $where = array_map(function ($field) {
            return "{$field} = :{$field}";
        }, array_keys($where));

        $sql = "UPDATE {$this->table} SET {$fields} WHERE " . implode(' AND ', $where);

        return $this->execute($sql);
    }

    public function delete(array $where)
    {
        $this->bindings = $where;
        
        $where = array_map(function ($field) {
            return "{$field} = :{$field}";
        }, array_keys($where));

        $sql = "DELETE FROM {$this->table} WHERE " . implode(' AND ', $where);

        return $this->execute($sql);
    }
}
