<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = $product->title;
    $this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">
    <div class="col-md-6">
        <img src="/<?= json_decode($product->url_image,true)[0]?>" class="img-fluid" alt="...">
    </div>
    <div class="col-md-6">
        <h2 ><?= $product->title?></h2>
        <p><?= $product->description?></p>
        <div class="row">
            <div class="col-md-6">
                <h2>Price: <?= $product->price ?> $</h2>
            </div>
            <div class="col-md-6">
                <a href="<?= Url::to(['basket/'. $product->id .'add-item']) ?>" class="btn btn-success w-100">To basket</a>
            </div>

        </div>
    </div>
</div>