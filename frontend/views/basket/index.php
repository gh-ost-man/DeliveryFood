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
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="<?= isset($user->email)? $user->email : ''?>" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" value="<?= isset($user->address)? $user->address : ''?>" required>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table" id="basket">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 100px"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Count</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td>
                                <div>
                                    <a href="<?= Url::to(['shop/'. $product['id'] .'item']) ?>">
                                        <img src="/<?= $product['url_image'][0] ?>" class="w-100" alt="">
                                    </a>
                                </div>
                            </td>
                            <td><?= $product['title'] ?></td>
                            <td>
                                <input class="product-count w-50" type="number" name="<?= isset($order->id)? $order->id: 'guest' ?>" id="<?= $product['id'] ?>"  value="<?= $product['count'] ?>" min="1">
                            </td>
                            <td class="price-<?= $product['id']?>"><?= $product['price'] ?> $</td>
                            <td><button id="<?= $product['id'] ?>" class="item btn btn-danger">Delete</button></td>
                        </tr>
                        <input  class="invisible" id="product-<?=$product['id']?>" value="<?= $product['discount']?>">
                    <?php endforeach?>
                </tbody>
            </table>
            <h5 id="discount" class="<?= ($discount_sum>0)? 'd-block': 'd-none'?>">Discount: -<span id="discount_value"><?= ($discount_sum != '' && $discount_sum>0)? $discount_sum: ''?></span> $</h5>
            <h1 style="font-size:30px">Total price: <span id="total"><?= $total_sum?></span> $</h1>
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="<?= Url::to(['/basket/cancel-order']) ?>" class='btn btn-danger'>Cancel order</a>
        </div>
    </div>
</form>

<script>

  let host = window.location.protocol + "//" + window.location.host;
  
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
      success: function(data){
        if(data.discount == 0) {
            $('#discount').addClass('d-none');
            $('#discount').removeClass('d-block');
        } else {
            $('#discount').addClass('d-block');
            $('#discount').removeClass('d-none');
        }
        $('#discount_value').html(data.discount);
        $('#total').html(data.total);
      }
    });

  });

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

<script>
    $('.item').click(function(e){
        e.preventDefault();
        
        let index = this.parentNode.parentNode.rowIndex;
        
        let id = $(this).attr('id');
        $.ajax({
            url: 'delete-item',
            type: 'post',
            data: {
                'id' : id 
            },
            success: function(data){
                document.getElementById("basket").deleteRow(index);
                if(data.discount == 0) {
                    $('#discount').addClass('d-none');
                    $('#discount').removeClass('d-block');
                    
                } else {
                    $('#discount').addClass('d-block');
                    $('#discount').removeClass('d-none');
                }
                $('#discount_value').html(data.discount);
                $('#total').html(data.total);
            }
        });
    });

</script>