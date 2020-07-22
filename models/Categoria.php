<?php

class Categoria {

    private $id;
    private $descripcion;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getAll() {
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");

        return $categorias;
    }

    public function getById($id) {
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = $id;");
        
        return $categoria->fetch_object();
    }

    public function save() {
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getDescripcion()}');";
        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

}