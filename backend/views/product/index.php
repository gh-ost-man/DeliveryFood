<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;

    use common\models\Product;

    $this->title = 'Products';
    $this->params['breadcrumbs'][] = $this->title;

    $this->registerCss(
    "
        .btn-update 
        {
            background-color: rgba(255,193,7,255);
            color: black;
        }

        .active-btn
        {
            background-color: black;
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
    <table class="table" id="products" style="min-width: 300px">
        <thead style="background-color: #222; color: white;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col" style="width: 50%">Description</th>
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
                    <?=  Html::a('Update', ['update','id' => $product['id'], 'page' => $page], ['class' => 'btn btn-update']);  ?>
                    <button id="<?= $product['id'] ?>" class="item btn btn-danger">Delete</button>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

</div>
<?php if(count($products) != 0) :?>
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
                document.getElementById("products").deleteRow(index);
            }
        });
    });

</script>

