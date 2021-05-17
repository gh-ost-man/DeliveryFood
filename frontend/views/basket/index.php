<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    $i = 1;

    $this->title = 'Basket';
    $this->params['breadcrumbs'][] = $this->title;
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
<form id="pay-order">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="<?= isset($user->email)? $user->email : ''?>" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" required>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
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
                                <a href="<?= Url::to(['shop/'. $product['id'] .'item']) ?>">
                                    <img src="/<?= $product['url_image'][0] ?>" style="width:70px" alt="">
                                </a>
                            </div>
                        </td>
                        <td><?= $product['title'] ?></td>
                        <td>
                            <input type="number" name="<?= isset($order->id)? $order->id: 'guest' ?>" id="<?= $product['id'] ?>" class="product-count" value="<?= $product['count'] ?>" min="1">
                        <td class="price-<?= $product['id']?>"><?= $product['price'] ?> $</td>
                    </tr>
                <?php endforeach?>
                </tbody>
            </table>
            <h1 style="font-size:30px">Total price: <span id="total"></span> $</h1>
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="<?= Url::to(['/basket/cancel-order']) ?>" class='btn btn-danger'>Cancel order</a>
        </div>
    </div>
</form>

<script>

  let host = window.location.protocol + "//" + window.location.host;
  
  Total();

  $('.product-count').change(function(){
    let id = $(this).attr('id');
    let count = $(this).val();
    let order_id = $(this).attr('name');
    let tag = $(this);

    $.ajax({
      url: 'update-item',
      type: 'post',
      data: {
        'product_id' : id,
        'order_id' : order_id,
        'count' : count
      },
      success: function(data){}
    });

    Total();
  });

  function Total(){
    let total = 0;
    $('.product-count').each(function(){
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

<script>
    $("#pay-order").submit(function(event){
        event.preventDefault();// відміна відправки форми

        email = this.elements['email'].value;
        address = this.elements['address'].value;

        $.post({
            url: 'pay',
            data: {
                'email': email,
                'address': address
            },
        });
    });
</script>