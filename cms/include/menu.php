<!-- MENU SUPERIOR DO CMS -->
<?php
  session_start();

  $conteudo = "#";
  $faleConosco = "#";
  $produtos = "#";
  $usuarios = "#";

    // echo($_SESSION['codUser']);
  if($_SESSION['codUser'] == 0){
    echo("<script>alert('Acesso inválido!')</script>");
    header('location:../index.php');
  }

  $conn = mysqli_connect('localhost','root','bcd127','db_delicia_gelada');
  $nomeUsuario = null;
  $codUser = $_SESSION['codUser'];
  $nivelUser = $_SESSION['nivelUser'];

  $acesso = "SELECT * FROM tbl_nivelDeUsuario WHERE codNivel =".$nivelUser;

  $execute = mysqli_query($conn, $acesso);

  $rsAtivar = mysqli_fetch_array($execute);

  if($rsAtivar['conteudo']){
    $conteudo = "main.php";
  }

  if ($rsAtivar['faleConosco']) {
    $faleConosco = "faleConosco.php";
  }

  if($rsAtivar['produtos']){
    $produtos = "mainProduto.php";
  }

  if($rsAtivar['usuario']){
    $usuario = "mainUsuario.php";
  }

  $sql = "SELECT nome FROM tbl_Usuario WHERE codUsuario =".$codUser;

  $select = mysqli_query($conn, $sql);

  if($rs = mysqli_fetch_array($select)){
    $nomeUsuario = $rs['nome'];
  }

  if(isset($_POST['btnSair'])){
    $_SESSION['codUser'] = 0;
    $_SESSION['nivelUser'] = 0;
    header('location:../index.php');
  }

?>
<nav>
  <div class="menu">
    <a href="<?php echo($conteudo);?>">
      <div class="">
        <img src="img/content.png" alt="Adm Conteudo">
      </div>
      <div class="">
        Adm. Conteúdo
      </div>

    </a>
  </div>
  <div class="menu">
    <a href="<?php echo($faleConosco);?>">
      <div class="">
        <img src="img/faleConosco.png" alt="Adm Fale conosco">
      </div>
    Adm. Fale Conosco
    </a>
  </div>
  <div class="menu">
    <a href="<?php echo($produtos);?>" >
      <div class="">
        <img src="img/admProd.png" alt="Adm Produtos">
      </div>
      Adm. Produtos
    </a>
  </div>
  <div class="menu">
    <a href="<?php echo($usuario);?>">
      <div class="">
        <img src="img/users.png" alt="Adm Usuario">
      </div>
    Adm. Usuários
    </a>
  </div>
  <div class="logout">
    <form class="frmSair" action="#" method="post">
      <p>Bem vindo, <b><?php echo($nomeUsuario); ?></b>.</p>
      <input type="submit" name="btnSair" value="Sair" onclick="return confirm('Deseja realmente sair?');">
    </form>
  </div>
</nav>
