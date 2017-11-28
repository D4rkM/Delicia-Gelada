<!DOCTYPE html>

<?php

  require_once("include/conexao.php");
  $conn = conexao();

  if(isset($_POST['btnSalvar'])){

    $nivel = $_POST['txtNivel'];
    $conteudo = $_POST['ckConteudo'] ? isset($_POST['ckConteudo']) : 0;
    $faleConosco = $_POST['ckFaleConosco'] ? isset($_POST['ckFaleConosco']) : 0;
    $produtos = $_POST['ckProdutos'] ? isset($_POST['ckProdutos']) : 0;
    $usuario = $_POST['ckUsuario'] ? isset($_POST['ckUsuario']) : 0;


    $sql = "INSERT INTO tbl_NivelDeUsuario(nivel, conteudo, faleConosco, produtos, usuario)
      VALUES ('$nivel','$conteudo','$faleConosco','$produtos','$usuario');";

    if(mysqli_query($conn, $sql)){
      echo("<script>alert('Nivel cadastrado com sucesso!');</script>");
      header('location:admNivel.php');
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
            <table>
              <tr>
                <td>Nivel : <input type="text" name="txtNivel" placeholder="Insira o nivel a ser cadastrado"></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ckConteudo" value="1">Conteúdo</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ckFaleConosco" value="1">Fale Conosco</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ckProdutos" value="1">Produtos</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ckUsuario" value="1">Usuários</td>
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
