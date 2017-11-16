<!DOCTYPE html>

<?php

  $conexao = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

  if(isset($_POST['btnSalvar'])){

    $nivel = $_POST['txtNivel'];

    $sql = "INSERT INTO tbl_NivelDeUsuario(nivel)
      VALUES ('$nivel');";

    if(mysqli_query($conexao, $sql)){

      echo("<script>alert('Nivel cadastrado com sucesso!');</script>");
    }else{
      // echo($sql);
      echo("<script>alert('Erro ao cadastrar nivel!');</script>");
    }

  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <title>CMS - Níveis</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="subMenu">
        <a href="admNivel.php">
          <img src="#" alt="retornar">
        </a>
      </div>
      <form class="frmAddNivel" action="cadNivel.php" method="post">
        <div class="conteudo">
          <div id="editarUsuairo">
            Nivel : <input type="text" name="txtNivel" placeholder="Insira o nivel a ser cadastrado"><br>
            <input type="submit" name="btnSalvar" value="Salvar">
          </div>
        </div>
      </form>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
