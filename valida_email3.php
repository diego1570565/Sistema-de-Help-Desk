
      <?php
          session_start();
          if ($_SESSION['cod'] == $_POST['nome'])
          {
            header('Location: adc_login.php');
          }
          else{
            header('Location: pagina_error.php?error= Código Inserido Incorreto');
          }
        ?>
  