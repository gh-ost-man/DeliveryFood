<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;

    use backend\models\Order;
    use backend\models\Item_Order;
    use common\models\User;
    use backend\models\Product;
   
    class OrderController extends Controller
    {
        public function actionIndex()
        {
            $users = [];
            $orders = Order::find()->all();
            foreach($orders as $order){
                $users[$order->user_id] = User::find()->where(['id' => $order->user_id])->one();
            }

            return $this->render('index',[
                'orders' => $orders,
                'users' => $users
            ]);
        }
        public function actionOrder($id)
        {
            $order = Order::find()->where(['id' => $id])->one();
            $items_order = Item_Order::findAll(['order_id' => $id]);
            $user = User::find()->where(['id' => $order->user_id])->one();

            $items = [];

            foreach($items_order as $item) {
                $product = Product::find()->where(['id'=> $item->product_id])->one();
                $items[] =[
                    'id' => $item->id,
                    'product' => $product->title,
                    'price' => $item->price,
                    'count' => $item->count
                ];
            }
            return $this->render('order',[
                'order' => $order,
                'items_order' => $items,
                'user' => $user
            ]);
        }

        public function actionDelete($id)
        {
            $order = Order::findOne(['id' => $id]);

            if($order->delete(['id' => $id])){
                Yii::$app->session->setFlash('success', "Order removed from database");
            } else {
                Yii::$app->session->setFlash('error', 'Error removing order from database');
            }

            return $this->redirect(['order/index']);
        }
    }