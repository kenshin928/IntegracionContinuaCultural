<?php

    class EncriptarPassMD5{
        static public function Encriptar($clave){
            return md5($clave);
        }
    }

?>