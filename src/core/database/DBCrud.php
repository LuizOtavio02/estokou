<?php

namespace core\database;

/**
 * @property string $table
 */
trait DBCrud
{
    public function create(array $data)
    {
        $fields = implode(', ',array_keys($data));
        $values = implode(', ', array_map(function ($key) {
            return ":{$key}";
        }, array_keys($data)));

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";

        dd($sql);
    }

}
