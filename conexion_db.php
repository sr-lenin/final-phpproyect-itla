<?php

class ConexionDb{


    public static function conexion_db(){
        $conn = new mysqli("localhost", "root", "", "libreria", "3306");


        if ($conn -> connect_errno) {
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
          } else {
            return $conn;
          }
          
    }
}
