<?php
namespace Php\Exam;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{
    private $pdo;
    public function __construct()
    {
        $create = "CREATE TABLE IF NOT EXISTS logs(id INTEGER PRIMARY KEY AUTOINCREMENT,level VARCHAR(10) NOT NULL,message TEXT NOT NULL)";
        $this->pdo = new \PDO('sqlite:syslog.sqlite3');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec($create);

    }
    public function emergency($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function alert($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function critical($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function error($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function warning($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function notice($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function info($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function debug($message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }

    public function log($level, $message, array $context = array())
    {
        $this->insertLog(explode("::", __METHOD__)[1], $message);
    }
    private function insertLog($level, $message) 
    {
        $stmt = $this->pdo->prepare("INSERT INTO logs (level, message) VALUES (:level, :message)");
        $stmt->bindValue(':level', $level);
        $stmt->bindValue(':message', $message);
        $stmt->execute();
    }
}