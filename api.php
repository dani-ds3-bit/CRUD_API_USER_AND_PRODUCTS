<?php
    header('Content-Type: application/json');
    include("controllers.php");

    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';

    switch($method){
        case 'GET':
            if($action === 'users' || $action === '' || $action === 'register'){
                echo json_encode(getUsers());
            }
            elseif($action === 'products'){
                echo json_encode(getProducts());
            }
            break;

        case 'POST':
            if ($action === 'register' || $action === 'users' || $action === ''){
                echo json_encode(registerUsers());
            }
            elseif ($action === 'products'){
                echo json_encode(registerProduct());
            }
            break;

        case 'DELETE':
            if ($action === 'users' || $action === ''){
                echo json_encode(deleteUser());
            }
            elseif ($action === 'products'){
                echo json_encode(deleteProduct());
            }
            break;
    }
?>
