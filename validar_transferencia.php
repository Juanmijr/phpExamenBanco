<HTML>
    <HEAD>
    </HEAD>
    <BODY>
        
        <?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:index.php");
}

require_once './Clases/Cuenta.php';
require_once './Clases/Transferencia.php';
$cuenta = unserialize($_SESSION['cuenta']);


$total = ($_POST['cantidad']) + ($_POST['cantidad']*0.01);
$saldoPosterior = $cuenta->saldo - $total;

?>
        
        
        
        <h1>Confirmación de transferencia: </h1>
        
        Origen: <?php echo $cuenta->iban;?><br><br>
        Destino: <?php echo $_POST['cuentaDestino']; ?><br><br>
        Cantidad: <?php echo $_POST['cantidad']; ?><br><br>
        Saldo anterior: <?php echo $cuenta->saldo;?><br><br>
        <p <?php if ($saldoPosterior<0) echo "" ?> > Saldo posterior: <?php echo $saldoPosterior;?></p>
        Comisión: <?php echo ($_POST['cantidad']*0.01); ?><br><br>
        
        <form method="POST" >
            <INPUT type="submit" <?php if ($saldoPosterior<0) echo "disabled='disabled';"?> name="transferencia" value="Realizar Transferencia">
        </form>
        
       y
antes de hacerla efectiva hay que comprobar que el saldo a transferir (más la comisión) es igual
o inferior al saldo disponible, para lo que se le mostrará al usuario los datos de la transferencia
(origen, destino, cantidad, saldo anterior, saldo posterior y comisión, y un botón para
confirmar). Si no hay dinero para realizar la transferencia, el saldo posterior aparecerá negativo
y en color rojo, y además el botón de confirmar la transferencia estará deshabilitado. 


    </BODY>
</HTML>