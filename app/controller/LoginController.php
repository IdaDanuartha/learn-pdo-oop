<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT']) . '\php-oop-pdo\belajar-crud-login\app\model\Database.php');

class LoginController {
    private $id;
    private $email;
    private $password;

    protected $dbCnx;

    public function __construct($id = 0, $email = '', $password = '') 
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;

        $this->dbCnx = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function setId($id) {$this->id = $id;}
    public function getId() {return $this->id;}

    public function setEmail($email) {$this->email = $email;}
    public function getEmail() {return $this->email;}

    public function setPassword($password) {$this->password = $password;}
    public function getPassword() {return $this->password;}

    // public function getAllUser()
    // {
    //     try {
    //         $stm = $this->dbCnx->prepare("SELECT * FROM users");
    //         $stm->execute();

    //         return $stm->fetchAll();
    //     } catch(Exception $e) {
    //         $e->getMessage();
    //     }
    // }

    public function login()
    {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM users WHERE email = ?");
            $stm->execute([$this->email]);

            $user = $stm->fetch();

            if($user && password_verify($this->password, $user['password'])) {
                session_start();
                $_SESSION['loggedin'] = true;

                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];

                header('Location: ../../../views/index.php');
            } else {
                echo "<script>alert('Invalid email or password'); document.location.href='../../../views/auth/login.php';</script>";
            }

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}