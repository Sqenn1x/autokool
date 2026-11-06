<?php
require_once __DIR__ . '/db.php';

// Lihtne PDO ümbris: getAll / getOne / executeRun (parameetrid on prepared statement'i jaoks)
class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = db();
    }

    public function getAll(string $sql, array $params = []): array
    {
        $st = $this->pdo->prepare($sql);
        $st->execute($params);
        return $st->fetchAll();
    }

    public function getOne(string $sql, array $params = []): ?array
    {
        $st = $this->pdo->prepare($sql);
        $st->execute($params);
        return $st->fetch() ?: null;
    }

    public function executeRun(string $sql, array $params = []): bool
    {
        try {
            return $this->pdo->prepare($sql)->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }
}
