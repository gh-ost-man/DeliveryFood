<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\Url;

$this->title = 'Promotion';
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?= $this->title;?></h4>
    </div>
    <?php
        $form = ActiveForm::begin(['id' => 'promotion-create']);
    ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'title')->textInput(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'promotion_value')->textInput(['type' => 'number', 'min' => 0, 'max' => 100, 'step' => '1']); ?>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                    'language' => 'uk-Ua',
                    'data' => $categories,
                    'options' => ['placeholder' => 'Select ...', 'name' => 'category_id' ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'dtStart')->textInput(['type' => 'date']); ?>
            </div>
        </div>
          
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'dtEnd')->textInput(['type' => 'date']); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'promotion_url')->widget(FileInput::classname(), [
                    'options'=>[
                        'multiple'=>true,
                        'max' => 1,
                    ],
                    'pluginOptions' => [
                        'initialPreview'=> $initialPreview,
                        'initialPreviewConfig' => $initialConfig,
                        'initialPreviewAsData'=> true,
                        'showCaption' => false,
                        'showUpload' => false,
                        'overwriteInitial'=> false,
                        'value' => $model->promotion_url,
                        'removeClass' => 'btn btn-default pull-right',
                        'browseClass' => 'btn btn-primary pull-right',
                        'maxFileSize'=> 2800,
                        'deleteUrl' => Url::to(['/promotion/file-delete-promotion?id=' . $promotion_id]),
                    ]
                ]);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success btn-block m-2']); ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
