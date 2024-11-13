<?php

/**
 * This file is generated by Gii, do not change manually!
 */

namespace app\models\base;

/**
 * This is the model class for table "deliveries".
 *
 * @property int $id
 * @property string $title
 *
 */
abstract class Delivery extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%deliveries}}';
    }

    public function rules()
    {
        return [
            'trim' => [['title'], 'trim'],
            'title_string' => [['title'], 'string'],
        ];
    }

    public function getWebhook()
    {
        return $this->hasOne(\app\models\Webhook::class, ['redelivery_of' => 'id'])->inverseOf('redelivery_of');
    }
}
