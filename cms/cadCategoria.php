<!DOCTYPE html>

<?php

  $conexao = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

  if(isset($_POST['btnSalvar'])){

    $nome = $_POST['txtCategoria'];
    $ativo = 1;//$_POST['ckativo'];

    $sql = "INSERT INTO tbl_categoria(categoria, ativo)
      VALUES ('$nome', '$ativo');";

    if(mysqli_query($conexao, $sql)){
      echo("<script>alert('Suco Cadastrado com Sucesso');</script>");
    }else{
      // echo($sql);
      echo("<script>alert('Erro ao cadastrar essa opção!');</script>");
      echo $sql;
    }

  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <title>CMS - Cadastro de Categoria</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <form class="frmAddCategoria" action="cadCategoria.php" method="post">
        <div class="conteudo">
          <div id="cadItem">
            <table width="500" height="200" border="solid">
              <tr>
                <td>Nome da Categoria : <input type="text" name="txtCategoria" placeholder="'Gelo Congelante'." required></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ckAtivo" value="">Ativo <br></td>
              </tr>
              <tr>
                <td><input type="submit" name="btnSalvar" value="Salvar"></td>
              </tr>
            </table>
          </div>
        </div>
      </form>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
