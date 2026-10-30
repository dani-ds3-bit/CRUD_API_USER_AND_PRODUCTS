<?php
    function connection(){
         $host = "localhost";
            $user = "root";
            $pass = "";
            $db   = "market_place";

        $connect = new mysqli($host, $user, $pass, $db);

        if($connect->connect_error){
            header("Content-Type: application/json");

            echo json_encode([
                "status" => "error",
                "message" => "Error de conexion " . $connect->connect_error
            ]);
            exit();
        }

        $connect->set_charset("utf8");
        return $connect;
    }
?>
