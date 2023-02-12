<head>
  <link rel="stylesheet" href="././css/nicepage.css" media="screen">
</head>
<div class="u-body u-xl-mode" data-lang="pt">
<section class="u-clearfix u-image u-section-1" id="carousel_bd30">
  <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
    <div class="u-layout">
      <div class="u-layout-row">
        
        <div class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-left-cell u-size-22 u-layout-cell-1">
          <div class="u-container-layout u-container-layout-1">
            <?php if($proximoevento != null){ ?>
              <h1 class="u-custom-font u-text u-text-body-alt-color u-title u-text-1" spellcheck="false">proximo ​evento</h1>
              <h3 class="u-custom-font u-text u-text-body-alt-color u-text-2" spellcheck="false">&nbsp;&nbsp;<?= date_format(date_create($proximoevento->dataevento), "d.m.Y") ?></h3>
            <?php } else { ?>
              <h1 class="u-custom-font u-text u-text-body-alt-color u-title u-text-1" spellcheck="false">proximo ​evento</h1>
              <h3 class="u-custom-font u-text u-text-body-alt-color u-text-2" spellcheck="false">&nbsp;&nbsp; Brevemente </h3>
            <?php } ?>
          </div>
        </div>
        <div class="u-align-center u-container-style u-layout-cell u-right-cell u-shape-rectangle u-size-38 u-layout-cell-2">
          <div class="u-container-layout u-container-layout-2">
            <h1 class="u-custom-font u-text u-text-body-alt-color u-title u-text-3" spellcheck="false">Ecstasy&nbsp;&nbsp;</h1>
            <h1 class="u-custom-font u-text u-text-body-alt-color u-title u-text-4" spellcheck="false">&nbsp;&nbsp;&nbsp;Club</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-align-center u-clearfix u-palette-5-base u-section-2" id="sec-2915">
  <div class="u-clearfix u-sheet u-valign-middle-sm u-valign-middle-xs u-sheet-1">
    <h2 class="u-custom-font u-text u-text-default u-text-1" spellcheck="false">A TUA DISCOTECA</h2>
    <p class="u-text u-text-2">Zona VIP&nbsp;
        <span class="u-file-icon u-icon u-text-white u-icon-1">
            <img src="././assets/481037-16a84870.png" alt="">
        </span>&nbsp;Bar&nbsp;
        <span class="u-file-icon u-icon u-text-white u-icon-2">
            <img src="././assets/481037-16a84870.png" alt="">
        </span>&nbsp;Pistas de dança&nbsp;
        <span class="u-file-icon u-icon u-text-white u-icon-3">
            <img src="././assets/481037-16a84870.png" alt="">
        </span>&nbsp;Hookah&nbsp;
        <span class="u-file-icon u-icon u-text-white u-icon-4">
            <img src="././assets/481037-16a84870.png" alt="">
        </span>&nbsp;Karaoke
    </p>
  </div>
</section>
<section class="u-align-center u-clearfix u-palette-5-dark-3 u-section-3" id="carousel_39ce">
  <div class="u-clearfix u-sheet u-sheet-1">
    <h1 class="u-custom-font u-text u-text-1"><span class="u-icon"></span>&nbsp;Últimos Eventos
    </h1>
    <div class="u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xl u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <?php foreach ($lasteventos as $evento) { ?>
          <div class="u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-1">
              <img src="./../../backend/web/cartaz/<?=$evento->cartaz?>" alt="<?= $evento->nome?>" class="u-image u-image-default u-preserve-proportions u-image-1" data-image-width="626" data-image-height="626">
              <h2 class="u-custom-font u-text u-text-2" spellcheck="false"><?= $evento->nome?></h2>
              <h5 class="u-custom-font u-font-pt-sans u-text u-text-3" spellcheck="false"><?php setlocale(LC_ALL, 'Portuguese'); echo strftime('%B %d, %G', date_create($evento->dataevento)->getTimestamp()); ?></h5>
            </div>
          </div>
        <?php }?>
      </div>
    </div>
  </div>
</section>
<section class="u-black u-clearfix u-section-4" id="carousel_dd79">
  <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
    <div class="u-gutter-0 u-layout">
      <div class="u-layout-row">
        <div class="u-size-20 u-size-30-md">
          <div class="u-layout-row">
            <div class="u-align-left u-container-style u-image u-layout-cell u-left-cell u-size-60 u-image-1" src="" data-image-width="720" data-image-height="1080">
            </div>
          </div>
        </div>
        <div class="u-size-20 u-size-30-md">
          <div class="u-layout-row">
            <div class="u-container-style u-layout-cell u-palette-5-base u-size-60 u-layout-cell-2" src="">
              <div class="u-container-layout u-valign-middle u-container-layout-2" src="">
                <h2 class="u-align-center u-custom-font u-text u-text-1" spellcheck="true"> O proximo nível de diverção é no Ecstasy Club</h2>
                <br>
                <p class="u-align-justify u-text u-text-2" spellcheck="true">O Ecstasy Club é o melhor bar da zona centro que está situado bem no corção de Leiria se queres uma noite totalmente inesquecivel cria já tua conta e compra a tua pulseira para os novos eventos.<p>
                <p class="u-align-justify u-text u-text-3" spellcheck="true">O Ecstasy Club recebe os melhores artistas de portugal como os WBG, Piruka, Bispo entre outro tambem já contamos com no internacionais como McKevinho, Annita e Post Malone.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="u-size-20 u-size-60-md">
          <div class="u-layout-col">
            <div class="u-align-left u-container-style u-image u-layout-cell u-right-cell u-size-30 u-image-2" data-image-width="716" data-image-height="621">
              <div class="u-container-layout u-valign-bottom-lg u-valign-bottom-md u-valign-bottom-sm u-valign-bottom-xs u-container-layout-3"></div>
            </div>
            <div class="u-align-left u-container-style u-image u-layout-cell u-right-cell u-size-30 u-image-3" src="" data-image-width="1500" data-image-height="1000">
              <div class="u-container-layout u-container-layout-4" src=""></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-align-left u-clearfix u-image u-section-5" id="carousel_75eb" data-image-width="1104" data-image-height="1080">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-align-right u-container-style u-expanded-width-sm u-expanded-width-xs u-group u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <h3 class="u-custom-font u-text u-text-custom-color-1 u-text-font u-text-1" spellcheck="false">Festivais <span class="u-text-custom-color-2"></span>Eventos Festas
        </h3>
        <h1 class="u-custom-font u-text u-text-body-alt-color u-title u-text-2" spellcheck="false">
            The
            <br>music
            <span style="font-style: italic;">
                <br>show
            </span>
          <br>
        </h1>
        <a href="index.php?r=eventos%2Findex" class="u-border-none u-btn u-button-style u-palette-5-base u-text-body-alt-color u-btn-1">Eventos</a>
      </div>
    </div>
  </div>
</section>
<section class="u-align-center u-clearfix u-palette-5-dark-3 u-section-6">
  <h2 class="u-custom-font u-text u-text-1" spellcheck="false"> Os melhores&nbsp;<span style="font-style: italic;" class="u-text-palette-5-base">DJ'<span class="u-text-custom-color-1"></span>s
    </span>&nbsp;e A<i>rtistas</i>
  </h2>
  <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
    <div class="u-layout">
      <div class="u-layout-row">
        <div class="u-container-style u-image u-layout-cell u-left-cell u-size-15 u-size-30-md u-image-1" data-image-width="720" data-image-height="1080"></div>
        <div class="u-container-style u-image u-layout-cell u-size-15 u-size  -30-md u-image-2"></div>
        <div class="u-container-style u-image u-layout-cell u-size-15 u-size-30-md u-image-3" data-image-width="1617" data-image-height="1080"></div>
        <div class="u-container-style u-image u-layout-cell u-right-cell u-size-15 u-size-30-md u-image-4"></div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-7" id="carousel_1c92">
  <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
    <div class="u-layout">
      <div class="u-layout-row">
        <div class="u-align-left u-container-style u-image u-layout-cell u-left-cell u-size-40 u-image-1">
          <div class="u-container-layout u-container-layout-1"></div>
        </div>
        <div class="u-align-center u-container-style u-image u-layout-cell u-right-cell u-size-20 u-image-2">
          <div class="u-container-layout u-valign-top u-container-layout-2"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-align-center u-clearfix u-palette-5-dark-3 u-section-8" id="sec-0b57">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
    <h2 class="u-custom-font u-text u-text-1" spellcheck="false">
      <span style="font-size: 3rem;">Tonight </span>
      <span style="font-style: italic;">Special Party&nbsp; &nbsp; &nbsp; &nbsp;</span>
      <p><span class="u-text-palette-5-base">&nbsp; VIP's Disponiveis</span></p>
    </h2>
  </div>
</section>
</div>