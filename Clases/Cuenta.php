<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuentas
 *
 * @author DWES
 */
require_once 'Clases/Conexion.php';
class Cuenta {
    private $iban;
    private $saldo;
    private $dni_cuenta;
    
    public function __construct($iban, $saldo, $dni_cuenta) {
        $this->iban = $iban;
        $this->saldo = $saldo;
        $this->dni_cuenta = $dni_cuenta;
    }
    public static function getCuentasCliente ($DNI){
         $conex = new Conexion();
        if ($conex->connect_errno != 0) {
            echo $conex->connect_error;
        } else {
             $consulta1= $conex->query("SELECT * from cuentas WHERE dni_cuenta = '$DNI'");
            if ($conex->errno != 0) {
                echo $conex->error;
                return FALSE;
            } else {
                $cuentas =  Array();
                while ($registro = $consulta1->fetch_object()) {
                   $cuentas[] = new Cuenta($registro->iban, $registro->saldo, $registro->dni_cuenta);
                    
                }
                return $cuentas;
            }
        }
}

public static function getTodasCuentas (){
      $conex = new Conexion();
      $conex->set_charset('utf8');
      
        if ($conex->connect_errno != 0) {
            echo $conex->connect_error;
        } else {
             $consulta1= $conex->query("SELECT * from cuentas, usuarios WHERE cuentas.dni_cuenta = usuarios.DNI ");
            if ($conex->errno != 0) {
                echo $conex->error;
                return FALSE;
            } else {
                $cuentas;
                while ($registro = $consulta1->fetch_object()) {
                   $cuentas[] = array("iban"=>"$registro->iban" , "titulo"=>"$registro->Nombre - $registro->iban");
                    
                }
                return $cuentas;
            }
        }
}

public function __get($name) {
    return $this->$name;
}
}
