<?php 
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\filters\AccessControl;

    use backend\models\Promotion;
    use backend\models\PromotionForm;
    use common\models\Category;
    use common\models\Product;
   
    class PromotionController extends Controller
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
                'promotions' => Promotion::find()->all()
            ]);
        }

        public function actionView($id)
        {
            $promotion = Promotion::findOne(['id' => $id]);
            $images = json_decode($promotion->promotion_url);
            $category = Category::findOne(['id' => $promotion->category_id]);
            $product = Product::findOne(['id' => $promotion->product_id]);

            return $this->render('view', [
                'promotion' => $promotion,
                'images' => $images,
                'category' => $category,
                'product' => $product
            ]);
        }

        public function actionCreate()
        {
            $model = new PromotionForm;

            if($model->load(Yii::$app->request->post())){
                $promotion = new Promotion;
                $model->promotion_url = UploadedFile::getInstances($model, 'promotion_url');
                if ($imagePath = $model->upload()){
                    $promotion->title = $model->title;
                    $promotion->type = $model->type;
                    $promotion->promotion_value = $model->promotion_value;
                    $promotion->category_id = $model->category_id;
                    $promotion->product_id = $model->product_id;
                    $promotion->dtStart = $model->dtStart;
                    $promotion->dtEnd = $model->dtEnd;
                    $promotion->promotion_url = json_encode($imagePath);
                    
                    if($promotion->save()){
                        Yii::$app->session->setFlash('success', 'Promotion saved into database');
                    }
                   
                } else {
                    Yii::$app->session->setFlash('error', 'Error saving promotion in database');
                }
                return $this->redirect(['promotion/create']);
            }

            $categories = Category::find()->all();
            foreach($categories as $category){
                $category_array[$category->id] = $category->title;
            }

            $products = Product::find()->all();
            $product_array = [];
            foreach($products as $product){
                $product_array[$product->id] = $product->title;
            }

            return $this->render('create', [
                'model' => $model,
                'types' => PromotionForm::getTypes(),
                'categories' => $category_array,
                'products' => $product_array,
                'initialPreview' => [],
                'initialConfig' => [],
                'promotion_id' => ''
            ]);
        }

        public function actionUpdate($id)
        {
            $model = new PromotionForm;
            $promotion = Promotion::findOne(['id' => $id]);

            if($model->load(Yii::$app->request->post())){
                $model->promotion_url = UploadedFile::getInstances($model, 'promotion_url');
                $imagePath = $model->upload();

              
                if ($imagePath !== false){
                    $promotion->title = $model->title;
                    $promotion->type = $model->type;
                    $promotion->promotion_value = $model->promotion_value;
                    $promotion->category_id = $model->category_id;
                    $promotion->product_id = $model->product_id;
                    $promotion->dtStart = $model->dtStart;
                    $promotion->dtEnd = $model->dtEnd;

                    if($imagePath){
                        $image = json_decode($promotion->promotion_url, true);
                        $imagePath = array_merge($image, $imagePath);
                        $promotion->promotion_url = json_encode($imagePath);
                    } 

                    if($promotion->promotion_url == '[]' ) {
                        Yii::$app->session->setFlash('error', 'Select image');
                        return $this->redirect(['promotion/'.$id.'update']);
                    }
                   
                    if($promotion->save() && $model->promotion_url !== ''){
                        Yii::$app->session->setFlash('success', 'Рекламу оновлено в БД');
                    }
                }  else {
                    Yii::$app->session->setFlash('error', 'Помилка оновлення реклами в БД');
                }
                return $this->redirect(['promotion/index']);
            }

            
            $model->title = $promotion->title;
            $model->type = $promotion->type;
            $model->promotion_value = $promotion->promotion_value;
            $model->category_id = $promotion->category_id;
            $model->product_id = $promotion->product_id;
            $model->dtStart = $promotion->dtStart;
            $model->dtEnd = $promotion->dtEnd;
            $images = json_decode($promotion->promotion_url, true);
           
            $initialPreview = [];
            $initialConfig = [];

            
            $categories = Category::find()->all();
            foreach($categories as $category){
                $category_array[$category->id] = $category->title;
            }

            $products = Product::find()->all();
            $product_array = [];
            foreach($products as $product){
                $product_array[$product->id] = $product->title;
            }

            foreach($images as $image){
                $initialPreview[] = '../../' . $image;
                $initialConfig[] = [
                    'key' => $image
                ];
            }
        
            return $this->render('create', [
                'model' => $model,
                'types' => PromotionForm::getTypes(),
                'categories' => $category_array,
                'products' => $product_array,
                'initialPreview' => $initialPreview,
                'initialConfig' => $initialConfig,
                'promotion_id' => $promotion->id
            ]);
        }

        public function actionFileDeletePromotion($id)
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// формат відповіді
            
            if (isset($_POST['key'])){
                $image = $_POST['key'];
                
                unlink($image);
                
                $promotion = Promotion::findOne(['id' => $id]);
                $images = json_decode($promotion->promotion_url, true);
                $result = [];

                foreach($images as $value){
                    if($image != $value){
                        $result[] = $value;
                    }
                }
                
                $promotion->promotion_url = json_encode($result);
                $promotion->save();
            }
            
            return true;
        }

        public function actionDelete($id)
        {
            $promotion = Promotion::findOne(['id' => $id]);
            $images = json_decode($promotion->promotion_url, true);
          
            if($promotion->delete(['id' => $id])) {
                foreach($images as $image){
                    unlink($image);
                }

                Yii::$app->session->setFlash('success', "Promotion: < {$promotion->title} > removed from Database");
            } else {
                Yii::$app->session->setFlash('error', 'Помилка видалення товару з БД');
            }

            return $this->redirect(['promotion/index']);
        }
    }