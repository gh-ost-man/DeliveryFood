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
    <table class="table">
        <thead style="background-color: #22262A; color: white;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col" style="width: 10%;">Date</th>
            <th scope="col" style="width: 10%;">User</th>
            <th scope="col">Status</th>
            <th scope="col">Total price</th>
            <th scope="col" style="width: 20%;">Address</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order) : ?>
            <?php if(isset($users[$order->user_id])): ?>
                <tr>
                    <th scope="row"><?= $u++; ?></th>
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
            <?php endif ?>

        <?php endforeach ?>
        </tbody>
    </table>
    <table class="table">
        <thead style="background-color: #22262A; color: white;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col" style="width: 10%;">Date</th>
            <th scope="col" style="width: 10%;">Guest</th>
            <th scope="col">Status</th>
            <th scope="col">Total price</th>
            <th scope="col" style="width: 20%;">Address</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order) : ?>
            <?php if(!isset($users[$order->user_id])): ?>
                <tr>
                    <th scope="row"><?= $g++; ?></th>
                    <th scope="row"><?= $order->id; ?></th>
                    <td><?=  (new DateTime(`$order->date_order`))->format('Y-m-d');  ?></td>
                    <td>
                        <p><?= $users[$order->guest]?></p>
                    </td>
                    <td><?= $order->status ?></td>
                    <td><?= $order->total_price ?></td>
                    <td><?= $order->address ?></td>
                    <td> 
                        <?=  Html::a('View products', ['order','id' => $order->id], ['class' => 'btn btn-success']);  ?>
                        <?=  Html::a('Delete', ['delete','id' => $order->id], ['class' => 'btn btn-danger']);  ?>
                    </td>
                </tr>
            <?php endif ?>
        <?php endforeach ?>
        </tbody>
    </table>
</div>