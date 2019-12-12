<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

session_start();
require_once './Clases/Usuario.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Área restringida para usuarios: </h1>
        <form method="POST" action="">
            DNI: <input type='text' name='usuario' value=''><br><br>
            Contraseña: <input type="password" name="pass" value=""><br><br>
            <input type="submit" name="boton" value="LOGIN">
        </form>
        <?php
        if (isset($_POST['boton'])) {
            if ($usuario = Usuario::usuarioCorrecto($_POST['usuario'], $_POST['pass'])) {
               
                $_SESSION['usuario'] = serialize($usuario);
                echo $_SESSION['usuario'];
                header("Location:inicio_cliente.php");
            }
        }
        ?>
    </body>
</html>
