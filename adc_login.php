<?php
session_start();
require('conexao.php');
include('../Caixa_de_Ferramentas/Funcoes.php');
verifica_tabela('usuarios', $conn);
if ($_SESSION['existencia'] == false) {
    $Query = "CREATE TABLE `usuarios` (
        `Email` varchar(50) NOT NULL,
        `Senha` varchar(10) NOT NULL,
        `Nome` varchar(30) NOT NULL,
        `Condicao` varchar(10) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ";
    $resultado = mysqli_query($conn, $Query);
}
$email_do_cadastro = $_SESSION['emailLogin'];
$senha_do_cadastro = $_SESSION['emailSenha'];
$nome_do_cadastro  =  $_SESSION['nomeLogin'];
echo "até aqui deu certo";
$inserir_novos_dados = "INSERT INTO usuarios (Email,senha,Nome) VALUES
    (" . " '$email_do_cadastro' " . ',' . " '$senha_do_cadastro'" . ',' . " '$nome_do_cadastro' " . ')';

try{
$resultado = mysqli_query($conn, $inserir_novos_dados);
}
catch(Exception $e){
    header("location: pagina_error.php?error= $e->getmessage()");

}
if ($resultado) {
    header('location: Index.php');
    $_SESSION['nome'] = $nome_do_cadastro;
}
mysqli_close($conn);
