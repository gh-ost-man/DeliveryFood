<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use yii\helpers\Url;

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap4\Alert;

use common\models\Category;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php 
    $this->registerCss(
        " 
            #w0-collapse
            {
                flex-grow: 0; 
            }
            #menu 
            {
                list-type: none;
            }
            .bg-nav
            {
                background-color: rgba(34,38,42,255);
            }
        "
        );
?>

<div class="wrap">
   
    <?php
        $this->registerCss(
        " 
            #w0-collapse
            {
                flex-grow: 0; 
            }
            #menu 
            {
                list-type: none;
            }
            .bg-nav
            {
                background-color: rgba(34,38,42,255);
            }
        "
        );

        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-nav m-0 p-0',
            ],
        ]);
        // $menuItems = [
        //     ['label' => 'Home', 'url' => ['/site/index']],
        //     ['label' => 'About', 'url' => ['/site/about']],
        //     ['label' => 'Contact', 'url' => ['/site/contact']],
        // ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'About us', 'url' => ['/shop/about']];
            $menuItems[] = ['label' => 'Basket', 'url' =>  ['/shop/basket']];
            $menuItems[] = ['label' => 'Sign up', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Sign in', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => 'About us', 'url' => ['/shop/about']];
            $menuItems[] = ['label' => 'Basket', 'url' =>  ['/shop/basket']];

            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn text-white']
                )
                . Html::endForm()
                . '</li>';
        }

       
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav nav-dark nav-pills'],
            'items' => $menuItems,
        ]);


        NavBar::end();
    ?>

    <div class="bg-nav">
        <div class="container">
            <?php foreach(Category::find()->all() as $category) : ?>
                <a class="text-white" href="<?= Url::to(["/shop/" . $category->id . "view"]) ?>"><?= $category->title; ?></a>
            <?php endforeach ?>
        </div>
    </div>
  
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <!-- <?= Alert::widget() ?> -->
        <?= $content ?>
    </div>

    <script>
        $('a.active').css('background-color', 'black');
    </script>       
  
</div>


<footer class="footer bg-nav">
    <div class="container">
        <!-- <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p> -->
        <p class="pull-left text-white">@Delivery Food</p>
    </div>
</footer>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
