<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use kartik\select2\Select2;
$this->title = 'Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ["index"]];
$this->params['breadcrumbs'][] = $this->title;

$i = 1;
$j = 1;
?>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h4>Order</h4></div>
  <!-- Table -->
  <table class="table" >
    <thead style="background-color: #22262A; color: white;">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Id</th>
        <th scope="col">Date</th>
        <th scope="col"><?= ($status == 'user') ? 'User' : 'Guest';?>  </th>
        <th scope="col">Status</th>
        <th scope="col">Total price</th>
        <th scope="col">Address</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"><?= $i++; ?></th>
            <th scope="row"><?= $order->id; ?></th>
            <td><?= (new DateTime(`$order->date_order`))->format('Y-m-d'); ?></td>
            <td>
              <?php if ($status=='user') : ?>
                <?=  Html::a($user->email, ['user/view','id' => $user->id], ['class' => ' ']);  ?>
              <?php endif?>
              <?php if ($status=='guest') : ?>
                <p><?= $guest?></p>
              <?php endif?>
              
            </td>
            <td><?= $order->status?></td>
            <td><?= $order->total_price?></td>
            <td><?= $order->address ?></td>
        </tr>
    </tbody>
  </table>
  <table class="table" >
    <thead style="background-color: #22262A; color: white;">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Id</th>
        <th scope="col">Product</th>
        <th scope="col">Count</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($items_order as $item) : ?>
        <tr>
            <th scope="row"><?= $j++; ?></th>
            <th scope="row"><?= $item['id']; ?></th>
            <td><?= $item['product'] ?></td>
            <td><?= $item['count'] ?></td>
            <td><?= $item['price'] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
  </table>
</div>