<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Promotions';
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
  <div class="panel-heading"><h4>Promotions</h4></div>
  <?= Html::a(
            'Add promotion',
            Url::toRoute('promotion/create'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-create',
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
        <th scope="col" style="max-width:50%;">Title</th>
        <th scope="col">Value</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($promotions as $promo) : ?>
          <tr>
              <th scope="row"><?= $i++; ?></th>
              <th scope="row"><?= $promo['id']; ?></th>
              <th scope="row"><?= $promo['title']; ?></th>
              <th scope="row"><?= $promo['promotion_value']; ?></th>
              <td> 
                    <?=  Html::a('View', ['view','id' => $promo['id']], ['class' => 'btn btn-info']);  ?>
                    <?=  Html::a('Update', ['update','id' => $promo['id']], ['class' => 'btn btn-update']);  ?>
                    <?=  Html::a('Delete', ['delete','id' => $promo['id']], ['class' => 'btn btn-danger']);  ?>
              </td>
          </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>