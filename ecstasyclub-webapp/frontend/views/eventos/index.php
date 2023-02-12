<link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/lista-de-eventos.css" media="screen">
<section class="u-clearfix u-custom-color-2 u-section-1" id="sec-07e1">
<br>
  <div class="u-clearfix u-sheet u-sheet-1">
    <h2 class="u-align-center u-text u-text-default u-text-1" spellcheck="false">Lista de eventos</h2>
    <div class="container">
      <div class="u-expanded-width-lg u-expanded-width-xl u-layout-grid u-list u-list-1">
        <br>
        <?php  if($eventos != null){ ?>
          <div class="u-repeater u-repeater-1">
            <?php foreach ($eventos as $evento) { ?>
              <a href='index.php?r=eventos%2Fview&id=<?= $evento->id ?>'>
                <div class="u-container-style u-custom-item u-image u-repeater-item u-shading" style="background-image: url('./../../backend/web/cartaz/<?= $evento->cartaz ?>');">
                  <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-md u-valign-bottom-sm u-valign-bottom-xs u-valign-top-xl u-container-layout-1">
                    <h3 class="u-text u-text-default-xl u-text-2" style="font-size:1.90rem;"><?= $evento->nome ?></h3>
                  </div>
                </div>
              </a>
            <?php } ?>    
          </div>
          <?php } else { ?>
            <h2 class="u-align-center u-text u-text-default u-text-1" spellcheck="false">Novos eventos em breve fique atento!</h2>
          <?php } ?>
      </div>
    </div>
  </div>
  <br><br><br><br><br>
</section>