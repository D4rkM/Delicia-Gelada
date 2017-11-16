<?php
	$id = $_POST['id'];

	session_start();

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

	if(isset($_POST['btnEditar'])){

		$nome = $_POST['txtProduto'];
		$preco = $_POST['txtPreco'];
		$subCategoria = $_POST['selectSubCategoria'];
		$descricao = $_POST['txtDescricao'];

    if(isset($_POST['ckAtivo'])){
      $ativo = $_POST['ckAtivo'];
    }else{
      $ativo = 0;
    }

    $upload_dir = "img/produto/";
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

			if (mysqli_query($conexao, $sql)){
				?><script> alert('Usuário alterado com sucesso!'); </script>"<?php
					header("location:listaProdutos.php");
			} else {
				echo("<script> alert('Não foi possível alterar a página..'); </script>");
			}
		}
    //Verificando se a extensão é permitida
    if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.jpeg')){
      $extensao = substr($nome_arq, strpos($nome_arq,"."), 5);
      $prefixo = substr($nome_arq, 0, strpos($nome_arq,"."));
      $nome_arq = md5($prefixo).$extensao;

      //Guardamos o caminho e o nome da imagem que será inserida no BD.
      $upload_file = $upload_dir . $nome_arq;

      if (move_uploaded_file($_FILES['fotoImp']['tmp_name'], $upload_file)){

        $sql = "UPDATE tbl_produto
        SET nome = '$nome',
        preco = '$preco',
        descricao = '$descricao',
        codSubCategoria = '$subCategoria',
        foto = '$upload_file',
        ativo = '$ativo'
        WHERE codigo = ".$_SESSION['codProd'];

        // echo($sql);

        if (mysqli_query($conexao, $sql)){
    			?><script> alert('Produto alterado com sucesso!'); </script>"<?php
    			header("location:listaProdutos.php");
    		} else {
    			echo("<script> alert('Não foi possível alterar o produto..'); </script>");
    		}

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
  				$select = mysqli_query($conexao, $sql);

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

                $select = mysqli_query($conexao, $sql);

                while($rs = mysqli_fetch_array($select)){
               ?>
              <optgroup label="<?php echo($rs['categoria']); ?>">
                <?php
                  $newSql = "SELECT * FROM tbl_subCategoria WHERE ativo = 1 AND codCategoria =".$rs['codigo'];

                  $subSelect = mysqli_query($conexao, $newSql);

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
            <td><input type="checkbox" name="ckAtivo" value="1" <?php echo($at); ?>>Ativo <br></td>
          </tr>
					<tr>
						<td><input type="submit" name="btnEditar" value="Editar"></td>
					</tr>
				</table>

  		</div>
    </form>
	</body>
</html>
