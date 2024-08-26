<?php

namespace app\models\base;

/**
 * desc
 *
 * @property int $id
 * @property string $name
 *
 */
abstract class D123 extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%d123s}}';
    }

    public function rules()
    {
        return [
            'trim' => [['name'], 'trim'],
            'name_string' => [['name'], 'string'],
        ];
    }

    public function getRouting()
    {
        return $this->hasOne(\app\models\Routing::class, ['d123_id' => 'id'])->inverseOf('d123');
    }
}
