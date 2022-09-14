<?php
    if($_POST["radio"] == "cesar") {
        $arrayResposta = array();
        $arrayNovasPalavras = array();
        $formatosPermitidos = "txt";
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        if($extensao == $formatosPermitidos){
            $temporario = $_FILES['arquivo']['tmp_name'];
            $palavra = file_get_contents($temporario);
            $arrayPalavra = str_split($palavra);
            $arrayPalavras = explode("\n", file_get_contents((__DIR__)."/palavras.txt"));
            $arrayLetras = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
            for ($i=1; $i < count($arrayLetras); $i++) {
                $palavraPronta = '';
                for ($j=0; $j < count($arrayPalavra); $j++) {
                    $letra = $arrayLetras[(array_search(strtolower($arrayPalavra[$j]), $arrayLetras) + $i) % 26];
                    if(ctype_upper($arrayPalavra[$j])){
                        $palavraPronta .= strtoupper($letra);
                    }else{
                        $palavraPronta .= $letra;
                    }
                }
                $arrayNovasPalavras[] = $palavraPronta;
            }

            for ($i=0; $i < count($arrayNovasPalavras); $i++) { 
                for ($j=0; $j < count($arrayPalavras); $j++) {
                    if(strtolower($arrayNovasPalavras[$i]) == strtolower(str_replace("\r", "", $arrayPalavras[$j]))){
                        $arrayResposta[] = [$arrayNovasPalavras[$i], $i+1];
                    }
                }
            }
            for ($i=0; $i < count($arrayNovasPalavras); $i++) { 
                $arrayResposta[] = [$arrayNovasPalavras[$i], $i+1];
            }
        }
        echo json_encode($arrayResposta);
    }elseif($_POST["radio"] == "vigenere") {
        
    }
?>