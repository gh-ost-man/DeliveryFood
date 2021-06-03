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
    use common\models\Order;
    use common\models\Item_Order;
    use frontend\models\SignupForm;

    class ShopController extends Controller
    {
        public function actionView($id)
        {
            $category = Category::find()->where(['id' => $id ])->one();
            $products = Product::find()->where(['category_id' => $id])->all();
            $promotions = Promotion::find()
            ->where(['>' , 'dtEnd', date('Y-m-d')])
            ->andWhere(['<=', 'dtStart', date('Y-m-d'),])
            ->andWhere(['=','category_id', $category->id])
            ->one();

            $cart = [];

            $idUser = Yii::$app->user->id;
            if($idUser) {
                $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();
    
                if($order!= null) {
                    $items_order = Item_Order::find()->where(['order_id' => $order->id])->all();
                    foreach($items_order as $item) {
                        $id = $item['product_id'];
                        $cart["prod-$id"] = $item;
                    }
                }
    
            } else {
                if(isset($_COOKIE['delivery_food_basket'])) {
                    $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);
                    foreach($info as $item) {
                        $id = $item['product_id'];
                        $cart["prod-$id"] = $item;
                    }
                }
            }

            return $this->render('view', [
                'category' => $category,
                'products' => $products,
                'promotions' => $promotions,
                'cart' => $cart
            ]);
        }   
    
        public function actionItem($id) 
        {
            $idUser = Yii::$app->user->id;
            $cart = [];
            
            if($idUser) {
                $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();
    
                if($order!= null) {
                    $items_order = Item_Order::find()->where(['order_id' => $order->id])->all();
                    foreach($items_order as $item) {
                        $id_prod = $item['product_id'];
                        $cart["prod-$id_prod"] = $item;
                    }
                }
    
            } else {
                if(isset($_COOKIE['delivery_food_basket'])) {
                    $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);
                    foreach($info as $item) {
                        $id_prod = $item['product_id'];
                        $cart["prod-$id_prod"] = $item;
                    }
                }
            }

            return $this->render('item', [
                'product' => Product::find()->where(['id' => $id])->one(),
                'cart' => $cart
            ]);
        }

        public function actionAbout()
        {
            return $this->render('about');
        }

        public function actionProfile() 
        {
            $user = User::find()->where(['id' => Yii::$app->user->id])->one();

            $model = new SignupForm();
            $model->username = $user->username;
            $model->email = $user->email;
            $model->address = $user->address;
            $model->password = '';
            
            if ($model->load(Yii::$app->request->post())) {

                $user->username = $model->username;
                $user->email = $model->email;
                $user->password = $model->password;
                $user->address = $model->address;
                if($user->save()){
                    $model->password = '';
                    Yii::$app->session->setFlash('success', 'Data updated.');
                    return $this->render('profile',[
                        'model' => $model
                    ]);
                }
            }
    

            return $this->render('profile',[
                'model' => $model
            ]);
        }
    }
    