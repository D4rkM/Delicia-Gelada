<?php
  session_start();
  // echo($_SESSION['codUser']);
  $login = null;
  $senha = null;
  // echo("<script>alert('$login')</script>");

  require_once("cms/include/conexao.php");
  $conn = conexao();

  if(isset($_POST['btnEntrar'])){

    $login = $_POST['txtLogin'];
    $senha = $_POST['txtSenha'];

    $log = "SELECT codUsuario, ativo, codNivel FROM tbl_usuario WHERE user = '$login' AND senha = md5('$senha');";


    //Evita SqlInjection
     addslashes($log);

    $select = mysqli_query($conn, $log);

    if($rs = mysqli_fetch_array($select)){
      // define('idUsuario', $rs['codUsuario']);
      if($rs['ativo']){
        header('location:cms/main.php');
        $_SESSION['codUser'] = $rs['codUsuario'];
        $_SESSION['nivelUser'] = $rs['codNivel'];
      }else{
        echo("<script> alert('Seu usuário está desativado... por favor entre em contato com a administração.');</script>");
      }

    }else{
      echo("<script> alert('Usuário ou senha inválidos.. Tente novamente.');</script>");
      echo("<script>alert('$log');</script>");
    }

  }
?>
<script>//Função para adicionar animação ao menu_superior (alterações de     opacidade)
  $(function(){
   //Função para utilizar a posição do scroll na animação
     $(window).scroll(function() {
       var top = $(window).scrollTop();//top pega a posição do scroll

       if(top > 150){ //verifica se a posição do srcoll é maior do que 150 para diminuir a opacidade
         // alert(top);
         $("#menu_superior").css("opacity","0.2");

       }else{ //se não mantem a opacidade
         $("#menu_superior").css("opacity","1");
       }
     });
     // Aplica um efeito para quando passar o mouse sobre o menu para que ele volte a opacidade para 1
     $('#menu_superior').hover(function(){
       $("#menu_superior").css("opacity","1");
     })
     // Efeito de retorno para quando retirar o mouse a opacidade diminuir novamente
     $('#menu_superior' && '#campo_items_menu' && '#logo' && '#autenticacao' && '.loginBtn' && '.login').mouseout(function(){
       var top = $(window).scrollTop();
       // alert(top);
       if (top > 150) {
         $("#menu_superior").css("opacity","0.2");
       }
     });
  });
</script>
<script>
  //Função para pesquisa no site
  //eventos
  $(document).ready(function(){
    $.("#pesquisar").submit(function(){

    });
  });

  function pesquisar(){
    $.ajax({
      type: "POST",
      url:"index.php",
      data: new FormData($('#form')[0])
      success: function(dados){
        $("index.php").html(dados);
      }
    });
  }
</script>
<div class="mobMenuShow">
  asdf
</div>
<div id="campo_vazio_menu_superior">
  <div id="menu_superior">
    <div id="campo_items_menu">
      <div id="menuMobile">
        <div id="btnMenu">
          <img src="img/menuMobile.png" alt="MenuMobile">
        </div>
         <!-- href="https://icons8.com.br/icon/3096/Cardápio">Créditos do ícone Cardápio -->
      </div>
      <div id="logo">
        <img src="img/orange.svg" alt="logo">
      </div>
      <!-- Menu Superior -->
      <nav>
        <div id="caixa_menu_superior">
          <ul id = "menu">
				    <li><a href="index.php">Home</a></li>
    				<li>
    					<a href="#">Blog</a>
    					<div class="divsubmenu">
    						<ul class="submenu">
    							<li> <a href="BlogSucoNatural.php">Importância do Suco</a> </li>
    							<li> <a href="BlogModa.php">A moda do Verão</a></li>
    						</ul>
    					</div>
    				</li>
    				<li><a href="#">Promoções</a>
              <div class="divsubmenu">
                <ul class="submenu">
                  <li> <a href="promocoes.php">Todas as Promoções</a> </li>
                  <li> <a href="promoSucoDoMes.php">Suco do mês</a> </li>
                </ul>
              </div>
            </li>
    				<li><a href="#">A empresa</a>
              <div class="divsubmenu">
                <ul class="submenu">
                  <li> <a href="ambientes.php">Nossos Ambientes</a> </li>
                  <li> <a href="contato.php">Fale Conosco</a></li>
                </ul>
              </div>
            </li>
			    </ul>
          <form id="form" class="pesquisar" action="index.php" method="get">
            <div class="pesquisaDiv">
              <div class="barraPesquisa">
                <br>

                <input type="text" name="txt_pesquisa" placeholder="Pesquise um produto ou categoria...">

              </div>
              <div class="iconPesquisar">
                <br>
                <input type="submit" name="btn_pesquisar" class="btn_pesquisar" value="">

                <!-- <a href="index.php?modo=pesquisar&pesquisa=<?php// echo($_GET['txt_pesquisa']);?>" id="pesquisar" onclick="pesquisar()"> -->

                  <!-- <img src="img/search.png" alt="Pesquisar" width="20px" height="20px"> -->
                <!-- </a> -->
              </div>
            </div>
          </form>
        </div>
      </nav>

      <form class="frmLogin" action="#" method="post">
        <div id="autenticacao">
          <div class="login">
            <div>
              Login:
            </div>
            <input type="text" name="txtLogin" value="" placeholder="         Insira seu login" required maxlength="50">
          </div>
          <div class="login">
            <div>
              Senha:
            </div>
            <input type="password" name="txtSenha" value="" placeholder="         Insira sua senha" required maxlength="14">
          </div>
          <div class="loginBtn">
            <br>
            <input type="submit" name="btnEntrar" value="Entrar">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
