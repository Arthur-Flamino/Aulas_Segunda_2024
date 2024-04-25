<?php 

    //Função criada para mostrar a conta bonitamente.
    function mostrarOperacoes($num1, $num2, $conta) {
        return "{$num1} {$conta} {$num2} = ";
    }
    //criando varias funções para todas as contas pedidas.
    function soma($num1, $num2){
        return $num1 + $num2;
    }
    function subtracao($num1, $num2){
        return $num1 - $num2;
    }
    function divisao($num1, $num2){
        if ($num2 != 0) {
            $resultado = $num1 / $num2;
            return "{$num1} / {$num2} = {$resultado}";
        }
        else{
            echo "Divisão por zero é invalida";
        }
    }
    function multiplicar($num1, $num2){
        return $num1 * $num2;
    }
    function elevar($num1, $num2){
        return pow($num1, $num2);
    }
    function fatorar($num1){
        if ($num1 != 0) {
            $resultado = 1;
            for ($i=1; $i <= $num1; $i++) { 
                $resultado *= $i;
            }
            return "{$num1}! = {$resultado}";
        }
        else{
            echo "Fatoração por zero é invalida";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>

</head>
<body>

    <h2>Calculadora em PHP</h2>

    <form  method="post" action=""> 
    <input type="number" name="num1" value="<?php echo $num1 = isset($num1) ? $num1 : 0;?>" require>
    <select name="seletor_conta">
        <option value="+"> + </option>
        <option value="-"> - </option>
        <option value="/"> / </option>
        <option value="*"> * </option>
        <option value="^"> ^ </option>
        <option value="!"> ! </option>
    </select>
    <input type="number" name="num2"  value="<?php echo $num2 = isset($num2) ? $num2 : 0;?>">
    <br>
    <br>
    <input type="submit" name="calcula" value="Calcular">
    <input type="submit" name="salvar" value=" M ">
</form>


<?php

    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $conta = $_POST["seletor_conta"];
    $num1_s;
    $num2_s;
    $conta_s;
    $resultado;


    if(isset($_POST['calcula'])){
        //Switch feito para calcular a conta, com funções feitas para cada operação.
        switch ($conta) {
            case'+':
                echo mostrarOperacoes($num1, $num2, "+"). soma($num1, $num2);
                break;
            case'-':
                echo mostrarOperacoes($num1, $num2, "-"). subtracao($num1, $num2);
                break;
            case'/':
                echo divisao($num1, $num2);
                break;
            case'*':
                echo mostrarOperacoes($num1, $num2, "*"). multiplicar($num1, $num2);
                break;
            case'^':
                echo mostrarOperacoes($num1, $num2, "^"). elevar($num1, $num2);
                break;
            case'!':
                echo fatorar($num1);
                break;
        }
    }
    elseif (isset($_POST['salvar'])) {
        if($num1_s != null && $num2_s != null && $conta_s != null){
            $resultado = 
            mostrarOperacoes($num1_s, $num2_s, $conta_s);
        }
    }
    ?>
    <div>
    </div>
    <hr>
    <h2>Histórico</h2>
</body>