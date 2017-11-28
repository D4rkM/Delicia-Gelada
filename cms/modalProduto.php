<?php
	$id = $_POST['id'];

	session_start();

	require_once("include/conexao.php");
	$conn = conexao();

	required_once("include/salvarImagem.php");

	if(isset($_POST['btnEditar'])){

		$nome = $_POST['txtProduto'];
		$preco = $_POST['txtPreco'];
		$subCategoria = $_POST['selectSubCategoria'];
		$descricao = $_POST['txtDescricao'];

		$ativado = $_POST['ckAtivar'];
		$ativado = $ativado == "" ? 0 : $ativado;

    $nome_arq = basename($_FILES['fotoImp']['name']);
    if($nome_arq == ""){

              $sql = "UPDATE tbl_produto
              SET nome = '$nome',
              preco = '$preco',
              descricao = '$descricao',
              codSubCategoria = '$subCategoria',
              ativo = '$ativo'
              WHERE codigo = ".$_SESSION['codProd'];

			// echo($sql);

			if (mysqli_query($conn, $sql)){
				?><script> alert('Usuário alterado com sucesso!'); </script>"<?php
					header("location:listaProdutos.php");
			} else {
				echo("<script> alert('Não foi possível alterar a página..'); </script>");
			}
		}else{
			$foto = salvarImagem($nome_arq);

			$sql = "UPDATE tbl_produto
			SET nome = '$nome',
			preco = '$preco',
			descricao = '$descricao',
			codSubCategoria = '$subCategoria',
			foto = '$foto',
			ativo = '$ativo'
			WHERE codigo = ".$_SESSION['codProd'];

			// echo($sql);

			if (mysqli_query($conn, $sql)){
				?><script> alert('Produto alterado com sucesso!'); </script>"<?php
				header("location:listaProdutos.php");
			} else {
				echo("<script> alert('Não foi possível alterar o produto..'); </script>");
			}
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
    <form class="frmEditarProduto" action="modalProduto.php" enctype="multipart/form-data" method="post">
  		<div>
  			<a href="#" class="fechar">Fechar(x)</a>
  		</div>
  		<div id="editarUsuairo">
				<?php
  				$sql = "SELECT * FROM tbl_produto WHERE codigo=".$id;
  				// echo($sql);
  				$select = mysqli_query($conn, $sql);

  				$rs = mysqli_fetch_array($select);

          $_SESSION['codProd'] = $rs['codigo'];

          $at = "";

          if($rs['ativo']){
            $at = "checked";
          }

  			?>
				<table width="500" height="auto" border="solid 1" style="margin-left:50px">
					<tr>
						<td>Código:  <?php echo($id); ?><br></td>
					</tr>
          <tr>
            <td>Nome : <input type="text" name="txtProduto" placeholder="Insira o nome do Produto." value="<?php echo($rs['nome']); ?>"></td>
          </tr>
          <tr>
            <td>Descrição: <textarea name="txtDescricao" placeholder="Insira a descrição do produto" rows="1" cols="30" maxlength="110"><?php echo($rs['descricao']);?></textarea></td>
          </tr>
          <tr>
            <td>Preço: <input type="text" name="txtPreco" placeholder="Insira o preço original do produto" title="Insira apenas números" value="<?php echo($rs['preco']); ?>"></td>
          </tr>
          <tr>
            <td>Sub-Categoria:
            <select class="subCategoria" name="selectSubCategoria">
              <?php
                $sql ="SELECT * FROM tbl_categoria WHERE ativo = 1;";

                $select = mysqli_query($conn, $sql);

                while($rs = mysqli_fetch_array($select)){
               ?>
              <optgroup label="<?php echo($rs['categoria']); ?>">
                <?php
                  $newSql = "SELECT * FROM tbl_subCategoria WHERE ativo = 1 AND codCategoria =".$rs['codigo'];

                  $subSelect = mysqli_query($conn, $newSql);

                  while($newRs = mysqli_fetch_array($subSelect)){
                ?>
                <option value="<?php echo($newRs['codigo']); ?>"><?php echo($newRs['nome']); ?></option>
                <?php
                    }  ?>
              </optgroup>
            <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td>Foto: <input type="file" name="fotoImp"></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="ckAtivar" value="1" <?php echo($at); ?>>Ativo <br></td>
          </tr>
					<tr>
						<td><input type="submit" name="btnEditar" value="Editar"></td>
					</tr>
				</table>

  		</div>
    </form>
	</body>
</html>
