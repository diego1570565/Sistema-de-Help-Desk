

      <?php
session_start();

if ($_POST['email'] != '' && $_POST['senha'] != '' && $_POST['nome'] != '') {
    header('location: Valida_email2.php');
    require '../Caixa_de_Ferramentas/Funcoes.php';
    $_SESSION['cod'] = rand(1, 50000);
    Enviar_email($_POST['email'], 'Cadastro', 'Seu código é:' . $_SESSION['cod']);
    $_SESSION['emailLogin'] = $_POST['email'];
    $_SESSION['emailSenha'] = $_POST['senha'];
    $_SESSION['nomeLogin'] = $_POST['nome'];
} else {
    header('location: pagina_error.php');
}
;
?>



