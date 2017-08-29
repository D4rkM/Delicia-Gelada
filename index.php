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
    src="javascript/jquery.min.js">
    </script>
    <script type="text/javascript"
    src="javascript/jquery.cycle.all.js">
    </script>
  </head>
  <body>
    <!-- MENU SUPERIOR -->
    <div id="campo_vazio_menu_superior">
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
            <div id="autenticacao">
              <div class="login">
                <div class="">
                  Login:
                </div>
                <input type="text" name="txtLogin" value="" placeholder="         Insira seu login" required>
              </div>
              <div class="login">
                <div class="">
                  Senha:
                </div>
                <input type="password" name="txtSenha" value="" placeholder="         Insira sua senha" required>
              </div>
              <div class="login">
                <br>
                <input type="submit" name="btnEntrar" value="Entrar">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- SLIDER -->
    <header>
      <script type="text/javascript">
        $('#s1').cycle({
          fx:     'fade',
          speed:  2000,
          next:   '#next',
          prev:   '#previus',
          pager:  '#nav'
        });
      </script>
      <div class="previus">
        <a href="#" id="previus"><img src="" alt="anterior"></a>
      </div>

      <div class="slide" id="s1">
        <img src="img/slider/suco-1.jpg" alt="#"/>
        <img src="img/slider/suco-2.jpg" alt="#"/>
        <img src="img/slider/suco-3.jpg" alt="#"/>
        <img src="img/slider/suco-4.jpg" alt="#"/>
      </div>
      <div class="nav" id="nav"></div>
      <div class="next">
        <a href="#" id="next"><img src="" alt="próximo"></a>
      </div>
      <!-- REDES SOCIAIS -->
      <div id="redes_sociais">
        <div class="redes">
          <img src="#" alt="">
          <a href="#">facebook</a>
        </div>
        <div class="redes">
          <img src="#" alt="">
          <a href="#">instagram</a>
        </div>
        <div class="redes">
          <img src="#" alt="">
          <a href="#">twitter</a>
        </div>
      </div>
    </header>
    <!-- CONTEUDO -->
    <section>
      <!-- MENU LATERAL -->
      <div id="menu_lateral">
        <nav>
          <?php  ?>
          <div class="categorias">
            <h2>teste</h2>
            <?php  ?>
            <ul>
              <li><a href="#">teste<?php  ?></a></li>
            </ul>
          </div>
          <?php  ?>
        </nav>
      </div>
      <!-- PRODUTOS -->
      <div id="conteudo">
        <?php
          $i = 0;
          $a = 0;
          while ($i < 20) {
            # code...
            $i = $i + 1;
           ?>
           <div class="faixa_produto">
             <?php  while ($a <= 2) {
               # code...
               $a = $a + 1;
             ?>
             <div class="imgProduto">

             </div>
             <div class="produto">
               <ul>
                 <li>Nome: <?php  ?></li>
                 <li>Descrição: <?php  ?></li>
                 <li>Preço: <?php  ?></li>
               </ul>
               <div class="detalhes">
                 Detalhes
               </div>
             </div>
             <?php }
             $a = 0;?>
           </div>
        <?php
        }
           ?>
      </div>
    </section>
    <footer>

    </footer>
  </body>
</html>
