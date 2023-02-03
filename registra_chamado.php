<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include '../Caixa_de_Ferramentas/Funcoes.php';
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "usuarios";
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
if ($conn) {
    echo "conectou";
}

$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$email = $_SESSION['email'];
$imagens = $_FILES['imagem']['name'];
$data = date('Y-m-d');
$rond = rand(1, 500000);
$nome_imagem_salva = $email . '&' . '[' . $rond . ']' . $_FILES['imagem']['name'];
echo '<hr>';
echo $nome_imagem_salva;
echo '<hr>';
$_UP['pasta'] = 'Uploads/';
echo '<pre>';
print_r($_FILES['imagem']);
echo '</pre>';
$nome_final = $_FILES['imagem']['name'];
if (move_uploaded_file($_FILES['imagem']['tmp_name'], $_UP['pasta'] . $nome_imagem_salva)) {
    $verifica_imagem = true;
    echo "Arquivo enviado";
} else {
    echo "Não Há imagem";
}
echo '<hr>';

verifica_tabela('chamados', $conn);

if ($_SESSION['existencia'] == false) {
    $query = "CREATE TABLE `chamados` (
  `titulo` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `conteudo` varchar(500) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `id` int(11) NOT NULL,
  `situacao` varchar(20) DEFAULT NULL,
  `Imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $result = $conn->query($query);
}
$query = "SELECT id from chamados ORDER BY id DESC LIMIT 1";
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        if ($row['id'] != '') {
            $id = $row['id'];
            $id = $id + 1;
        }
    }
    $result->close();
}
if ($titulo != '' && $imagens == '') {
    $abrir_chamado = "INSERT INTO chamados (situacao, titulo, categoria, conteudo, email, data, id ) values " . "( 'aberto', '$titulo' , '$categoria' , '$descricao' , '$email', '$data' ,'$id')";
}

else if ($titulo != '' && $imagens != '') {
    $abrir_chamado = "INSERT INTO chamados (situacao, titulo, categoria, conteudo, email, data, id , Imagem ) values " . "( 'aberto','$titulo' , '$categoria' , '$descricao' , '$email', '$data' ,'$id' , '$nome_imagem_salva')";
}
else{
  header('location: pagina_error.php');
}
$var1 = false;
try {
  $resultado = mysqli_query($conn, $abrir_chamado);
} catch (Exception $e) {
  header("location: pagina_error.php?error=Não foi possivel inserir seu chamado, tente novamente revisando e removas as aspas caso existam");
echo '<pre>';
print_r($e->getmessage());
}
if ($resultado) {
    header('location: abrir_chamado.php');
    Enviar_email($_SESSION['email'], "HelpDesk", '<h2>Bom dia, <br> <h3>Seu chamado ' . ($titulo) . '<br> <h3> <br>' . $descricao . '<br> <h3>foi encaminhado ao banco<h3></h2>');
    $_SESSION['chamado_aberto'] = false;
} 