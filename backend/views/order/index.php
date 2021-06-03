<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;

    $this->title = 'Orders';
    $this->params['breadcrumbs'][] = $this->title;

    $this->registerCss(
    "
        .btn-update 
        {
            background-color: rgba(255,193,7,255);
            color: black;
        }
    "
    );

    $u = 1; //user
    $g = 1; //guest
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading"><h4>Orders</h4></div>
    
    <!-- Table -->
  
    <table class="table" id="orders">
        <thead style="background-color: #22262A; color: white;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col" style="width: 10%;">Date</th>
            <th scope="col" style="width: 10%;">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Total price</th>
            <th scope="col" style="width: 20%;">Address</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order) : ?>
                <tr>
                    <th scope="row"><?= $g++; ?></th>
                    <th scope="row"><?= $order->id; ?></th>
                    <td><?=  (new DateTime(`$order->date_order`))->format('Y-m-d');  ?></td>
                    <td>
                        <?php if(isset($users[$order->user_id])): ?>
                            <?=  Html::a($users[$order->user_id]->email, ['user/view','id' => $order->user_id], ['class' => ' ']);  ?>
                        <?php endif?>
                        <?php if(!isset($users[$order->user_id])): ?>
                            <?= $users[$order->guest]?>
                        <?php endif?>
                    </td>
                    <td><?= $order->status ?></td>
                    <td><?= $order->total_price ?></td>
                    <td><?= $order->address ?></td>
                    <td> 
                        <?=  Html::a('View products', ['order','id' => $order->id], ['class' => 'btn btn-success']);  ?>
                        <button id="<?= $order->id ?>" class="item btn btn-danger">Delete</button>
                    </td>
                </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php if(count($orders) != 0) :?>
    <ul class=" pager" >
        <?php foreach(range($start_page,$end_page) as $p) : if($p == $page) { ?>
            <li class="active">
                <?=  Html::a($p, ['index','page' => $p], ['class' => 'page-link', 'style' => [
                    "background-color" => '#222',
                    "color" => 'white'
                ]]);  ?>
            </li>
        <?php } else { ?>
            <li class="">
                <?=  Html::a($p, ['index','page' => $p], ['class' => 'page-link', 'style' => [
                    "background-color" => 'white',
                    "color" => 'black'
                ]]);  ?>
            </li>
        <?php } endforeach?>
    </ul>
<?php endif?>

<script>
    $('.item').click(function(e){
        e.preventDefault();
        let index = this.parentNode.parentNode.rowIndex;
        let id = $(this).attr('id');

        $.ajax({
            url: 'delete',
            type: 'post',
            data: {
                'id' : id 
            },
            success: function(data){
                document.getElementById("orders").deleteRow(index);
            }
        });
    });
</script>
