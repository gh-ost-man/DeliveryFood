<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Categories';
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
  <div class="panel-heading"><h4>Categories</h4></div>
  <?= Html::a(
            'Add category',
            Url::toRoute('category/create'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'category-create',
                'style' => [
                    'margin' => '10px' 
                ]
            ]
        );?>
  <!-- Table -->
  <table class="table" id="categories">
    <thead style="background-color: #22262A; color: white;">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($categories as $category) : ?>
          <tr>
              <th scope="row"><?= $i++; ?></th>
              <th scope="row"><?= $category['id']; ?></th>
              <td><?= $category['title'] ?></td>
              <td> 
                <?=  Html::a('Update', ['update','id' => $category['id']], ['class' => 'btn btn-update']);  ?>
                <button id="<?= $category['id'] ?>" class="item btn btn-danger">Delete</button>
              </td>
          </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<script>
  $('.item').click(function(e){
    e.preventDefault();
    
    let index = this.parentNode.parentNode.rowIndex;
    let id = $(this).attr('id');

    $.ajax({
        url: 'delete',
        type: 'post',
        data: { 'id' : id },
        success: function(data){
          document.getElementById("categories").deleteRow(index);
        }
    });
  });

</script>