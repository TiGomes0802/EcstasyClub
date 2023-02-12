<link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/detalhes_evento.css" media="screen">
<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-0c69">
  <br>
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-clearfix u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-gutter-40 u-layout-wrap u-layout-wrap-1">
      <div class="u-layout">
        <div class="u-layout-row">
          <div class="u-align-left u-container-style u-image u-layout-cell u-size-27" style="background-image: url('./../../backend/web/cartaz/<?= $evento->cartaz ?>');" data-image-width="716" data-image-height="621">
            <div class="u-container-layout u-valign-bottom u-container-layout-1"></div>
          </div>
          <div class="u-container-style u-layout-cell u-size-33 u-layout-cell-2">
            <div class="u-container-layout u-valign-bottom-xs u-container-layout-2">
              <h2 class="u-align-left u-custom-font u-font-montserrat u-text u-text-1" ><?=$evento->nome?></h2>
              <p class="u-align-justify u-custom-font u-font-montserrat u-text u-text-2"><?=$evento->descricao?></p>
              <p class="u-align-left u-custom-font u-font-montserrat u-text u-text-3">
                <span style="font-weight: 700;"><?=number_format( $evento->preco, 2 ) . '€'?></span>
              </p>
              <p class="u-align-left u-custom-font u-font-montserrat u-text u-text-4">
                <span style="font-weight: 700;"><?=date("d/m/Y", strtotime($evento->dataevento));?></span>
              </p>
              <?php if ($evento->numbilhetesdisp > 0 && $comprado == null) { ?>
                <a href="index.php?r=pulseiras%2Fcomprar&id_evento=<?=$evento->id?>&codigorp=" id="comprarpuls" class="u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-font-lato u-hover-custom-color-2 u-radius-20 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1" data-animation-duration="0" data-animation-delay="0" >Comprar<br>pulseira</a>
              <?php } else {  
                if ($comprado != null) { ?>
                  <a href="#" class="u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-font-lato u-hover-custom-color-2 u-radius-20 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1" data-animation-duration="0" data-animation-delay="0" >Pulseira<br>Adquirida</a>
                <?php } else { ?>
                  <a href="#" class="u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-font-lato u-hover-custom-color-2 u-radius-20 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1" data-animation-duration="0" data-animation-delay="0" >Evento<br>Esgotado</a>
                <?php } ?>
              <?php }   
                if(Yii::$app->user->id != null) { 
                  if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'rp') { ?>
                    <br>
                    <script>
                      function myFunction() {
                        navigator.clipboard.writeText("http://localhost/ecstasyclub/frontend/web/index.php?r=pulseiras%2Fcomprar&id_evento=<?=$evento->id?>&codigorp=<?=$user->codigoRP?>");
                      }
                    </script>
                    <button class="u-active-custom-color-2 u-border-2 u-border-active-custom-color-1 u-border-custom-color-1 u-border-hover-custom-color-1 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-font-lato u-hover-custom-color-2 u-radius-20 u-text-active-custom-color-1 u-text-custom-color-2 u-text-hover-custom-color-1 u-btn-1" data-animation-duration="0" data-animation-delay="0" onclick="myFunction()">Copy text</button>
                  <?php } ?>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br>
</section>