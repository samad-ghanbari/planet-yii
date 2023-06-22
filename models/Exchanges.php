<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exchanges".
 *
 * @property int $id
 * @property int $province_id
 * @property int $office_id
 * @property int $area
 * @property string $name
 * @property string $abbr
 * @property int $type 1:kol;2:exch;3:site
 * @property int|null $mother_id
 * @property int|null $uplink_id
 * @property int|null $site_cascade
 * @property int|null $site_node
 * @property float $site_top px
 * @property float $site_left px
 * @property string $address
 *
 * @property Provinces $province
 * @property Offices $office
 * @property Saloons[] $saloons
 */
class Exchanges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exchanges';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id', 'office_id', 'area', 'name', 'abbr', 'type', 'address'], 'required'],
            [['province_id', 'office_id', 'area', 'type', 'mother_id', 'uplink_id', 'site_cascade', 'site_node'], 'integer'],
            [['site_top', 'site_left'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['abbr'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 200],
            [['province_id', 'office_id', 'area', 'name', 'abbr', 'mother_id'], 'unique', 'targetAttribute' => ['province_id', 'office_id', 'area', 'name', 'abbr', 'mother_id']],
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
            'area' => 'Area',
            'name' => 'Name',
            'abbr' => 'Abbr',
            'type' => 'Type',
            'mother_id' => 'Mother ID',
            'uplink_id' => 'Uplink ID',
            'site_cascade' => 'Site Cascade',
            'site_node' => 'Site Node',
            'site_top' => 'Site Top',
            'site_left' => 'Site Left',
            'address' => 'Address',
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

    /**
     * Gets query for [[Saloons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaloons()
    {
        return $this->hasMany(Saloons::className(), ['exchange_id' => 'id']);
    }
}
