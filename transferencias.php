<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:index.php");
}

require_once './Clases/Cuenta.php';
require_once './Clases/Transferencia.php';
$cuenta = unserialize($_SESSION['cuenta']);
?>
<html>

    <body>
        <h1>TRANFERENCIAS: </h1>
        <p> Cuenta : <?php echo $cuenta->iban; ?></p>
        <p> Saldo: <?php echo $cuenta->saldo; ?></p>

        <form method="POST" action="validar_transferencia.php">
            Cantidad a transferir: <input type='number' name="cantidad" value=""><br><br>
            Cuenta a la que transferir: <select name='cuentaDestino'>

                <?php
                $array = Cuenta::getTodasCuentas();

                foreach ($array as $cuentas) {
                    echo "<option value=" . $cuentas['iban'] . "> " . $cuentas['titulo'] . " </option>";
                }
                ?>
            </select>
            <br><br>

            <input type="submit" name="boton" value="Realizar Transferencia">
        </form>

    </body>

</html>
