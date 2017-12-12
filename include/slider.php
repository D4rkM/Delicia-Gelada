<?php
require_once("cms/include/conexao.php");
$conn = conexao();

  $sliderSql = "SELECT * FROM tbl_slider WHERE ativo =1;";

  $select = mysqli_query($conn, $sliderSql);

  if($rs = mysqli_fetch_array($select)){
    $setaEsc = $rs['setaEsc'];
    $setaDir = $rs['setaDir'];
    $img1 = $rs['img1'];
    $img2 = $rs['img2'];
    $img3 = $rs['img3'];
    $img4 = $rs['img4'];
    $img5 = $rs['img5'];
    $img6 = $rs['img6'];
    $ativo = $rs['ativo'];

    $setaEsc = substr($setaEsc, strpos($SetaEsc,'i'), 80); }
    // echo($setaEsc);
?>

<!-- SLIDER -->
<!-- Configurações do slider (efeitos, setas) -->
<script>
    $(function(){
      $("#botao_img_slide ul").cycle ({
        fx:'fade',
        speed: 2000 ,
        timeout: 1000 ,
        prev:'#anterior',
        next:'#proxima',
      })
    })
</script>
<!-- Slider no html -->
<div id="slide">
    <div id="botao_img_slide">
      <a href="#" id="anterior" >
        <div id="Ant"><img src="<?php echo("img/slider/setas/setaEsc.png");?>" alt="Anterior"/> </div>
      </a>
      <a href="#" id="proxima">
        <div id="Prox"><img src="img/slider/setas/setaDir.png" alt="Próximo"/> </div>
      </a>
      <ul>
        <li><a href="#"><img class="imgSlider" alt="Anuncio1" src="img/slider/suco-1.jpg" /></a></li>
        <li><a href="#"><img class="imgSlider" alt="Anuncio2" src="img/slider/suco-2.jpg" /></a></li>
        <li><a href="#"><img class="imgSlider" alt="Anuncio3" src="img/slider/suco-3.jpg" /></a></li>
        <li><a href="#"><img class="imgSlider" alt="Anuncio4" src="img/slider/suco-4.jpg" /></a></li>
      </ul>
    </div>
</div>
