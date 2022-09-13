<?php
    if(isset($_POST['enviar-formulario'])) {
        $formatosPermitidos = "txt";
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        if(1){
            $temporario = $_FILES['arquivo']['tmp_name'];
            $palavra = file_get_contents($temporario);
            echo $palavra;
            die;
        }
        header("Location: index.php");
    }