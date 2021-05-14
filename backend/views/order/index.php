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

$i = 1;

?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading"><h4>Orders</h4></div>
    
    <!-- Table -->
    <table class="table">
        <thead style="background-color: #22262A; color: white;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Date</th>
            <th scope="col">User</th>
            <th scope="col">Status</th>
            <th scope="col">Total price</th>
            <th scope="col" style="width: 40%;">Address</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <th scope="row"><?= $order->id; ?></th>
                <td><?=  (new DateTime(`$order->date_order`))->format('Y-m-d');  ?></td>
                <td>
                    <?=  Html::a($users[$order->user_id]->email, ['user/view','id' => $order->user_id], ['class' => ' ']);  ?>
                </td>
                <td><?= $order->status ?></td>
                <td><?= $order->total_price ?></td>
                <td><?= $order->address ?></td>
                <td> 
                    <?=  Html::a('View products', ['order','id' => $order->id], ['class' => 'btn btn-success']);  ?>
                    <?=  Html::a('Delete', ['delete','id' => $order->id], ['class' => 'btn btn-danger']);  ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>