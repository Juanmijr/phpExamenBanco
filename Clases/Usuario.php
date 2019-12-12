<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author DWES
 */require_once 'Clases/Conexion.php';
class Usuario {

    private $nombre;
    private $direccion;
    private $telefono;
    private $DNI;
    private $clave;

    public function __construct($nombre, $direccion, $telefono, $DNI, $clave) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->DNI = $DNI;
        $this->clave = $clave;
    }

    public static function usuarioCorrecto($DNI, $clave) {
        $conex = new Conexion();
        if ($conex->connect_errno != 0) {
            echo $conex->connect_error;
        } else {
            $consulta1= $conex->query("SELECT * from usuarios WHERE DNI = '$DNI' AND clave = '$clave'");
            if ($conex->errno != 0) {
                echo $conex->error;
                return FALSE;
            } else {
                if ($registro = $consulta1->fetch_object()) {
                   $usuario = new Usuario($registro->Nombre, $registro->Direccion, $registro->Telefono, $registro->DNI, $registro->clave);
                    return $usuario;
                }
            }
        }
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    

}
