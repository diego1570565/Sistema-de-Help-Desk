<?php
session_start();

$_SESSION['varVerificacao'] = true;

require_once 'conexao.php';

$query = 'SELECT ' . 'count' . '(*) FROM  chamados';

try {
    if ($result = $conn->query($query)) {
    $chamados_front = array();
    while ($row = $result->fetch_assoc()) {
        $contagem = $row['count(*)'];
    }
}
} catch (Exception $e) {
    header("location: pagina_error.php?error= $e->getmessage()");

}



$result->close();

if ($_SESSION['id_Cha'] <> $contagem && ($_SESSION['id_Cha'] + 5) <> $contagem && ($_SESSION['id_Cha'] + 4) <> $contagem && ($_SESSION['id_Cha'] + 3) <> $contagem && ($_SESSION['id_Cha'] + 2) <> $contagem && ($_SESSION['id_Cha'] + 1) <> $contagem) {
    if (($_SESSION['Diego'] + 1) <= ($contagem)) {
        $_SESSION['id_Cha'] = $_SESSION['Diego'] + 1;
    }
    if (($_SESSION['Diego'] + 2) <= ($contagem)) {
        $_SESSION['id_Cha'] = $_SESSION['Diego'] + 2;
    }
    if (($_SESSION['Diego'] + 3) <= ($contagem)) {
        $_SESSION['id_Cha'] = $_SESSION['Diego'] + 3;
    }
    if (($_SESSION['Diego'] + 4) <= ($contagem)) {
        $_SESSION['id_Cha'] = $_SESSION['Diego'] + 4;
    }
}


echo 'ID de cima:' . $_SESSION['Diego'];
echo '<br>';
echo 'O número Todal de Chamados: (contagem)' . $contagem;
echo '<br>';
echo 'O ultimo de baixo: (idcha) ' . $_SESSION['id_Cha'];
header('location:consultar_chamado.php');
