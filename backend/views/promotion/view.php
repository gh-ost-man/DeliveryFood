<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'View';
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-md-6">
        <div class="thumbnail">
            <img src="/<?= $images[0] ?>" alt="...">
        </div>
    </div>
    <div class="col-md-6">
        <h1><?= $promotion->title?></h1>
        <h4>Type: <?= $promotion->type ?></h4>
        <h4>Value: <?= $promotion->promotion_value?></h4>
        <h3>Category: <?= ($category != null)? $category->title : 'None'  ?></h3>
        <h3>Product: <?= ($product) ? $product->title : 'None' ?></h3>
    </div>
</div>