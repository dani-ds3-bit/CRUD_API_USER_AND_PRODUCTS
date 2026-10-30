<?php
     include_once("connection.php");
     $con = connection();

     function getUsers(){
        $con = connection();
        $sql = "SELECT * FROM users";
        $query = mysqli_query($con, $sql);

        $users = [];
        while($row = mysqli_fetch_assoc($query)){
            $users[] = $row;

        }
        $con->close();
        return ["status" => "success", "data" => $users];

     }

     function registerUsers(){
        $con = connection();
            $name =trim( $_POST['name']?? '');

            $lastname =trim( $_POST['lastname']?? '');
            $username =trim( $_POST['username']?? '');
            $password = $_POST['password'] ?? '';
            $email =trim( $_POST['email']?? '');

            if (empty($name) || empty($lastname) || empty($username) || empty($password) || empty($email)) {
                return ["status" => "error", "message" => "Todos los campos son obligatorios"];
               
                
            }



            $passwordHash = password_hash("$password", PASSWORD_DEFAULT);


            $sql = "INSERT INTO users (name, lastname, username, password, email) VALUES(?, ?, ?, ?, ?)";

            $stmt = $con->prepare ($sql);
            $stmt->bind_param ("sssss", $name, $lastname, $username, $passwordHash, $email);

            if($stmt->execute()){

                $response = ["status" => "success", "message" => "usuario registrado de manera exitosa", "data" => getUsers()["data"]];

            }else{
                $response = ["status" => "error", "message" => "Error al registrar el usuario" . $stmt->error];

            }
            $con->close();
            $stmt->close();

            return $response;


      
     }

     function deleteUser(){
        $con = connection();
        $id = $_GET['id'] ?? $_POST['id'] ?? '';

        if (empty($id)) {
            return ["status" => "error", "message" => "El id es obligatorio"];
        }

        $sqlProducts = "DELETE FROM products WHERE user_id = ?";
        $stmtProducts = $con->prepare($sqlProducts);
        $stmtProducts->bind_param("i", $id);
        $stmtProducts->execute();
        $stmtProducts->close();

        $sqlUser = "DELETE FROM users WHERE id = ?";
        $stmtUser = $con->prepare($sqlUser);
        $stmtUser->bind_param("i", $id);

        if($stmtUser->execute()){
            $response = ["status" => "success", "message" => "productos y usuario eliminados de manera exitosa", "data" => getUsers()["data"]];
        }else{
            $response = ["status" => "error", "message" => "Error al eliminar el usuario" . $stmtUser->error];
        }

        $con->close();
        $stmtUser->close();

        return $response;
     }

     function getProducts(){
        $con = connection();
        $sql = "SELECT * FROM products";
        $query = mysqli_query($con, $sql);

        $products = [];
        while($row = mysqli_fetch_assoc($query)){
            $products[] = $row;

        }
        $con->close();
        return ["status" => "success", "data" => $products];

     }

     function registerProduct(){
        $con = connection();
            $user_id = trim($_POST['user_id'] ?? '');
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $stock = trim($_POST['stock'] ?? '');

            if (empty($user_id) || empty($name) || empty($description) || empty($price) || empty($stock)) {
                return ["status" => "error", "message" => "Todos los campos son obligatorios"];
            }

            $sql = "INSERT INTO products (user_id, name, description, price, stock) VALUES(?, ?, ?, ?, ?)";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("issdi", $user_id, $name, $description, $price, $stock);

            if($stmt->execute()){
                $response = ["status" => "success", "message" => "producto registrado de manera exitosa", "data" => getProducts()["data"]];
            }else{
                $response = ["status" => "error", "message" => "Error al registrar el producto" . $stmt->error];
            }

            $con->close();
            $stmt->close();

            return $response;
     }

     function deleteProduct(){
        $con = connection();
        $id = $_GET['id'] ?? $_POST['id'] ?? '';

        if (empty($id)) {
            return ["status" => "error", "message" => "El id es obligatorio"];
        }

        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);

        if($stmt->execute()){
            $response = ["status" => "success", "message" => "producto eliminado de manera exitosa", "data" => getProducts()["data"]];
        }else{
            $response = ["status" => "error", "message" => "Error al eliminar el producto" . $stmt->error];
        }

        $con->close();
        $stmt->close();

        return $response;
     }

?>
