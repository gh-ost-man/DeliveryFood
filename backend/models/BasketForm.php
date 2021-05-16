<?php
namespace backend\models;

use yii\base\Model;

class BasketForm extends Model 
{
    public $user_id; // user
    public $email;   // guest
    public $address;
    
    public function rules()
    {
        return[];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'address' => 'Address',
        ];
    }
}