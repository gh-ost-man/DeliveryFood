<?php 
    namespace backend\models;

    use Yii;
    use \yii\db\ActiveRecord;

    /**
     * 
     * @property int $id
     * @property string $title
     * @property string $type
     * @property int $promotion_value
     * @property string $url_image
     * @property int $category_id
     * @property int $product_id
     * @property DateTime $dtStart
     * @property DateTime $dtEnd
     */
    class Promotion extends ActiveRecord
    {
        public static function tableName()
        {
            return 'promotions';
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