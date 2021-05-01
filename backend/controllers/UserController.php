<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;

    use common\models\User;
    use backend\models\Order;
    use backend\models\Item_Order;
    use backend\models\Product;
   
    class UserController extends Controller
    {
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

        
            return  $this->render('index', [
                'user_array' => $user_array,
                'role_array' => $role_array
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
        public function actionDelete($id)
        {
            $user = User::findOne(['id' => $id]);
          
            if($user->delete(['id' => $id])) {
                Yii::$app->session->setFlash('success', "User: < {$user->username} > removed from Database");
                Yii::$app->AuthManager->revokeAll($id);
            } else {
                Yii::$app->session->setFlash('error', 'Error deleting user from Database');
            }
            return $this->redirect(['user/index']);
        }
    }