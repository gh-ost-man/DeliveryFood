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
use common\models\Order;
use common\models\Item_Order;

class BasketController extends Controller {
    
    public function actionIndex()
    {
        $idUser = Yii::$app->user->id;

        if($idUser) {
            $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();
    
            if($order != null) {
                $items_order = Item_Order::find()->where(['order_id' => $order->id])->all();
                $products = [];
    
                foreach($items_order as $item) {
                    $product = Product::find()->where(['id' => $item->product_id])->one();
    
                    $products[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product-> price,
                        'url_image' => json_decode($product->url_image, true),
                        'count' => $item->count,
                    ];
                } 
                return $this->render('index', [
                    'order' => $order,
                    'products' => $products,
                    'user' => User::find()->where(['id' => $idUser])->one()

                ]);
            }
        } else {
            if(isset($_COOKIE['delivery_food_basket'])){
                $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);

                foreach($info as $item){
                    $product = Product::find()->where(['id' => $item['product_id']])->one();
                    $products[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product-> price,
                        'url_image' => json_decode($product->url_image, true),
                        'count' => $item['count'],
                    ];
                }
    
                return $this->render('index', [
                    'order' => [],
                    'products' => $products,
                    'user' => User::find()->where(['id' => $idUser])->one()
    
                ]);
            }
        }

        return $this->render('index', [
            'order' => [],
            'products' => [],
            'user' => [],
            'user' => User::find()->where(['id' => $idUser])->one()
        ]);
    }
    public function actionAddItem($id)
    {
        $idUser = Yii::$app->user->id;
        
        if($idUser){
            $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();

            if($order == null ) 
            {
                $model = new Order;
                $model->user_id = $idUser;
                $model->status = 'new';
                
                if ($model->save()){
                    $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();
                }
            }
    
            $item_Order =  Item_Order::find()->where(['product_id' => $id])->andWhere(['=','order_id', $order->id])->one();
            $product = Product::find()->where(['id' => $id])->one();
                
            if($item_Order == null){
                $new_item_order = new Item_Order;
                $new_item_order->order_id = $order->id;
                $new_item_order->product_id = $id;
                $new_item_order->price = $product->price;
                $new_item_order->save();
            }
        } else {
            $info = [];
            if(!isset($_COOKIE['delivery_food_basket'])){
                $product = Product::find()->where(['id'=> $id])->one();

                $info[] = [
                    'product_id'=> $id,
                    'count' => 1,
                    'price' => $product->price
                ];

                setcookie('delivery_food_basket', serialize($info), time() + ( 60 * 60 * 24 * 10 )); //  time() +(60*60*24*10)) -> 10 days
                
                return $this->redirect('index');
            }
            $product = Product::find()->where(['id'=> $id])->one();

            $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);

            // чи є продукт в cookie
            $check = array_filter($info,function($item) use ($id){
                return $item['product_id'] == $id;
            });

            if(!$check) {
                $info[] = [
                    'product_id'=> $id,
                    'count' => 1,
                    'price' => $product->price
                ];

                setcookie('delivery_food_basket', serialize($info), time() + ( 60 * 60 * 24 * 10 )); //  time() +(60*60*24*10)) -> 10 days
            }
        }
    
        return $this->redirect('index');
    }

    public function actionUpdateItem()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// формат відповіді
        $idUser = Yii::$app->user->id;

        if($_POST != null) {
            if($idUser){
                $item_order = Item_Order::find()->where(['product_id' => $_POST['product_id']])->andWhere(['=','order_id', $_POST['order_id']])->one();
                $product = Product::find()->where(['id' => $item_order->product_id])->one();
                $item_order->count = $_POST['count'];
                $item_order->price = $product->price * $item_order->count;
                $item_order->save();
                
            } else {
                $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);
                
                for($i = 0; $i < count($info); $i++) {
                    if($info[$i]['product_id'] == $_POST['product_id']) {
                        $info[$i]['count'] = $_POST['count'];
                        break;
                    }
                }
                setcookie('delivery_food_basket', serialize($info), time() + ( 60 * 60 * 24 * 10 )); //  time() +(60*60*24*10)) -> 10 days
            }
            return false;
        }

        return true;
    }

    public function actionPay()
    {
        $idUser = Yii::$app->user->id;

        if($idUser)
        {
            $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();
    
            if($order != null) {
                $items_order = Item_Order::find()->where(['order_id' => $order->id])->all();
    
                if(count($items_order) == 0) return $this->redirect('index');
                
                $total = 0;
    
                foreach($items_order as $item){
                    $total += $item->price;
                }
    
                $order->status = 'booked';
                $order->total_price = $total;
                $order->address = $_POST['address'];
            
               if($order->save()) {
                    Yii::$app->session->setFlash('success', "Order removed from database");
               } 
            }
        } else {

            $model = new Order;
            $model->guest = $_POST['email'];
            $model->status = 'new';
            $model->save();
            
            $order = Order::find()->where(['guest' => $_POST['email']])->andWhere(['=','status','new'])->one();

            $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);

            foreach($info as $item){
                $product = Product::find()->where(['id' => $item['product_id']])->one();

                $new_item_order = new Item_Order;
                $new_item_order->order_id = $order->id;
                $new_item_order->product_id = $item['product_id'];
                $new_item_order->count = $item['count'];
                $new_item_order->price = $product->price * $new_item_order->count;
                $new_item_order->save();
            }

            $items_order = Item_Order::find()->where(['order_id' => $order->id])->all();

            $total = 0;
            foreach($items_order as $item){
                $total += $item->price;
            }

            $order->status = 'booked';
            $order->total_price = $total;
            $order->address = $_POST['address'];
            if($order->save()) {
                Yii::$app->session->setFlash('success', "Order booked");
                setcookie("delivery_food_basket", "", time() - ( 60 * 60 * 24 * 10 ));
            }
        }

        return $this->redirect('index');
    }
    public function actionCancelOrder()
    {
        $idUser = Yii::$app->user->id;

        if($idUser) {
            $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();

            if($order != null){
                Item_Order::deleteAll(['order_id' => $order->id]);
            }
        } else {

            if(isset($_COOKIE['delivery_food_basket'])) {
                setcookie("delivery_food_basket", "", time() - ( 60 * 60 * 24 * 10 ));
            }
        }

        return $this->redirect('index');
    }
}