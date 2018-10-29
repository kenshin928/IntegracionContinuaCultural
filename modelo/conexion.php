<?php
    class Conexion{
        private $link;

        public function setLink($link){
            return $this->link;
        }
        public function obtenerConexion()
        {
            return $this->link;
        }

        public function __construct() {
            if($this->link === null){
                $this->link = new PDO("mysql:host=localhost;dbname=thexperto",
                                "root",
                                "");
                $this->link->exec("set names utf8");
            }
        }

        static public function conectar(){
            try{
                $link = new PDO("mysql:host=localhost;dbname=thexperto",
                                "root",
                                "");
                $link->exec("set names utf8");
                return $link;
            }catch(Exception $e){
                return $e->getMessage();
            }
        }


    }
?>