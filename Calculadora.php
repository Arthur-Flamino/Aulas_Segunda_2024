<?php
// iniciando uma session.
session_start();

// Iniciando um histórico com session.
if (!isset($_SESSION['historico'])) {
    $_SESSION['historico'] = [];
}
$historico = $_SESSION['historico'];

// Função criada para mostrar a conta bonitamente.
function mostrarOperacoes($num1, $num2, $conta) {
    return "{$num1} {$conta} {$num2} = ";
}

// Criando várias funções para todas as contas pedidas.
function soma($num1, $num2){
    return mostrarOperacoes($num1, $num2, "+") . $num1 + $num2;
}

function subtracao($num1, $num2){
    return mostrarOperacoes($num1, $num2, "-") . $num1 - $num2;
}

function divisao($num1, $num2){
    if ($num2 != 0) {
        $resultado = $num1 / $num2;
        return "{$num1} / {$num2} = {$resultado}";
    } else {
        return "Divisão por zero é inválida";
    }
}

function multiplicar($num1, $num2){
    return mostrarOperacoes($num1, $num2, "*") . $num1 * $num2;
}

function elevar($num1, $num2){
    return mostrarOperacoes($num1, $num2, "^") . pow($num1, $num2);
}

function fatorar($num1){
    if ($num1 != 0) {
        $resultado = 1;
        for ($i = 1; $i <= $num1; $i++) { 
            $resultado *= $i;
        }
        return "{$num1}! = {$resultado}";
    } else {
        return "Fatoração por zero é inválida";
    }
}

// verifica se o input calcula foi clicado.
if(isset($_POST['calcula'])){
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $conta = $_POST["seletor_conta"];
    
    // Switch feito para calcular a conta, com funções feitas para cada operação.
    switch ($conta) {
    case '+':
        $_SESSION["resultado"] = soma($num1, $num2);
    break;
    case '-':
        $_SESSION["resultado"] = subtracao($num1, $num2);
    break;
    case '/':
        $_SESSION["resultado"] = divisao($num1, $num2);
    break;
    case '*':
        $_SESSION["resultado"] = multiplicar($num1, $num2);
    break;
    case '^':
        $_SESSION["resultado"] = elevar($num1, $num2);
    break;
    case '!':
        $_SESSION["resultado"] = fatorar($num1);
    break;
    }
    array_push($historico, $_SESSION["resultado"]);
     $_SESSION['historico'] = $historico;    
}

// verifica se o input salvar foi clicado.
if (isset($_POST['salvar'])) {
    $_SESSION["resultado_s"] = $_SESSION["resultado"];            
    "Resultado salvo!";
} 

// verifica se o input mostrar foi clicado.
if (isset($_POST['mostrar'])) {
    if(isset($_SESSION["resultado_s"])){
        $_SESSION["resultado_s"];
    }else{
        "Nenhum resultado salvo.";
    }
}

// verifica se o input limpar histórico foi clicado.
if (isset($_POST['limpar_historico'])) {
    $_SESSION["historico"] = [];
    $historico = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>

    <style>
        body {
            background-color: black;
            color: lightskyblue;
            font-family: Arial, sans-serif;
            font-size: 17.3px;
            font-weight: bold;
        }
        h2 {
            font-size: 25px;
        }
        input, select {
            background-color: lightskyblue;
            color: black;
            border: none;
            padding: 5px 8px;
            font-size: 13px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Calculadora em PHP</h2>

    <form method="post" action=""> 
        <input type="number" name="num1" value="<?php echo isset($num1) ? $num1 : 0;?>" required>
        <select name="seletor_conta">
            <option value="+"> + </option>
            <option value="-"> - </option>
            <option value="/"> / </option>
            <option value="*"> * </option>
            <option value="^"> ^ </option>
            <option value="!"> ! </option>
        </select>
        <input type="number" name="num2"  value="<?php echo isset($num2) ? $num2 : 0;?>">
        <br><br>
        <input type="submit" name="calcula" value="Calcular">
        <input type="submit" name="salvar" value="Salvar">
        <input type="submit" name="mostrar" value="Mostrar">
        <input type="submit" name="limpar_historico" value="Limpar Histórico">
    </form>

    <div>
        <p>
            <?php
            // Mostrar resultado da operação
            if (isset($_SESSION["resultado"])) {
                echo $_SESSION["resultado"];
                echo"<br>";
            }
            // verifica se o input salvar foi clicado.
            if (isset($_POST['salvar'])) {
            $_SESSION["resultado_s"] = $_SESSION["resultado"];            
            echo "Resultado salvo!";
            } 
            // verifica se o input mostrar foi clicado.
            if (isset($_POST['mostrar'])) {
                if(isset($_SESSION["resultado_s"])){
                    echo "Salvo: " . $_SESSION["resultado_s"];
                }else{
                    echo "Nenhum resultado salvo.";
                }
            }
            ?>
        </p>
    </div>

    <hr>
    <h2>Histórico</h2>
    <div>
        <p>
            <?php 
            if (isset($_SESSION["historico"])) {
                foreach ($historico as $conta) {
                    echo "<p>• " . $conta . "</p>";
                }
            }
            ?>
        </p>
    </div>
</body>
</html>

