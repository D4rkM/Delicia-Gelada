<?php

  $login = 0;

  $login = "SELECT codigo FROM tbl_usuario WHERE login = '' AND senha = ''";

  try {
      define('idUsuario', mysqli_query($conn, $login));
  } catch (Exception $e) {

  }

  if (idUsuario != 0) {

  }

?>
