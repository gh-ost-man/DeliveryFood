<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;
    
    use frontend\models\SignupForm;

    use common\models\User;
    use common\models\Order;
    use common\models\Item_Order;
    use common\models\Product;
   
    class UserController extends Controller
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
            $role = Yii::$app->AuthManager->Roles;
            $role_array = [];
            foreach($role as $key => $value){
                $role_array[$key] = $key; 
            }
           
            $users = User::find()->asArray()->all();
            
            $user_array = [];
            foreach($users as $user){
                if(array_keys(Yii::$app->AuthManager->getRolesByUser($user['id'])) != null){
                    $role = array_keys(Yii::$app->AuthManager->getRolesByUser($user['id']))[0];
                } else {
                    $role = '';
                }
                $user_array[] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $role 
                ];
            }            

            $nodesOnPage = 10;
            $page = 1;
            $start_page = 1;
            $end_page = 1;
            $count = count($users);
            
            $page = (isset($_GET['page']))? $_GET['page'] : 1;
            $from = ($page - 1) * $nodesOnPage;
           
            if($page >= 10){
                $start_page = $page - 5;
                $end_page = (ceil( $count / $nodesOnPage) > $page + $nodesOnPage)? $page + $nodesOnPage: ceil( $count / $nodesOnPage);
            }else{
                $start_page = 1;
                $end_page =(ceil($count / $nodesOnPage) > 10) ? 10 : ceil($count / $nodesOnPage);
            }
        
            return  $this->render('index', [
                'user_array' => $user_array,
                'role_array' => $role_array,
                'start_page' => $start_page,
                'end_page' => $end_page,
                'page' => $page
            ]);
        }

        public function actionView($id)
        {
            $role = Yii::$app->AuthManager->Roles;
            $role_array = [];
            foreach($role as $key => $value){
                $role_array[$key] = $key; 
            }
           
            $user = User::findOne(['id' => $id]);
            
            if(array_keys(Yii::$app->AuthManager->getRolesByUser($id)) != null){
                $role = array_keys(Yii::$app->AuthManager->getRolesByUser($id))[0];
            } else {
                $role = '';
            }
        
            return  $this->render('view', [
                'user' => $user,
                'role' => $role,
                'role_array' => $role_array
            ]);
        }

        public function actionChangeRole()
        {
            if ($_POST['id'] != '' && $_POST['role'] != ''){
                $auth = Yii::$app->authManager;
                
                if(array_keys(Yii::$app->AuthManager->getRolesByUser($_POST['id'])) != null){
                    $role_old = array_keys(Yii::$app->AuthManager->getRolesByUser($_POST['id']))[0];
    
                    $role_old = $auth->getRole($role_old);
                    Yii::$app->AuthManager->revoke($role_old, $_POST['id']);
                } 
                $role_new = $auth->getRole($_POST['role']);
                $auth->assign($role_new, $_POST['id']);
            }
            return false;
        }

        public function actionHistory($id)
        {

            $orders = Order::findAll(['user_id' => $id]);

            $history = [];
            foreach($orders as $order) {
                $user = User::find()->where(['id' => $order->user_id])->one();;
                $history[] = [
                    'id'=> $order->id,
                    'date_order'=> $order->date_order,
                    'status'=> $order->status,
                    'user_id'=> $order->user_id,
                    'user_username'=> $user->username,
                    'total_price'=> $order->total_price,
                    'address'=> $order->address,
                ];
            }

            return $this->render('history',[
                'history' => $history
            ]);
        }

        public function actionOrder($id)
        {
            $order = Order::find()->where(['id' => $id])->one();
            $items_order = Item_Order::findAll(['order_id' => $id]);
            
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
                'items_order' => $items
            ]);
        }
        public function actionDelete()
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// ???????????? ??????????????????

            if($_POST) {
                $id = $_POST['id'];
                $user = User::findOne(['id' => $id]);
                $current_user_id =  Yii::$app->user->id;
              
                if($user->delete(['id' => $id])) {
                    Yii::$app->AuthManager->revokeAll($id);
                    if($id == $current_user_id) {
                        Yii::$app->user->logout();
                        return $this->goHome();
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error deleting user from Database');
                    return $this->redirect('index');
                }
                return false;
            }
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
                $user->address = $model->address;
                $user->password = $model->password;
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