<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign in';
?>
<section id="mu-reservation">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mu-reservation-area">
          <div class="mu-title">
            <span class="mu-subtitle" style="letter-spacing: 5px;">Sign In</span>
            <div></div>
            <i class="fa fa-spoon"></i>              
            <span class="mu-title-bar"></span>
          </div>
          <div class="mu-reservation-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione quidem autem iusto, perspiciatis, amet, quaerat blanditiis ducimus eius recusandae nisi aut totam alias consectetur et.</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">                       
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'email@gmail.com']) ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">                        
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'password']) ?>
                  </div>
                </div>
                <div class="col-md-6 text-white">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= Html::submitButton('Sign in', ['class' => 'mu-readmore-btn', 'name' => 'login-button']) ?>
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