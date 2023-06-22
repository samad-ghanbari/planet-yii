<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_users".
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $national_id
 * @property int $province_id
 * @property string|null $province
 * @property int $office_id
 * @property string|null $office
 * @property int $default_area
 * @property string $password
 */
class ViewUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_users';
    }
    public static function primaryKey()
    {
        return ['id'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'default_area'], 'integer'],
            [['name', 'lastname', 'national_id', 'province_id', 'office_id', 'default_area', 'password'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['lastname', 'province', 'office'], 'string', 'max' => 200],
            [['national_id'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'national_id' => 'National ID',
            'province_id' => 'Province ID',
            'province' => 'Province',
            'office_id' => 'Office ID',
            'office' => 'Office',
            'default_area' => 'Default Area',
            'password' => 'Password',
        ];
    }
}
