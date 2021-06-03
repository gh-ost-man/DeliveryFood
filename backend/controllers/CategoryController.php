<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;

    use common\models\Category;
    use common\models\Product;
    use backend\models\CategoryForm;
   
    class CategoryController extends Controller
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
            return $this->render('index',[
                'categories' =>Category::find()->asArray()->all()
            ]);
        }

        public function actionCreate()
        {
            $model = new CategoryForm;

            if($model->load(Yii::$app->request->post()))
            {
                $category = new Category;
                $category->title = $model->title;
                
                if($category->save())
                {
                    Yii::$app->session->setFlash('success', 'Category saved into DB');
                }
                else { 
                    Yii::$app->session->setFlash('error', 'Error! Category NOT saved into DB ');
                }
                
                return  $this->redirect(['category/index']);
            }
        
            return $this->render('create', [
                'model' => $model,    
                'initialPreview' => [],
                'initialConfig' => [],
                'category_id'=> '',
            ]);
        }

        public function actionUpdate($id){
            $model = new CategoryForm;

            $category = Category::findOne(['id' => $id]);

            if($model->load(Yii::$app->request->post()))
            {
                $category->title = $model->title;

                if($category->save())
                {
                    Yii::$app->session->setFlash('success', 'Товар збережено в БД ');
                }
                else{
                    Yii::$app->session->setFlash('error', 'Помилка НЕ збережено в БД ');
                }
            
                return  $this->redirect(['category/index']);
            
            }

            $model->title = $category->title;   
            $initialPreview = [];
            $initialConfig = [];
        
            return $this->render('create', [
                'model' => $model,        
                'initialPreview' => $initialPreview,
                'category_id'=> $category->id,
                'initialConfig' =>  $initialConfig,
            ]);
        }

        public function actionDelete(){
            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// формат відповіді
            
            if($_POST) {
                $model = new CategoryForm; 
                $id = $_POST['id'];
                $category = Category::findOne(['id' => $id]);
                $products = Product::find()->where(['category_id' => $id])->all();
            
                if($category->delete()){

                    foreach($products as $product) {
                        $images = json_decode($product->url_image, true);
                        foreach($images as $image){
                            unlink($image);
                        }
                    }
                    return  false;
                }
                else{
                    Yii::$app->session->setFlash('error', 'Error! Category NOT deleted from DB');
                    return $this->redirect('index');
                }
            }
        }
    }