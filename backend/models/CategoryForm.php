<?php

namespace backend\models;

use yii\base\Model;

class CategoryForm extends Model
{
    public $title;
    
    public function rules()
    {
        return [
            [['title',], 'string', 'message' => 'Invalid field type'],
            [['title',], 'required', 'message' => 'The value is required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title'
        ];
    }
}