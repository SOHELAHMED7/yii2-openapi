<?php

namespace app\models\base;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property array $tags
 * @property array $tags_arbit
 * @property array $number_arr
 * @property array $number_arr_min_uniq
 * @property array $int_arr
 * @property array $int_arr_min_uniq
 * @property array $bool_arr
 * @property array $arr_arr_int
 * @property array $arr_arr_str
 * @property array $arr_arr_arr_str
 * @property array $arr_of_obj
 * @property User[] $user_ref_obj_arr
 * @property array $one_of_arr
 * @property array $one_of_arr_complex
 * @property array $one_of_from_multi_ref_arr
 *
 * @property array|\app\models\User[] $userRefObjArrNormal
 * @property array|\app\models\User[] $userRefObjArr
 */
abstract class Pet extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%pets}}';
    }

    public function rules()
    {
        return [
            'trim' => [['name'], 'trim'],
            'required' => [['name'], 'required'],
            'name_string' => [['name'], 'string'],
            'age_integer' => [['age'], 'integer'],
            'safe' => [['tags', 'tags_arbit', 'number_arr', 'number_arr_min_uniq', 'int_arr', 'int_arr_min_uniq', 'bool_arr', 'arr_arr_int', 'arr_arr_str', 'arr_arr_arr_str', 'arr_of_obj', 'user_ref_obj_arr', 'one_of_arr', 'one_of_arr_complex', 'one_of_from_multi_ref_arr'], 'safe'],
        ];
    }

    public function getUserRefObjArrNormal()
    {
        return $this->hasMany(\app\models\User::class, ['pet_id' => 'id']);
    }

    public function getUserRefObjArr()
    {
        return $this->hasMany(\app\models\User::class, ['pet_id' => 'id']);
    }
}
