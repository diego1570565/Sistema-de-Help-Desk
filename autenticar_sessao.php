<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] <> 'SIM'){
  $var1 = true;
  header('Location: index.php');}
  ?>