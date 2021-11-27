<?php
include_once "_com/dao.php";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "parts/imports.php"; ?>
    <link rel="stylesheet" href="css/chat.css">


    <script>
        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById("chat").innerHTML = req.responseText;
                }
            }
            req.open('GET', 'chat.php', true);
            req.send();
        }
        var messageBody = document.querySelector('#chat');
        messageBody.scrollTop =  messageBody.clientHeight - messageBody.scrollHeight ;
        setInterval(function() {
            ajax();
        }, 1000);
    </script>
</head>

<body onload="ajax();">
    <?php include_once "parts/navbarJuego.php"; ?>

    <div class="container-main">
        <?php
        if (isset($_SESSION["usuario"])) { ?>
            <div class="contenedor">
                <div class="contenedor-chat">
                    <div id="chat">

                    </div>
                </div>
                <form method="POST" action="chatMain.php">
                    <textarea name="mensaje" max="30" required></textarea>
                    <input type="submit" name="enviar" class="btn btn-danger btn-block">
                </form>
                <?php
                if (isset($_REQUEST["enviar"])) {
                    DAO::chatInsertar();
                }


                ?>
            </div>
    </div>
<?php } ?>
</body>

</html>