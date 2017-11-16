<?php
	$id = $_POST['id'];

	session_start();

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

	if(isset($_POST['btnEditar'])){

		$tituloPromocao = $_POST['txtTituloPromo'];
		$desconto = $_POST['txtPromo'];
		$promoCode = $_POST['txtPromoCode'];
		$descricao = $_POST['txtDescricao'];
		$codProduto = $_POST['selectProduto'];
    $cod = $_SESSION['codPromo'];
		if(isset($_POST['ckAtivo'])){
      $ativo = $_POST['ckAtivar'];
    }else{
      $ativo = 0;
    }

    if(isset($_POST['ckPromoMes'])){

      $sucoMes = $_POST['ckPromoMes'];

      $sql = "UPDATE tbl_promocao
  						SET promoMes = 0;";

      mysqli_query($conexao, $sql);

    }else{
      $sucoMes = 0;
    }

		$sql = "UPDATE tbl_promocao
						SET codProduto = '$codProduto',
						tituloPromocao = '$tituloPromocao',
						desconto = '$desconto',
						ativo = '$ativo',
						promoCode = '$promoCode',
					  descricao= '$descricao',
						promoMes = '$sucoMes'
						WHERE codigo = '$cod';";

		// echo($sql);

		if (mysqli_query($conexao, $sql)){
			?><script> alert('Usuário alterado com sucesso!'); </script>"<?php
				header("location:listaPromo.php");
		} else {
			echo("<script> alert('Não foi possível alterar a Promoção..'); </script>");
		}

	}
?>
<html>
	<head>
		<title></title>
		<script>
    	$(document).ready(function() {

    		$(".fechar").click(function() {
    			//$(".modalContainer").fadeOut();
    		$(".modalContainer").slideToggle(1000);
    		});
    	});
		</script>
	</head>
	<body>
    <form class="frmEditarPromocao" action="modalPromo.php" method="post">
  		<div>
  			<a href="#" class="fechar">Fechar(x)</a>
  		</div>
  		<div id="editarUsuairo">
				<?php
  				$sql = "SELECT * FROM tbl_promocao WHERE codigo=".$id;
  				echo($sql);
  				$select = mysqli_query($conexao, $sql);

  				$rs = mysqli_fetch_array($select);

          $_SESSION['codPromo'] = $rs['codigo'];

          $cod = $rs['codigo'];

          $at = "";
          $atSucoMes = "";

          if($rs['ativo']){
            $at = "checked";
          }

          if($rs['promoMes']){
            $atSucoMes = "checked";
          }


  			?>
				<table width="500" height="auto" border="solid 1" style="margin-left:50px">
					<tr>
						<td>Código:  <?php echo($id); ?><br></td>
					</tr>
					<tr>
						<td>Título da Promoção: <input type="text" name="txtTituloPromo" maxlength="50" required value="<?php echo($rs['tituloPromocao']); ?>">
            </td>
					</tr>
					<tr>
						<td>Desconto: <input type="text" name="txtPromo" placeholder="Insira o desconto que será aplicado na promoção" title="Insira apenas números" value="<?php echo($rs['desconto']); ?>" required>
            </td>
					</tr>
					<tr>
						<td>Descrição: <textarea name="txtDescricao" rows="4" cols="80" required maxlength="110"><?php echo($rs['descricao']); ?></textarea></td>
					</tr>
					<tr>
						<td>Código Promocional: <input type="text" name="txtPromoCode" placeholder="Insira caso seja nessecário" value="<?php echo($rs['promoCode']); ?>">
					</tr>
					<tr>
            <td>
              Produto:
              <select class="produto" name="selectProduto" required>
                <?php
                  $newSql = "SELECT * from tbl_produto;";
                  $select = mysqli_query($conexao, $newSql);
                  while($newRs = mysqli_fetch_array($select)){
                ?>
                <option value="<?php echo($newRs['codigo']); ?>"><?php echo($newRs['nome']); ?></option>
                <?php
                  }  ?>
              </select>
            </td>
					</tr>
					<tr>
						<td>Promo Suco do Mês: <input type="checkbox" name="cbxAtivar" value="1" <?php echo($atSucoMes); ?>></td>
					</tr>
					<tr>
						<td>Ativar Promoção: <input type="checkbox" name="ckPromoMes" value="1" <?php echo($at); ?>></td>
					</tr>
					<tr>
						<td><input type="submit" name="btnEditar" value="Editar"></td>
					</tr>
				</table>

  		</div>
    </form>
	</body>
</html>
