<?php 
    namespace common\models;

    use Yii;
    use \yii\db\ActiveRecord;

    /**
     * 
     * @property int $id
     * @property string $title
     */
    class Category extends ActiveRecord
    {
        public static function tableName()
        {
            return 'categories';
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