<?php
namespace backend\models;

use yii\base\Model;

class PromotionForm extends Model
{
    public $title;
    public $promotion_value;
    public $promotion_url;
    public $category_id;
    public $dtStart;
    public $dtEnd;

    public function rules()
    {
        return [
            [['title'], 'string', 'message' => 'Invalid field type'],
            [['title','promotion_value','category_id','dtStart','dtEnd'], 'required', 'message' => 'The value is required'],
            
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'promotion_value' => 'Value',
            'category_id' => 'Category',
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
}