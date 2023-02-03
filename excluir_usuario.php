<?php
require 'conexao.php';
session_start();

$nomedousuario = $_SESSION['nomedousuario'];
$query = "Delete from usuarios where Nome=" . "'$nomedousuario'";

try {
    $resultado = mysqli_query($conn, $query);
} catch (Exception $e) {
    header("location: pagina_error.php?error= $e->getmessage()");

}
header('location:home.php');
?>