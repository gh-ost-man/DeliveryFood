<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use \yii\bootstrap4\Dropdown ;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>  *{ font-family: 'Consolas' }  </style>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => "Delivery Food",
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menu_home = [
            'label' => 'Home',
            'url' => ['/site/index']
        ];
        $menu_product = [
            'label' => 'Products',
            'url' => ['/product/index'],
        ];
        $menu_category = [
            'label' => 'Categories',
            'url' => ['/category/index'],
        ];
        $menu_promotion = [
            'label' => 'Promotions',
            'url' => ['/promotion/index'],
        ];
       
        $menu_user = [
            'label' => 'Users',
            'url' => ['/user/index'],
        ];
        $menu_order = [
            'label' => 'Orders',
            'url' => ['/order/index']
        ];
        $menu_profile= [
            'label' => 'Profile',
            'url' => ['/user/profile']
        ];
        $menuItems = [];
        if (Yii::$app->user->isGuest){
            $menuItems[] = $menu_home; 
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];

        } else  {
            $menu_logout = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';

            // if(Yii::$app->user->can('admin')){
            // }
            $menuItems[] = $menu_category;
            $menuItems[] = $menu_product;
            $menuItems[] = $menu_promotion;
            $menuItems[] = $menu_order;
            $menuItems[] = $menu_user;
            $menuItems[] = $menu_profile;
            $menuItems[] = $menu_logout;
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
    ?>
 
    <div class="container">
        <?= Breadcrumbs::widget(['homeLink' => [
            'label' => 'Головна'
        ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <!-- <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p> -->
        <p  class="pull-left">@Delivery Food</p>


        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
