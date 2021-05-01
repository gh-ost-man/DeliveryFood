<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;
    use backend\models\Category;
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
            $dataProvider = new ActiveDataProvider([
                'query' => Category::find(),
            ]);

            return $this->render('index',[
                'dataProvider' => $dataProvider
            ]);
        }

        public function actionCreate()
        {
            $model = new CategoryForm;
            if($model->load(Yii::$app->request->post()))
            {
           
                $discount = new Category;
                $discount->title = $model->title;
                
                if($discount->save())
                {
                    Yii::$app->session->setFlash('success', 'Category saved into DB');
                }
                else{
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

        public function actionDelete($id){
            $model = new CategoryForm; 
            $category = Category::findOne(['id' => $id]);
        
            if($category -> delete())
                {
                Yii::$app->session->setFlash('success', 'Category deleted from DB ');
                }
                else{
                    Yii::$app->session->setFlash('error', 'Error! Category NOT deleted from DB');
                }
            
            return  $this->redirect(['category/index']);
        }
}