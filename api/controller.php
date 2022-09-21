<?php
    ini_set( 'default_charset', 'utf-8');
    $formatosPermitidos = "txt";
    $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
    $temporario = $_FILES['arquivo']['tmp_name'];
    $palavra = file_get_contents($temporario);
    $arrayResposta = array();
    if($palavra != ""){
        $arrayPalavra = str_split($palavra);
        $arrayLetras = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
        $stream = fopen((__DIR__)."/palavras.txt", "r");
        $palavras = "";
        while(($line=fgets($stream))!==false) { 
            $palavras .= preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/ç/"),explode(" ","a A e E i I o O u U n N c"),$line);
        }
        $arrayPalavras = explode("\n", str_replace("\r", "", $palavras));
        if($_POST["radio"] == "cesar") {
            $arrayNovasPalavras = array();
            if($extensao == $formatosPermitidos){
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
                array_unshift($arrayResposta, "cesar");
            }
        }
        elseif($_POST["radio"] == "vigenere") {
            $arrayResultados = array();
            $chave = "";
            for ($j=0; $j < count($arrayLetras); $j++) {
                for ($k=0; $k < count($arrayLetras); $k++) {
                    for ($l=1; $l < count($arrayLetras); $l++) {
                        $chave = [$arrayLetras[$j],$arrayLetras[$k],$arrayLetras[$l],$arrayLetras[$j],$arrayLetras[$k],$arrayLetras[$l]];
                        $chaveMontada = $arrayLetras[$j].$arrayLetras[$k].$arrayLetras[$l];
                        $palavraMontada = "";
                        for ($i=0; $i < count($arrayPalavra); $i++) {
                            $posicao = array_search(strtolower($arrayPalavra[$i]), $arrayLetras) - array_search(strtolower($chave[$i]), $arrayLetras);
                            if($posicao < 0){
                                $posicao += 26;
                            }
                            if(ctype_upper($arrayPalavra[$i])){
                                $palavraMontada .= strtoupper($arrayLetras[$posicao]);
                            }else{
                                $palavraMontada .= $arrayLetras[$posicao];
                            }
                        }
                        if(in_array(strtolower($palavraMontada), $arrayPalavras)){
                            $resposta = [$palavraMontada, strtoupper($chaveMontada)];
                            break 3;
                        }else{
                            array_push($arrayResposta, [$palavraMontada, strtoupper($chaveMontada)]);
                        }
                    }                
                }            
            }
            array_unshift($arrayResposta, $resposta);
            array_unshift($arrayResposta, "vigenere");
        }
    }
    else{
        array_unshift($arrayResposta, "vazio");
    }
    echo json_encode($arrayResposta);
?>