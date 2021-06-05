<?php
  use yii\helpers\Html;
  use yii\helpers\Url;

  $this->title = $category->title;
  $this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => [$category->id . 'view']];
  $this->params['breadcrumbs'][] = $this->title;
?>

<style>
  hr
  {
    background: black;
  }

  .corner-text-wrapper {
    -webkit-transform: rotate(45deg);  
      -moz-transform: rotate(45deg);  
        -ms-transform: rotate(45deg);  
        -o-transform: rotate(45deg);  
            transform: rotate(45deg);
      clip: rect(0px, 141.421px, 70.7107px, 0px);
      height: 141.421px;
      position: absolute;
      right: -20.7107px;
      top: -20.7107px;
      width: 141.421px;
      z-index: 1;
  }
  .corner-text {
    color: white;
    -webkit-transform: rotate(-45deg);  
    -moz-transform: rotate(-45deg); 
    -ms-transform: rotate(-45deg); 
    -o-transform: rotate(-45deg); 
    transform: rotate(-45deg);
    left: 20px;
    top: 20px;
    background-color: #c1a35f;
    display: block;
    height: 100px;
    position: absolute;
    width: 100px;
    z-index: 2;
  }
  .corner-text span {
    position: relative;
    font-family: "HelveticaNeue-CondensedBold", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    font-weight: 700;
    /* top: -185px; */
    top: 10px;
    left: 10px;
    display: block;
    text-align: center;
  }
</style>
<h1><?= $category->title?></h1>
<hr>

<div class="row">
  <?php  foreach ($products as $key => $value) :  $image= json_decode($value->url_image,true) ?>
    <div class="col-md-3 mt-4">
      <div class="card h-100">
        <?php if($promotions) : ?>
          <div class="corner-text-wrapper">
            <div class="corner-text">
              <span style="font-size:18px"><?= $promotions->promotion_value . ' + ' . 1 ?></span>
            </div>
          </div>
        <?php endif ?>
        <?php if($value->discount) : ?>
          <div class="corner-text-wrapper">
            <div class="corner-text">
              <span style="font-size:18px">- <?= $value->discount ?> $</span>
            </div>
          </div>
        <?php endif ?>
        <a href="<?= Url::to(['shop/'. $value->id .'item']) ?>">
          <img src="/<?= $image[0]?>" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
          <h4 class="card-title text-center" ><?= $value->title?></h4>
          <p class="card-text" style="text-align: justify;"><?= $value->description?></p>  
        </div>
        <div class="card-footer">
            <?php if($value->discount): ?>
              <h5 class="float-left mr-2 text-danger" style="text-decoration: line-through;"><?= $value->price?>$</h5>
            <?php endif ?>
            <h5 class="float-left "><?= ($value->discount)? $value->price - $value->discount : $value->price?>$</h5>
            <?php $id = $value->id?>
            <span class="float-right <?= isset($cart["prod-$id"])? 'd-block' : 'd-none'?>" id="in-<?=$value->id?>">In cart</span>
            <button class="btn float-right text-white cart <?= isset($cart['prod-'.$value->id])? 'd-none' : 'd-block'?>" id="<?=$value->id?>" style="background-color: #c1a35f">Add to Cart</button>
        </div>
      </div>
    </div>
  <?php  endforeach  ?>
</div>

<script>
    $('.cart').click(function(e) {
      let id = this.id;
      $.ajax({
            url: '/basket/add',
            type: 'post',
            data: {
              id : id 
            },
            success: function(data){
              $('#in-'+id).addClass('d-block');
              $('#in-'+id).removeClass('d-none');
              $('#'+id).addClass('d-none');
              $('#'+id).removeClass('d-block');
            }
        });
    });
  </script>