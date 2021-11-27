<?php
include_once "_com/dao.php";
$filas = DAO::chatObtener();
foreach ($filas as $fila) {


?>
    <div id="datos-chat">
    
        <span><?= $fila["usuario"] ?></span>
        <span><?= $fila["mensaje"] ?></span>
        <span><?= formatFecha($fila["fecha"]) ?></span>
    </div>

<?php } ?>
