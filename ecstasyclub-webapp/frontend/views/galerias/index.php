<!DOCTYPE html>
<html style="font-size: 16px;" lang="pt">
  <head>
  <link rel="stylesheet" href="././css/nicepage2.css" media="screen">
<link rel="stylesheet" href="././css/lista-de-eventos.css" media="screen">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  </head>
  <body class="u-body u-xl-mode" data-lang="pt">
    <section class="u-clearfix u-custom-color-2 u-section-1" id="sec-07e1">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-text u-text-default u-text-1" spellcheck="false">Lista de Galerias</h2>
        
        <div class="container">

        <div class="u-expanded-width-lg u-expanded-width-xl u-layout-grid u-list u-list-1">
          
          <div class="u-repeater u-repeater-1">
            
            <?php 
              
            foreach ($eventos as $evento) { ?>
              <a href='index.php?r=galerias%2Fview&id=<?= $evento->id ?>'>
              <div class="u-container-style u-custom-item u-image u-repeater-item u-shading" style="background-image: url('./../../backend/web/cartaz/<?= $evento->cartaz ?>');">
                <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-md u-valign-bottom-sm u-valign-bottom-xs u-valign-top-xl u-container-layout-1">
                  <h3 class="u-text u-text-default-xl u-text-2" style="font-size:1.90rem;"><?= $evento->nome ?></h3>
                </div>
              </div>
            </a>
              
           <?php } ?>


          </div>
        </div>
        </div>
      </div>
    </section>
  </body>
</html>