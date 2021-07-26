<?php
namespace App;

/**
 * SQLite connnection
 */
class SQLiteConnection {
    /**
     * @var PDO 
     */
    private $pdo;

    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
    public function connect() {
        try {
            $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
            $this->pdo->sqliteCreateFunction('regexp_like', 'preg_match', 2);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return $this->pdo;   
    }
}