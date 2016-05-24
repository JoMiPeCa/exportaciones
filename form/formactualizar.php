<?php
$oProducto = new Producto();
?>
<form method="POST" action="accform/accProductoActualizar.php">
    <?php
    While ($Registro = $oProducto->Selecciona()) {
        ?>
        <input type="radio" name=elimina<?= $Registro->IdProducto() ?> value="<?= $Registro->IdProducto() ?>" id="idproducto">
        <?= $Registro->Nombre() ?>/<?= $Registro->Ano() ?>
        <br>
        <?php
    }
    ?>
    <tr>
        <td>Nombre: <input type="text" name="nombre" id="nombre" required="true"</td>
        <td>Total $: <input type="number" name="total" id="total" required="true"</td>
        <td>Año: <input type="number" name="anio" id="anio" required="true"</td>
    </tr></br>
    <tr>
        <td><input type="submit" value="Actualizar"></td>
    </tr>
</form>