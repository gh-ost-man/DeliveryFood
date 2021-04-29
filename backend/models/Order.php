<?php 
    namespace backend\models;

    use Yii;
    use \yii\db\ActiveRecord;

    /**
     * @property int $id
     * @property DateTime $date_order
     * @property int $user_id
     * @property float $total_price
     * @property string $address
     *
     */
    class Order extends ActiveRecord
    {
        public static function tableName()
        {
            return 'orders';
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