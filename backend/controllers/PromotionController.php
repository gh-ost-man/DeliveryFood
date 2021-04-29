<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;

    use backend\models\Promotion;
   
    class PromotionController extends Controller
    {
        public function actionIndex()
        {
            return $this->render('index');
        }
    }