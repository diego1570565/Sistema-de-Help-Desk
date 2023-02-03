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


$query = "delete from chamados where id = " . "$id_chamado";
try {
    $resultado = mysqli_query($conn, $query);
} catch (Exception $e) {
    header("location: pagina_error.php?error= $e->getmessage()");

}
if($resultado){
    echo ("<script>alert('Chamado Deletado Com Sucesso')</script>");
    header('location:consultar_chamado.php');

}


?>
