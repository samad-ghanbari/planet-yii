<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchases".
 *
 * @property int $id
 * @property int $province_id
 * @property int $office_id
 * @property string $abbr
 * @property string $purchase
 *
 * @property Provinces $province
 * @property Offices $office
 */
class Purchases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id', 'office_id', 'abbr', 'purchase'], 'required'],
            [['province_id', 'office_id'], 'integer'],
            [['abbr'], 'string', 'max' => 10],
            [['purchase'], 'string', 'max' => 200],
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
            'province_id' => 'Province ID',
            'office_id' => 'Office ID',
            'abbr' => 'Abbr',
            'purchase' => 'Purchase',
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
