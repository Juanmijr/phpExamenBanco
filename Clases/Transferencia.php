<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transferencia
 *
 * @author DWES
 */
class Transferencia {

    private $iban_origen;
    private $iban_destino;
    private $fecha;
    private $cantidad;

    public function __construct($iban_origen, $iban_destino, $fecha, $cantidad) {
        $this->iban_origen = $iban_origen;
        $this->iban_destino = $iban_destino;
        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
    }

    public static function getTranseferenciasCuentas($cuenta) {
        $conex = new Conexion();
        if ($conex->connect_errno != 0) {
            echo $conex->connect_error;
        } else {
            $consulta1 = $conex->query("SELECT * from transferencias WHERE iban_origen = '$cuenta'");
            if ($conex->errno != 0) {
                echo $conex->error;
                return FALSE;
            } else {
                $transferencia = array ();
                while ($registro = $consulta1->fetch_object()) {
                    $transferencia[] = new Transferencia($registro->iban_origen, $registro->iban_destino, $registro->fecha, $registro->cantidad);
                    return $transferencia;
                }
            }
        }
    }
    
    
 public function __get($name) {
    return $this->$name;
}
}
