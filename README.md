# Proyecto MARKET_PLACE (API CRUD de Usuarios y Productos)

## De que trata el proyecto
En este proyecto se hizo un CRUD sencillo usando PHP y MySQL. 

Se programo una condicion importante: cuando se borra un usuario, el codigo primero borra todos los productos de ese usuario y ya despues borra al usuario para que no queden productos sueltos en la base de datos.

## Programas que se ocupan para correrlo
Para poder ejecutar este proyecto en la computadora se necesita tener:
- **XAMPP** (para Apache y MySQL)
- **Postman** (para las pruebas de GET, POST y DELETE)
- **Navegador web** (para entrar a phpMyAdmin)

## Como ejecutarlo paso a paso

1. **Guardar la carpeta del proyecto**
   Primero se tiene que poner la carpeta `MARKET_PLACE` adentro de la ruta `C:\xampp\htdocs\`. Adentro de esta carpeta estan los 3 archivos que se programaron: `connection.php`, `controllers.php` y `api.php`.

2. **Prender el XAMPP**
   Se abre el panel de control de XAMPP y se le da clic al boton **Start** en **Apache** y en **MySQL** hasta que los dos se pongan en color verde.

3. **Crear la base de datos en phpMyAdmin**
   Se entra en el navegador a `http://localhost/phpmyadmin` y se crea una base de datos llamada `market_place`. Adentro se crean las dos tablas (`users` y `products`), o se puede correr este codigo en la pestaña SQL:

```sql
CREATE DATABASE market_place;
USE market_place;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL
);
```

## Como hacer las pruebas en Postman

Para probar que el codigo funciona, se abre Postman y se usa la direccion base:
`http://localhost/MARKET_PLACE/api.php`

### Pruebas para Usuarios
- **Ver usuarios (GET):**
  Se pone el metodo `GET` y el link:
  `http://localhost/MARKET_PLACE/api.php?action=users`

- **Crear un usuario (POST):**
  Se cambia el metodo a `POST` con el mismo link `http://localhost/MARKET_PLACE/api.php?action=users`. En la parte de **Body -> form-data** se agregan los datos: `name`, `lastname`, `username`, `password` y `email`.

- **Borrar un usuario y sus productos (DELETE):**
  Se pone el metodo `DELETE` y en el link se pasa el id del usuario que se quiere borrar:
  `http://localhost/MARKET_PLACE/api.php?action=users&id=1`
  *(Al hacer esto primero se borran los productos de ese usuario y luego se borra el usuario).*

### Pruebas para Productos
- **Ver productos (GET):**
  Se pone el metodo `GET` y el link:
  `http://localhost/MARKET_PLACE/api.php?action=products`

- **Crear un producto (POST):**
  Se pone el metodo `POST` con el link `http://localhost/MARKET_PLACE/api.php?action=products`. En **Body -> form-data** se ponen los campos: `user_id` (el id del usuario dueño del producto), `name`, `description`, `price` y `stock`.

- **Borrar un producto (DELETE):**
  Se pone el metodo `DELETE` y en el link se pone el id del producto:
  `http://localhost/MARKET_PLACE/api.php?action=products&id=1`
