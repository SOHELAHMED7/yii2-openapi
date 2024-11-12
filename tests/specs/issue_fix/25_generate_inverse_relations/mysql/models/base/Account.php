<?php

namespace app\models\base;

/**
 * Account
 *
 * @property int $id
 * @property string $name account name
 * @property string $paymentMethodName
 * @property int $user_id
 * @property int $user2_id
 * @property int $user3
 *
 * @property \app\models\User $user
 * @property \app\models\User $user2
 * @property \app\models\User $user3
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
            'trim' => [['name', 'paymentMethodName'], 'trim'],
            'required' => [['name'], 'required'],
            'user_id_integer' => [['user_id'], 'integer'],
            'user_id_exist' => [['user_id'], 'exist', 'targetRelation' => 'User'],
            'user2_id_integer' => [['user2_id'], 'integer'],
            'user2_id_exist' => [['user2_id'], 'exist', 'targetRelation' => 'User2'],
            'user3_integer' => [['user3'], 'integer'],
            'user3_exist' => [['user3'], 'exist', 'targetRelation' => 'User3'],
            'name_string' => [['name'], 'string', 'max' => 128],
            'paymentMethodName_string' => [['paymentMethodName'], 'string'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(\app\models\User::class, ['id' => 'user_id']);
    }

    public function getUser2()
    {
        return $this->hasOne(\app\models\User::class, ['id' => 'user2_id']);
    }

    public function getUser3()
    {
        return $this->hasOne(\app\models\User::class, ['id' => 'user3']);
    }
}
