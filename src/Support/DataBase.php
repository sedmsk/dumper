<?php

declare(strict_types=1);

namespace SD\Dumper\Support;

use PDO;

class DataBase
{
    protected static $instance;

    /**
     * @var \PDO
     */
    protected $pdo;

    protected $sql_create_table = <<<'SQLite'
CREATE TABLE IF NOT EXISTS dumps (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    data TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
SQLite;

    public function __construct()
    {
        $file = implode(
            DIRECTORY_SEPARATOR,
            [
                sys_get_temp_dir(),
                implode(
                    '.',
                    [
                        'dumper',
                        substr(hash('md5', __DIR__), 0, 10),
                        'database',
                    ]
                ),
            ]
        );

        $this->pdo = new PDO('sqlite:'.$file, null, null, [PDO::ATTR_PERSISTENT => true]);

        $this->pdo->exec($this->sql_create_table);
    }

    public static function insert($data): void
    {
        $SQL = 'INSERT INTO dumps (data) VALUES (:data)';
        $params = [
            'data' => $data,
        ];

        static::getPDO()
            ->prepare($SQL)
            ->execute($params);
    }

    public static function getPDO(): PDO
    {
        return static::getInstance()->pdo;
    }

    protected static function getInstance(): self
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function select($id = null): array
    {
        $params = [];
        if ($id === null) {
            $SQL = 'SELECT d.* FROM dumps d WHERE created_at > datetime(\'now\', \'-5 minutes\') ORDER BY id DESC LIMIT 10';
        } else {
            $SQL = 'SELECT d.* FROM dumps d WHERE id > :id ORDER BY id DESC ';
            $params[':id'] = $id;
        }

        $x = static::getPDO()
            ->prepare($SQL);
        $x->execute($params);

        return $x->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete()
    {
        $SQL = 'DELETE FROM dumps;';

        $x = static::getPDO()
            ->prepare($SQL);
        $x->execute();
    }
}
