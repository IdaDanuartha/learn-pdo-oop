<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\php-oop-pdo\belajar-crud-login\app\model\Database.php');

class PostController {
    private $id;
    private $title;
    private $category;
    private $content;
    private $created_at;
    private $updated_at;

    protected $dbCnx;

    public function __construct($id = 0, $title = '', $category = '', $content = '', $created_at = '', $updated_at = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;

        $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    }

    public function setId($id)
    {
        $this->id = $id;
    } 
    public function getId()
    {
        return $this->id;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    } 
    public function getTitle()
    {
        return $this->title;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    } 
    public function getCategory()
    {
        return $this->category;
    }

    public function setContent($content)
    {
        $this->content = $content;
    } 
    public function getContent()
    {
        return $this->content;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    } 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    } 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function fetchAll()
    {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM posts");
            $stm->execute();

            return $stm->fetchAll();
        } catch(Exception $e) {
            $e->getMessage();
        }
    }

    public function store()
    {
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO posts (title, category, content, created_at, updated_at) VALUES (?,?,?,?,?)");
            $stm->execute([$this->title, $this->category, $this->content, $this->created_at, $this->updated_at]);

            echo "<script>alert('Data created successfully'); document.location.href='../../views/index.php';</script>";
        } catch(Exception $e) {
            $e->getMessage();
        }
    }

    public function edit()
    {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM posts WHERE id=?");
            $stm->execute([$this->id]);

            return $stm->fetchAll();
        } catch(Exception $e) {
            $e->getMessage();
        }
    }
    
    public function update()
    {
        try {
            $stm = $this->dbCnx->prepare("UPDATE posts SET title=?, category=?, content=?, updated_at=? WHERE id=?");
            $stm->execute([$this->title, $this->category, $this->content, $this->updated_at, $this->id]);

            echo "<script>alert('Data updated successfully'); document.location.href='../../views/index.php';</script>";
        } catch(Exception $e) {
            $e->getMessage();
        }
    }

    public function delete()
    {
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM posts WHERE id=?");
            $stm->execute([$this->id]);

            echo "<script>alert('Data deleted successfully'); document.location.href='../../views/index.php';</script>";
        } catch(Exception $e) {
            $e->getMessage();
        }
    }
}