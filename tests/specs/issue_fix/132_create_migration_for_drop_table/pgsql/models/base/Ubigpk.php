<?php

namespace app\models\base;

/**
 *
 *
 * @property integer $id
 * @property string $name
 * @property string $f
 * @property string $g5
 * @property string $g6
 * @property string $g7
 * @property double $dp
 *
 */
abstract class Ubigpk extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%ubigpks}}';
    }

    public function rules()
    {
        return [
            'trim' => [['name', 'f', 'g5', 'g6', 'g7'], 'trim'],
            'name_string' => [['name'], 'string', 'max' => 150],
            'f_string' => [['f'], 'string'],
            'g5_string' => [['g5'], 'string'],
            'g6_string' => [['g6'], 'string'],
            'g7_string' => [['g7'], 'string'],
            'dp_double' => [['dp'], 'double'],
        ];
    }
}
