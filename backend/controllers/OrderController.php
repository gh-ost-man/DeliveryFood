<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;

    use common\models\Order;
    use common\models\Item_Order;
    use common\models\User;
    use common\models\Product;
   
    class OrderController extends Controller
    {
        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => [],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin','owner','manager'],
                        ]
                    ],
                ],
            ];
        }
        public function actionIndex()
        {
            $users = [];
            $orders = Order::find()->all();

            $nodesOnPage = 10;
            $page = 1;
            $start_page = 1;
            $end_page = 1;
            $count = count($orders);
            
            $page = (isset($_GET['page']))? $_GET['page'] : 1;
            $from = ($page - 1) * $nodesOnPage;
           
            if($page >= 10){
                $start_page = $page - 5;
                $end_page = (ceil( $count / $nodesOnPage) > $page + $nodesOnPage)? $page + $nodesOnPage: ceil( $count / $nodesOnPage);
            }else{
                $start_page = 1;
                $end_page =(ceil($count / $nodesOnPage) > 10) ? 10 : ceil($count / $nodesOnPage);
            }

            foreach($orders as $order){
                if(isset($order->user_id)){
                    $users[$order->user_id] = User::find()->where(['id' => $order->user_id])->one();
                } else {
                    $users[$order->guest] = $order->guest;
                }
            }

            return $this->render('index',[
                'orders' => Order::find()->offset($from)->limit($nodesOnPage)->all(),
                'users' => $users,
                'start_page' => $start_page,
                'end_page' => $end_page,
                'page' => $page
            ]);
        }
        public function actionOrder($id)
        {
            $order = Order::find()->where(['id' => $id])->one();
 
            if(!$order) {
                return $this->redirect('index');
            }
            
            $items_order = Item_Order::findAll(['order_id' => $id]);
            $user = User::find()->where(['id' => $order->user_id])->one();
            $guest = $order->guest;
            $items = [];
            $status = '';

            foreach($items_order as $item) {
                $product = Product::find()->where(['id'=> $item->product_id])->one();
                $items[] =[
                    'id' => $item->id,
                    'product' => $product->title,
                    'product_price' => $product->price,
                    'price' => $item->price,
                    'count' => $item->count
                ];
            }

            $status = ($user)? 'user' : 'guest';

            return $this->render('order',[
                'order' => $order,
                'items_order' => $items,
                'user' => $user,
                'guest' => $guest,
                'status' => $status
            ]);
        }

        public function actionDelete()
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// формат відповіді

            if($_POST) {
                $id = $_POST['id'];
                $order = Order::findOne(['id' => $id]);
    
                if($order->delete(['id' => $id])){
                    return false;
                } else {
                    Yii::$app->session->setFlash('error', 'Error removing order from database');
                    return $this->redirect('index');
                }
            }
        }
    }