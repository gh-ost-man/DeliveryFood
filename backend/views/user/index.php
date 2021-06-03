<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use kartik\select2\Select2;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

$js = <<< JS
    $('.role').change(function(){
        var id = $(this).attr('name');
        var role = $(this).val();
        $.ajax({
            type: 'post',
            url: 'change-role',
            data: {
                'id' : id, 
                'role' : role
                },
            success: (function() {
                alert('Role is changed');
            })
        });
    });
JS;

$i = 1;
$this->registerJS($js);
?>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h4>Users</h4></div>
  <!-- Table -->
  <table class="table" id="users">
    <thead style="background-color: #22262A; color: white;">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($user_array as $user) : ?>
          <tr>
              <th scope="row"><?= $i++; ?></th>
              <th scope="row"><?= $user['id']; ?></th>
              <td><?= $user['username'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><?= $user['role'] ?></td>
              <td> 
                  <?=  Html::a('View', ['view','id' => $user['id']], ['class' => 'btn btn-info']);  ?>
                  <?=  Html::a('View order history', ['history','id' => $user['id']], ['class' => 'btn btn-success']);  ?>
                  <button id="<?= $user['id'] ?>" class="item btn btn-danger">Delete</button>
              </td>
          </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php if(count($user_array) != 0) :?>
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
                document.getElementById("users").deleteRow(index);
            }
        });
    });

</script>