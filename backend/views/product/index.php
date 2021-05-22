<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Products';
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
    <div class="panel-heading"><h4>Products</h4></div>
    <?= Html::a(
                'Add product',
                Url::toRoute('product/create'),
                [
                    'class' => 'btn btn-success pull-right',
                    'id' => 'product-create',
                    'style' => [
                        'margin' => '10px' 
                    ]
                ]
            );?>
    <!-- Table -->
    <table class="table">
        <thead style="background-color: #22262A; color: white;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col" style="width: 50%;">Description</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($products as $product) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <th scope="row"><?= $product['id']; ?></th>
                <td><?= $product['title'] ?></td>
                <td><?= $product['description'] ?></td>
                <td> 
                    <?=  Html::a('View', ['view','id' => $product['id']], ['class' => 'btn btn-info']);  ?>
                    <?=  Html::a('Update', ['update','id' => $product['id']], ['class' => 'btn btn-update']);  ?>
                    <?=  Html::a('Delete', ['delete','id' => $product['id']], ['class' => 'btn btn-danger']);  ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>