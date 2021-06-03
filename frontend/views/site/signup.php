<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
$this->title = 'About us';
?>

<section id="mu-reservation">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-reservation-area">
          <div class="mu-title">
            <span class="mu-subtitle" style="letter-spacing: 5px;">Register</span>
            <div></div>
            <i class="fa fa-spoon"></i>              
            <span class="mu-title-bar"></span>
          </div>
          <div class="mu-reservation-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione quidem autem iusto, perspiciatis, amet, quaerat blanditiis ducimus eius recusandae nisi aut totam alias consectetur et.</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">                       
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'Username']) ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">                        
                    <?= $form->field($model, 'email', [
                        'inputOptions' => [
                            'placeholder' => 'Email'
                        ]
                    ]) ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">                        
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">                        
                    <?= $form->field($model, 'address')->textInput(['placeholder' => 'Address']) ?>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'mu-readmore-btn', 'name' => 'signup-button']) ?>
                    </div>
                </div>
              </div>
              <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  