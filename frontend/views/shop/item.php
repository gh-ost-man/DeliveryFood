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
                <h3>Price: <?= $product->price ?> $</h3>
            </div>
            <div class="col-md-6">
                <?php $id = $product->id; ?>
                <h3 class="float-right <?= isset($cart["prod-$id"])? 'd-block' : 'd-none'?>" id="in-<?=$product->id?>">In cart</h3>
                <button class="btn float-right text-white cart <?= isset($cart['prod-'.$id])? 'd-none' : 'd-block'?>" id="<?=$product->id?>" style="background-color: #c1a35f">Add to Cart</button>
            </div>
        </div>
    </div>
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