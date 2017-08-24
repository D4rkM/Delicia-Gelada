<!DOCTYPE html>
<?php

 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delícia Gelada</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">
    <script type="text/javascript"
    src="javascript/jquery-3.2.1.min.js">
    </script>
  </head>
  <body>
    <!-- MENU SUPERIOR -->
    <div id="campo_menu_superior">

      <div id="menu_superior">

        <div id="campo_items_menu">
          <div id="logo">
            <h1>Logo</h1>
          </div>
          <nav>
            <div id="caixa_menu_superior">
              <ul>
                <li class="opcoes">
                  <a href="#">Home</a>
                </li>
                <li class="opcoes">
                  <a href="#">A moda do verão</a>
                </li>
                <li class="opcoes">
                  <a href="#">A importância do suco natural</a>
                </li>
                <li class="opcoes">
                  <a href="#">Promoções</a>
                </li>
                <li class="opcoes">
                  <a href="#">Nossos Ambientes</a>
                </li>
                <li class="opcoes">
                  <a href="#">Suco do mês</a>
                </li>
              </ul>
            </div>
          </nav>
          <form class="frmLogin" action="index.php" method="post">
            <div class="login">
              <div class="">
                Login:
              </div>
              <input type="text" name="txtLogin" value="" placeholder="       Insira seu login" required>
            </div>
            <div class="login">
              <div class="">
                Senha:
              </div>
              <input type="password" name="txtSenha" value="" placeholder="       Insira sua senha" required>
            </div>
            <div class="login">
              <input type="submit" name="btnEntrar" value="Entrar">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- SLIDER -->
    <header>
      <div id="redes_sociais">
        <div class="redes">
          <img src="" alt="">
          <a href="#">facebook</a>
        </div>
        <div class="redes">
          <img src="" alt="">
          <a href="#">instagram</a>
        </div>
        <div class="redes">
          <img src="" alt="">
          <a href="#">twitter</a>
        </div>
      </div>
    </header>
    <!-- CONTEUDO -->
    <section>
      <!-- MENU LATERAL -->
      <div id="menu_lateral">
        <nav>
          <h2>menulateral</h2>
        </nav>
      </div>
      <!-- PRODUTOS -->
      <div id="conteudo">
        <?php
          //$i = 0;
          //while ($i < 10) {
            # code...
          //  $i = $i + 1;
           ?>
           <div id="faixa_produto">
             <div class="produto">
               <ul>
                 <li>Nome: <?php  ?></li>
                 <li>Descrição: <?php  ?></li>
                 <li>Preço: <?php  ?></li>
               </ul>
             </div>

           </div>
        <?php
        //}
           ?>
      </div>
    </section>
    <footer>

    </footer>
  </body>
</html>
