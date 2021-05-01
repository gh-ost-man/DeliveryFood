<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\widgets\FileInput;

use yii\widgets\ActiveForm;

$this->title = 'Category';
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?=$this->title;?></h4>
    </div>
    <?php
    $form=ActiveForm::begin(['id' => 'category-create']);
    ?>
     <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
            <p>Title</p>
                <?=$model->title?>
            </div>
        </div>   
    </div>
    <?php
        ActiveForm::end();
    ?>
</div>