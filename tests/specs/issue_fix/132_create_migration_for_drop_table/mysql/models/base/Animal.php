<?php

/**
 * This file is generated by Gii, do not change manually!
 */

namespace app\models\base;

/**
 * This is the model class for table "the_animal_table_name".
 *
 * @property integer $id
 * @property string $name
 *
 */
abstract class Animal extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%the_animal_table_name}}';
    }

    public function rules()
    {
        return [
            'trim' => [['name'], 'trim'],
            'name_string' => [['name'], 'string', 'max' => 150],
        ];
    }
}
