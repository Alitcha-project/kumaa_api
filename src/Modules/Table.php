<?php

namespace Kumaa\Modules;

class Table
{
    protected $table = "";

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get(int $id): array
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
        $prepare = $this->pdo->prepare($query);
        $prepare->execute([$id]);
        $data = $prepare->fetchAll();

        return $data ?? [];
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM ' . $this->table;
        $prepare = $this->pdo->prepare($query);
        $prepare->execute();
        $data = $prepare->fetchAll();

        return $data ?? [];
    }

    public function insert(array $fields): bool
    {
        $field_key = join(', ', array_keys($fields));
        $field_value = join(', ', array_map(function ($field) {
            return ':'.$field;
        }, array_keys($fields)));

        $query = 'INSERT INTO ' . $this->table . ' (' . $field_key . ') VALUES (' . $field_value .')';
        $prepare = $this->pdo->prepare($query);
        return $prepare->execute($fields);
    }

    public function delete(int $id): bool
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';
        $prepare = $this->pdo->prepare($query);
        return $prepare->execute([$id]);
    }

    public function update(int $id, array $fields)
    {
        $sub_query = join(', ', array_map(function ($field) {
            return $field . ' = :' . $field;
        }, array_keys($fields)));
        $query = 'UPDATE ' . $this->table . ' SET ' . $sub_query . ' WHERE id = :id';
        $prepare = $this->pdo->prepare($query);
        return $prepare->execute(array_merge($fields, ['id' => $id]));
    }
}