<?php
require_once("credentials.php");

function getPDO()
{
    try {
        $dsn = "$motor:host=$host;dbname=$dbname;charset=$charset;port=$port";
        $pdo = new PDO($dsn, $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        echo "Database connected>>>>";

        return $pdo;
    } catch (PDOException $e) {
        $file_log = "log.txt";
        $log_message = "[" . date("Y-m-d H:i:s") . "] Connection error PDO: " . $e->getMessage() . " Code: " . $e->getCode() . PHP_EOL;
        file_put_contents($file_log, $log_message, FILE_APPEND);
        throw new PDOException($e->getMessage(), $e->getCode());
    }
}

?>