<?php
session_start();
$id_chamado = $_SESSION['id_chamado'];
$sit_chamado = $_SESSION['sit_chamado'];
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "usuarios";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
if ($conn){
    echo "conectou";
}

if ($sit_chamado == 'aberto')
{
    $query = "UPDATE chamados SET situacao = 'fechado' where id=". "$id_chamado";
}
if ($sit_chamado == 'fechado')
{
    $query = "UPDATE chamados SET situacao = 'aberto' where id=" . "$id_chamado";
}
try {
    $resultado = mysqli_query($conn, $query);
} catch (Exception $e) {
    header("location: pagina_error.php?error= $e->getmessage()");

}

if($resultado){
    header('location:consultar_chamado.php');
    $_SESSION['chamado_alterado']= false;  

}



?>