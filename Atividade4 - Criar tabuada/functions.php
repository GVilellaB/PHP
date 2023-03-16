<?php
 function calculadora($numb1,$numb2, $op){
    if($op == "mais"){
    echo "$numb1 + $numb2 = ".$numb1 + $numb2;
    }
    elseif($op =="menos"){
    echo "$numb1 - $numb2 = ".$numb1 - $numb2;
    }
    elseif($op =="vezes"){
    echo "$numb1 * $numb2 = ".$numb1 * $numb2;
    }
    elseif($op =="dividir"){
    echo "$numb1 / $numb2 = ".$numb1 / $numb2;
    }
}    
function escreva($texto){
    echo $texto;
}
function tabuada($numero,$i){
    $tabuada = "";
    // $vettabuada=[]; (variavel vetor)   
    for($i=0; $i< 11; $i++ ){    
        // array_push($vettabuada,"$numero."*$i = ".$numero*$i."<br>";) (pegando os dados para o vetor)  
        $tabuada .= $numero."*$i = ".$numero*$i."<br>";                
    } 
    //echo $tabuada ( retorna a tabuada do vetor)
    return $tabuada;     
}
function agendar($DiaHora,$NomePaciente,$convenio,$DetAgenda){
    include('conn.php');
        $sql ="INSERT INTO tab_agendamentos(DataHora,NomePaciente,Convenio,DetalhesPaciente) VALUES('$DiaHora','$NomePaciente','$convenio','$DetAgenda')";

        if(mysqli_query($conn,$sql)){
            echo "<script>alert('Registro Efetuado')</script>";
        }
}
?>