<?php
  session_start();
  // echo($_SESSION['codUser']);
  $login = null;
  $senha = null;
  // echo("<script>alert('$login')</script>");

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

  if(isset($_POST['btnEntrar'])){

    $login = $_POST['txtLogin'];
    $senha = $_POST['txtSenha'];

    $sql = "SELECT codUsuario, ativo, codNivel FROM tbl_Usuario WHERE user = '$login' AND senha = md5('$senha');";


    //Evita SqlInjection
    // addslashes($sql);

    $select = mysqli_query($conexao, $sql);

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
      echo("<script>alert('$sql');</script>");
    }

  }
?>
<script>//Função para adicionar animação ao menu_superior (alterações de opacidade)
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
<div id="campo_vazio_menu_superior">
  <div id="menu_superior">
    <div id="campo_items_menu">
      <div id="logo">
        <img src="img/orange.svg" alt="logo">
      </div>
      <!-- Menu Superior -->
      <nav>
        <div id="caixa_menu_superior">
          <ul id = "menu">
				<li><a href="index.php">Home</a></li>
				<li>
					<a href="blog.php">Blog</a>
					<div class="divsubmenu">
						<ul class="submenu">
							<li> <a href="BlogSucoNatural.php">Importância do Suco</a> </li>
							<li> <a href="BlogModa.php">A moda do Verão</a></li>
						</ul>
					</div>
				</li>
				<li><a href="promocoes.php">Promoções</a>
          <div class="divsubmenu">
            <ul class="submenu">
              <li> <a href="promoSucoDoMes.php">Especial do dia</a> </li>
              <li> <a href="promoSucoDoMes.php">Suco do mês</a> </li>
            </ul>
          </div></li>
				<li><a href="#">A empresa</a>
          <div class="divsubmenu">
            <ul class="submenu">
              <li> <a href="ambientes.php">Nossos Ambientes</a> </li>
              <li> <a href="contato.php">Fale Conosco</a></li>
            </ul>
          </div>
        </li>

			</ul>
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
