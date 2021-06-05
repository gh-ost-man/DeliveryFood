<?php

/* @var $this yii\web\View */

  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\bootstrap4\ActiveForm;

  $this->title = 'Delivery Food';
  $i = 0; 
  $flag = false;
?>
  <!-- Favicon -->
  <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
  <!-- Font awesome -->
  <link href="asset/css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="asset/css/bootstrap.css" rel="stylesheet">   
  <!-- Theme color -->
  <link id="switcher" href="asset/css/theme-color/default-theme.css" rel="stylesheet">     
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>        
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>
  
<div class="container-fluid">
  <?php if($promotion) : ?>
    <div class="text-center"> 
      <img src="/<?= json_decode($promotion->promotion_url,true)[0]?>" class="w-75" alt="...">
    </div>
  <?php endif ?>
</div>

 <!-- Start Restaurant Menu -->
  <section id="mu-restaurant-menu" >
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-restaurant-menu-area">
            <div class="mu-title">
              <span class="mu-subtitle" style="font-size: 5rem">Delivery Food</span>
              <h2>OUR MENU</h2>
              <i class="fa fa-spoon"></i>              
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-restaurant-menu-content">
              <ul class="nav nav-tabs mu-restaurant-menu">
                <?php foreach($categories as $category ) : ?>
                  <li><a href="#<?= $category->id?>" data-toggle="tab"><?= $category->title?></a></li>
                <?php endforeach ?>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <?php  foreach ($categories as $cat) : ?>
                  <div class="tab-pane fade " id="<?= $cat->id?>">
                    <div class="mu-tab-content-area">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mu-tab-content-left">
                            <ul class="mu-menu-item-nav">
                              <?php $cnt = (count($products[$cat->id]) <= 3)? count($products[$cat->id]) :count($products[$cat->id])/2 ?>
                              <?php for($prod = 0; $prod < $cnt; $prod++ ) :  $image = json_decode($products[$cat->id][$prod]['url_image'],true); ?>
                                <li>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="<?= Url::to(['shop/'.$products[$cat->id][$prod]['id'] .'item']) ?>">
                                        <img class="media-object" src="/<?= $image[0]?>" alt="img">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="<?= Url::to(['shop/'.$products[$cat->id][$prod]['id'] .'item']) ?>" style="color:#222; text-decoration: none;"><?= $products[$cat->id][$prod]['title']?></a></h4>
                                      <?php if($products[$cat->id][$prod]['discount']) : ?>
                                        <span class="mu-menu-price text-secondary" style="text-decoration: line-through;"><?= $products[$cat->id][$prod]['price'] ?>$</span>
                                      <?php endif?>
                                      <span class="mu-menu-price "><?= $products[$cat->id][$prod]['price'] - $products[$cat->id][$prod]['discount'] ?>$</span>
                                      <p><?= $products[$cat->id][$prod]['description']?></p>
                                      <?php $id = $products[$cat->id][$prod]['id'];?>
                                      <span class="<?= isset($cart["prod-$id"])? 'd-block' : 'd-none'?>" id="in-<?=$products[$cat->id][$prod]['id']?>">In cart</span>
                                      <button class="btn text-white cart <?= isset($cart["prod-$id"])? 'd-none' : 'd-block'?>" id="<?=$products[$cat->id][$prod]['id']?>" href="<?= Url::to(['basket/'. $products[$cat->id][$prod]['id'] .'add-item']) ?>" style="background-color: #c1a35f">Add to Cart</button>
                                    </div>
                                  </div>
                                </li>
                                <?php  endfor ?>
                              </ul>   
                          </div>
                        </div>
                        <?php if(count($products[$cat->id]) > 3) :?>
                          <div class="col-md-6">
                            <div class="mu-tab-content-left">
                              <ul class="mu-menu-item-nav">
                                <?php for($prod = (is_float(count($products[$cat->id]) / 2))? (count($products[$cat->id]) / 2) + 1 : count($products[$cat->id]) / 2; $prod < count($products[$cat->id]); $prod++ ) :  $image = json_decode($products[$cat->id][$prod]['url_image'],true); ?>
                                  <li>
                                    <div class="media">
                                      <div class="media-left">
                                        <a href="<?= Url::to(['shop/'.$products[$cat->id][$prod]['id'] .'item']) ?>">
                                          <img class="media-object" src="/<?= $image[0]?>" alt="img">
                                        </a>
                                      </div>
                                      <div class="media-body">
                                        <h4 class="media-heading"><a href="<?= Url::to(['shop/'.$products[$cat->id][$prod]['id'] .'item']) ?>" style="color:#222; text-decoration: none;"><?= $products[$cat->id][$prod]['title']?></a></h4>
                                        <?php if($products[$cat->id][$prod]['discount']) : ?>
                                          <span class="mu-menu-price text-secondary" style="text-decoration: line-through;"><?= $products[$cat->id][$prod]['price'] ?>$</span>
                                        <?php endif?>
                                        <span class="mu-menu-price "><?= $products[$cat->id][$prod]['price'] - $products[$cat->id][$prod]['discount'] ?>$</span>
                                        <p><?= $products[$cat->id][$prod]['description']?></p>
                                        <?php $id = $products[$cat->id][$prod]['id'];?>
                                        <span class="<?= isset($cart["prod-$id"])? 'd-block' : 'd-none'?>" id="in-<?=$products[$cat->id][$prod]['id']?>">In cart</span>
                                        <button class="btn text-white cart <?= isset($cart["prod-$id"])? 'd-none' : 'd-block'?>" id="<?=$products[$cat->id][$prod]['id']?>" style="background-color: #c1a35f">Add to Cart</button>
                                      </div>
                                    </div>
                                  </li>
                                <?php  endfor ?>
                              </ul>   
                            </div>
                          </div>
                          <div class="col-md-12">
                            <a href="<?= Url::to(["shop/" . $cat->id . "view"]) ?>" class="btn btn-warning">View More</a>
                          </div>
                      <?php endif?>
                    </div>
                    </div>
                </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Restaurant Menu -->

  <section id="mu-map" class="mt-5">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2572.219296601386!2d24.025597615342196!3d49.85712513781923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473add07f1731fd1%3A0xbadadff90f884085!2sIT%20Step%20Academy!5e0!3m2!1suk!2sua!4v1622378371525!5m2!1suk!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </section>


  <script src="asset/js/jquery.min.js"></script>  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="asset/js/bootstrap.js"></script> 

  <script>
    $('.cart').click(function(e) {
      let id = this.id;
      $.ajax({
            url: 'basket/add',
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