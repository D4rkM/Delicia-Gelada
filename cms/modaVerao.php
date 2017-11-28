<!DOCTYPE html>

<?php

  $titulo = null;
  $texto1 = null;
  $texto2 = null;

  require_once("include/conexao.php");
  $conn = conexao();

  require_once("incluce/salvarImagem.php");

  if(isset($_POST['btnSalvar'])){

    $titulo = $_POST['txtTitulo'];
    $texto1 = $_POST['txt1'];
    $texto2 = $_POST['txt2'];

    $ativado = $_POST['ckAtivar'];
		$ativado = $ativado == "" ? 0 : $ativado;
    // Pegando nome e extensão da imagem
    $nome_arq = basename($_FILES['fotoImp']['name']);

    $imagem = salvarImagem($nome_arq);

    //Atualizando Outros campos para alterar dados da página
    $sql = "UPDATE tbl_modaVerao
            SET ativo = 0;";
    mysqli_query($conn, $sql);

    $sql="INSERT INTO tbl_modaVerao(titulo, imagem, texto1, texto2, ativo)
          VALUES ('$titulo', '$imagem', '$texto1', '$texto1', '$ativo');";

    if(mysqli_query($conn, $sql)){
      header('location:modaVerao.php');

      echo("Arquivo movido com sucesso");
    }else{
      echo("Erro ao tentar enviar dados para o banco\n" .$sql);
    }
  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/cms.css">
    <title>CMS - Importância do Suco Natural</title>
  </head>
  <body>
    <div class="main">
      <?php include('include/cabecalho.php'); ?>
      <?php include('include/menu.php'); ?>
      <div class="subMenu">
        <a href="listaModaVerao.php">
          <img src="#" alt="Retornar">
        </a>
      </div>
      <form class="frmAtualizarSite" action="modaVerao.php" enctype="multipart/form-data" method="post">
        <div class="conteudo">
          <div class="cadastrarItem">
            <div class="">
              Título: <input type="text" name="txtTitulo" maxlength="50" required>
            </div>
            <div class="">
              Texto1: <textarea name="txt1" rows="4" cols="80" required maxlength="950"></textarea>
            </div>
            <div class="">
              Texto2: <textarea name="txt2" rows="4" cols="80" required maxlength="950"></textarea>
            </div>

            <div class="">
              Foto: <input type="file" name="fotoImp">
            </div>
            <div class="">
              Ativar Página: <input type="checkbox" name="ckAtivar" value="1">
            </div>
            <div class="">
              <input type="submit" name="btnSalvar" value="Salvar">
            </div>
          </div>
        </div>
      </form>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
