<?php

namespace app\models\base;

/**
 * user account
 *
 * @property int $id
 * @property string $name account name
 *
 */
abstract class Account extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%accounts}}';
    }

    public function rules()
    {
        return [
            'trim' => [['name'], 'trim'],
            'required' => [['name'], 'required'],
            'name_string' => [['name'], 'string', 'max' => 40],
        ];
    }

    public function getE123()
    {
        return $this->hasOne(\app\models\E123::class, ['account_id' => 'id'])->inverseOf('account');
    }

    public function getE1232()
    {
        return $this->hasOne(\app\models\E123::class, ['account_2_id' => 'id'])->inverseOf('account_2');
    }

    public function getE1233()
    {
        return $this->hasOne(\app\models\E123::class, ['account_3_id' => 'id'])->inverseOf('account_3');
    }
}
