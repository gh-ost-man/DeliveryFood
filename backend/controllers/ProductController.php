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
    use backend\models\ProductForm;
   
    class ProductController extends Controller
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
                'products' => Product::find()->all()
            ]);
        }

        public function actionCreate()
        {
            $model = new ProductForm;

            if($model->load(Yii::$app->request->post())){
                $tovar = new Product;
                $model->url_image = UploadedFile::getInstances($model, 'url_image');
               
                if ($imagePath = $model->upload()){
                    $tovar->title = $model->title;
                    $tovar->description = $model->description;
                    $tovar->category_id = $model->category_id;
                    $tovar->price = $model->price;
                    $tovar->url_image = json_encode($imagePath);
                    
                    if($tovar->save()){
                        Yii::$app->session->setFlash('success', 'The product saved into Database');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error saving product in database');
                }
                return $this->redirect(['product/index']);
            }

            $categories = Category::find()->all();
            foreach($categories as $category){
                $category_array[$category->id] = $category->title;
            }

            return $this->render('create', [
                'model' => $model,
                'categories' => $category_array,
                'initialPreview' => [],
                'initialConfig' => [],
                'product_id' => ''
            ]);
        }

        public function actionUpdate($id)
        {
            $model = new ProductForm;
            $product = Product::findOne(['id' => $id]);

            
            if($model->load(Yii::$app->request->post())){
                
                $model->url_image = UploadedFile::getInstances($model, 'url_image');

              

                $imagePath = $model->upload();
               
                if ($imagePath !== false){
                    $product->title = $model->title;
                    $product->description = $model->description;
                    $product->category_id = $model->category_id;
                    $product->price = $model->price;
                    
                    $image = json_decode($product->url_image, true);
                    $imagePath = array_merge($image, $imagePath);
                    $product->url_image = json_encode($imagePath);
                    
                    if( $product->url_image == '[]' ){
                        Yii::$app->session->setFlash('error', 'Select image');
                        return $this->redirect(['product/index']);
                    }
                    
                    if($product->save()){
                        Yii::$app->session->setFlash('success', 'The product is updated in the database');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error updating product in database');
                }
                return $this->redirect(['product/index']);
            }

            $model->title = $product->title;
            $model->description = $product->description;
            $model->price = $product->price;
            $model->category_id = $product->category_id;
 
            $categories = Category::find()->all();
            foreach($categories as $category) {
                $category_array[$category->id] = $category->title;
            }

            $images = json_decode($product->url_image, true);
           
            $initialPreview = [];
            $initialConfig = [];

            foreach($images as $image){
                $initialPreview[] = '../../' . $image;
                $initialConfig[] = [
                    'key' => $image
                ];
            }
        
            return $this->render('create', [
                'model' => $model,
                'categories' => $category_array,
                'initialPreview' => $initialPreview,
                'product_id' => $product->id,
                'initialConfig' => $initialConfig,
            ]);
        }
        public function actionFileDeleteProduct($id)
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;// формат відповіді
            
            if (isset($_POST['key'])){
                $image = $_POST['key'];
                
                unlink($image);
                
                $product = Product::findOne(['id' => $id]);
                $images = json_decode($product->url_image, true);
                $result = [];

                foreach($images as $value){
                    if($image != $value){
                        $result[] = $value;
                    }
                }
                
                $product->url_image = json_encode($result);
                $product->save();
            }
            return true;
        }

        public function actionDelete($id)
        {
            $product = Product::findOne(['id' => $id]);
            $images = json_decode($product->url_image, true);
          
            if($product->delete(['id' => $id])) {
                foreach($images as $image){
                    unlink($image);
                }

                Yii::$app->session->setFlash('success', "The product was removed from the database");
            } else {
                Yii::$app->session->setFlash('error', 'Error removing product from database');
            }

            return $this->redirect(['product/index']);
        }

        public function actionView($id)
        {
            $product = Product::findOne(['id' => $id]);
            $images = json_decode($product->url_image);
            $category = Category::findOne(['id' => $product->category_id]);

            return $this->render('view', [
                'product' => $product,
                'images' => $images,
                'category' => $category
            ]);
        }
    }