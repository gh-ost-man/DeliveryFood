<?php
namespace backend\models;

use yii\base\Model;

class ProductForm extends Model 
{
    public $title;
    public $description;
    public $url_image;
    public $category_id;
    public $price;
    
    public function rules()
    {
        return[
            [['title', 'description'], 'string', 'message' => 'Invalid field type'],
            [['category_id'], 'integer', 'min' => 0],
            [['price'], 'double', 'min' => 0],
            [['title', 'description', 'category_id', 'price'], 'required', 'message' => 'The value is required'],
            [['url_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
        ]; 
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'category_id' => 'Category',
            'price' => 'Price'
        ];
    }
}