<?php
//habilita o uso de variaveis de sessão
// session_start();
$nome="";
$telefone="";
$celular="";
$email="";
$obs="";
$botao="Inserir";
//Conexão com Banco de Dados MySQL

	//Estabelece a conexão com a base de dados Mysql
	$conexao=mysql_connect("localhost","root","bcd127");

	//Especifica qual database será utilizado
	mysql_select_db("dbcontatos");

//***********************************************
//programação para editar / excluir

//verificar se existe a variavel modo na urldecode
//essa variavel foi passada via GET no link
//criado na palavra excluir
if (isset($_GET["modo"]))
{
	$modo=$_GET["modo"];
	//verificar se o conteudo da variavel modo
	//é igual a excluir ou editar
	if ($modo=="excluir")
	{
		$cod = $_GET["codigo"];
		$sql="delete from tblcontatos where codigo=".$cod;
		mysql_query($sql);

		//Caso a variavel modo não seja = excluir
		//vericamos se = editar
	}elseif($modo=="editar")
	{
		//Resgatamos a chave primaria "codigo"
		//que foi passada no link do editar
		//e montamos o Select para pesquisa
		$_SESSION["cod"]=$_GET["codigo"];
		$sql="select * from tblcontatos where codigo=".$_SESSION["cod"];

		//Executamos no Banco o Select each
		//guardamos na variavel local $select
		$select=mysql_query($sql);

		//Converte em Array o resultado do banco
		//e guarda na variavel rsconsulta
		$rsconsulta=mysql_fetch_array($select);

		//Resgatamos o resultado do banco
		//e guardamos em variavel locais
		$nome=$rsconsulta["nome"];
		$telefone=$rsconsulta["telefone"];
		$celular=$rsconsulta["celular"];
		$email=$rsconsulta["email"];
		$obs=$rsconsulta["obs"];
		$botao="Editar";
	}

}else
{
		//programação para inserir no banco
		if (isset($_GET["btnsalvar"]))
		{
			//variaveis que vieram via
			//GET no botao Salvar
			$nome=$_GET["txtnome"];
			$telefone=$_GET["txttelefone"];
			$celular=$_GET["txtcelular"];
			$email=$_GET["txtemail"];
			$obs=$_GET["txtobs"];
			$operacao=$_GET["btnsalvar"];

				if($operacao=="Inserir")
				{
					$sql="insert into tblcontatos (nome,telefone,celular,email,obs)values('".$nome."','".$telefone."','".$celular."','".$email."','".$obs."')";
				}elseif($operacao=="Editar")
				{
					$sql="update tblcontatos set nome='".$nome."',telefone='".$telefone."',celular='".$celular."',email='".$email."',obs='".$obs."' where codigo=".$_SESSION["cod"];

				}
					mysql_query($sql);

					//Permite redirecionar para uma nova
					//pagina

					$to = "marcel.nt@gmail.com";
					$subject = "teste do email";
					$message = "teste teste";
					$headers = "";

					if (mail($to,$subject,$message))

					{
						echo "Email enviado com sucesso";
					}else{
						echo "Email não enviado";
					}

					//header("location:contatos.php");

			}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery.js"></script>
<title>Untitled Document</title>
<script>
$(document).ready(function() {

  $(".ver").click(function() {
    $(".modalContainer").slideToggle(2000);
	//slideToggle
	//toggle
	//FadeIn
  });
});



	function Modal(idIten){
		$.ajax({
			type: "POST",
			url: "modal.php",
			data: {id:idIten},
			success: function(dados){
				$('.modal').html(dados);
			}
		});
	}
</script>

</head>

<body>

<div class="modalContainer">
	<div class="modal">

	</div>
</div>


<div id="principal">



     <div id="conteudo">
    	<div id="cadastro">

            <form name="frmcontatos" method="get" action="contatos.php">

                <table id="tblcadastro">
                  <tr>
                    <td colspan="2">Cadastro de Contatos</td>
                  </tr>
                  <tr>
                    <td>Nome:</td>
                    <td><input class="caixa" name="txtnome" type="text"   value="<?php echo($nome) ?>" required /></td>
                  </tr>
                  <tr>
                    <td>Telefone:</td>
                    <td><input class="caixa" name="txttelefone" type="text"  value="<?php echo($telefone) ?>" /></td>
                  </tr>
                  <tr>
                    <td>Celular:</td>
                    <td><input class="caixa" name="txtcelular" type="text" value="<?php echo($celular) ?>" /></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td><input class="caixa" name="txtemail" type="text" value="<?php echo($email) ?>" required /></td>
                  </tr>
                  <tr>
                    <td>Obs:</td>
                    <td><textarea name="txtobs" cols="20" rows="5"><?php echo($obs) ?></textarea></td>
                  </tr>
                  <tr>
                    <td><input name="btnsalvar" type="submit" value="<?php echo($botao) ?>" /></td>
                    <td><input name="btnlimpar" type="reset" value="Limpar" /></td>
                  </tr>
                </table>

            </form>

        </div>
        <div id="consulta">
        	<table id="tblconsulta">
              <tr>
                <td colspan="5">Consulta de Contatos</td>
              </tr>
              <tr>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Celular</td>
                <td>Email</td>
                <td>Opções</td>
              </tr>
			  <?php
				$sql="select * from tblcontatos order by codigo desc";

				//Executa o select no banco e grava
				//na variavel $select o resultado da busca
				$select=mysql_query($sql);

				//Estrutura de repetição, onde acontece
				//a conversão do resultado obtido pelo
				//BD que foi armazenado na variavel
				//$select para um ARRAY, ou seja uma
				//matriz
				$cont=0;
				while($rs=mysql_fetch_array($select))
				{
					if($cont%2==0)
					{
						$cor="#666666";
					}
					else
					{
						$cor="#FFFFFF";
					}
			  ?>
					  <tr bgcolor="<?php echo($cor) ?>">
						<td><?php echo($rs["nome"]) ?></td>
						<td><?php echo($rs["telefone"]) ?></td>
						<td><?php echo($rs["celular"]) ?></td>
						<td><?php echo($rs["email"]) ?></td>
						<td><a href="contatos.php?modo=editar&codigo=<?php echo($rs["codigo"]) ?>">Editar</a> | <a href="contatos.php?modo=excluir&codigo=<?php echo($rs["codigo"]) ?>">Excluir</a>
							<a class="ver" href="#" onclick="Modal(<?php echo($rs["codigo"]) ?>)">Ver Mais</a></td>
					  </tr>
			  <?php
					$cont=$cont+1;
				}
			  ?>


            </table>

        </div>

    </div>



</div>

</body>
</html>
