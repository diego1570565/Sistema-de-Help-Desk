<?php
session_start();
$_SESSION['id_Cha'] = $_SESSION['Diego'] - 6;
try {
   header('location:consultar_chamado.php');
} catch (Exception $e) {
    header("location: pagina_error.php?error= $e->getmessage()");

}
$_SESSION['varVerificacao'] = true;
