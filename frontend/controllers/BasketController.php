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
            $info=[
                'fname' => 'John',
                'lname' => 'Smith'
            ];
            setcookie('cookie', serialize($info), time() +(60*60*24*10));
            // var_dump(unserialize($_COOKIE['cookie'], ["allowed_classes" => false]));
            var_dump($_COOKIE['cookie']);
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
            if(isset($_COOKIE['cookie'])) {
                var_dump("TRUE");
                die();
            }
            else {
                var_dump("false");
                die();
            }
        }
    
        return $this->redirect('index');
    }

    public function actionUpdateItem()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// формат відповіді

        if($_POST != null) {
            $item_order = Item_Order::find()->where(['product_id' => $_POST['product_id']])->andWhere(['=','order_id', $_POST['order_id']])->one();
            $product = Product::find()->where(['id' => $item_order->product_id])->one();
            $item_order->count = $_POST['count'];
            $item_order->price = $product->price;
            $item_order->save();
           
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
                $items_order = Item_Order::find(['order_id' => $order->id])->all();
    
                if(count($items_order) == 0){
                    return $this->redirect('index');
                }
    
                $total = 0;
    
                foreach($items_order as $item){
                    $total += $item->price;
                }
    
                $order->status = 'booked';
                $order->total_price = $total;
                $order->address = $_POST['address'];
                $order->save();
    
               return $this->redirect('/site/index');
            }
        }

        return $this->redirect('index');
    }
    public function actionCancelOrder()
    {
        $idUser = Yii::$app->user->id;

        $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();

        if($order != null){
            Item_Order::deleteAll(['order_id' => $order->id]);
        }

        return $this->redirect('basket');
    }
}