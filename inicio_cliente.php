<html>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location:index.php");
    }
    require_once './Clases/Cuenta.php';
    require_once './Clases/Usuario.php';
    require_once './Clases/Transferencia.php';
    ?>
    <body>
        <?php
        $usuario = unserialize($_SESSION['usuario']);

        if ($cuentas = Cuenta::getCuentasCliente($usuario->DNI)) {
            echo "<table>";
            echo "<tr>";
            echo "<th>IBAN</th>";
            echo "<th>SALDO</th>";
            echo "<th>DNI CUENTA</th>";
            echo "</tr>";
            foreach ($cuentas as $cuenta) {
                echo "<tr>";
                echo "<td>$cuenta->iban</td>";
                echo "<td>$cuenta->saldo</td>";
                echo "<td>$cuenta->dni_cuenta</td>";
                ?>

                <form method="POST" action="">
                    <td><input type="submit" name="historial" value="Historial"></td>
                    <input type="hidden" name="iban" value="<?php echo $cuenta->iban; ?>">
                        
                </form >
                <form method="POST" action="">
                    <td><input type="submit" name="realizarTransferencias" value="Realizar Transferencias"></td>

                </form>
                <?php
                if (isset($_POST['realizarTransferencias'])){
                    $_SESSION['cuenta'] = serialize($cuenta);
                    header("Location:transferencias.php");
                }
                ?>
                <?php
                echo "</tr>";
            }
            echo "<table>";
            
            
                    if (isset($_POST['historial'])) {
                        if ($trans = Transferencia::getTranseferenciasCuentas($_POST['iban'])) {
                            echo "<hr>";
                            echo "<h1>HISTORIAL DE TRANSFERENCIAS: </h1>";
                            echo "<table>";
                            echo "<tr>";
                            echo "<th>IBAN ORIGEN</th>";
                            echo "<th>IBAN DESTINO</th>";
                            echo "<th>FECHA</th>";
                            echo "<th>CANTIDAD</th>";
                            echo "</tr>";
                            foreach ($trans as $transSeparado) {
                                echo "<tr>";
                                echo "<td>$transSeparado->iban_origen</td>";
                                echo "<td>$transSeparado->iban_destino</td>";
                                echo "<td>".date("d-m-Y H:i:s",$transSeparado->fecha)."</td>";
                                echo "<td>$transSeparado->cantidad</td>";
                                echo"<tr>";
                            }
                            echo "</table>";
                        }
                    }
                    


        }
        ?>
    </body>
</html>