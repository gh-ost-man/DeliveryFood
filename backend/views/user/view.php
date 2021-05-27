<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;

    use kartik\select2\Select2;

    $this->title = 'Users';
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $user['email'];

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
  
    $this->registerJS($js);

    $i = 1;
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading"><h4>View</h4></div>
    <div  class="panel-body">
        <p class="h3" style="font-weight: 600;">Id: <?= $user['id']?></p>
        <p class="h3" style="font-weight: 600;">Username: <?= $user['username']?></p>
        <p class="h3" style="font-weight: 600;">Email: <?= $user['email']?></p>
        <div>
            <label class="h3">Role</label> 
            <?= Select2::widget([
                'name' => $user['id'],
                'data' => $role_array,
                'value' =>$role,
                'options' => [
                    'class' => 'role',
                    'width' => '50px',
                    'placeholder' => 'Select provinces ...',
                'multiple' => false
                ],
            ]); ?>
        </div>
    </div>
</div>