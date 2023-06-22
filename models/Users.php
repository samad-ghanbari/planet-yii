<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $national_id
 * @property int $province_id
 * @property int $office_id
 * @property int $default_area
 * @property string $password
 * @property Provinces $province
 * @property Offices $office
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lastname', 'national_id', 'province_id', 'office_id', 'default_area', 'password'], 'required'],
            [['province_id', 'office_id', 'default_area'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['lastname'], 'string', 'max' => 200],
            [['national_id'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 512],
            [['national_id'], 'unique'],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offices::className(), 'targetAttribute' => ['office_id' => 'id']],
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
            'office_id' => 'Office ID',
            'default_area' => 'Default Area',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[Office]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Offices::className(), ['id' => 'office_id']);
    }
}
