<?php

class Connection {
    private $conn;

    public function __construct()
    {
        try{
            $envVars = $this->parseEnvFile('.env');
            $host = $envVars['DB_HOST'];
            $port = (int)$envVars['DB_PORT'];
            $username = $envVars['DB_USERNAME'];
            $password = $envVars['DB_PASSWORD'];
            $database = $envVars['DB_DATABASE'];


            $this->conn = new mysqli($host, $username, $password, $database, $port);

        }catch(Exception $exc){
            die('Failed to connect to the database: ' . $exc);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function executeQuery($query)
    {
        try{
            $result = $this->conn->query($query);

        }catch(Exception $exc){
            die('Error executing query: ' . $this->conn->error);
        }
        return $result;
    }

    public function getLastInsertedId()
    {
        return $this->conn->insert_id;
    }

    public function close()
    {
        $this->conn->close();
    }

    private function parseEnvFile($filePath)
    {
        $envVars = [];

        if (!file_exists($filePath)) {
            die('.env file not found.');
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $envVars[$key] = trim($value);
            }
        }

        return $envVars;
    }
}

?>
