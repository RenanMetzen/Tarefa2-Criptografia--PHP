<?php
ini_set( 'default_charset', 'utf-8');
    if($_POST["radio"] == "cesar") {
        $arrayResposta = array();
        $arrayNovasPalavras = array();
        $formatosPermitidos = "txt";
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        if($extensao == $formatosPermitidos){
            $temporario = $_FILES['arquivo']['tmp_name'];

            $palavra = file_get_contents($temporario);
            $arrayPalavra = str_split($palavra);

            $stream = fopen((__DIR__)."/palavras.txt", "r");
            $palavras = "";
            while(($line=fgets($stream))!==false) { 
                 $palavras .= preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/ç/"),explode(" ","a A e E i I o O u U n N c"),$line);
            }
            $arrayPalavras = explode("\r\n", $palavras);
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
                if(in_array(strtolower($arrayNovasPalavras[$i]), $arrayPalavras)){
                    array_unshift($arrayResposta, [$arrayNovasPalavras[$i], $i+1]);
                }else{
                    array_push($arrayResposta, [$arrayNovasPalavras[$i], $i+1]);
                }
            }
        }
        echo json_encode($arrayResposta);
    }
    elseif($_POST["radio"] == "vigenere") {
        
    }
?>