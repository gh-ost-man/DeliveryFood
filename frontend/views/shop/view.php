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
</style>
<h1><?= $category->title?></h1>
<hr>

<div class="row">
    <?php  foreach ($products as $key => $value) :  $image= json_decode($value->url_image,true) ?>
      <div class="col-md-3">
        <div class="card h-100">
            <img src="/<?= $image[0]?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title text-center" ><?= $value->title?></h4>
              <p class="card-text" style="text-align: justify;"><?= $value->description?></p>  
            </div>
            <div class="card-footer">
                <h4 class="float-left w-50"><?= $value->price?>$</h4>
                <a href="<?= Url::to(['basket/'. $value->id .'add-item']) ?>" class="btn btn-success float-right">To basket</a>
            </div>
          </div>
      </div>
    <?php  endforeach  ?>
    
</div>