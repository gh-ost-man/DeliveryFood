<?php

/* @var $this yii\web\View */

  use yii\helpers\Html;
  use yii\helpers\Url;

  $this->title = 'Delivery Food';
  $i=0; 


?>

<div class="container-fluid">
  <?php if($promotion) : ?>
    <div class="text-center"> 
      <img src="<?= json_decode($promotion->promotion_url,true)[0]?>" class="w-75 " alt="...">
    </div>
  <?php endif ?>

  <div class="row row-cols-1 row-cols-md-3 mt-4">
    <?php  foreach ($products as $key => $value) :  $image= json_decode($value["url_image"],true) ?>
      <div class="col mb-4">
        <div class="card h-100">
          <a href="<?= Url::to(['shop/'. $value['id'] .'item']) ?>">
            <img src="<?= $image[0]?>" class="card-img-top" alt="...">
          </a>
          <div class="card-body">
            <h5 class="card-title"><?= $value["title"]?></h5>
            <p class="card-text"><?= $value["description"]?></p>  
          </div>
          <div class="card-footer">
            <h4 class="float-left w-50"><?= $value['price']?>$</h4>
            <a href="<?= Url::to(['basket/'. $value["id"] .'add-item']) ?>" class="btn btn-success float-right">Add to Cart</a>
          </div>
        </div>
      </div>
    <?php  endforeach  ?> 
  </div>
</div>

<img src="/images/map/map.jpg" class="img-fluid w-100"  alt="...">