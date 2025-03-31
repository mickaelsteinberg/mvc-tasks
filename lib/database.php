<?php 

class DatabaseConnection {
    
    public ?\PDO $database = null;
    
    public function getConnection(): PDO
    {
        if ($this->database == null) {
            $host = 'localhost';
            $dbname = 'mvc-tasks';
            $username = 'root';
            $password = '';
            $charset = 'utf8mb4';
            
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            
            try {
                $this->database = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        
        return $this->database;
    }
    
}
