
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="./img/EcstasyClubLogo.png" alt="Ecstasy Club Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ecstasy Club</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="./index.php?r=userprofile%2Fview&id=<?= Yii::$app->user->id ?>" class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'gestor') {
                echo \hail812\adminlte\widgets\Menu::widget([
                    'items' => [
                        ['label' => "Rp's", 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['userprofile/index']],
                        ['label' => 'Notícias', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['noticias/index']],
                        ['label' => 'Eventos', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['eventos/index', 'estado' => 'ativo']],
                        ['label' => 'Bebidas', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['bebidas/index']],
                        ['label' => "Vip's", 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['vip/index']],
                    ],   
                ]);
            }
            if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'admin') {
                echo \hail812\adminlte\widgets\Menu::widget([
                    'items' => [
                        ['label' => 'Empregados', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['userprofile/index']],
                        ['label' => 'Cliente', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['userprofile/indexclientes']],
                        ['label' => 'Notícias', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['noticias/index']],
                        ['label' => 'Eventos', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['eventos/index', 'estado' => 'ativo']],
                        ['label' => 'Bebidas', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['bebidas/index']],
                        ['label' => "Vip's", 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['vip/index']],
                        ['label' => 'Disco', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['disco/view']],
                    ],
                ]);
            }
            ?>
        </nav>
    </div>
</aside>