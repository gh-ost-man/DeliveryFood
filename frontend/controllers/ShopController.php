<?php

    namespace frontend\controllers;
        
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;

    use common\models\Category;
    use common\models\Product;
    use common\models\User;
    use common\models\Promotion;

    class ShopController extends Controller
    {
        public function actionView($id)
        {
            $category = Category::find()->where(['id' => $id ])->one();
            $products = Product::find()->where(['category_id' => $id])->all();
            $promotions = Promotion::find()
            ->where(['>' , 'dtEnd', date('Y-m-d')])
            ->andWhere(['<=', 'dtStart', date('Y-m-d'),])
            ->one();

            return $this->render('view', [
                'category' => $category,
                'products' => $products,
                'promotions' => $promotions
            ]);
        }   

    
        public function actionItem($id) 
        {
            return $this->render('item', [
                'product' => Product::find()->where(['id' => $id])->one()
            ]);
        }

        public function actionAbout()
        {
            return $this->render('about');
        }
    }
    