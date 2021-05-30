<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\Url;

$this->title = ($model->title)? 'Update product': 'Create product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?= $this->title;?></h4>
    </div>
    <?php
        $form = ActiveForm::begin(['id' => 'product-create']);
    ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'title')->textInput(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'description')->textarea(['row' => '3'])->label('Опис товару'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'price')->textInput(['type' => 'number', 'min' => 0, 'step' => '0.1']); ?>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                    'language' => 'uk-Ua',
                    'data' => $categories,
                    'options' => ['placeholder' => 'Виберіть ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'discount')->textInput(['type' => 'number', 'min' => 0, 'step' => '1', 'name' => 'discount']); ?>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'url_image')->widget(FileInput::classname(), [
                    'options'=>[
                        'multiple'=>true,
                        'max' => 10,
                    ],
                    'pluginOptions' => [
                        'initialPreview'=> $initialPreview,
                        'initialPreviewConfig' => $initialConfig,
                        'initialPreviewAsData'=> true,
                        'showCaption' => false,
                        'showUpload' => false,
                        'overwriteInitial'=> false,
                        'removeClass' => 'btn btn-default pull-right',
                        'browseClass' => 'btn btn-primary pull-right',
                        'maxFileSize'=> 2800,
                        'deleteUrl' => Url::to(['/product/file-delete-product?id=' . $product_id]),
                        // 'deleteUrl' => Url::to(["/tovar/" . $tovar_id . "/file-delete-product"])
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