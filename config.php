<?php
class Database {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname = "floricultura4estacoes";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    public function insertUser($email, $senha) {
        $stmt = $this->conn->prepare("INSERT INTO cadastro (email, senha) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $senha);

        if ($stmt->execute() === TRUE) {
            echo "<script>
                    alert('Cadastro realizado com sucesso!');
                    setTimeout(function() {
                        window.location.href = 'menu.html';
                    }, 1000);
                </script>";
        } else {
            echo "<script>alert('Erro: " . addslashes($stmt->error) . "');</script>";
        }

        $stmt->close();
    }

    public function close() {
        $this->conn->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $db = new Database();
    $db->insertUser($email, $senha);
    $db->close();
}
?>
