<?php
function conexao(){
  $conn = mysqli_connect("localhost","root","bcd127","db_delicia_gelada");
  return $conn;
}
?>
