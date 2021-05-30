<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\FileInput;



$this->title = ($model->title)? 'Update category' :  'Create category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?=$this->title;?></h4>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'category-create']); ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?=$form->field($model, 'title')->textInput();?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton('Save',['class'=>'btn btn-success btn-block]']) ?>
            </div>
        </div>
    </div>
    <?php  ActiveForm::end(); ?>
</div>