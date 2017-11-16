<?php
	$id = $_POST['id'];

	session_start();

  $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'db_delicia_gelada');

	if(isset($_POST['btnEditar'])){

		$titulo = $_POST['txt_titulo'];
		$texto1 = $_POST['txt1'];
		$texto2 = $_POST['txt2'];
		$texto3 = $_POST['txt3'];
		$texto4 = $_POST['txt4'];
		$subtexto = $_POST['txt5'];
		$subtitulo = $_POST['txtSubtitulo'];
		$cod = $_SESSION['codImp'];
		if(isset($_POST['ckPromoMes'])){

      $ativo = $_POST['ckAtivar'];

      $sql = "UPDATE tbl_importanciaSuco
  						SET ativo = 0;";

      mysqli_query($conexao, $sql);

    }else{
      $ativo = 0;
    }

		$upload_dir = "img/produto/";
    $nome_arq = basename($_FILES['fotoImp']['name']);
		if($nome_arq == ""){
			$sql = "UPDATE tbl_importanciaSuco
							SET texto1 = '$texto1',
							texto2 = '$texto2',
							texto3 = '$texto3',
							texto4 = '$texto4',
							subtexto = '$subtexto',
							titulo = '$titulo',
							subtitulo = '$subtitulo',
							ativo = '$ativo'
							WHERE codigo = '$cod';";

			// echo($sql);

			if(mysqli_query($conexao, $sql)){
				echo("<script>alert('Pagina editada com Sucesso');</script>");
				header("location:listaImportancia.php");
			}else{
				// echo($sql);
				echo("<script>alert('Erro ao editar a página!');</script>");

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

				$sql = "UPDATE tbl_importanciaSuco
								SET texto1 = '$texto1',
								texto2 = '$texto2',
								texto3 = '$texto3',
								texto4 = '$texto4',
								subtexto = '$subtexto',
								titulo = '$titulo',
								subtitulo = '$subtitulo',
								imagem = '$upload_file',
								ativo = '$ativo'
								WHERE codigo = '$cod';";

				// echo($sql);

        if(mysqli_query($conexao, $sql)){
          echo("<script>alert('Pagina editada com Sucesso');</script>");
					header("location:listaImportancia.php");
        }else{
          // echo($sql);
          echo("<script>alert('Erro ao editar a página!');</script>");

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
    <form class="frmEditarImportancia" action="modalImportancia.php" enctype="multipart/form-data" method="post">
  		<div>
  			<a href="#" class="fechar">Fechar(x)</a>
  		</div>
  		<div id="editarUsuairo">
				<?php
  				$sql = "SELECT * FROM tbl_importanciaSuco WHERE codigo =".$id;
					// echo($sql);
  				$select = mysqli_query($conexao, $sql);

  				$rs = mysqli_fetch_array($select);

					$at = "";

					if($rs['ativo']){
						$at = "checked";
					}

					$_SESSION['codImp'] = $rs['codigo'];
  			?>
				<table width="500" height="auto" border="solid 1" style="margin-left:50px">
					<tr>
						<td>Código:  <?php echo($id); ?><br></td>
					</tr>
					<tr>
						<td>Título: <input type="text" name="txt_titulo" maxlength="50" required value="<?php echo($rs['titulo']); ?>"></td>
					</tr>
					<tr>
						<td>Texto1: <textarea name="txt1" rows="4" cols="80" required maxlength="950"><?php echo($rs['texto1']); ?></textarea></td>
					</tr>
					<tr>
						<td>Texto2: <textarea name="txt2" rows="4" cols="80" required maxlength="950"><?php echo($rs['texto2']); ?></textarea></td>
					</tr>
					<tr>
						<td>Texto3: <textarea name="txt3" rows="4" cols="80" required maxlength="950"><?php echo($rs['texto3']); ?></textarea></td>
					</tr>
					<tr>
						<td>Texto4: <textarea name="txt4" rows="4" cols="80" required maxlength="950"><?php echo($rs['texto4']); ?></textarea></td>
					</tr>
					<tr>
						<td>Subtitulo: <input type="text" name="txtSubtitulo" maxlength="50" required value="<?php echo($rs['subtitulo']); ?>"></td>
					</tr>
					<tr>
						<td>SubTexto: <textarea name="txt5" rows="4" cols="80" required maxlength="750"><?php echo($rs['subtexto']); ?></textarea></td>
					</tr>
					<tr>
						<td>Foto: <input type="file" name="fotoImp">
						<div>
							<img src="<?php echo($rs['imagem']); ?>" alt="Imagem da página" width="50" height="30"/>
						</div>
						</td>
					</tr>
					<tr>
						<td>Ativar Página: <input type="checkbox" name="ckAtivar" value="1" <?php echo($at); ?>></td>
					</tr>
					<tr>
						<td><input type="submit" name="btnEditar" value="Editar"></td>
					</tr>
				</table>

  		</div>
    </form>
	</body>
</html>
