<?php
  use yii\helpers\Html;
  use yii\helpers\Url;

    var_dump($products);

    $i = 1;
?>
<style>       
    hr
    {
        height: 1px;
        background-color: black;
        border: none;
    }
</style>

<h1>Basket</h1>
<hr>
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Count</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td>
                                <div>
                                    <img src="/<?= $product['url_image'][0] ?>" style="width:70px" alt="">
                                </div>
                            </td>
                            <td><?= $product['title'] ?></td>
                            <td>
                                <input type="number" name="<?= $order->id ?>" id="<?= $product['id'] ?>" class="tovar-count" value="<?= $product['count'] ?>" min="1">
                            <td class="price-<?= $product['id']?>"><?= $product['price'] ?> $</td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
                    <h1 class="" style="font-size:30px">Total price: <span id="total"></span> $</h1>
                    <a id="pay" href="<?= Url::to(['/tovar/pay-order']) ?>" class='btn btn-success'>To pay an order</a>
                    <a href="<?= Url::to(['/tovar/cancel-order']) ?>" class='btn btn-danger'>Cancel order</a>
          
        </div>
    </div>
</form>
<script>

  let host = window.location.protocol + "//" + window.location.host;
  
  Total();

  $('.tovar-count').change(function(){
    let id = $(this).attr('id');
    let count = $(this).val();
    let order_id = $(this).attr('name');
    let tag = $(this);
    $.ajax({
      url: 'update-item',
      type: 'post',
      data: {
        'tovar_id' : id,
        'order_id' : order_id,
        'count' : count
      },
      success: function(data){
        if(data.status == 'error') {
          alert(data.message);
          tag.val('1');
        }
      }
    });

    Total();
  });

  function Total(){
    let total = 0;
    $('.tovar-count').each(function(){
        let id = $(this).attr('id');
        let count = $(this).val();
        let price = parseInt($('.price-' + id).html());
        let m = count * price;

        console.log(`id =  ${id}\nCount = ${count}\nPrice = ${price}\nTotal = ${m}`);

        total += m;
    });
    
    $('#total').html(total);
  }

</script>
