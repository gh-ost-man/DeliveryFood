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
use common\models\Promotion;

class BasketController extends Controller {

    private function getTotalPrice($id = null, $items = null) {
        $discount = 0;
        $total = 0;
        $cart = [];
        $cnt = 0;
        $tovars= [];

        $promotion = Promotion::find()
        ->where(['>' , 'dtEnd', date('Y-m-d')])
        ->andWhere(['<=', 'dtStart', date('Y-m-d'),])
        ->one();


        if($id) {
            $items_order = Item_Order::find()->where(['order_id' => $id])->all();
            
            if($promotion != null) {
                foreach($items_order as $item) {
                    for($i = 0; $i < $item->count; $i++) {
                        $cart[] = $item->product_id;
                    }
                }

                foreach($cart as $id) {
                    $tovar = Product::find()->where(['id' => $id])->one();
    
                    if($tovar->category_id == $promotion->category_id) {
                        $cnt++;
                        if($cnt == ($promotion->promotion_value + 1)) {
                            $cnt = 0;
                            $discount += $tovar->price;
                        } else {
                            $tovars[] = $tovar;
                        }
                    } else {
                        $tovars[] = $tovar;
                    }
                }
              
                foreach($tovars as $item){
                    if($item['discount'] != null) {
                        $total += $item['price'] - $item['discount'];
                        $discount += $item['discount'];
                    } else {
                        $total += $item['price'];
                    }
                }
            } else {
                foreach($items_order as $item) {
                    $total += $item->price;
                }
            }
    
            return ['total' => $total, 'discount' => $discount];
        } else {
            // $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);
            
            if($promotion != null) {
                foreach($items as $item) {
                    for($i = 0; $i < $item['count']; $i++) {
                        $cart[] = $item['product_id'];
                    }
                }
    
                foreach($cart as $id) {
                    $tovar = Product::find()->where(['id' => $id])->one();
                   
                    if($tovar->category_id == $promotion->category_id) {
                        $cnt++;
                      
                        if($cnt == ($promotion->promotion_value + 1)) {
                            $cnt = 0;
                            $discount += $tovar->price;
                        } else {
                            $tovars[] = $tovar;
                        }
                    } else {
                        $tovars[] = $tovar;
                    }
                }
                foreach($tovars as $item){
                    if($item['discount'] != null) {
                        $total += $item['price'] - $item['discount'];
                        $discount += $item['discount'];
                    } else {
                        $total += $item['price'];
                    }
                }
    
            } else {
                foreach($items as $item) {
                    $total += $item['price'];
                }
            }
    
            return ['total' => $total, 'discount' => $discount];
        }
    }

    public function actionIndex()
    {
        $idUser = Yii::$app->user->id;

        $promotions = Promotion::find()->where(['>' , 'dtEnd', date('Y-m-d')])->andWhere(['!=','category_id', 'NULL'])->one();
        if($idUser) {
            
            $order = Order::find()->where(['user_id' => $idUser])->andWhere(['=','status','new'])->one();
            $total = 0;
            $discount = 0;
            $cart = [];
           
            if($order != null) {
                $items_order = Item_Order::find()->where(['order_id' => $order->id])->all();
                $products = [];

                $total = $this->getTotalPrice($order->id)['total'];
                $discount = $this->getTotalPrice($order->id)['discount'];

                foreach($items_order as $item) {
                    $product = Product::find()->where(['id' => $item->product_id])->one();
                  
                    $products[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product-> price,
                        'url_image' => json_decode($product->url_image, true),
                        'count' => $item->count,
                        'discount' => $product->discount
                    ];
                } 

                return $this->render('index', [
                    'order' => $order,
                    'products' => $products,
                    'user' => User::find()->where(['id' => $idUser])->one(),
                    'total_sum' => $total,
                    'discount_sum' => $discount
                ]);
            }
        } else {
            if(isset($_COOKIE['delivery_food_basket'])){
                $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);

              
                foreach($info as $item){
                    $product = Product::find()->where(['id' => $item['product_id']])->one();

                    if($product!=null) {
                        $products[] = [
                            'id' => $product->id,
                            'title' => $product->title,
                            'price' => $product-> price,
                            'url_image' => json_decode($product->url_image, true),
                            'count' => $item['count'],
                            'discount' => $product->discount
                        ];
                    } else {
                        for($i = 0; $i<count($info); $i++) {
                            if($info[$i]['product_id'] == $item['product_id']) {
                                array_splice($info, $i, 1);
                                setcookie('delivery_food_basket', serialize($info), time() + ( 60 * 60 * 24 * 10 )); //  time() +(60*60*24*10)) -> 10 days
                                break;
                            }
                        }
                    }
                }
                $total = $this->getTotalPrice(null, $info)['total'];
                $discount = $this->getTotalPrice(null, $info)['discount'];

                return $this->render('index', [
                    'order' => [],
                    'products' => $products,
                    'user' => User::find()->where(['id' => $idUser])->one(),
                    'total_sum' => $total,
                    'discount_sum' => $discount
                ]);
            }
        }

        return $this->render('index', [
            'order' => [],
            'products' => [],
            'user' => User::find()->where(['id' => $idUser])->one(),
            "total_sum" => 0,
            'discount_sum' => 0
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
                    'product_id'=> $product->id,
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

                $items_order = Item_Order::find()->where(['order_id' => $_POST['order_id']])->all();
                
                return [
                    "total" => $this->getTotalPrice($_POST['order_id'])['total'],
                    'discount' => $this->getTotalPrice($_POST['order_id'])['discount'] 
                ];
                
            } else {
                $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);
                
                for($i = 0; $i < count($info); $i++) {
                    if($info[$i]['product_id'] == $_POST['product_id']) {
                        $info[$i]['count'] = $_POST['count'];
                        $info[$i]['price'] = (float)$info[$i]['price'] * (float)$info[$i]['count'];
                        
                       setcookie('delivery_food_basket', serialize($info), time() + ( 60 * 60 * 24 * 10 ));  //  time() +(60*60*24*10)) -> 10 days
                       
                       break;
                    }
                }

                return [
                    'total' => $this->getTotalPrice(null, $info)['total'],
                    'discount' => $this->getTotalPrice(null, $info)['discount']
                ];
            }
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
                $total = 0;
                $cart = []; 


                if(count($items_order) == 0) return $this->redirect('index');
                
                //Шукаєм діючу рукламу
                $promotion = Promotion::find()
                ->where(['>' , 'dtEnd', date('Y-m-d')])
                ->andWhere(['<=', 'dtStart', date('Y-m-d'),])
                ->one();

                if($promotion != null) {
                    //вибираєм всі продукти з замовлення
                    foreach($items_order as $item) {
                        for($i = 0; $i < $item->count; $i++) {
                            $cart[] = $item->product_id;
                        }
                    }
    
                    $i = 0;
                    $products= [];
                    foreach($cart as $id) {
                        $product = Product::find()->where(['id' => $id])->one();
    
                        if($product->category_id == $promotion->category_id) {
                            $i++;
                            if($i == ($promotion->promotion_value + 1)) {
                                $i = 0;
                            } else {
                                $products[] = $product;
                            }
                        } else {
                            $products[] = $product;
                        }
                    }
        
                    foreach($products as $item){
                        if($item['discount'] != null) {
                            $total += $item['price'] - $item['discount'];
                        } else {
                            $total += $item['price'];
                        }
                    }

                } else {
                    foreach($items_order as $item) {
                        $total += $item->price;
                    }
                }


                $order->status = 'booked';
                $order->total_price = $total;
                $order->address = $_POST['address'];
            
                if($order->save()) {
                    Yii::$app->session->setFlash('success', "Order booked");
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

    public function actionDeleteItem()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// формат відповіді

        if ($_POST != null) {
            if(Yii::$app->user->id) {
                $order = Order::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['=','status','new'])->one();

                $item_order = Item_Order::find()
                ->where(['order_id' => $order->id])
                ->andWhere(['product_id' => $_POST['id']])->one()
                ->delete();

                if(count(Item_Order::find()->where(['order_id' => $order->id])->all()) == 0) {
                    $order->delete();
                }
                return [
                    "total" => $this->getTotalPrice($order->id)['total'],
                    'discount' => $this->getTotalPrice($order->id)['discount'] 
                ];

            } else {
                if(isset($_COOKIE['delivery_food_basket'])) {
                    $info = unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);

                    for($i = 0; $i<count($info); $i++) {
                        if($info[$i]['product_id'] == $_POST['id']) {
                            array_splice($info, $i, 1);
                            break;
                        }
                    }
                    if(count($info) == 0) {
                        setcookie("delivery_food_basket", "", time() - ( 60 * 60 * 24 * 10 ));
                    } else {
                        setcookie('delivery_food_basket', serialize($info), time() + ( 60 * 60 * 24 * 10 )); //  time() +(60*60*24*10)) -> 10 days
                    }

                    return [
                        'total' => $this->getTotalPrice(null, $info)['total'],
                        'discount' => $this->getTotalPrice(null, $info)['discount']
                    ];
                }
            }
        }
        return true;
    }

    public function getCart():array {
        if(isset($_COOKIE['delivery_food_basket'])){
            return unserialize($_COOKIE['delivery_food_basket'], ["allowed_classes" => false]);
        }
    }
}