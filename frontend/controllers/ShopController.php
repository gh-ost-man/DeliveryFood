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
    use backend\models\Order;
    use backend\models\Item_Order;
    // use common\models\Product;
    // use common\models\Order;
    // use common\models\Item_Order;
    // use common\models\Promotion;

    class ShopController extends Controller
    {
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

        public function actionBasket()
        {
            $idUser = Yii::$app->user->id;

            $order = Order::find()->where(['user_id' => $idUser])->one();

            if($order != null){
                $items_order = Item_Order::find(['order_id' => $order->id])->all();
                $products = [];
    
                foreach($items_order as $item) {
                    $product = Product::find()->where(['id' => $item->product_id])->one();
    
                    $products[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product-> price,
                        'url_image' => json_decode($product->url_image, true),
                        'count' => $item->count
                    ];
                } 
    
                return $this->render('basket', [
                    'order' => $order,
                    'items_order' => $items_order,
                    'products' => $products
                ]);
            }
            return $this->render('basket', [
                'order' => [],
                'items_order' => [],
                'products' => []
            ]);
        }

        public function actionAbout()
        {
            return $this->render('about');
        }

    }
    