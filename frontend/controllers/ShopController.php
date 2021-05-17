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

    class ShopController extends Controller
    {
        public function actionView($id)
        {
            $category = Category::find()->where(['id' => $id ])->one();
            $products = Product::find()->where(['category_id' => $id])->all();
            
            return $this->render('view', [
                'category' => $category,
                'products' => $products
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
    