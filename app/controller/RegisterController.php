<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT']) . '\php-oop-pdo\belajar-crud-login\app\model\Database.php');
include('LoginController.php');

class RegisterController {
    private $id;
    private $username;
    private $email;
    private $password;

    protected $dbCnx;

    public function __construct($id = 0, $username = '', $email = '', $password = '') 
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;

        $this->dbCnx = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function setId($id) {$this->id = $id;}
    public function getId() {return $this->id;}

    public function setUsername($username) {$this->username = $username;}
    public function getUsername() {return $this->username;}

    public function setEmail($email) {$this->email = $email;}
    public function getEmail() {return $this->email;}

    public function setPassword($password) {$this->password = password_hash($password, PASSWORD_DEFAULT);}
    public function getPassword() {return $this->password;}

    public function checkUser($email)
    {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM users WHERE email='$email'");
            $stm->execute();

            if($stm->fetchColumn()) {
                echo "<script>alert('Users already exists! please login'); document.location.href='../../../views/auth/login.php';</script>";
            } else {
                $this->register();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function register()
    {
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
            $stm->execute([$this->username, $this->email, $this->password]);

            $login = new LoginController();
            $login->setEmail($_POST['email']);
            $login->setPassword($_POST['password']);

            $login->login();

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}