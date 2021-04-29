<?php
namespace backend\models;

use yii\base\Model;




class PromotionForm extends Model
{
   public string $title;
   public string $type;
   public int $promotion_value;
   public string $promotion_image;
   public int $category_id;
   public int $product_id;
   public DateTime $dtStart;
   public DateTime $dtEnd;

    public function rules()
    {
        return [
            [['title', 'description'], 'string', 'message' => 'Invalid field type'],
            [['title', 'description','promotion_value','type', 'dtStart','dtEnd'], 'required', 'message' => 'The value is required'],
            [['promotion_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'promotion_value' => 'Promotion value',
            'category_id' => 'Category',
            'product_id' => 'Product',
            'dtStart' => 'Start date',
            'dtEnd' => 'End date'
        ];
    }
}