<?php
require 'conexao.php';
session_start();

$nomedousuario = $_SESSION['nomedousuario'];
$query = "UPDATE usuarios SET Condicao = 'adm' where Nome=" . "'$nomedousuario'";
try {
    $resultado = mysqli_query($conn, $query);
} catch (Exception $e) {
    header("location: pagina_error.php?error= $e->getmessage()");

}

echo "<script>alert 'Usuario agora é um Administrador'</script>";
header('location:home.php');
?>