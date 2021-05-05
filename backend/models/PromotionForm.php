<?php
namespace backend\models;

use yii\base\Model;

class PromotionForm extends Model
{
    public $title;
    public $type;
    public $promotion_value;
    public $promotion_url;
    public $category_id;
    public $product_id;
    public $dtStart;
    public $dtEnd;

    const TYPES = ['n+1' => 'n+1','discount' => 'discount'];

    public function rules()
    {
        return [
            [['title'], 'string', 'message' => 'Invalid field type'],
            [['title','promotion_value','type','category_id','promotion_url'], 'required', 'message' => 'The value is required'],
            
            // [['promotion_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'type' => 'Type',
            'promotion_value' => 'Value',
            'category_id' => 'Category',
            'product_id' => 'Product',
            'dtStart' => 'Start date',
            'dtEnd' => 'End date'
        ];
    }
    public function upload()
    {
        if($this->validate()){
            $result = [];

            foreach($this->promotion_url as $file){
                $fileName = md5(microtime() . rand(0, 1000));
                $imagePath = '../../images/promotion/' . $fileName . '.' . $file->extension;
                $file->saveAs($imagePath);
                $result[] = $imagePath;
            }
            return $result;
        }
        return false;
    }

    static function  getTypes()
    {
        return self::TYPES;
    }
}