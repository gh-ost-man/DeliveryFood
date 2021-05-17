<?php 
    namespace common\models;

    use Yii;
    use \yii\db\ActiveRecord;

    /**
     * @property int $id
     * @property int $order_id
     * @property int $product_id
     * @property int $count
     * @property float $price
     *
     */
    class Item_Order extends ActiveRecord
    {
        public static function tableName()
        {
            return 'items_order';
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