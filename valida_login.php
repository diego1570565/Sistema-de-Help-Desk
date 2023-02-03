<?php
require_once "conexao.php";
$email_do_cadastro = $_POST['email'];
$senha_do_cadastro = $_POST['senha'];

if ($senha_do_cadastro && $email_do_cadastro != '') {
    session_start();

    if ($conn) {
        echo "conectado <hr>";
    }

    $consulta = "SELECT Email FROM usuarios WHERE Email = " . "'$email_do_cadastro' and senha = " . "'$senha_do_cadastro';";

    try {
        $resultado = mysqli_query($conn, $consulta);
    }catch (Exception $e) {
            header("location: pagina_error.php?error= $e->getmessage()");     
    }
        echo '<pre>';
        print_r($resultado);
        if ($resultado->num_rows > 0) {

            $_SESSION['autenticado'] = 'SIM';
            $_SESSION['email'] = ($email_do_cadastro);
            header('Location:home.php');
            $_SESSION['id_Cha'] = -1;

            $query = "SELECT Condicao FROM usuarios WHERE Email = " . "'$email_do_cadastro';";

            if ($result = $conn->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['Condicao'] != 'adm') {
                        $_SESSION['condicao'] = 'USUARIO';
                    } else {
                        $_SESSION['condicao'] = 'ADMINISTRADOR';
                    }
                }
            }
            $query = "SELECT Nome FROM usuarios WHERE Email = " . "'$email_do_cadastro';";

            if ($result = $conn->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['Nome'] = ($row['Nome']);
                }
            }
            $result->close();

        } else {
            echo "Nao encontrado";
            header('location:pagina_error.php?error=Login ou Senha inserida Incorretamente');
        }

    mysqli_close($conn);
} else {
    header('login.php');
}
