<!DOCTYPE html>
<?php
//Declarando as variáveis em escopo
$nome = null;
$telefone = null;
$celular = null;
$email = null;
$homepage = null;
$facebook = null;
$sexo = null;
$profissao = null;
$desc_sugestao = null;
$desc_info = null;

//Conexão com o banco de dados

//Estabelecendo conexao

  require_once("cms/include/conexao.php");
  $conn = conexao();

//Checa conexao
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

//Ativando o Banco a ser utilizado

if(isset($_POST['btnEnviar'])){
  // Pegando variaveis
  $nome = $_POST['txtNome'];
  $telefone = $_POST['txtTelefone'];
  $celular = $_POST['txtCelular'];
  $email = $_POST['txtEmail'];
  $homepage = $_POST['txtHome'];
  $facebook = $_POST['txtFacebook'];
  $sexo = $_POST['rdoSexo'];
  $profissao = $_POST['txtProfissao'];
  $desc_sugestao = $_POST['txtSugestao'];
  $desc_info = $_POST['txtInfo'];

//Construindo script de inserção de dados no banco
  $sql = "insert into tbl_faleconosco(nome, telefone, celular, email, home_page, facebook, sexo, profissao, desc_sugestao, desc_informacao) values ('$nome','$telefone','$celular','$email','$homepage','$facebook', '$sexo','$profissao','$desc_sugestao','$desc_info');";

  //Evitando SqlInjection
  addslashes($sql);

//Executando Script no BD

  if(mysqli_query($conn, $sql)){

    echo('<script tipe="text/javascript"> alert("Dados enviados com Sucesso, em breve nossos analistas lhe responderão!! Obrigado!"); </script>');
    //fechando conexao com banco
    mysqli_close($conn);
    header('location:Contato.php');
  } else{
    echo ("<script>alert(Sinto muito tivemos um erro de conexão com nosso banco de dados... <br>" .$sql. "<br>" . mysqli_error($conn).');</script>');
  }
  // echo($sql);
}

 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delícia Gelada</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/contato.css">
    <script type="text/javascript"
    src="js/jquery.min.js">
    </script>
    <script type="text/javascript">
      /* Máscaras Para Telefone e Celular */
      function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)//Inicia a função execmascara
      }
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
      }
      function mascaraTelefone(v){    //Mascara para o telefone
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
          v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
          return v;
      }
      function mascaraCelular(v){   //Mascara para o celular
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
          v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
          return v;
      }
      function id( el ){ //Função para pegar os elementos da caixa
        return document.getElementById( el );
      }
      window.onload = function(){
        id('telefone').onkeypress = function(){
          mascara( this, mascaraTelefone);
        }
        id('celular').onkeypress = function(){
          mascara( this, mascaraCelular)
        }
      }

    </script>
  </head>
  <body>
    <!-- MENU SUPERIOR -->

    <?php include 'include/menu.php'; ?>

    <div class="main">
      <!-- REDES SOCIAIS -->
      <?php include "include/redesSociais.php" ?>

    <!-- FORMULARIO FALE CONOSCO -->
    <!-- Iniciando Formulario de Contato -->
      <form class="frmFaleConosco" action="contato.php" method="post">
        <div class="titulo">
          <h2>Fale Conosco</h2>
          <div class="botaoEnviar">
            <input type="submit" name="btnEnviar" value="Enviar">
          </div>
        </div>
        <div class="comentario">
          <p>Entre em contato conosco, ofereça criticas, elogios ou sugestões!!</p>
        </div>
        <div class="espacoFaleConosco">
          <div class="faixa">
            <div class="esquerda">
              <p>*Nome:</p>
            </div>
            <div class="direita">
              <input type="text" name="txtNome" placeholder="Digite seu nome" pattern="[a-z A-Z ã Ã õ Õ é É í Í ô Ô â Â ç]*" title="Insira apenas letras." size="40" maxlength="50" required>
            </div>
          </div>
          <div class="faixa">
            <div class="esquerda">
              <p>Telefone:</p>
            </div>
            <div class="direita">
              <input id="telefone" type="tel" name="txtTelefone" placeholder="Insira seu telefone" size="40" maxlength='14' >
            </div>
          </div>
          <div class="faixa">
            <div class="esquerda">
              <p>*Celular:</p>
            </div>
            <div class="direita">
              <input id="celular" type="cel" name="txtCelular" placeholder="Insira seu celular" size="40" maxlength="15" required>
            </div>
          </div>
          <div class="faixa">
            <div class="esquerda">
              <p>*Email:</p>
            </div>
            <div class="direita">
              <input type="email" name="txtEmail" placeholder="Insira seu email" size="40" maxlength="30" required>
            </div>
          </div>
          <div class="faixa">
            <div class="esquerda">
              <p>Home Page:</p>
            </div>
            <div class="direita">
              <input type="url" name="txtHome" placeholder="Insira o link da sua Home Page" size="40" maxlength="50">
            </div>
          </div>
          <div class="faixa">
            <div class="esquerda">
              <p>Link no Facebook:</p>
            </div>
            <div class="direita">
              <input type="url" name="txtFacebook" placeholder="Insira o Link da sua Página" size="40" maxlength="30">
            </div>
          </div>
          <div class="faixa">
            <div class="esquerda">
              <p>*Sexo:</p>
            </div>
            <div class="direita">
              <input type="radio" name="rdoSexo" value="F" required>Feminino
              <input type="radio" name="rdoSexo" value="M">Masculino
            </div>
          </div>
          <div class="faixa">
            <div class="esquerda">
              <p>*Profissão:</p>
            </div>
            <div class="direita">
              <input type="text" name="txtProfissao" placeholder="Insira sua profissão" size="40" maxlength="30" required>
            </div>
          </div>
        </div>

        <div class="espacoFaleConosco">
          <h3>Sugestão/Criticas</h3>
          <div class="CaixasDeTexto">
            <textarea name="txtSugestao" rows="10" cols="65" placeholder="Ex: 'Podem adicionar mais opções do suco tal.'" maxlength="2800"></textarea>
          </div>
          <h3>Informações de Produtos</h3>
          <div class="CaixasDeTexto">
            <textarea name="txtInfo" rows="10" cols="65" placeholder= "Ex: Quantas calorias tem o suco de laranja?"  maxlength="2800"></textarea>
          </div>
        </div>
      </form>
   </div>
   <?php include "include/rodape.php"; ?>
  </body>
</html>
