<?php
    if($_POST["radio"] == "cesar") {
        $arrayNovasPalavras = array();
        $formatosPermitidos = "txt";
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        if($extensao == $formatosPermitidos){
            $temporario = $_FILES['arquivo']['tmp_name'];
            $palavra = file_get_contents($temporario);
            $arrayPalavra = str_split($palavra);
            $arrayPalavras = explode("\n", file_get_contents("palavras.txt"));
            $arrayLetras = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
            for ($i=1; $i < count($arrayLetras); $i++) {
                $palavraPronta = '';
                for ($j=0; $j < count($arrayPalavra); $j++) {
                    $letra = $arrayLetras[(array_search($arrayPalavra[$j], $arrayLetras) + $i) % 26];
                    $palavraPronta .= $letra;
                }
                $arrayNovasPalavras[] = $palavraPronta;
            }
        }
        echo json_encode($arrayNovasPalavras);
    }
?>