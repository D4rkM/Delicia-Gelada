<!DOCTYPE html>

<?php

  $titulo = null;
  $subtitulo = null;
  $txt1 = null;
  $txt2 = null;
  $txt3 = null;
  $txt4 = null;
  $txt5 = null;
  $nome_arq = null;


  $conn = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

  if(isset($_POST['btnSalvar'])){

    $titulo = $_POST['txtTitulo'];
    $subtitulo = $_POST['txtSubtitulo'];
    $txt1 = $_POST['txt1'];
    $txt2 = $_POST['txt2'];
    $txt3 = $_POST['txt3'];
    $txt4 = $_POST['txt4'];
    $txt5 = $_POST['txt5'];
    $upload_dir = "../img/blog/";
    $ativo = 1;

    // Pegando nome e extensão da imagem
    $nome_arq = basename($_FILES['fotoImp']['name']);

    //Verificando se a extensão é permitida
    if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif')){
      $extensao = substr($nome_arq, strpos($nome_arq,"."), 5);
      $prefixo = substr($nome_arq, 0, strpos($nome_arq,"."));
      $nome_arq = md5($prefixo).$extensao;

      //Guardamos o caminho e o nome da imagem que será inserida no BD.
      $upload_file = $upload_dir . $nome_arq;

      if (move_uploaded_file($_FILES['fotoImp']['tmp_name'], $upload_file)){
        //Atualizando Outros campos para alterar dados da página
        $sql = "UPDATE tbl_importanciaSuco
                SET ativo = 0;";
        mysqli_query($conn, $sql);

        $sql="INSERT INTO tbl_importanciaSuco
        (texto1, texto2, texto3, texto4, subtexto, titulo, subtitulo, imagem, ativo)
        VALUES('$txt1','$txt2','$txt3','$txt4','$txt5','$titulo','$subtitulo','$upload_file','$ativo');";

        if(mysqli_query($conn, $sql)){
          header('location:importanciaSuco.php');

          echo("Arquivo movido com sucesso");
        }else{
          echo("Erro ao tentar enviar dados para o banco\n" .$sql);
        }

      }else{
          echo("O arquivo não pode ser movido para o servidor");
      }

    }else{
        echo('Extensão Inválida!!!!');
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
        <a href="listaImportancia.php">
          <img src="#" alt="Retornar">
        </a>
      </div>
      <form class="frmAtualizarSite" action="importanciaSuco.php" enctype="multipart/form-data" method="post">
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
              Texto3: <textarea name="txt3" rows="4" cols="80" required maxlength="950"></textarea>
            </div>
            <div class="">
              Texto4: <textarea name="txt4" rows="4" cols="80" required maxlength="950"></textarea>
            </div>
            <div class="">
              Subtitulo: <input type="text" name="txtSubtitulo" maxlength="50" required>
            </div>
            <div class="">
              Subetexto: <textarea name="txt5" rows="4" cols="80" required maxlength="750"></textarea>
            </div>
            <div class="">
              Foto: <input type="file" name="fotoImp">
            </div>
            <div class="">
              Ativar Página: <input type="checkbox" name="cbxAtivar" value="1">
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
