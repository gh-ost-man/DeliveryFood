<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'View';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-md-6">
        <div class="thumbnail">
            <img src="/<?= $images[0] ?>" alt="...">
        </div>
    </div>
    <div class="col-md-6">
        <h1><?= $product->title?></h1>
        <p style="font-size: 15px;"><?= $product->description?></p>
        <h3>Price: <?= $product->price ?></h3>
        <h3>Category: <?= $category->title?></h3>
        <?php if($product->discount) :?>
        <h3>Discount: <?= $product->discount?> $</h3>
        <?php endif ?>

    </div>
</div>