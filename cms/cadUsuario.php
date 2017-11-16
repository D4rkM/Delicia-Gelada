<!DOCTYPE html>

<?php

  $conexao = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');

  if(isset($_POST['btnSalvar'])){

    $nome = $_POST['txtNome'];
    $usuario = $_POST['txtUsuario'];
    $senha = $_POST['txtSenha'];
    $confSenha = $_POST['txtConfSenha'];
    $codNivel = $_POST['selectNivel'];
    $ativado = 1;

    if ($senha != $confSenha){
      echo("<script>alert('A senha não está correta..');</script>");
    }else{

      $sql = "INSERT INTO tbl_Usuario(nome, user, senha, codNivel, ativo, foto)
        VALUES ('$nome','$usuario',md5('$senha'),'$codNivel','$ativado', '');";

      if(mysqli_query($conexao, $sql)){

        echo("<script>alert('Usuário cadastrado com sucesso!');</script>");
      }else{
        // echo($sql);
        echo("<script>alert('Erro ao cadastrar usuário!');</script>");
      }

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
        <a href="admUsuario.php">
          <img src="#" alt="retornar">
        </a>
      </div>
      <form class="frmAddUsuario" action="cadUsuario.php" method="post">
        <div class="conteudo">
          <div id="editarUsuairo">
            Nome : <input type="text" name="txtNome" placeholder="Insira o nome do Usuário"><br>
            Usuario: <input type="text" name="txtUsuario" placeholder="Insira o Usuário para acesso da conta"> <br>
            Senha: <input type="password" name="txtSenha" placeholder="Insira a senha de usuário"><br>
            Confirme a senha: <input type="password" name="txtConfSenha" placeholder="Insira a senha novamente"><br>
            <input type="checkbox" name="ckAtivo" value=""/>Usuario Ativado<br>
            Nível:
            <select class="nivel" name="selectNivel">
              <?php
                $newSql = "SELECT * from tbl_NivelDeUsuario;";
                $select = mysqli_query($conexao, $newSql);
                while($newRs = mysqli_fetch_array($select)){
              ?>
              <option value="<?php echo($newRs['codNivel']); ?>"><?php echo($newRs['nivel']); ?></option>
              <?php
                }  ?>
            </select> <br>
            <input type="submit" name="btnSalvar" value="Salvar">
          </div>
        </div>
      </form>
      <?php include('include/rodape.php'); ?>
    </div>
  </body>
</html>
