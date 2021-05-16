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
    use backend\models\Order;
    use backend\models\Item_Order;
    use backend\models\BasketForm;

    // use common\models\Product;
    // use common\models\Order;
    // use common\models\Item_Order;
    // use common\models\Promotion;

    class ShopController extends Controller
    {
        public int $i = 0;
        public function actionView($id)
        {
            $products = Product::find()->where(['category_id' => $id])->all();
            $category = Category::find()->where(['id' => $id ])->one();
            
            return $this->render('view', [
                'products' => $products,
                'category' => $category
            ]);

            return $this->render('view',[
                'products' => []
            ]);
        }   

        public function actionAbout()
        {
            return $this->render('about');
        }
    
    }
    