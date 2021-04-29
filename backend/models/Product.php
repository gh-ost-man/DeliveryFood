<?php 
    namespace backend\models;

    use Yii;
    use \yii\db\ActiveRecord;

    /**
     * 
     * @property int $id
     * @property string $title
     * @property string $description
     * @property string $url_image
     * @property float $price
     * @property int $category_id
     */
    class Product extends ActiveRecord
    {
        public static function tableName()
        {
            return 'products';
        }

        public function rules()
        {
            return [];
        }

        public function attributeLabel()
        {
            return [];
        }
    }