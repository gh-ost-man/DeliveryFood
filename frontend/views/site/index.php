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
<div class="container-fluid">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="\images\Sakura.jpg" class="d-block w-100" style="height: 500px;" alt="...">
      </div>
      <div class="carousel-item">
        <img src="\images\download.jpg" class="d-block w-100" style="height: 500px;" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
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
            <a href="<?= Url::to(['basket/'. $value["id"] .'add-item']) ?>" class="btn btn-success float-right">To basket</a>
          </div>
        </div>
      </div>
    <?php  endforeach  ?> 
  </div>
</div>

<img src="\images\map.jpg" class="img-fluid w-100"  style="height: 500px;" alt="...">