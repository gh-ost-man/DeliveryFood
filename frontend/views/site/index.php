<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Delivery Food';

$this->registerCss(
    `
        .bg-nav
        {
            background-color: rgba(34,38,42,255);
        }
    `);
?>

<div class="row p-0 m-0 bg-nav">
    <div class="col-md-12">
        <?php foreach($categories as $category) : ?>
            <a class="text-white" href="<?= Url::to(["/shop/" . $category->id . "view"]) ?>"><?= $category->title; ?></a>
        <?php endforeach ?>
    </div>
</div>
<div class="container-fluid">
    <h1>MAIN PAGE</h1>
</div>
